@extends('layouts.app')

@section('title', 'Daftar - SMKN 4 BOGOR')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 relative" style="background-image: url('{{ asset('storage/fotos/image.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-lg w-full relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-pink-primary to-pink-600 rounded-2xl shadow-xl mb-4 transform hover:scale-105 transition-transform">
                <img src="{{ asset('logo.png') }}" alt="SMKN 4 BOGOR" class="w-14 h-14 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <svg class="w-12 h-12 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Buat Akun Baru</h1>
            <p class="text-white/95 drop-shadow-md">Bergabunglah dengan komunitas SMKN 4 BOGOR</p>
        </div>
        
        <!-- Register Card -->
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
            
            <form action="{{ route('user.register') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Name Input -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Nama Lengkap
                        </div>
                    </label>
                    <input 
                        type="text" 
                        id="name" 
                        name="name" 
                        value="{{ old('name') }}" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                        placeholder="Masukkan nama lengkap Anda"
                        required
                    >
                </div>
                
                <!-- Username Input -->
                <div>
                    <label for="username" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                            Username
                        </div>
                    </label>
                    <input 
                        type="text" 
                        id="username" 
                        name="username" 
                        value="{{ old('username') }}" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                        placeholder="Pilih username unik Anda"
                        required
                    >
                    <p class="mt-1 text-xs text-gray-500">Username hanya boleh mengandung huruf, angka, dan underscore</p>
                </div>
                
                <!-- Email Input -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                            Email
                        </div>
                    </label>
                    <input 
                        type="email" 
                        id="email" 
                        name="email" 
                        value="{{ old('email') }}" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                        placeholder="nama@email.com"
                        required
                    >
                </div>
                
                <!-- Phone Input (Optional) -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            Nomor HP <span class="text-gray-400 font-normal">(Opsional)</span>
                        </div>
                    </label>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        value="{{ old('phone') }}" 
                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                        placeholder="08xx xxxx xxxx"
                    >
                </div>
                
                <!-- Password Input -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            Password
                        </div>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                            placeholder="Minimal 6 karakter"
                            required
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password', 'toggle-password')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-pink-primary transition-colors"
                        >
                            <svg id="toggle-password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="toggle-password-eye-off" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                    <p class="mt-1 text-xs text-gray-500">Minimal 6 karakter</p>
                </div>
                
                <!-- Confirm Password Input -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                            Konfirmasi Password
                        </div>
                    </label>
                    <div class="relative">
                        <input 
                            type="password" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            class="w-full px-4 py-3 pr-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                            placeholder="Ulangi password Anda"
                            required
                        >
                        <button 
                            type="button" 
                            onclick="togglePassword('password_confirmation', 'toggle-confirm-password')"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-pink-primary transition-colors"
                        >
                            <svg id="toggle-confirm-password-eye" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="toggle-confirm-password-eye-off" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full px-6 py-4 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 flex items-center justify-center space-x-2 mt-8 ring-2 ring-white/20"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    <span>Daftar Sekarang</span>
                </button>
            </form>
            
            <!-- Divider -->
            <div class="relative my-8">
                <div class="absolute inset-0 flex items-center">
                    <div class="w-full border-t border-gray-200"></div>
                </div>
                <div class="relative flex justify-center text-sm">
                    <span class="px-4 bg-white text-gray-500">Atau</span>
                </div>
            </div>
            
            <!-- Login Link -->
            <div class="text-center">
                <p class="text-gray-600 mb-4">Sudah punya akun?</p>
                <a 
                    href="{{ route('user.login') }}" 
                    class="inline-flex items-center px-6 py-3 border-2 border-pink-600 text-pink-600 font-bold rounded-xl hover:bg-pink-600 hover:text-white transition-all duration-200 transform hover:scale-105 shadow hover:shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                    </svg>
                    Masuk ke Akun
                </a>
            </div>
        </div>
        
        <!-- Back to Home -->
        <div class="mt-6 text-center">
            <a href="{{ route('guest.home') }}" class="inline-flex items-center text-white/90 hover:text-white transition-colors text-sm font-medium drop-shadow-md">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali ke Beranda
            </a>
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
function togglePassword(inputId, toggleId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(toggleId + '-eye');
    const eyeOffIcon = document.getElementById(toggleId + '-eye-off');
    
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.add('hidden');
        eyeOffIcon.classList.remove('hidden');
    } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('hidden');
        eyeOffIcon.classList.add('hidden');
    }
}
</script>
@endpush
@endsection
