@extends('layouts.admin')

@section('title', 'Detail Foto - Admin')
@section('page-title', 'Detail Foto')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="mb-6">
        <a href="{{ route('admin.foto.index') }}" class="text-pink-primary hover:text-pink-dark">← Kembali</a>
    </div>
    
    @if($foto->file)
    <div class="mb-6">
        <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto" class="max-w-2xl w-full border border-gray-200 rounded-lg">
    </div>
    @endif
    
    <div class="mb-6 text-gray-600 border-b border-gray-200 pb-4">
        <p>Galeri: <strong>{{ $foto->galery->post->judul ?? '-' }}</strong></p>
        <p class="mt-2">Dibuat: <strong>{{ $foto->created_at->format('d F Y H:i') }}</strong></p>
    </div>
    
    <div class="flex space-x-4">
        <a href="{{ route('admin.foto.edit', $foto) }}" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Edit</a>
        <a href="{{ route('admin.foto.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection
