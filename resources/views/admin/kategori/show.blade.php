@extends('layouts.admin')

@section('title', 'Detail Kategori - Admin')
@section('page-title', 'Detail Kategori')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="mb-6">
        <a href="{{ route('admin.kategori.index') }}" class="text-pink-primary hover:text-pink-dark">← Kembali</a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $kategori->judul }}</h1>
    
    <div class="mb-6 text-gray-600 border-b border-gray-200 pb-4">
        <p>Jumlah Posts: <strong>{{ $kategori->posts->count() }}</strong></p>
        <p>Dibuat: <strong>{{ $kategori->created_at->format('d F Y') }}</strong></p>
    </div>
    
    @if($kategori->posts->count() > 0)
    <div class="mb-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Posts dalam Kategori ini</h2>
        <ul class="space-y-2">
            @foreach($kategori->posts as $post)
            <li class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                <span>{{ $post->judul }}</span>
                <a href="{{ route('admin.posts.show', $post) }}" class="text-pink-primary hover:text-pink-dark">Lihat</a>
            </li>
            @endforeach
        </ul>
    </div>
    @endif
    
    <div class="flex space-x-4">
        <a href="{{ route('admin.kategori.edit', $kategori) }}" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Edit</a>
        <a href="{{ route('admin.kategori.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection
