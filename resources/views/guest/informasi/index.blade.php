@extends('layouts.app')

@section('title', 'Informasi Terkini - Web Galeri Sekolah')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Informasi Terkini</h1>
        
        @if($posts->count() > 0)
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($posts as $post)
            <a href="{{ route('guest.informasi.show', $post) }}" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden border border-gray-200">
                @if($post->galery && $post->galery->fotos->count() > 0)
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="{{ asset('storage/' . $post->galery->fotos->first()->file) }}" 
                         alt="{{ $post->judul }}" 
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                    <div class="absolute top-2 right-2 bg-pink-primary text-white px-2 py-1 rounded text-xs font-medium flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        {{ $post->galery->fotos->count() }} foto
                    </div>
                </div>
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2">{{ $post->judul }}</h2>
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ Str::limit(strip_tags($post->isi), 150) }}</p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span>{{ $post->petugas->username ?? 'Admin' }}</span>
                        <span>{{ $post->created_at->format('d M Y') }}</span>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            {{ $posts->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <p class="text-gray-600">Belum ada informasi tersedia.</p>
        </div>
        @endif
    </div>
</section>
@endsection
