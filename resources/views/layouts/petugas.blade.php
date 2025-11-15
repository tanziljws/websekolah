<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Petugas Dashboard - Web Galeri Sekolah')</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        :root {
            --primary-pink: #ec4899;
            --primary-pink-light: #fce7f3;
            --primary-pink-dark: #db2777;
        }
        
        .bg-pink-primary { background-color: var(--primary-pink); }
        .bg-pink-light { background-color: var(--primary-pink-light); }
        .text-pink-primary { color: var(--primary-pink); }
        .border-pink-primary { border-color: var(--primary-pink); }
        .hover\:bg-pink-dark:hover { background-color: var(--primary-pink-dark); }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Petugas Panel</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('petugas.dashboard') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-light hover:text-pink-primary transition {{ request()->routeIs('petugas.dashboard') ? 'bg-pink-light text-pink-primary border-r-4 border-pink-primary' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('petugas.posts.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-light hover:text-pink-primary transition {{ request()->routeIs('petugas.posts.*') ? 'bg-pink-light text-pink-primary border-r-4 border-pink-primary' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Posts
                </a>
                <a href="{{ route('petugas.galery.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-light hover:text-pink-primary transition {{ request()->routeIs('petugas.galery.*') ? 'bg-pink-light text-pink-primary border-r-4 border-pink-primary' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Galeri
                </a>
                <a href="{{ route('petugas.foto.index') }}" class="flex items-center px-6 py-3 text-gray-700 hover:bg-pink-light hover:text-pink-primary transition {{ request()->routeIs('petugas.foto.*') ? 'bg-pink-light text-pink-primary border-r-4 border-pink-primary' : '' }}">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    Foto
                </a>
            </nav>
            <div class="absolute bottom-0 w-64 p-6 border-t border-gray-200">
                <form action="{{ route('petugas.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-6 py-3 text-gray-700 hover:bg-pink-light hover:text-pink-primary transition">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </aside>
        
        <main class="flex-1 overflow-y-auto">
            <header class="bg-white shadow-md px-6 py-4">
                <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
            </header>
            
            <div class="p-6">
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
                @endif
                
                @if(session('error'))
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    {{ session('error') }}
                </div>
                @endif
                
                @yield('content')
            </div>
        </main>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
