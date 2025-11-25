@extends('layouts.admin')

@section('title', 'Tambah Foto - Admin')
@section('page-title', 'Tambah Foto')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <form action="{{ route('admin.foto.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-4">
            <label for="galery_id" class="block text-gray-700 font-medium mb-2">Galeri *</label>
            <select id="galery_id" name="galery_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                <option value="">Pilih Galeri</option>
                @foreach($galeries as $galery)
                <option value="{{ $galery->id }}" {{ old('galery_id') == $galery->id ? 'selected' : '' }}>
                    {{ $galery->post->judul ?? 'Galeri #' . $galery->id }}
                </option>
                @endforeach
            </select>
            @error('galery_id')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-4">
            <label for="file" class="block text-gray-700 font-medium mb-2">Foto (Single)</label>
            <input type="file" id="file" name="file" accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent">
            @error('file')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="mb-6">
            <label for="files" class="block text-gray-700 font-medium mb-2">Atau Upload Multiple Foto</label>
            <input type="file" id="files" name="files[]" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent">
            <p class="text-xs text-gray-500 mt-1">Bisa upload multiple foto sekaligus (prioritas jika diisi)</p>
            @error('files.*')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>
        
        <div class="flex space-x-4">
            <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
            <a href="{{ route('admin.foto.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Batal</a>
        </div>
    </form>
</div>
@endsection
