@extends('layouts.app')

@section('title', 'Login Petugas - Web Galeri Sekolah')

@section('content')
<section class="py-12 bg-gradient-to-r from-pink-50 to-white min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white rounded-lg shadow-lg p-8 border border-gray-200">
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-gray-900">Login Petugas</h1>
            </div>
            
            @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <form action="{{ route('petugas.login') }}" method="POST">
                @csrf
                
                <div class="mb-4">
                    <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required autofocus>
                </div>
                
                <div class="mb-6">
                    <label for="password" class="block text-gray-700 font-medium mb-2">Password</label>
                    <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                </div>
                
                <button type="submit" class="w-full px-6 py-3 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium">Login</button>
            </form>
            
            <div class="mt-6 text-center">
                <a href="{{ route('guest.home') }}" class="text-pink-primary hover:text-pink-dark font-medium">Kembali ke Beranda</a>
            </div>
        </div>
    </div>
</section>
@endsection
