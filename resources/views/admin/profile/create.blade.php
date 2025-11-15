@extends('layouts.admin')

@section('title', 'Tambah Profile Sekolah - Admin')
@section('page-title', 'Tambah Profile Sekolah')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <form action="{{ route('admin.profile.store') }}" method="POST">
        @csrf
        
        <div class="mb-4">
            <label for="judul" class="block text-gray-700 font-medium mb-2">Judul *</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
            @error('judul')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="isi" class="block text-gray-700 font-medium mb-2">Isi *</label>
            <textarea id="isi" name="isi" rows="10" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>{{ old('isi') }}</textarea>
            @error('isi')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
            <a href="{{ route('admin.profile.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
