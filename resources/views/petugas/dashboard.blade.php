@extends('layouts.petugas')

@section('title', 'Dashboard Petugas - Web Galeri Sekolah')
@section('page-title', 'Dashboard')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Posts</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalPosts }}</p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Galeri</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalGaleries }}</p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Foto</p>
                <p class="text-3xl font-bold text-gray-900 mt-2">{{ $totalFotos }}</p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-900">Post Terbaru</h2>
        <a href="{{ route('petugas.posts.index') }}" class="text-pink-primary hover:text-pink-dark font-medium">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Judul</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Kategori</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentPosts as $post)
                <tr class="border-b border-gray-100 hover:bg-pink-light transition">
                    <td class="py-3 px-4">{{ Str::limit($post->judul, 40) }}</td>
                    <td class="py-3 px-4">{{ $post->kategori->judul ?? '-' }}</td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded text-xs font-medium {{ $post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ ucfirst($post->status) }}
                        </span>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600">{{ $post->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-600">Belum ada post.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
