@extends('layouts.app')

@section('title', 'Login - SMKN 4 BOGOR')

@section('content')
<section class="min-h-screen flex items-center justify-center py-12 px-4 relative" style="background-image: url('{{ asset('storage/fotos/image.png') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="absolute inset-0 bg-black/50"></div>
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-96 h-96 bg-pink-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob"></div>
        <div class="absolute top-0 right-0 w-96 h-96 bg-purple-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-8 left-20 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-blob animation-delay-4000"></div>
    </div>
    
    <div class="max-w-md w-full relative z-10">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-br from-pink-primary to-pink-600 rounded-2xl shadow-xl mb-4 transform hover:scale-105 transition-transform">
                <img src="{{ asset('logo.png') }}" alt="SMKN 4 BOGOR" class="w-14 h-14 object-contain" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                <svg class="w-12 h-12 text-white hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
            </div>
            <h1 class="text-4xl font-bold text-white mb-2 drop-shadow-lg">Selamat Datang</h1>
            <p class="text-white/95 drop-shadow-md">Masuk ke akun Anda untuk melanjutkan</p>
        </div>
        
        <!-- Login Card -->
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
            
            <form action="{{ route('user.login') }}" method="POST" class="space-y-6">
                @csrf
                
                <!-- Email/Username Input -->
                <div>
                    <label for="identity" class="block text-sm font-semibold text-gray-700 mb-2">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-pink-primary mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Email, Username, atau Nomor HP
                        </div>
                    </label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="identity" 
                            name="identity" 
                            value="{{ old('identity') }}" 
                            class="w-full px-4 py-3 pl-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                            placeholder="Masukkan email atau username Anda"
                            required 
                            autofocus
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                    </div>
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
                            class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-pink-primary transition-all duration-200 bg-gray-50 focus:bg-white" 
                            placeholder="Masukkan password Anda"
                            required
                        >
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <button 
                            type="button" 
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-0 pr-4 flex items-center text-gray-400 hover:text-pink-primary transition-colors"
                        >
                            <svg id="eye-icon" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            <svg id="eye-off-icon" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 5.411m0 0L21 21" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <!-- Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input 
                            type="checkbox" 
                            id="remember" 
                            name="remember" 
                            class="w-4 h-4 text-pink-primary border-gray-300 rounded focus:ring-pink-primary"
                        >
                        <label for="remember" class="ml-2 text-sm text-gray-600">Ingat saya</label>
                    </div>
                    <a href="{{ route('user.forgot-password') }}" class="text-sm font-medium text-pink-primary hover:text-pink-dark transition-colors">
                        Lupa password?
                    </a>
                </div>
                
                <!-- Submit Button -->
                <button 
                    type="submit" 
                    class="w-full px-6 py-4 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-[1.02] transition-all duration-200 flex items-center justify-center space-x-2 ring-2 ring-white/20"
                >
                    <span>Masuk</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
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
            
            <!-- Register Link -->
            <div class="text-center">
                <p class="text-gray-600 mb-4">Belum punya akun?</p>
                <a 
                    href="{{ route('user.register') }}" 
                    class="inline-flex items-center px-6 py-3 border-2 border-pink-600 text-pink-600 font-bold rounded-xl hover:bg-pink-600 hover:text-white transition-all duration-200 transform hover:scale-105 shadow hover:shadow-lg"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                    Daftar Sekarang
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
function togglePassword() {
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon');
    const eyeOffIcon = document.getElementById('eye-off-icon');
    
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
