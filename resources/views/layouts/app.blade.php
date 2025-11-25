<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Web Galeri Sekolah')</title>
    
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
    </style>
    
    @stack('styles')
</head>
<body class="bg-white text-gray-900">
    <!-- Navigation -->
    @include('components.navigation')
    
    <!-- Main Content -->
    <main>
        @yield('content')
    </main>
    
    <!-- Footer -->
    @include('components.footer')
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @stack('scripts')
</body>
</html>
