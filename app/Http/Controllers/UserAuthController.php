<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Services\BrevoMailService;
use Carbon\Carbon;

class UserAuthController extends Controller
{
    public function showRegisterForm()
    {
        // Check if user is already logged in
        if (Auth::guard('user')->check()) {
            return redirect()->route('guest.home');
        }
        
        return view('user.register');
    }

    public function register(Request $request)
    {
        // Validate first
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'username.required' => 'Username wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        // Normalize input: trim whitespace and lowercase email
        $email = strtolower(trim($request->email));
        $username = trim($request->username);
        
        // Check uniqueness with normalized values
        if (User::where('username', $username)->exists()) {
            return back()->withErrors(['username' => 'Username sudah digunakan.'])->withInput();
        }
        
        if (User::where('email', $email)->exists()) {
            return back()->withErrors(['email' => 'Email sudah terdaftar.'])->withInput();
        }

        // Generate OTP
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        
        // Simpan data user di session (belum disimpan ke database)
        session([
            'pending_registration' => [
                'name' => trim($request->name),
                'username' => $username,
                'email' => $email,
                'phone' => $request->phone ? trim($request->phone) : null,
                'password' => $request->password, // akan dihash saat simpan ke database
                'otp_code' => $otp,
                'otp_expires_at' => Carbon::now()->addMinutes(10)->toDateTimeString(),
            ]
        ]);

        // Kirim OTP via email menggunakan Brevo
        try {
            $brevoService = new BrevoMailService();
            $sent = $brevoService->sendOtpEmail($email, $otp);
            if (!$sent) {
                Log::warning('BrevoMailService returned false for register OTP', [
                    'email' => $email
                ]);
                return back()->withErrors(['email' => 'Gagal mengirim email OTP. Silakan coba lagi atau hubungi admin.'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Exception when sending register OTP email', [
                'email' => $email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['email' => 'Gagal mengirim email OTP. Silakan coba lagi atau hubungi admin.'])->withInput();
        }

        return redirect()->route('user.otp')->with('status', 'Kode OTP telah dikirim. Silakan cek email Anda.');
    }

    public function showOtpForm(Request $request)
    {
        // Check if there's pending registration or existing user OTP
        if (!session('pending_registration') && !session('otp_user_id')) {
            return redirect()->route('user.register');
        }
        
        $pendingRegistration = session('pending_registration');
        $email = $pendingRegistration['email'] ?? null;
        if (!$email && session('otp_user_id')) {
            $user = User::find(session('otp_user_id'));
            $email = $user->email ?? null;
        }
        
        return view('user.otp', compact('email'));
    }

    public function verifyOtp(Request $request)
    {
        // Handle OTP input from separate inputs (otp0, otp1, etc.) or single input (otp)
        $otpValue = $request->input('otp');
        if (!$otpValue) {
            // Try to get from separate inputs
            $otpParts = [];
            for ($i = 0; $i < 6; $i++) {
                $part = $request->input("otp{$i}");
                if ($part) {
                    $otpParts[] = $part;
                }
            }
            $otpValue = implode('', $otpParts);
        }
        
        $request->merge(['otp' => $otpValue]);
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $pendingRegistration = session('pending_registration');
        $userId = session('otp_user_id');
        
        // Handle new registration (data belum di database)
        if ($pendingRegistration) {
            // Check OTP expiry
            $otpExpiresAt = Carbon::parse($pendingRegistration['otp_expires_at']);
            if (Carbon::now()->greaterThan($otpExpiresAt)) {
                session()->forget('pending_registration');
                return redirect()->route('user.register')->withErrors(['otp' => 'OTP kedaluwarsa. Silakan daftar ulang.']);
            }

            // Verify OTP
            if ($request->otp !== $pendingRegistration['otp_code']) {
                return redirect()->route('user.otp')->withErrors(['otp' => 'OTP tidak valid.']);
            }

            // OTP valid, simpan user ke database
            try {
                $user = User::create([
                    'name' => $pendingRegistration['name'],
                    'username' => $pendingRegistration['username'],
                    'email' => $pendingRegistration['email'],
                    'phone' => $pendingRegistration['phone'],
                    'password' => $pendingRegistration['password'], // hashed by model cast
                    'is_verified' => true,
                    'email_verified_at' => Carbon::now(),
                ]);
            } catch (\Exception $e) {
                Log::error('User registration error during OTP verification: ' . $e->getMessage());
                session()->forget('pending_registration');
                return redirect()->route('user.register')->withErrors(['email' => 'Terjadi kesalahan saat menyimpan data. Silakan daftar ulang.']);
            }

            // Bersihkan sesi dan login user
            session()->forget('pending_registration');
            Auth::guard('user')->login($user);

            return redirect()->route('guest.home')->with('status', 'Akun berhasil dibuat dan diverifikasi.');
        }
        
        // Handle existing user OTP verification (untuk unverified users)
        if ($userId) {
            $user = User::find($userId);
            if (!$user) {
                session()->forget('otp_user_id');
                return redirect()->route('user.register')->withErrors(['otp' => 'Sesi OTP berakhir. Silakan daftar ulang.']);
            }

            if (!$user->otp_code || !$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
                return redirect()->route('user.otp')->withErrors(['otp' => 'OTP kedaluwarsa. Silakan kirim ulang.']);
            }

            if ($request->otp !== $user->otp_code) {
                return redirect()->route('user.otp')->withErrors(['otp' => 'OTP tidak valid.']);
            }

            // Verifikasi berhasil
            $user->is_verified = true;
            if ($user->email && !$user->email_verified_at) {
                $user->email_verified_at = Carbon::now();
            }
            $user->otp_code = null;
            $user->otp_expires_at = null;
            $user->save();

            // Bersihkan sesi OTP dan login user
            session()->forget('otp_user_id');
            Auth::guard('user')->login($user);

            return redirect()->route('guest.home')->with('status', 'Akun berhasil diverifikasi.');
        }

        return redirect()->route('user.register')->withErrors(['otp' => 'Sesi OTP berakhir. Silakan daftar ulang.']);
    }

    public function resendOtp(Request $request)
    {
        $pendingRegistration = session('pending_registration');
        $userId = session('otp_user_id');
        
        // Generate new OTP
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $email = null;
        
        // Handle new registration (data belum di database)
        if ($pendingRegistration) {
            // Update OTP in session
            $pendingRegistration['otp_code'] = $otp;
            $pendingRegistration['otp_expires_at'] = Carbon::now()->addMinutes(10)->toDateTimeString();
            session(['pending_registration' => $pendingRegistration]);
            $email = $pendingRegistration['email'];
        } 
        // Handle existing user (data sudah di database)
        elseif ($userId) {
            $user = User::find($userId);
            if (!$user) {
                return redirect()->route('user.register');
            }
            $user->otp_code = $otp;
            $user->otp_expires_at = Carbon::now()->addMinutes(10);
            $user->save();
            $email = $user->email;
        } else {
            return redirect()->route('user.register');
        }

        // Send OTP via email menggunakan Brevo
        if ($email) {
            try {
                $brevoService = new BrevoMailService();
                $sent = $brevoService->sendOtpEmail($email, $otp);
                if (!$sent) {
                    Log::warning('BrevoMailService returned false for resend OTP', [
                        'email' => $email
                    ]);
                    return redirect()->route('user.otp')->withErrors(['otp' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.']);
                }
            } catch (\Exception $e) {
                Log::error('Exception when resending OTP email', [
                    'email' => $email,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                return redirect()->route('user.otp')->withErrors(['otp' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.']);
            }
        }

        return redirect()->route('user.otp')->with('status', 'OTP baru telah dikirim.');
    }

    public function showLoginForm()
    {
        if (Auth::guard('user')->check()) {
            return redirect()->route('guest.home');
        }
        return view('user.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'identity' => 'required|string',
            'password' => 'required|string',
        ]);

        // Normalize identity input
        $identity = trim($request->identity);
        if (empty($identity)) {
            return back()->withErrors(['identity' => 'Email, username, atau nomor HP wajib diisi.'])->withInput();
        }
        
        $identityLower = strtolower($identity);
        
        // Check if identity looks like an email
        $isEmail = filter_var($identityLower, FILTER_VALIDATE_EMAIL);
        
        // Query user based on identity type
        if ($isEmail) {
            $user = User::where('email', $identityLower)->first();
        } else {
            // Try username first, then phone
            $user = User::where('username', $identity)->first();
            if (!$user && !empty($identity)) {
                $user = User::where('phone', $identity)->first();
            }
        }

        if (!$user) {
            return back()->withErrors(['identity' => 'Akun tidak ditemukan.'])->withInput();
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors(['password' => 'Password salah.'])->withInput();
        }

        if (!$user->is_verified) {
            session(['otp_user_id' => $user->id]);
            return redirect()->route('user.otp')->withErrors(['otp' => 'Akun belum diverifikasi. Silakan masukkan OTP.']);
        }

        Auth::guard('user')->login($user);
        return redirect()->intended(route('guest.home'));
    }

    public function logout(Request $request)
    {
        Auth::guard('user')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('guest.home');
    }

    public function showForgotPasswordForm()
    {
        return view('user.forgot-password');
    }

    public function sendResetOtp(Request $request)
    {
        // Normalize email input
        $email = strtolower(trim($request->email));
        $request->merge(['email' => $email]);
        
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.exists' => 'Email tidak terdaftar.',
        ]);

        $user = User::where('email', $email)->first();
        
        // Generate OTP
        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Simpan session dulu
        session(['reset_password_user_id' => $user->id]);

        // Send OTP via email menggunakan Brevo
        try {
            $brevoService = new BrevoMailService();
            $sent = $brevoService->sendResetPasswordOtpEmail($user->email, $otp);
            if (!$sent) {
                Log::warning('BrevoMailService returned false for reset password OTP', [
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);
                return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.'])->withInput();
            }
        } catch (\Exception $e) {
            Log::error('Exception when sending reset password OTP email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return back()->withErrors(['email' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.'])->withInput();
        }

        return redirect()->route('user.reset-password-otp')->with('status', 'Kode OTP telah dikirim ke email Anda.');
    }

    public function showResetPasswordOtpForm()
    {
        if (!session('reset_password_user_id')) {
            return redirect()->route('user.forgot-password');
        }
        return view('user.reset-password-otp');
    }

    public function verifyResetOtp(Request $request)
    {
        // Handle OTP input from separate inputs (otp0, otp1, etc.) or single input (otp)
        $otpValue = $request->input('otp');
        if (!$otpValue) {
            // Try to get from separate inputs
            $otpParts = [];
            for ($i = 0; $i < 6; $i++) {
                $part = $request->input("otp{$i}");
                if ($part) {
                    $otpParts[] = $part;
                }
            }
            $otpValue = implode('', $otpParts);
        }
        
        $request->merge(['otp' => $otpValue]);
        $request->validate([
            'otp' => 'required|string|size:6',
        ]);

        $userId = session('reset_password_user_id');
        $user = $userId ? User::find($userId) : null;
        
        if (!$user) {
            return redirect()->route('user.forgot-password')->withErrors(['otp' => 'Sesi berakhir. Silakan kirim ulang OTP.']);
        }

        if (!$user->otp_code || !$user->otp_expires_at || Carbon::now()->greaterThan($user->otp_expires_at)) {
            return redirect()->route('user.reset-password-otp')->withErrors(['otp' => 'OTP kedaluwarsa. Silakan kirim ulang.']);
        }

        if ($request->otp !== $user->otp_code) {
            return redirect()->route('user.reset-password-otp')->withErrors(['otp' => 'OTP tidak valid.']);
        }

        // OTP valid, redirect to reset password form
        session(['reset_password_verified' => true]);
        return redirect()->route('user.reset-password-form');
    }

    public function showResetPasswordForm()
    {
        if (!session('reset_password_verified') || !session('reset_password_user_id')) {
            return redirect()->route('user.forgot-password');
        }
        return view('user.reset-password');
    }

    public function resetPassword(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $userId = session('reset_password_user_id');
        $user = $userId ? User::find($userId) : null;
        
        if (!$user || !session('reset_password_verified')) {
            return redirect()->route('user.forgot-password');
        }

        // Update password
        $user->password = $request->password; // Will be hashed by model
        $user->otp_code = null;
        $user->otp_expires_at = null;
        $user->save();

        // Clear session
        session()->forget(['reset_password_user_id', 'reset_password_verified']);

        return redirect()->route('user.login')->with('status', 'Password berhasil diubah. Silakan login dengan password baru.');
    }

    public function resendResetOtp()
    {
        $userId = session('reset_password_user_id');
        $user = $userId ? User::find($userId) : null;
        
        if (!$user) {
            return redirect()->route('user.forgot-password');
        }

        $otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $user->otp_code = $otp;
        $user->otp_expires_at = Carbon::now()->addMinutes(10);
        $user->save();

        // Send OTP via email menggunakan Brevo
        try {
            $brevoService = new BrevoMailService();
            $sent = $brevoService->sendResetPasswordOtpEmail($user->email, $otp);
            if (!$sent) {
                Log::warning('BrevoMailService returned false for resend reset password OTP', [
                    'user_id' => $user->id,
                    'email' => $user->email
                ]);
                return redirect()->route('user.reset-password-otp')->withErrors(['otp' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.']);
            }
        } catch (\Exception $e) {
            Log::error('Exception when resending reset password OTP email', [
                'user_id' => $user->id,
                'email' => $user->email,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('user.reset-password-otp')->withErrors(['otp' => 'Gagal mengirim email. Silakan coba lagi atau hubungi admin.']);
        }

        return redirect()->route('user.reset-password-otp')->with('status', 'OTP baru telah dikirim.');
    }
}
