@extends('layouts.admin')

@section('title', 'Detail Profile Sekolah - Admin')
@section('page-title', 'Detail Profile Sekolah')

@section('content')
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="mb-6">
        <a href="{{ route('admin.profile.index') }}" class="text-pink-primary hover:text-pink-dark">← Kembali</a>
    </div>
    
    <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $profile->judul }}</h1>
    
    <div class="mb-6 text-gray-600 border-b border-gray-200 pb-4">
        <p>Dibuat: <strong>{{ $profile->created_at->format('d F Y') }}</strong></p>
        <p class="mt-1">Diupdate: <strong>{{ $profile->updated_at->format('d F Y') }}</strong></p>
    </div>
    
    <div class="prose max-w-none text-gray-700 mb-6">
        {!! nl2br(e($profile->isi)) !!}
    </div>
    
    <div class="flex space-x-4">
        <a href="{{ route('admin.profile.edit', $profile) }}" class="px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Edit</a>
        <a href="{{ route('admin.profile.index') }}" class="px-6 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Kembali</a>
    </div>
</div>
@endsection
