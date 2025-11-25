@extends('layouts.admin')

@section('title', 'Edit Kategori - Admin')
@section('page-title', 'Edit Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <form action="{{ route('admin.kategori.update', $kategori) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label for="judul" class="block text-gray-700 font-medium mb-2">Judul *</label>
            <input type="text" id="judul" name="judul" value="{{ old('judul', $kategori->judul) }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
            @error('judul')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Update</button>
            <a href="{{ route('admin.kategori.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
