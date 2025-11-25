# 📧 Dokumentasi Logika Send Email (Brevo)

## 📋 Daftar Isi
1. [Overview](#overview)
2. [Konfigurasi](#konfigurasi)
3. [Alur Registration OTP](#alur-registration-otp)
4. [Alur Reset Password OTP](#alur-reset-password-otp)
5. [BrevoMailService](#brevomailservice)
6. [Email Templates](#email-templates)
7. [Troubleshooting](#troubleshooting)

---

## 🎯 Overview

Aplikasi ini menggunakan **Brevo (sebelumnya Sendinblue)** sebagai email service untuk mengirim OTP (One-Time Password) via API. Email dikirim untuk:
- ✅ **Registration OTP**: Verifikasi email saat registrasi
- ✅ **Reset Password OTP**: Verifikasi saat reset password

### Teknologi yang Digunakan:
- **Brevo API v3**: REST API untuk mengirim email
- **Laravel HTTP Client**: Untuk request ke Brevo API
- **Blade Templates**: Template email HTML

---

## ⚙️ Konfigurasi

### 1. Environment Variables (`.env`)

```env
# Brevo API Configuration
BREVO_API_KEY=xkeysib-xxxxxxxxxxxxxxxxxxxxxxxxxxxxx

# Email From Configuration
MAIL_FROM_ADDRESS=noreply@smkn4bogor.sch.id
MAIL_FROM_NAME="SMKN 4 BOGOR"
```

### 2. Config Files

**`config/services.php`:**
```php
'brevo' => [
    'key' => env('BREVO_API_KEY'),
],
```

**`config/mail.php`:**
```php
'from' => [
    'address' => env('MAIL_FROM_ADDRESS', 'hello@example.com'),
    'name' => env('MAIL_FROM_NAME', 'Example'),
],
```

---

## 📝 Alur Registration OTP

### Flow Diagram:

```
User Register
    ↓
1. Validasi Input (name, username, email, password)
    ↓
2. Cek Uniqueness (username & email)
    ↓
3. Generate OTP (6 digit random)
    ↓
4. Simpan Data di Session (BUKAN database!)
   └─> pending_registration = {
        name, username, email, password, 
        otp_code, otp_expires_at (10 menit)
       }
    ↓
5. Kirim OTP via Email (BrevoMailService)
    ↓
6. Redirect ke Halaman OTP
    ↓
User Masukkan OTP
    ↓
7. Verify OTP
    ↓
8. OTP Valid? 
    ├─> YES: Simpan User ke Database + Login
    └─> NO: Tampilkan Error, User Input Ulang
```

### Detail Step-by-Step:

#### **Step 1-2: Validasi & Cek Uniqueness**
**File**: `app/Http/Controllers/UserAuthController.php` → `register()`

```php
// Validasi form
$request->validate([
    'name' => 'required|string|max:255',
    'username' => 'required|string|max:50',
    'email' => 'required|email',
    'password' => 'required|string|min:6|confirmed',
]);

// Normalize email (lowercase, trim)
$email = strtolower(trim($request->email));

// Cek apakah username/email sudah ada
if (User::where('username', $username)->exists()) {
    return back()->withErrors(['username' => 'Username sudah digunakan.']);
}
```

#### **Step 3: Generate OTP**
```php
// Generate 6 digit OTP (000000 - 999999)
$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);
// Contoh: "123456", "000789", "999999"
```

#### **Step 4: Simpan di Session**
```php
// Data TIDAK disimpan ke database dulu!
session([
    'pending_registration' => [
        'name' => trim($request->name),
        'username' => $username,
        'email' => $email,
        'password' => $request->password, // akan dihash saat simpan
        'otp_code' => $otp,
        'otp_expires_at' => Carbon::now()->addMinutes(10)->toDateTimeString(),
    ]
]);
```

**Mengapa Session?**
- ✅ Data user belum diverifikasi, jadi belum aman untuk disimpan
- ✅ Jika OTP tidak di-verify, data tidak terbuang di database
- ✅ Lebih secure: hanya user yang punya akses email yang bisa verify

#### **Step 5: Kirim Email via Brevo**

**File**: `app/Http/Controllers/UserAuthController.php` → `register()`

```php
try {
    $brevoService = new BrevoMailService();
    $sent = $brevoService->sendOtpEmail($email, $otp);
    
    if (!$sent) {
        return back()->withErrors(['email' => 'Gagal mengirim email OTP.']);
    }
} catch (\Exception $e) {
    // Log error dan tampilkan error ke user
}
```

**File**: `app/Services/BrevoMailService.php` → `sendOtpEmail()`

```php
public function sendOtpEmail(string $to, string $otp): bool
{
    // 1. Render email template (Blade)
    $html = View::make('emails.otp', ['otp' => $otp])->render();
    
    // 2. Get from address & name dari config
    $fromName = config('mail.from.name', 'SMKN 4 BOGOR');
    $fromAddress = config('mail.from.address');
    
    // 3. Prepare HTTP Request ke Brevo API
    $response = Http::withHeaders([
        'api-key' => $this->apiKey, // BREVO_API_KEY
        'Content-Type' => 'application/json',
    ])->post('https://api.brevo.com/v3/smtp/email', [
        'sender' => [
            'name' => $fromName,
            'email' => $fromAddress,
        ],
        'to' => [
            ['email' => $to]
        ],
        'subject' => 'Kode OTP Verifikasi Akun Anda',
        'htmlContent' => $html, // HTML email body
    ]);
    
    // 4. Return true jika berhasil
    return $response->successful();
}
```

**Brevo API Request Structure:**
```json
POST https://api.brevo.com/v3/smtp/email
Headers:
  - api-key: xkeysib-xxxxxxxxxx
  - Content-Type: application/json

Body:
{
  "sender": {
    "name": "SMKN 4 BOGOR",
    "email": "noreply@smkn4bogor.sch.id"
  },
  "to": [
    {
      "email": "user@example.com"
    }
  ],
  "subject": "Kode OTP Verifikasi Akun Anda",
  "htmlContent": "<html>...</html>"
}
```

#### **Step 7-8: Verify OTP**

**File**: `app/Http/Controllers/UserAuthController.php` → `verifyOtp()`

```php
// Ambil data dari session
$pendingRegistration = session('pending_registration');

// 1. Cek OTP Expiry (10 menit)
$otpExpiresAt = Carbon::parse($pendingRegistration['otp_expires_at']);
if (Carbon::now()->greaterThan($otpExpiresAt)) {
    return redirect()->route('user.register')
        ->withErrors(['otp' => 'OTP kedaluwarsa.']);
}

// 2. Verify OTP
if ($request->otp !== $pendingRegistration['otp_code']) {
    return redirect()->route('user.otp')
        ->withErrors(['otp' => 'OTP tidak valid.']);
}

// 3. OTP Valid! Simpan User ke Database
$user = User::create([
    'name' => $pendingRegistration['name'],
    'username' => $pendingRegistration['username'],
    'email' => $pendingRegistration['email'],
    'password' => $pendingRegistration['password'], // auto-hashed
    'is_verified' => true,
    'email_verified_at' => Carbon::now(),
]);

// 4. Bersihkan session dan login
session()->forget('pending_registration');
Auth::guard('user')->login($user);

return redirect()->route('guest.home')
    ->with('status', 'Akun berhasil dibuat.');
```

---

## 🔐 Alur Reset Password OTP

### Flow Diagram:

```
User Request Reset Password
    ↓
1. Validasi Email (harus terdaftar)
    ↓
2. Cari User by Email
    ↓
3. Generate OTP (6 digit random)
    ↓
4. Simpan OTP ke Database
   └─> user.otp_code = "123456"
   └─> user.otp_expires_at = now() + 10 menit
    ↓
5. Simpan User ID di Session
   └─> reset_password_user_id = user.id
    ↓
6. Kirim OTP via Email (BrevoMailService)
    ↓
7. Redirect ke Halaman Verify OTP
    ↓
User Masukkan OTP
    ↓
8. Verify OTP
    ↓
9. OTP Valid?
    ├─> YES: Set Session "verified" → Redirect ke Form Reset Password
    └─> NO: Tampilkan Error
    ↓
User Input Password Baru
    ↓
10. Update Password di Database
    ↓
11. Clear OTP & Session
    ↓
12. Redirect ke Login
```

### Detail Step-by-Step:

#### **Step 1-2: Validasi & Cari User**

**File**: `app/Http/Controllers/UserAuthController.php` → `sendResetOtp()`

```php
$request->validate([
    'email' => 'required|email|exists:users,email',
]);

$user = User::where('email', $email)->first();
```

#### **Step 3-4: Generate & Simpan OTP ke Database**

```php
// Generate OTP
$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);

// Simpan ke database (BUKAN session, karena user sudah ada!)
$user->otp_code = $otp;
$user->otp_expires_at = Carbon::now()->addMinutes(10);
$user->save();
```

**Perbedaan dengan Registration:**
- Registration: OTP disimpan di **session** (user belum ada di database)
- Reset Password: OTP disimpan di **database** (user sudah ada)

#### **Step 5-6: Session & Kirim Email**

```php
// Simpan user ID di session
session(['reset_password_user_id' => $user->id]);

// Kirim email
$brevoService = new BrevoMailService();
$sent = $brevoService->sendResetPasswordOtpEmail($user->email, $otp);
```

#### **Step 8-9: Verify OTP**

**File**: `app/Http/Controllers/UserAuthController.php` → `verifyResetOtp()`

```php
$userId = session('reset_password_user_id');
$user = User::find($userId);

// Cek expiry
if (Carbon::now()->greaterThan($user->otp_expires_at)) {
    return redirect()->route('user.reset-password-otp')
        ->withErrors(['otp' => 'OTP kedaluwarsa.']);
}

// Verify
if ($request->otp !== $user->otp_code) {
    return redirect()->route('user.reset-password-otp')
        ->withErrors(['otp' => 'OTP tidak valid.']);
}

// OTP Valid! Set session verified
session(['reset_password_verified' => true]);
return redirect()->route('user.reset-password-form');
```

#### **Step 10-12: Update Password**

**File**: `app/Http/Controllers/UserAuthController.php` → `resetPassword()`

```php
$request->validate([
    'password' => 'required|string|min:6|confirmed',
]);

$user = User::find(session('reset_password_user_id'));

// Update password (auto-hashed by model)
$user->password = $request->password;
$user->otp_code = null; // Clear OTP
$user->otp_expires_at = null;
$user->save();

// Clear session
session()->forget(['reset_password_user_id', 'reset_password_verified']);

return redirect()->route('user.login')
    ->with('status', 'Password berhasil diubah.');
```

---

## 🔧 BrevoMailService

### Class Structure:

```php
class BrevoMailService
{
    protected $apiKey;          // BREVO_API_KEY dari config
    protected $apiUrl = 'https://api.brevo.com/v3/smtp/email';

    public function __construct()
    {
        $this->apiKey = config('services.brevo.key');
    }

    // Method 1: Registration OTP
    public function sendOtpEmail(string $to, string $otp): bool

    // Method 2: Reset Password OTP
    public function sendResetPasswordOtpEmail(string $to, string $otp): bool
}
```

### Proses Send Email:

1. **Render Email Template**
   ```php
   $html = View::make('emails.otp', ['otp' => $otp])->render();
   ```
   - Menggunakan Blade template: `resources/views/emails/otp.blade.php`
   - Variable `$otp` di-pass ke template

2. **Get Config**
   ```php
   $fromName = config('mail.from.name');        // "SMKN 4 BOGOR"
   $fromAddress = config('mail.from.address');  // "noreply@smkn4bogor.sch.id"
   ```

3. **HTTP Request ke Brevo**
   ```php
   $response = Http::withHeaders([
       'api-key' => $this->apiKey,
       'Content-Type' => 'application/json',
   ])->post($this->apiUrl, [
       'sender' => ['name' => $fromName, 'email' => $fromAddress],
       'to' => [['email' => $to]],
       'subject' => '...',
       'htmlContent' => $html,
   ]);
   ```

4. **Handle Response**
   ```php
   if ($response->successful()) {
       Log::info('Email sent successfully');
       return true;
   } else {
       Log::error('Brevo API error', ['error' => $response->json()]);
       throw new Exception('Brevo API Error');
   }
   ```

### Error Handling:

- ✅ **Log semua error** ke `storage/logs/laravel.log`
- ✅ **Return false** jika gagal (bukan throw exception langsung)
- ✅ **User-friendly error message** di controller
- ✅ **Timeout 30 detik** untuk HTTP request

---

## 📧 Email Templates

### Location:
- `resources/views/emails/otp.blade.php` - Registration OTP
- `resources/views/emails/reset-password-otp.blade.php` - Reset Password OTP

### Structure:

```blade
<!DOCTYPE html>
<html>
<head>
    <style>
        /* CSS untuk email styling */
    </style>
</head>
<body>
    <div class="container">
        <div class="email-wrapper">
            <div class="email-header">
                <h1>Verifikasi Akun Anda</h1>
            </div>
            <div class="email-body">
                <p>Halo!</p>
                <p>Gunakan kode OTP di bawah ini:</p>
                
                <div class="otp-code">
                    <div class="code">{{ $otp }}</div>  <!-- Variable dari controller -->
                </div>
                
                <p>Kode ini akan kedaluwarsa dalam <strong>10 menit</strong>.</p>
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} SMKN 4 BOGOR.</p>
            </div>
        </div>
    </div>
</body>
</html>
```

### Variables yang Dikirim:
- `$otp`: 6 digit OTP code (contoh: "123456")

---

## 🐛 Troubleshooting

### Error: "Brevo API key not configured"
**Solusi:**
1. Pastikan `.env` ada `BREVO_API_KEY=...`
2. Run `php artisan config:clear`
3. Cek `config('services.brevo.key')` tidak null

### Error: "MAIL_FROM_ADDRESS tidak dikonfigurasi"
**Solusi:**
1. Set `MAIL_FROM_ADDRESS` di `.env`
2. Pastikan email sudah **diverifikasi** di Brevo dashboard
3. Gunakan email yang sama dengan yang diverifikasi

### Error: "Failed to send email" (API Error)
**Solusi:**
1. Cek logs: `storage/logs/laravel.log`
2. Pastikan API key valid di Brevo dashboard
3. Cek quota email Brevo (free tier: 300 email/hari)
4. Pastikan sender email sudah verified

### Email Terkirim Tapi Tidak Masuk Inbox
**Kemungkinan:**
- Email masuk **Spam/Junk folder**
- Brevo reputation masih rendah (baru setup)
- **Solusi**: Minta user cek spam, atau verify domain di Brevo

### OTP Tidak Valid Padahal Benar
**Kemungkinan:**
- OTP sudah expired (10 menit)
- Session expired/cleared
- **Solusi**: Request OTP baru

### Resend OTP Tidak Berfungsi
**File**: `app/Http/Controllers/UserAuthController.php` → `resendOtp()`

```php
// Generate OTP baru
$otp = str_pad((string)random_int(0, 999999), 6, '0', STR_PAD_LEFT);

// Update OTP di session (registration) atau database (existing user)
if ($pendingRegistration) {
    $pendingRegistration['otp_code'] = $otp;
    $pendingRegistration['otp_expires_at'] = Carbon::now()->addMinutes(10);
    session(['pending_registration' => $pendingRegistration]);
} else {
    $user->otp_code = $otp;
    $user->otp_expires_at = Carbon::now()->addMinutes(10);
    $user->save();
}

// Kirim email baru
$brevoService->sendOtpEmail($email, $otp);
```

---

## 📊 Summary Flow

### Registration:
```
User Input → Validate → Generate OTP → Session → Send Email (Brevo) 
→ Verify OTP → Save to DB → Login
```

### Reset Password:
```
User Input Email → Find User → Generate OTP → Save to DB → Send Email (Brevo)
→ Verify OTP → Update Password → Clear OTP → Login
```

### Key Points:
1. ✅ OTP disimpan di **session** untuk registration (user belum ada)
2. ✅ OTP disimpan di **database** untuk reset password (user sudah ada)
3. ✅ OTP expiry: **10 menit**
4. ✅ Email dikirim via **Brevo API v3**
5. ✅ Template email menggunakan **Blade**
6. ✅ Error handling dengan **logging**

---

## 📚 Referensi

- [Brevo API Documentation](https://developers.brevo.com/)
- [Laravel HTTP Client](https://laravel.com/docs/http-client)
- [Laravel Blade Templates](https://laravel.com/docs/blade)

---

**Last Updated**: {{ date('Y-m-d') }  
**Version**: 1.0

