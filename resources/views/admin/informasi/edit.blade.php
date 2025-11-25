@extends('layouts.admin')

@section('title', 'Edit Informasi - Admin')
@section('page-title', 'Edit Informasi')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Edit Informasi</h2>
        </div>
        
        <form action="{{ route('admin.informasi.update', $post) }}" method="POST" class="p-6 space-y-6">
            @csrf
            @method('PUT')
            
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Informasi <span class="text-red-500">*</span>
                </label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $post->judul) }}" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none" required>
                @error('judul')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            
            <!-- Isi -->
            <div>
                <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi/Keterangan Informasi <span class="text-red-500">*</span>
                </label>
                <textarea id="isi" name="isi" rows="8" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none resize-none" required>{{ old('isi', $post->isi) }}</textarea>
                @error('isi')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            
            <!-- Link ke Galeri -->
            <div>
                <label for="galery_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Link ke Galeri (Opsional)
                </label>
                <select id="galery_id" name="galery_id" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer">
                    <option value="">-- Tidak ada link galeri --</option>
                    @foreach($galeries as $galery)
                    <option value="{{ $galery->id }}" {{ old('galery_id', $post->galery_id) == $galery->id ? 'selected' : '' }}>
                        {{ $galery->post->judul ?? 'Galeri #' . $galery->id }} ({{ $galery->fotos->count() }} foto)
                    </option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Pilih galeri jika informasi ini terkait dengan galeri foto tertentu</p>
                @error('galery_id')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer" required>
                    <option value="published" {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>Published (Tampilkan di halaman informasi)</option>
                    <option value="draft" {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>Draft (Simpan sebagai draft)</option>
                </select>
                @error('status')
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    {{ $message }}
                </p>
                @enderror
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.informasi.index') }}" class="px-6 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-pink-primary rounded-lg hover:bg-pink-dark shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    Update Informasi
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

