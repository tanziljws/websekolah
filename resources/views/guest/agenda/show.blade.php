@extends('layouts.app')

@section('title', $post->judul . ' - Agenda')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <a href="{{ route('guest.agenda') }}" class="text-pink-primary hover:text-pink-dark mb-4 inline-block">← Kembali ke Agenda</a>
            
            <article class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $post->judul }}</h1>
                
                <div class="flex items-center space-x-4 text-gray-600 mb-6 border-b border-gray-200 pb-4">
                    <span>Oleh: <strong>{{ $post->petugas->username ?? 'Admin' }}</strong></span>
                    <span>•</span>
                    <span>{{ $post->created_at->format('d F Y') }}</span>
                </div>
                
                <div class="prose max-w-none text-gray-700 mb-8">
                    {!! nl2br(e($post->isi)) !!}
                </div>
                
                @if($post->galery)
                <div class="mt-8 p-6 bg-pink-light rounded-lg border border-pink-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">📸 Galeri Terkait</h3>
                    <p class="text-gray-700 mb-4">Agenda ini memiliki galeri foto terkait:</p>
                    <a href="{{ route('guest.galeri.show', $post->galery) }}" class="inline-flex items-center px-6 py-3 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Lihat Galeri ({{ $post->galery->fotos->count() }} foto)
                    </a>
                </div>
                @endif
            </article>
            
            <!-- Related Posts -->
            @if($relatedPosts->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Agenda Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedPosts as $related)
                    <a href="{{ route('guest.agenda.show', $related) }}" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition p-6 border border-gray-200">
                        <h3 class="font-bold text-gray-900 mb-2 line-clamp-2">{{ $related->judul }}</h3>
                        <p class="text-sm text-gray-500">{{ $related->created_at->format('d M Y') }}</p>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
