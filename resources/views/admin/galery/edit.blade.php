@extends('layouts.admin')

@section('title', 'Edit Galeri - Admin')
@section('page-title', 'Edit Galeri')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <form action="{{ route('admin.galery.update', $galery) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="mb-4">
            <label for="post_id" class="block text-gray-700 font-medium mb-2">Post *</label>
            <select id="post_id" name="post_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                @foreach($posts as $post)
                <option value="{{ $post->id }}" {{ old('post_id', $galery->post_id) == $post->id ? 'selected' : '' }}>
                    {{ $post->judul }} ({{ $post->kategori->judul ?? '-' }})
                </option>
                @endforeach
            </select>
            @error('post_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="status" class="block text-gray-700 font-medium mb-2">Status *</label>
            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                <option value="1" {{ old('status', $galery->status) == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('status', $galery->status) == '0' ? 'selected' : '' }}>Nonaktif</option>
            </select>
            @error('status')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Update</button>
            <a href="{{ route('admin.galery.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
