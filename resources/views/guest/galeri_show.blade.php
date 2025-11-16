@extends('layouts.app')

@section('title', $galery->post->judul ?? 'Detail Galeri - Web Galeri Sekolah')

@section('content')
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="{{ route('guest.galeri') }}" class="text-pink-primary hover:text-pink-dark mb-4 inline-block">← Kembali ke Galeri</a>
                <h1 class="text-4xl font-bold text-gray-900">{{ $galery->post->judul ?? 'Galeri' }}</h1>
            </div>
            
            <!-- Actions (Like, Bookmark, Share) -->
            @auth('user')
            <div class="flex items-center space-x-4 mb-8 flex-wrap gap-2">
                <form action="{{ route('galleries.like', $galery) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2 {{ $isLiked ?? false ? 'bg-pink-primary text-white' : 'bg-pink-light text-pink-primary' }} rounded-lg hover:bg-pink-200 transition">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.834a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                        </svg>
                        <span class="font-medium">{{ $galery->total_likes ?? 0 }}</span>
                    </button>
                </form>
                <form action="{{ route('galleries.bookmark', $galery) }}" method="POST" class="inline" id="bookmark-form">
                    @csrf
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2 {{ ($isBookmarked ?? false) ? 'bg-pink-primary text-white' : 'bg-pink-light text-pink-primary' }} rounded-lg hover:bg-pink-200 transition">
                        <svg class="w-5 h-5" fill="{{ ($isBookmarked ?? false) ? 'currentColor' : 'none' }}" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span class="font-medium">{{ ($isBookmarked ?? false) ? 'Tersimpan' : 'Simpan' }}</span>
                    </button>
                </form>
                <button onclick="shareGallery()" class="flex items-center space-x-2 px-4 py-2 bg-pink-light text-pink-primary rounded-lg hover:bg-pink-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <span class="font-medium">Bagikan</span>
                </button>
            </div>
            @else
            <div class="flex items-center space-x-4 mb-8 flex-wrap gap-2">
                <button onclick="shareGallery()" class="flex items-center space-x-2 px-4 py-2 bg-pink-light text-pink-primary rounded-lg hover:bg-pink-200 transition">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <span class="font-medium">Bagikan</span>
                </button>
            </div>
            @endauth
            
            <!-- Photo Gallery -->
            @if($galery->fotos->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                @foreach($galery->fotos as $foto)
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ asset('storage/' . $foto->file) }}" 
                             alt="Foto" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                            <a href="{{ route('galleries.fotos.download', ['galery' => $galery->id, 'foto' => $foto->id]) }}" class="opacity-0 group-hover:opacity-100 transition px-4 py-2 bg-white rounded-lg text-pink-primary font-medium hover:bg-pink-light">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @else
            <div class="text-center py-12">
                <p class="text-gray-600">Belum ada foto dalam galeri ini.</p>
            </div>
            @endif
            
            <!-- Comments Section -->
            @auth('user')
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Komentar</h3>
                
                <!-- Add Comment Form -->
                <form action="{{ route('galleries.comments.store', $galery) }}" method="POST" class="mb-6">
                    @csrf
                    <textarea name="body" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit" class="mt-2 px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Kirim Komentar</button>
                </form>
                
                <!-- Comments List -->
                <div class="space-y-4">
                    @forelse($galery->comments->whereNull('parent_id') as $comment)
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-pink-primary rounded-full flex items-center justify-center text-white font-bold">
                                {{ strtoupper(substr($comment->user->name ?? 'U', 0, 1)) }}
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-bold text-gray-900">{{ $comment->user->name ?? 'User' }}</h4>
                                    <div class="flex items-center space-x-3">
                                        <span class="text-sm text-gray-500">{{ $comment->created_at->diffForHumans() }}</span>
                                        @if(auth('user')->check() && auth('user')->id() == $comment->user_id)
                                        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus komentar ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                        @endif
                                    </div>
                                </div>
                                <p class="text-gray-700 mt-1">{{ $comment->body }}</p>
                                
                                <!-- Reply Button -->
                                <button onclick="showReplyForm({{ $comment->id }})" class="text-sm text-pink-primary hover:text-pink-dark mt-2">Balas</button>
                                
                                <!-- Reply Form (Hidden) -->
                                <div id="reply-form-{{ $comment->id }}" class="hidden mt-3">
                                    <form action="{{ route('comments.reply', $comment) }}" method="POST">
                                        @csrf
                                        <textarea name="body" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" placeholder="Tulis balasan..." required></textarea>
                                        <div class="flex space-x-2 mt-2">
                                            <button type="submit" class="px-4 py-1 bg-pink-primary text-white rounded hover:bg-pink-dark text-sm">Kirim</button>
                                            <button type="button" onclick="hideReplyForm({{ $comment->id }})" class="px-4 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm">Batal</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Replies -->
                                @foreach($comment->children as $reply)
                                <div class="ml-8 mt-3 border-l-2 border-pink-200 pl-3">
                                    <div class="flex items-center justify-between">
                                        <h5 class="font-medium text-gray-900">{{ $reply->user->name ?? 'User' }}</h5>
                                        <div class="flex items-center space-x-3">
                                            <span class="text-sm text-gray-500">{{ $reply->created_at->diffForHumans() }}</span>
                                            @if(auth('user')->check() && auth('user')->id() == $reply->user_id)
                                            <form action="{{ route('comments.destroy', $reply) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus balasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-sm text-red-500 hover:text-red-700 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                    </div>
                                    <p class="text-gray-700 mt-1">{{ $reply->body }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-600">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    @endforelse
                </div>
            </div>
            @else
            <div class="bg-pink-light rounded-lg p-6 text-center">
                <p class="text-gray-700 mb-4">Login untuk berkomentar dan berinteraksi dengan galeri.</p>
                <a href="{{ route('user.login') }}" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Login</a>
            </div>
            @endauth
            
            <!-- Recommendations -->
            @if($recommendations->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($recommendations as $rec)
                    <a href="{{ route('guest.galeri.show', $rec) }}" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden border border-gray-200">
                        @if($rec->fotos->count() > 0)
                        <div class="h-48 overflow-hidden">
                            <img src="{{ asset('storage/' . $rec->fotos->first()->file) }}" alt="{{ $rec->post->judul ?? 'Galeri' }}" class="w-full h-full object-cover">
                        </div>
                        @endif
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900">{{ $rec->post->judul ?? 'Galeri' }}</h3>
                            <p class="text-sm text-gray-500 mt-1">{{ $rec->fotos->count() }} foto</p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<script>
function showReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).classList.remove('hidden');
}

function hideReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).classList.add('hidden');
}

function shareGallery() {
    const url = window.location.href;
    const title = '{{ $galery->post->judul ?? "Galeri" }}';
    const text = 'Lihat galeri ini: ' + title;
    
    if (navigator.share) {
        navigator.share({
            title: title,
            text: text,
            url: url
        }).catch(err => {
            console.log('Error sharing:', err);
            copyToClipboard(url);
        });
    } else {
        copyToClipboard(url);
    }
}

function copyToClipboard(text) {
    if (navigator.clipboard && navigator.clipboard.writeText) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Link berhasil disalin ke clipboard!');
        }).catch(err => {
            fallbackCopyToClipboard(text);
        });
    } else {
        fallbackCopyToClipboard(text);
    }
}

function fallbackCopyToClipboard(text) {
    const textArea = document.createElement('textarea');
    textArea.value = text;
    textArea.style.position = 'fixed';
    textArea.style.left = '-999999px';
    document.body.appendChild(textArea);
    textArea.select();
    try {
        document.execCommand('copy');
        alert('Link berhasil disalin ke clipboard!');
    } catch (err) {
        console.error('Failed to copy:', err);
        prompt('Salin link ini:', text);
    }
    document.body.removeChild(textArea);
}

// Update bookmark button after form submission
document.addEventListener('DOMContentLoaded', function() {
    const bookmarkForm = document.getElementById('bookmark-form');
    if (bookmarkForm) {
        bookmarkForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const form = this;
            const formData = new FormData(form);
            const button = form.querySelector('button[type="submit"]');
            const svg = button.querySelector('svg');
            const span = button.querySelector('span');
            
            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Update bookmark state based on server response
                if (data.is_bookmarked) {
                    button.classList.remove('bg-pink-light', 'text-pink-primary');
                    button.classList.add('bg-pink-primary', 'text-white');
                    svg.setAttribute('fill', 'currentColor');
                    span.textContent = 'Tersimpan';
                } else {
                    button.classList.remove('bg-pink-primary', 'text-white');
                    button.classList.add('bg-pink-light', 'text-pink-primary');
                    svg.setAttribute('fill', 'none');
                    span.textContent = 'Simpan';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Fallback to normal form submission
                form.submit();
            });
        });
    }
});
</script>
@endsection
