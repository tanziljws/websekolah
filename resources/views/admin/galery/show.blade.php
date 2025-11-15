@extends('layouts.admin')

@section('title', 'Detail Galeri - Admin')
@section('page-title', 'Detail Galeri')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="mb-6">
        <a href="{{ route('admin.galery.index') }}" class="text-pink-primary hover:text-pink-dark">← Kembali</a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $galery->post->judul ?? 'Galeri' }}</h1>
    
    <div class="mb-6 flex items-center space-x-4 text-gray-600 border-b border-gray-200 pb-4">
        <span>Status: 
            <span class="px-2 py-1 rounded text-xs font-medium {{ $galery->status == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                {{ $galery->status == 1 ? 'Aktif' : 'Nonaktif' }}
            </span>
        </span>
        <span>•</span>
        <span>Jumlah Foto: <strong>{{ $galery->fotos->count() }}</strong></span>
    </div>
    
    <!-- Tambah Foto Section -->
    <div class="mb-8 bg-pink-light rounded-lg p-6 border border-pink-200">
        <h2 class="text-xl font-bold text-gray-900 mb-2">➕ Tambah Foto ke Galeri Ini</h2>
        <p class="text-sm text-gray-600 mb-4">Upload foto baru ke dalam galeri ini</p>
        <form action="{{ route('admin.foto.store') }}" method="POST" enctype="multipart/form-data" id="add-foto-form">
            @csrf
            <input type="hidden" name="galery_id" value="{{ $galery->id }}">
            <div class="flex items-end space-x-4">
                <div class="flex-1">
                    <label for="files" class="block text-gray-700 font-medium mb-2">Pilih Foto (Bisa Multiple)</label>
                    <input type="file" id="files" name="files[]" multiple accept="image/*" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                </div>
                <button type="submit" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Upload Foto</button>
            </div>
        </form>
    </div>
    
    <!-- Daftar Foto -->
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Foto dalam Galeri ({{ $galery->fotos->count() }})</h2>
        @if($galery->fotos->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            @foreach($galery->fotos as $foto)
            <div class="border border-gray-200 rounded-lg overflow-hidden bg-white">
                <div class="relative h-48 overflow-hidden group">
                    <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition flex items-center justify-center">
                        <form action="{{ route('admin.foto.destroy', $foto) }}" method="POST" class="opacity-0 group-hover:opacity-100 transition" onsubmit="return confirm('Yakin ingin menghapus foto ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 text-sm">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-8 bg-gray-50 rounded-lg border border-gray-200">
            <p class="text-gray-600">Belum ada foto dalam galeri ini. Upload foto di atas.</p>
        </div>
        @endif
    </div>
    
    <div class="flex space-x-4">
        <a href="{{ route('admin.galery.edit', $galery) }}" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Edit</a>
        <a href="{{ route('admin.galery.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection
