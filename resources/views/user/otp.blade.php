@extends('layouts.app')

@section('title', 'Verifikasi OTP - SMKN 4 BOGOR')

@section('content')
<section class="min-h-screen flex items-center justify-center bg-gradient-to-br from-pink-50 via-white to-pink-50 py-12 px-4">
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-md w-full relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-pink-primary to-pink-600 rounded-2xl shadow-xl mb-4 transform hover:scale-105 transition-transform">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-gray-900 mb-2">Verifikasi OTP</h1>
            <p class="text-gray-600">
                @if(isset($email))
                    Kode OTP telah dikirim ke<br><strong class="text-pink-primary">{{ $email }}</strong>
                @else
                    Masukkan kode OTP yang telah dikirim ke email Anda
                @endif
            </p>
        </div>
        
        <!-- OTP Card -->
        <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-gray-100 p-8 md:p-10">
            @if($errors->any())
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded-xl">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h3 class="text-red-800 font-semibold mb-1">Perhatian</h3>
                        <ul class="text-sm text-red-700 space-y-1">
                            @foreach($errors->all() as $error)
                            <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            
            @if(session('status'))
            <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 rounded-xl">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="text-green-800 font-medium">{{ session('status') }}</p>
                </div>
            </div>
            @endif
            
            <form action="{{ route('user.otp.verify') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- OTP Input -->
                <div>
                    <label for="otp" class="block text-sm font-semibold text-gray-700 mb-3 text-center">
                        Masukkan Kode OTP (6 digit)
                    </label>
                    <div class="flex justify-center space-x-2">
                        @for($i = 0; $i < 6; $i++)
                        <input 
                            type="text" 
                            id="otp{{ $i }}" 
                            name="otp{{ $i }}" 
                            maxlength="1" 
                            pattern="[0-9]"
                            class="w-12 h-14 text-center text-2xl font-bold border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white otp-input"
                            required 
                            autocomplete="off"
                            @if($i === 0) autofocus @endif
                        >
                        @endfor
                    </div>
                    <input type="hidden" name="otp" id="otp-hidden">
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full px-6 py-4 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 flex items-center justify-center space-x-2 ring-2 ring-white/20"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Verifikasi</span>
                </button>
            </form>
            
            <!-- Resend OTP -->
            <form action="{{ route('user.otp.resend') }}" method="POST" class="mt-6 text-center">
                @csrf
                <p class="text-gray-600 text-sm mb-3">Tidak menerima kode?</p>
                <button 
                    type="submit" 
                    class="inline-flex items-center px-6 py-3 border-2 border-pink-600 text-pink-600 font-bold rounded-xl hover:bg-pink-600 hover:text-white transition-all duration-200 transform hover:scale-105 shadow hover:shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Kirim Ulang OTP
                </button>
            </form>
            
            <!-- Back to Register -->
            <div class="mt-6 text-center">
                <a href="{{ route('user.register') }}" class="inline-flex items-center text-gray-600 hover:text-pink-primary transition-colors text-sm font-medium">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Daftar
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    @keyframes blob {
        0%, 100% {
            transform: translate(0px, 0px) scale(1);
        }
        33% {
            transform: translate(30px, -50px) scale(1.1);
        }
        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Refresh CSRF token after page load to prevent 419 errors
    fetch('{{ route("user.otp") }}', {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    }).then(() => {
        // Token already refreshed via page reload
    });
    
    const inputs = document.querySelectorAll('.otp-input');
    const hiddenInput = document.getElementById('otp-hidden');
    
    // Update hidden input whenever any OTP input changes
    function updateHiddenInput() {
        let otpValue = '';
        inputs.forEach(input => {
            otpValue += input.value;
        });
        hiddenInput.value = otpValue;
    }
    
    inputs.forEach((input, index) => {
        // Move to next input on input
        input.addEventListener('input', function(e) {
            const value = e.target.value.replace(/[^0-9]/g, '');
            e.target.value = value;
            updateHiddenInput();
            
            if (value && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });
        
        // Move to previous input on backspace
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                inputs[index - 1].focus();
            }
        });
        
        // Paste OTP
        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const paste = (e.clipboardData || window.clipboardData).getData('text');
            const pasteValues = paste.replace(/[^0-9]/g, '').slice(0, 6);
            
            pasteValues.split('').forEach((char, i) => {
                if (inputs[i]) {
                    inputs[i].value = char;
                }
            });
            updateHiddenInput();
            
            if (pasteValues.length === 6) {
                inputs[5].focus();
            }
        });
    });
    
    // Initial update
    updateHiddenInput();
});
</script>
@endpush
@endsection
