@extends('layouts.app')

@section('title', 'Galeri - Web Galeri Sekolah')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Galeri Foto</h1>
        
        <!-- Filter Chips -->
        @if($filterPosts->count() > 0)
        <div class="flex flex-wrap gap-2 justify-center mb-8">
            <a href="{{ route('guest.galeri') }}" class="px-4 py-2 rounded-full {{ !request('post') ? 'bg-pink-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                Semua
            </a>
            @foreach($filterPosts as $post)
            <a href="{{ route('guest.galeri', ['post' => $post->id]) }}" class="px-4 py-2 rounded-full {{ request('post') == $post->id ? 'bg-pink-primary text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition">
                {{ $post->judul }}
            </a>
            @endforeach
        </div>
        @endif
        
        <!-- Galeri Grid -->
        @if($galeries->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach($galeries as $galery)
            <a href="{{ route('guest.galeri.show', $galery) }}" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden border border-gray-200 group">
                @if($galery->fotos->count() > 0)
                <div class="relative h-64 overflow-hidden">
                    <img src="{{ asset('storage/' . $galery->fotos->first()->file) }}" alt="{{ $galery->post->judul ?? 'Galeri' }}" class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                    <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition"></div>
                    <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-4">
                        <h3 class="text-white font-bold text-lg mb-1">{{ $galery->post->judul ?? 'Galeri' }}</h3>
                        <p class="text-white text-sm">{{ $galery->fotos->count() }} foto</p>
                    </div>
                </div>
                @else
                <div class="h-64 bg-gray-200 flex items-center justify-center">
                    <span class="text-gray-400">Tidak ada foto</span>
                </div>
                @endif
                <div class="p-4">
                    <div class="flex items-center justify-between text-sm text-gray-500 mb-2">
                        <span>{{ $galery->total_likes ?? 0 }} likes</span>
                        <span>{{ $galery->total_downloads ?? 0 }} downloads</span>
                    </div>
                    <div class="flex items-center space-x-1 text-pink-primary text-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        <span class="font-medium">{{ number_format($galery->total_visitors ?? 0) }} dilihat</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-600">Belum ada galeri tersedia.</p>
        </div>
        @endif
        
        <!-- Galeri Posts (Optional) -->
        @if($galeriPosts->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Post Galeri Sekolah</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach($galeriPosts as $post)
                <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $post->judul }}</h3>
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->isi), 100) }}</p>
                    <span class="text-sm text-gray-500">{{ $post->created_at->format('d M Y') }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</section>
@endsection
