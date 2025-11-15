@extends('layouts.admin')

@section('title', 'Detail Informasi - Admin')
@section('page-title', 'Detail Informasi')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="mb-6">
        <a href="{{ route('admin.informasi.index') }}" class="text-pink-primary hover:text-pink-dark">← Kembali</a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->judul }}</h1>
    
    <div class="mb-6 flex items-center space-x-4 text-gray-600 border-b border-gray-200 pb-4">
        <span>Status: 
            <span class="px-2 py-1 rounded text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                {{ $post->status === 'published' ? 'Published' : 'Draft' }}
            </span>
        </span>
        <span>•</span>
        <span>{{ $post->created_at->format('d F Y') }}</span>
        @if($post->galery)
        <span>•</span>
        <a href="{{ route('admin.galery.show', $post->galery) }}" class="text-pink-primary hover:text-pink-dark font-medium">Lihat Galeri Terkait</a>
        @endif
    </div>
    
    <div class="prose max-w-none text-gray-700 mb-6">
        {!! nl2br(e($post->isi)) !!}
    </div>
    
    <div class="flex space-x-4">
        <a href="{{ route('admin.informasi.edit', $post) }}" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Edit</a>
        <form action="{{ route('admin.informasi.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus informasi ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-6 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Hapus</button>
        </form>
        <a href="{{ route('admin.informasi.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection

