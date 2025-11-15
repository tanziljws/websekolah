<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard - Web Galeri Sekolah')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-pink: #ec4899;
            --primary-pink-light: #fce7f3;
            --primary-pink-dark: #db2777;
        }
        
        .bg-pink-primary {
            background-color: var(--primary-pink);
        }
        
        .bg-pink-light {
            background-color: var(--primary-pink-light);
        }
        
        .text-pink-primary {
            color: var(--primary-pink);
        }
        
        .border-pink-primary {
            border-color: var(--primary-pink);
        }
        
        .hover\:bg-pink-dark:hover {
            background-color: var(--primary-pink-dark);
        }
        
        /* Sidebar Navigation Styles */
        .nav-menu-item {
            transition: all 0.2s ease;
        }
        
        .nav-menu-item:hover {
            transform: translateX(4px);
        }
        
        /* Scrollbar Styling */
        nav::-webkit-scrollbar {
            width: 6px;
        }
        
        nav::-webkit-scrollbar-track {
            background: transparent;
        }
        
        nav::-webkit-scrollbar-thumb {
            background: #e5e7eb;
            border-radius: 3px;
        }
        
        nav::-webkit-scrollbar-thumb:hover {
            background: #d1d5db;
        }
    </style>
    
    @stack('styles')
</head>
<body class="bg-gray-100">
    <!-- Sidebar -->
    <div class="flex h-screen">
        <aside class="w-64 bg-gradient-to-b from-white to-gray-50 shadow-xl border-r border-gray-200 relative">
            <!-- Logo & Header -->
            <div class="p-6 border-b border-gray-200 bg-white">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-gray-900">Admin Panel</h2>
                        <p class="text-xs text-gray-500">SMKN 4 BOGOR</p>
                    </div>
                </div>
            </div>
            
            <!-- Navigation -->
            <nav class="mt-4 px-3 pb-24 overflow-y-auto">
                <div class="space-y-1">
                    <a href="{{ route('admin.dashboard') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.dashboard') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.dashboard') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="font-medium">Dashboard</span>
                    </a>
                    
                    <!-- Section: Konten -->
                    <div class="mt-6 mb-3">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Konten</p>
                    </div>
                    
                    <a href="{{ route('admin.homepage.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.homepage.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.homepage.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <span class="font-medium">Homepage</span>
                    </a>
                    
                    <a href="{{ route('admin.posts.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.posts.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.posts.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">Posts</span>
                    </a>
                    
                    <a href="{{ route('admin.agenda.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.agenda.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.agenda.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">Agenda</span>
                    </a>
                    
                    <a href="{{ route('admin.informasi.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.informasi.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.informasi.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Informasi Terkini</span>
                    </a>
                    
                    <a href="{{ route('admin.galery.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.galery.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.galery.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="font-medium">Galeri & Foto</span>
                    </a>
                    
                    <!-- Section: Pengaturan -->
                    <div class="mt-6 mb-3">
                        <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pengaturan</p>
                    </div>
                    
                    <a href="{{ route('admin.kategori.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.kategori.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.kategori.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                            </svg>
                        </div>
                        <span class="font-medium">Kategori</span>
                    </a>
                    
                    <a href="{{ route('admin.profile.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.profile.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.profile.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <span class="font-medium">Profile Sekolah</span>
                    </a>
                    
                    <a href="{{ route('admin.petugas.index') }}" class="nav-menu-item group flex items-center px-4 py-3 text-gray-700 rounded-xl hover:bg-pink-50 hover:text-pink-primary transition-all duration-200 {{ request()->routeIs('admin.petugas.*') ? 'bg-pink-primary text-white shadow-lg shadow-pink-200' : '' }}">
                        <div class="w-10 h-10 rounded-lg flex items-center justify-center mr-3 {{ request()->routeIs('admin.petugas.*') ? 'bg-white/20' : 'bg-gray-100 group-hover:bg-pink-100' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <span class="font-medium">Petugas</span>
                    </a>
                </div>
            </nav>
            
            <!-- Footer - Logout -->
            <div class="absolute bottom-0 left-0 right-0 p-4 bg-white border-t border-gray-200">
                <form action="{{ route('admin.logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="w-full nav-menu-item group flex items-center justify-center px-4 py-3 text-gray-700 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all duration-200 border border-gray-200 hover:border-red-200">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span class="font-medium">Logout</span>
                    </button>
                </form>
            </div>
        </aside>
        
        <!-- Main Content -->
        <main class="flex-1 overflow-y-auto">
            <!-- Top Bar -->
            <header class="bg-white shadow-md px-6 py-4">
                <div class="flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('page-title', 'Dashboard')</h1>
                </div>
            </header>
            
            <!-- Content -->
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
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
