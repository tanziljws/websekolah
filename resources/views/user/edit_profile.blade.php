@extends('layouts.app')

@section('title', 'Edit Profil - Web Galeri Sekolah')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Edit Profil</h1>
            
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
            
            <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                <form action="{{ route('user.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <!-- Profile Photo -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                        <div class="flex items-center space-x-4">
                            @if($user->profile_photo_path)
                            <img src="{{ asset('storage/' . $user->profile_photo_path) }}" alt="{{ $user->name }}" class="w-20 h-20 rounded-full object-cover border-2 border-pink-primary">
                            @else
                            <div class="w-20 h-20 bg-pink-primary rounded-full flex items-center justify-center text-white text-xl font-bold">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </div>
                            @endif
                            <div>
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="text-sm text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 5MB)</p>
                            </div>
                        </div>
                        @error('profile_photo')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                        @error('name')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Username -->
                    <div class="mb-6">
                        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" pattern="[a-z0-9_]+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                        @error('username')
                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-xs text-gray-500 mt-1">Hanya huruf kecil, angka, dan underscore</p>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-pink-700 transition-all duration-200 ring-2 ring-white/20">Simpan Perubahan</button>
                        <a href="{{ route('user.profile') }}" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold text-center shadow">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
