@php
    $user = Auth::guard('user')->user();
    $admin = Auth::guard('admin')->user();
@endphp

<nav class="bg-white shadow-md sticky top-0 z-50 border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <a href="{{ route('guest.home') }}" class="flex items-center space-x-3 group">
                <img src="{{ asset('logo.png') }}" alt="SMKN 4 BOGOR" class="h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="h-12 w-12 bg-pink-primary rounded-lg hidden items-center justify-center text-white font-bold text-xl">
                    S4
                </div>
                <div class="hidden sm:block relative h-7 overflow-hidden w-48">
                    <span id="navbar-text" class="text-xl font-bold text-gray-900 block whitespace-nowrap animate-slide-in-from-logo">
                        Website Gallery
                    </span>
                </div>
            </a>
            
            <!-- Desktop Menu -->
            <div class="hidden md:flex items-center space-x-1">
                <a href="{{ route('guest.home') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Beranda</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('guest.profil') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Profil</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('guest.agenda') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Agenda</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('guest.informasi') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Informasi</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('guest.galeri') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Galeri</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                <a href="{{ route('guest.kontak') }}" 
                   class="nav-link relative px-4 py-2 text-gray-700 font-medium rounded-lg transition-all duration-300 hover:text-pink-primary hover:bg-pink-50 group">
                    <span class="relative z-10">Kontak</span>
                    <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-pink-primary transition-all duration-300 group-hover:w-full"></span>
                </a>
                
                <div class="ml-4 pl-4 border-l border-gray-200 flex items-center space-x-2">
                    @auth('user')
                        <a href="{{ route('user.profile') }}" 
                           class="px-4 py-2 text-sm text-gray-700 font-medium rounded-lg border border-gray-200 hover:border-pink-primary hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                            Profil Saya
                        </a>
                        <form action="{{ route('user.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 text-sm text-white font-medium rounded-lg bg-gray-600 hover:bg-gray-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Logout
                            </button>
                        </form>
                    @elseauth('admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="px-4 py-2 text-sm text-white font-medium rounded-lg bg-pink-primary hover:bg-pink-dark transition-all duration-300 shadow-sm hover:shadow-md">
                            Dashboard
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="px-4 py-2 text-sm text-white font-medium rounded-lg bg-gray-600 hover:bg-gray-700 transition-all duration-300 shadow-sm hover:shadow-md">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('user.login') }}" 
                           class="px-4 py-2 text-sm text-gray-700 font-medium rounded-lg border border-gray-300 hover:border-pink-primary hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                            Login
                        </a>
                        <a href="{{ route('user.register') }}" 
                           class="px-4 py-2 text-sm text-white font-medium rounded-lg bg-pink-primary hover:bg-pink-dark transition-all duration-300 shadow-sm hover:shadow-md transform hover:scale-105">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
            
            <!-- Mobile Menu Button -->
            <button id="mobile-menu-btn" class="md:hidden p-2 text-gray-700 rounded-lg hover:bg-gray-100 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
            </button>
        </div>
        
        <!-- Mobile Menu -->
        <div id="mobile-menu" class="hidden md:hidden pb-4 pt-2 border-t border-gray-100">
            <div class="space-y-1">
                <a href="{{ route('guest.home') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Beranda
                </a>
                <a href="{{ route('guest.profil') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Profil
                </a>
                <a href="{{ route('guest.agenda') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Agenda
                </a>
                <a href="{{ route('guest.informasi') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Informasi
                </a>
                <a href="{{ route('guest.galeri') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Galeri
                </a>
                <a href="{{ route('guest.kontak') }}" 
                   class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                    Kontak
                </a>
                
                <div class="pt-2 mt-2 border-t border-gray-200 space-y-1">
                    @auth('user')
                        <a href="{{ route('user.profile') }}" 
                           class="block px-4 py-2.5 text-gray-700 font-medium rounded-lg border border-gray-200 hover:border-pink-primary hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                            Profil Saya
                        </a>
                        <form action="{{ route('user.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2.5 text-white font-medium rounded-lg bg-gray-600 hover:bg-gray-700 transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    @elseauth('admin')
                        <a href="{{ route('admin.dashboard') }}" 
                           class="block px-4 py-2.5 text-white font-medium rounded-lg bg-pink-primary hover:bg-pink-dark transition-all duration-300">
                            Dashboard
                        </a>
                        <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" 
                                    class="w-full text-left px-4 py-2.5 text-white font-medium rounded-lg bg-gray-600 hover:bg-gray-700 transition-all duration-300">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('user.login') }}" 
                           class="block px-4 py-2.5 text-center text-gray-700 font-medium rounded-lg border border-gray-300 hover:border-pink-primary hover:text-pink-primary hover:bg-pink-50 transition-all duration-300">
                            Login
                        </a>
                        <a href="{{ route('user.register') }}" 
                           class="block px-4 py-2.5 text-center text-white font-medium rounded-lg bg-pink-primary hover:bg-pink-dark transition-all duration-300">
                            Daftar
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</nav>

<style>
    @keyframes slideInFromLogo {
        0% {
            transform: translateX(-120%);
            opacity: 0;
            filter: blur(4px);
        }
        50% {
            opacity: 0.8;
        }
        100% {
            transform: translateX(0);
            opacity: 1;
            filter: blur(0);
        }
    }

    @keyframes slideOutToRight {
        0% {
            transform: translateX(0);
            opacity: 1;
            filter: blur(0);
        }
        100% {
            transform: translateX(120%);
            opacity: 0;
            filter: blur(4px);
        }
    }

    @keyframes fadeIn {
        0% {
            opacity: 0;
        }
        100% {
            opacity: 1;
        }
    }

    .animate-slide-in-from-logo {
        animation: slideInFromLogo 0.8s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
    }

    .animate-slide-out {
        animation: slideOutToRight 0.5s cubic-bezier(0.55, 0.085, 0.68, 0.53) forwards;
    }

    .text-gradient-animated {
        background: linear-gradient(135deg, #ec4899 0%, #db2777 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        animation: fadeIn 0.3s ease-in;
    }
</style>

<script>
    document.getElementById('mobile-menu-btn')?.addEventListener('click', function() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });

    // Animated text in navbar
    document.addEventListener('DOMContentLoaded', function() {
        const navbarText = document.getElementById('navbar-text');
        if (!navbarText) return;

        const texts = [
            { text: 'Website Gallery', duration: 3500, class: '' },
            { text: 'SMKN 4 BOGOR', duration: 4500, class: 'text-gradient-animated' }
        ];

        let currentIndex = 0;

        function changeText() {
            // Slide out current text
            navbarText.classList.remove('animate-slide-in-from-logo', 'text-gradient-animated');
            navbarText.classList.add('animate-slide-out');

            setTimeout(() => {
                // Change text and add class if needed
                currentIndex = (currentIndex + 1) % texts.length;
                navbarText.textContent = texts[currentIndex].text;
                
                // Remove slide out and add slide in
                navbarText.classList.remove('animate-slide-out');
                
                // Add gradient class for SMKN 4 BOGOR
                if (texts[currentIndex].class) {
                    navbarText.classList.add(texts[currentIndex].class);
                }
                
                navbarText.classList.add('animate-slide-in-from-logo');

                // Schedule next change
                setTimeout(changeText, texts[currentIndex].duration);
            }, 500); // Wait for slide out animation to complete
        }

        // Start animation after initial display (let first text show for 3.5s)
        setTimeout(changeText, texts[0].duration);
    });
</script>
