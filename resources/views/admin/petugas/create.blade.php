@extends('layouts.admin')

@section('title', 'Tambah Petugas - Admin')
@section('page-title', 'Tambah Petugas')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <form action="{{ route('admin.petugas.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="username" class="block text-gray-700 font-medium mb-2">Username *</label>
            <input type="text" id="username" name="username" value="{{ old('username') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
            @error('username')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password *</label>
            <input type="password" id="password" name="password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
            @error('password')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="password_confirmation" class="block text-gray-700 font-medium mb-2">Konfirmasi Password *</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
            @error('password_confirmation')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
            <a href="{{ route('admin.petugas.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
