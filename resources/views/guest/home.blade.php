@extends('layouts.app')

@section('title', 'Beranda - Web Galeri Sekolah')

@section('content')
<!-- Hero Section - Carousel -->
@if($heroImages->count() > 0)
<section class="relative h-screen overflow-hidden">
    <div id="heroCarousel" class="relative h-full">
        @foreach($heroImages as $index => $hero)
        @php
            $image = is_array($hero) ? $hero['filename'] : $hero;
            $title = is_array($hero) ? $hero['title'] : 'Kegiatan SMKN 4 BOGOR';
            $description = is_array($hero) ? $hero['description'] : 'Menampilkan berbagai kegiatan dan aktivitas di SMKN 4 BOGOR';
        @endphp
        <div class="hero-slide {{ $index === 0 ? 'active' : '' }} absolute inset-0 w-full h-full transition-opacity duration-1000" style="opacity: {{ $index === 0 ? 1 : 0 }};">
            <img src="{{ asset('storage/hero/' . $image) }}" alt="{{ $title }}" class="w-full h-full object-cover" onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'1920\' height=\'1080\'%3E%3Crect fill=\'%23e5e7eb\' width=\'1920\' height=\'1080\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'24\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/50 to-black/30"></div>
            
            <!-- Content di pojok kiri bawah -->
            <div class="hero-content absolute bottom-8 left-8 md:bottom-12 md:left-16 max-w-2xl {{ $index === 0 ? 'animate-fade-in-up' : '' }}">
                <div class="text-white">
                    <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight drop-shadow-lg">
                        {{ $title }}
                    </h1>
                    <p class="text-base md:text-lg lg:text-xl mb-6 opacity-95 leading-relaxed max-w-xl drop-shadow-md">
                        {{ $description }}
                    </p>
                    <a href="{{ route('guest.galeri') }}" class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-xl hover:shadow-2xl transform hover:scale-105 transition-all duration-200 ring-2 ring-white/20">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Lihat Galeri
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Carousel Controls -->
    @if($heroImages->count() > 1)
    <div class="absolute bottom-8 right-8 md:bottom-12 md:right-16 flex space-x-2">
        @foreach($heroImages as $index => $hero)
        <button onclick="goToSlide({{ $index }})" class="carousel-dot w-3 h-3 rounded-full bg-white {{ $index === 0 ? 'bg-pink-primary ring-2 ring-pink-primary ring-offset-2 ring-offset-black/50' : 'opacity-50' }} transition-all duration-300 hover:opacity-100" data-slide="{{ $index }}"></button>
        @endforeach
    </div>
    @endif
</section>
@else
<section class="bg-gradient-to-r from-pink-50 to-white py-20">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Selamat Datang di<br>
                <span class="text-pink-primary">SMKN 4 BOGOR</span>
            </h1>
            <p class="text-xl text-gray-600 mb-8">Temukan berbagai kegiatan dan aktivitas sekolah kami</p>
            <a href="{{ route('guest.galeri') }}" class="inline-block px-8 py-3 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">
                Lihat Galeri
            </a>
        </div>
    </div>
</section>
@endif

<!-- Bento Grid Section - Galeri Kegiatan -->
@if(isset($latestGaleries) && $latestGaleries->count() > 0)
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">Galeri Kegiatan Sekolah</h2>
                <p class="text-gray-600">Momen-momen terbaik dari berbagai kegiatan di SMKN 4 BOGOR</p>
            </div>
            <a href="{{ route('guest.galeri') }}" class="hidden md:flex items-center text-pink-primary hover:text-pink-dark font-medium transition">
                Lihat Semua
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
        
        <div class="bento-grid gap-4">
            @foreach($latestGaleries->take(6) as $index => $galery)
                @if($galery->fotos->count() > 0)
                <a href="{{ route('guest.galeri.show', $galery) }}" 
                   class="bento-item group relative overflow-hidden rounded-2xl bg-gray-200 transition-all duration-300 hover:scale-[1.02] hover:shadow-2xl"
                   style="grid-area: item{{ $index + 1 }}">
                    @if($index === 0)
                        <!-- Large featured item -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('storage/' . $galery->fotos->first()->file) }}" 
                                 alt="{{ $galery->post->judul ?? 'Galeri' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-pink-primary px-3 py-1 rounded-full text-xs font-medium">
                                        {{ $galery->fotos->count() }} foto
                                    </span>
                                    <span class="text-sm opacity-90">{{ $galery->created_at->format('d M Y') }}</span>
                                </div>
                                <h3 class="text-2xl font-bold mb-2 line-clamp-2">{{ $galery->post->judul ?? 'Galeri' }}</h3>
                                @if($galery->post && $galery->post->isi)
                                <p class="text-sm opacity-90 line-clamp-2">{{ Str::limit(strip_tags($galery->post->isi), 100) }}</p>
                                @endif
                            </div>
                        </div>
                    @elseif($index === 1 || $index === 2)
                        <!-- Medium items -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('storage/' . $galery->fotos->first()->file) }}" 
                                 alt="{{ $galery->post->judul ?? 'Galeri' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/30 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5 text-white">
                                <div class="flex items-center justify-between mb-2">
                                    <span class="bg-pink-primary px-2 py-1 rounded-full text-xs font-medium">
                                        {{ $galery->fotos->count() }} foto
                                    </span>
                                </div>
                                <h3 class="text-lg font-bold line-clamp-1">{{ $galery->post->judul ?? 'Galeri' }}</h3>
                            </div>
                        </div>
                    @else
                        <!-- Small items -->
                        <div class="absolute inset-0">
                            <img src="{{ asset('storage/' . $galery->fotos->first()->file) }}" 
                                 alt="{{ $galery->post->judul ?? 'Galeri' }}" 
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                 onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4 text-white">
                                <h3 class="text-sm font-bold line-clamp-1 mb-1">{{ $galery->post->judul ?? 'Galeri' }}</h3>
                                <span class="text-xs opacity-90">{{ $galery->fotos->count() }} foto</span>
                            </div>
                        </div>
                    @endif
                </a>
                @endif
            @endforeach
        </div>
        
        <div class="mt-6 text-center md:hidden">
            <a href="{{ route('guest.galeri') }}" class="inline-flex items-center text-pink-primary hover:text-pink-dark font-medium">
                Lihat Semua Galeri
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Pengumuman & Agenda Bento -->
<section class="py-12 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="bento-content-grid gap-6">
            <!-- Pengumuman Penting -->
            @if($latestInformasi->count() > 0)
            <div class="bento-content-item bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z" />
                        </svg>
                        Pengumuman
                    </h2>
                    <a href="{{ route('guest.informasi') }}" class="text-sm text-pink-primary hover:text-pink-dark font-medium">Lihat semua →</a>
                </div>
                <div class="space-y-4">
                    @foreach($latestInformasi->take(3) as $info)
                    <a href="{{ route('guest.informasi.show', $info) }}" class="block p-4 bg-gray-50 rounded-xl hover:bg-pink-50 transition-colors border border-transparent hover:border-pink-200">
                        <div class="flex items-start gap-4">
                            @if($info->galery && $info->galery->fotos->count() > 0)
                            <div class="flex-shrink-0 w-20 h-20 rounded-lg overflow-hidden bg-gray-200">
                                <img src="{{ asset('storage/' . $info->galery->fotos->first()->file) }}" 
                                     alt="{{ $info->judul }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23e5e7eb\' width=\'100\' height=\'100\'/%3E%3C/svg%3E';">
                            </div>
                            @endif
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 hover:text-pink-primary transition-colors">{{ $info->judul }}</h3>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-2">{{ Str::limit(strip_tags($info->isi), 80) }}</p>
                                <span class="text-xs text-gray-500">{{ $info->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
            
            <!-- Agenda Kegiatan -->
            @if($latestAgenda->count() > 0)
            <div class="bento-content-item bg-white rounded-2xl p-6 shadow-lg border border-gray-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        Agenda Kegiatan
                    </h2>
                    <a href="{{ route('guest.agenda') }}" class="text-sm text-pink-primary hover:text-pink-dark font-medium">Lihat semua →</a>
                </div>
                <div class="space-y-4">
                    @foreach($latestAgenda->take(4) as $agenda)
                    <a href="{{ route('guest.agenda.show', $agenda) }}" class="block group">
                        <div class="flex items-center gap-4 p-3 rounded-xl hover:bg-pink-50 transition-colors">
                            <div class="flex-shrink-0 w-16 h-16 bg-pink-primary rounded-lg flex flex-col items-center justify-center text-white">
                                <span class="text-lg font-bold">{{ $agenda->created_at->format('d') }}</span>
                                <span class="text-xs">{{ $agenda->created_at->format('M') }}</span>
                            </div>
                            <div class="flex-1 min-w-0">
                                <h3 class="font-bold text-gray-900 mb-1 line-clamp-1 group-hover:text-pink-primary transition-colors">{{ $agenda->judul }}</h3>
                                <p class="text-sm text-gray-600 line-clamp-1">{{ Str::limit(strip_tags($agenda->isi), 60) }}</p>
                            </div>
                            @if($agenda->galery && $agenda->galery->fotos->count() > 0)
                            <div class="flex-shrink-0 w-12 h-12 rounded-lg overflow-hidden bg-gray-200 hidden md:block">
                                <img src="{{ asset('storage/' . $agenda->galery->fotos->first()->file) }}" 
                                     alt="{{ $agenda->judul }}" 
                                     class="w-full h-full object-cover"
                                     onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'100\' height=\'100\'%3E%3Crect fill=\'%23e5e7eb\' width=\'100\' height=\'100\'/%3E%3C/svg%3E';">
                            </div>
                            @endif
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</section>

<!-- About Preview Section -->
@if($profile)
<section class="py-20 bg-white border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-12">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Tentang Sekolah</h2>
                <div class="w-24 h-1 bg-pink-primary mx-auto mb-6"></div>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">Kenali lebih dekat SMK Negeri 4 Kota Bogor</p>
            </div>
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-10">
                <!-- Logo & Title -->
                <div class="lg:col-span-1 flex flex-col items-center justify-center">
                    <div class="mb-6">
                        <img src="{{ asset('logo.png') }}" alt="SMKN 4 BOGOR" class="h-40 w-auto object-contain">
                    </div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 text-center">{{ $profile->judul ?? 'SMK Negeri 4 Kota Bogor' }}</h3>
                    <p class="text-gray-600 text-center">Vokasi Berkualitas, Siap Kerja</p>
                </div>
                
                <!-- Content -->
                <div class="lg:col-span-2">
                    <div class="bg-gray-50 rounded-2xl p-8 border border-gray-200">
                        <p class="text-gray-700 leading-relaxed text-lg mb-6 line-clamp-6">
                            {{ Str::limit(strip_tags($profile->isi ?? 'SMK Negeri 4 Kota Bogor adalah lembaga pendidikan menengah kejuruan yang berkomitmen untuk menghasilkan lulusan yang kompeten dan siap bekerja. Kami menyediakan berbagai program keahlian yang relevan dengan kebutuhan industri.'), 400) }}
                        </p>
                        
                        <!-- Key Points -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                            <div class="flex items-start space-x-3 p-4 bg-white rounded-xl border border-gray-200 hover:border-pink-primary transition-colors">
                                <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Fasilitas Lengkap</h4>
                                    <p class="text-sm text-gray-600">Peralatan modern dan laboratorium yang memadai</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3 p-4 bg-white rounded-xl border border-gray-200 hover:border-pink-primary transition-colors">
                                <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Guru Berpengalaman</h4>
                                    <p class="text-sm text-gray-600">Tim pengajar profesional dan kompeten</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3 p-4 bg-white rounded-xl border border-gray-200 hover:border-pink-primary transition-colors">
                                <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Link Industri</h4>
                                    <p class="text-sm text-gray-600">Kerjasama dengan industri dan dunia usaha</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start space-x-3 p-4 bg-white rounded-xl border border-gray-200 hover:border-pink-primary transition-colors">
                                <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center flex-shrink-0">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="font-bold text-gray-900 mb-1">Sertifikasi</h4>
                                    <p class="text-sm text-gray-600">Program sertifikasi keahlian profesional</p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-8 text-center">
                            <a href="{{ route('guest.profil') }}" 
                               class="inline-flex items-center px-8 py-3 bg-pink-primary text-white font-medium rounded-xl hover:bg-pink-dark transition-all duration-300 shadow-lg hover:shadow-xl">
                                Baca Profil Lengkap
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<!-- Bento Grid - Visi Misi & Prestasi -->
<section class="py-16 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Visi, Misi & Prestasi</h2>
                <div class="w-24 h-1 bg-pink-primary mx-auto mb-4"></div>
            </div>
            
            <div class="bento-info-grid gap-6">
                <!-- Visi - Large -->
                <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-8 hover:shadow-xl transition-shadow" style="grid-area: visi">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-900">Visi</h3>
                    </div>
                    <p class="text-gray-700 leading-relaxed">
                        @if($visi && $visi->content)
                            {!! nl2br(e($visi->content)) !!}
                        @else
                            Menjadi sekolah <strong class="text-pink-primary">"tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan."</strong>
                        @endif
                    </p>
                </div>
                
                <!-- Misi -->
                <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow" style="grid-area: misi">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Misi</h3>
                    </div>
                    <ul class="space-y-2 text-sm">
                        @if($misi && $misi->count() > 0)
                            @foreach($misi->take(3) as $item)
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">{{ $item->content }}</span>
                            </li>
                            @endforeach
                        @else
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Menumbuhkan sikap agama / spiritualitas</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Mengembangkan literasi sesuai kompetensi</span>
                            </li>
                            <li class="flex items-start">
                                <svg class="w-5 h-5 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span class="text-gray-700">Meningkatkan keterampilan kompetensi</span>
                            </li>
                        @endif
                    </ul>
                </div>
                
                <!-- Prestasi Cards -->
                @if($prestasi && $prestasi->count() > 0)
                    @foreach($prestasi->take(3) as $index => $item)
                    <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow text-center" style="grid-area: prestasi{{ $index + 1 }}">
                        <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->title ?? 'Prestasi' }}</h3>
                        <p class="text-gray-600 text-sm">{{ $item->content ?? '' }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow text-center" style="grid-area: prestasi1">
                        <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Akreditasi A</h3>
                        <p class="text-gray-600 text-sm">Sekolah terakreditasi dengan skor A</p>
                    </div>
                    
                    <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow text-center" style="grid-area: prestasi2">
                        <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Kelas Industri</h3>
                        <p class="text-gray-600 text-sm">Kerjasama dengan perusahaan besar</p>
                    </div>
                    
                    <div class="bento-info-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow text-center" style="grid-area: prestasi3">
                        <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Penyerapan Lulusan</h3>
                        <p class="text-gray-600 text-sm">Langsung diserap perusahaan besar</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Bento Grid - Program Keahlian & Fasilitas -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Program & Fasilitas</h2>
                <div class="w-24 h-1 bg-pink-primary mx-auto mb-4"></div>
            </div>
            
            <div class="bento-program-grid gap-6">
                <!-- Program Keahlian Cards -->
                @if($programs && $programs->count() > 0)
                    @foreach($programs->take(4) as $index => $item)
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 hover:scale-105" style="grid-area: program{{ $index + 1 }}">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $item->title ?? 'Program Keahlian' }}</h3>
                        <p class="text-gray-600 text-sm mb-3">{{ $item->content ?? '' }}</p>
                        @if($item->meta && isset($item->meta['badge']))
                            <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">{{ $item->meta['badge'] }}</span>
                        @else
                            <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">Kelas Industri</span>
                        @endif
                    </div>
                    @endforeach
                @else
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 hover:scale-105" style="grid-area: program1">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Teknik Komputer & Jaringan</h3>
                        <p class="text-gray-600 text-sm mb-3">Teknologi komputer, jaringan, dan IoT dengan kerjasama Samsung</p>
                        <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">Kelas Industri</span>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 hover:scale-105" style="grid-area: program2">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Rekayasa Perangkat Lunak</h3>
                        <p class="text-gray-600 text-sm mb-3">Pengembangan aplikasi dengan kerjasama Axio & Telkom</p>
                        <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">Kelas Industri</span>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 hover:scale-105" style="grid-area: program3">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Teknik Kendaraan Ringan</h3>
                        <p class="text-gray-600 text-sm mb-3">Teknologi otomotif dengan kurikulum standar PT Honda</p>
                        <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">Kelas Industri</span>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-all duration-300 hover:scale-105" style="grid-area: program4">
                        <div class="w-14 h-14 bg-pink-primary rounded-xl flex items-center justify-center mb-4">
                            <svg class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-2">Teknik Fabrikasi Logam</h3>
                        <p class="text-gray-600 text-sm mb-3">Manufaktur dengan program pelatihan Komatsu "Takumi"</p>
                        <span class="inline-block px-3 py-1 bg-pink-50 text-pink-primary rounded-full text-xs font-medium">Kelas Industri</span>
                    </div>
                @endif
                
                <!-- Fasilitas Cards -->
                @if($fasilitas && $fasilitas->count() > 0)
                    @foreach($fasilitas->take(5) as $index => $item)
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas{{ $index + 1 }}">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">{{ $item->title ?? 'Fasilitas' }}</h3>
                        <p class="text-gray-600 text-xs">{{ $item->content ?? '' }}</p>
                    </div>
                    @endforeach
                @else
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas1">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Lahan ± 12.724 m²</h3>
                        <p class="text-gray-600 text-xs">Lahan luas untuk kenyamanan</p>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas2">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.387-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Laboratorium Praktik</h3>
                        <p class="text-gray-600 text-xs">Fasilitas praktik lengkap</p>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas3">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.111 16.404a5.5 5.5 0 017.778 0M12 20h.01m-7.08-7.071c3.904-3.905 10.236-3.905 14.141 0M1.394 9.393c5.857-5.857 15.355-5.857 21.213 0" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Internet & Teknologi</h3>
                        <p class="text-gray-600 text-xs">Akses teknologi memadai</p>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas4">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Kelas Industri</h3>
                        <p class="text-gray-600 text-xs">Standar perusahaan mitra</p>
                    </div>
                    
                    <div class="bento-program-item bg-white rounded-2xl shadow-lg border border-gray-200 p-5 hover:shadow-xl transition-shadow" style="grid-area: fasilitas5">
                        <div class="w-12 h-12 bg-pink-primary rounded-xl flex items-center justify-center mb-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                            </svg>
                        </div>
                        <h3 class="font-bold text-gray-900 mb-1">Ruang Kelas Modern</h3>
                        <p class="text-gray-600 text-xs">Nyaman dan modern</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Carousel -->
@if($testimonials->count() > 0)
<section class="py-16 bg-white relative overflow-hidden">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-12 text-center">Testimoni</h2>
        <div class="relative max-w-6xl mx-auto">
            <div id="testimonialCarousel" class="overflow-hidden">
                <div class="flex transition-transform duration-500 ease-in-out" id="testimonialTrack">
                    @foreach($testimonials as $testimonial)
                    <div class="testimonial-slide min-w-full px-4">
                        <div class="max-w-3xl mx-auto bg-gradient-to-br from-pink-50 to-white rounded-2xl p-8 md:p-12 shadow-xl border-2 border-pink-100">
                            <div class="flex items-center justify-center mb-6">
                                <div class="flex space-x-1 text-yellow-400">
                                    @for($i = 0; $i < 5; $i++)
                                    <svg class="w-6 h-6 fill-current" viewBox="0 0 20 20">
                                        <path d="M10 15l-5.878 3.09 1.123-6.545L.489 6.91l6.572-.955L10 0l2.939 5.955 6.572.955-4.756 4.635 1.123 6.545z"/>
                                    </svg>
                                    @endfor
                                </div>
                            </div>
                            <p class="text-xl text-gray-700 italic mb-8 text-center leading-relaxed">"{{ $testimonial->pesan }}"</p>
                            <div class="flex items-center justify-center">
                                <div class="w-16 h-16 bg-pink-primary rounded-full flex items-center justify-center text-white text-2xl font-bold mr-4">
                                    {{ strtoupper(substr($testimonial->nama, 0, 1)) }}
                                </div>
                                <div class="text-left">
                                    <h4 class="font-bold text-gray-900 text-lg">{{ $testimonial->nama }}</h4>
                                    <p class="text-sm text-gray-600">{{ $testimonial->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            
            <!-- Navigation Buttons -->
            @if($testimonials->count() > 1)
            <button id="testimonialPrev" class="absolute left-0 top-1/2 -translate-y-1/2 -translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-pink-primary hover:text-white transition-all duration-300 border-2 border-pink-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                </svg>
            </button>
            <button id="testimonialNext" class="absolute right-0 top-1/2 -translate-y-1/2 translate-x-4 bg-white rounded-full p-3 shadow-lg hover:bg-pink-primary hover:text-white transition-all duration-300 border-2 border-pink-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                </svg>
            </button>
            
            <!-- Dots Indicator -->
            <div class="flex justify-center mt-8 space-x-2">
                @foreach($testimonials as $index => $testimonial)
                <button onclick="goToTestimonial({{ $index }})" class="testimonial-dot w-3 h-3 rounded-full {{ $index === 0 ? 'bg-pink-primary' : 'bg-gray-300' }} transition" data-slide="{{ $index }}"></button>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@endif

<!-- Maps & CTA Section -->
<section class="py-16 bg-white border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Google Maps -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Lokasi Sekolah
                    </h2>
                    <p class="text-gray-600 mt-1 text-sm">SMK Negeri 4 Kota Bogor</p>
                </div>
                <div class="h-96 w-full">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3963.4419!2d106.7976!3d-6.5944!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMzUnNDAuMCJTIDEwNsKwNDcrNTEuNCJF!5e0!3m2!1sid!2sid!4v1234567890123!5m2!1sid!2sid" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade"
                        class="w-full h-full">
                    </iframe>
                </div>
                <div class="p-6 border-t border-gray-200">
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <svg class="w-4 h-4 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            Jl. Raya Sekolah, Bogor
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- CTA Kontak Kami -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-8 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-2 flex items-center">
                        <svg class="w-6 h-6 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        Hubungi Kami
                    </h2>
                    <p class="text-gray-600 mb-8">Butuh bantuan atau memiliki pertanyaan? Jangan ragu untuk menghubungi kami melalui berbagai cara di bawah ini.</p>
                    
                    <!-- Contact Info -->
                    <div class="space-y-6 mb-8">
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Email</h3>
                                <p class="text-gray-600">info@smkn4bogor.sch.id</p>
                                <p class="text-gray-600 text-sm">hubungi@smkn4bogor.sch.id</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Telepon</h3>
                                <p class="text-gray-600">(0251) 8321234</p>
                                <p class="text-gray-600 text-sm">Senin - Jumat: 07:00 - 15:00 WIB</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-4">
                            <div class="w-12 h-12 bg-pink-50 rounded-lg flex items-center justify-center flex-shrink-0">
                                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-900 mb-1">Alamat</h3>
                                <p class="text-gray-600">Jl. Raya Sekolah No. 123<br>Kecamatan Bogor Selatan<br>Kota Bogor, Jawa Barat 16134</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- CTA Buttons -->
                <div class="space-y-3">
                    <a href="{{ route('guest.kontak') }}" 
                       class="block w-full px-6 py-4 bg-pink-primary text-white text-center font-bold rounded-xl hover:bg-pink-dark transition-all duration-300 shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                        Kirim Pesan
                    </a>
                    <a href="tel:+622518321234" 
                       class="block w-full px-6 py-3 bg-white text-pink-primary text-center font-medium rounded-xl border-2 border-pink-primary hover:bg-pink-50 transition-all duration-300">
                        Hubungi Sekarang
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    /* Hero Animations */
    @keyframes fadeInUp {
        0% {
            opacity: 0;
            transform: translateY(30px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out forwards;
    }

    /* Hero Slide Transition */
    .hero-slide {
        transition: opacity 1s ease-in-out;
    }

    .hero-slide.active .animate-fade-in-up {
        animation: fadeInUp 0.8s ease-out 0.3s both;
    }

    /* Bento Grid Layout - Galeri */
    .bento-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(3, 200px);
        grid-template-areas:
            "item1 item1 item2 item3"
            "item1 item1 item4 item5"
            "item6 item6 item4 item5";
    }
    
    .bento-item {
        position: relative;
        height: 100%;
        min-height: 200px;
    }
    
    .bento-item:nth-child(1) { grid-area: item1; }
    .bento-item:nth-child(2) { grid-area: item2; }
    .bento-item:nth-child(3) { grid-area: item3; }
    .bento-item:nth-child(4) { grid-area: item4; }
    .bento-item:nth-child(5) { grid-area: item5; }
    .bento-item:nth-child(6) { grid-area: item6; }
    
    /* Content Grid */
    .bento-content-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .bento-content-item {
        min-height: 400px;
    }
    
    /* Bento Info Grid - Visi Misi & Prestasi */
    .bento-info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        grid-template-rows: repeat(2, auto);
        grid-template-areas:
            "visi visi misi prestasi1"
            "visi visi prestasi2 prestasi3";
    }
    
    .bento-info-item {
        min-height: 180px;
    }
    
    /* Bento Program Grid - Program & Fasilitas */
    .bento-program-grid {
        display: grid;
        grid-template-columns: repeat(5, 1fr);
        grid-template-rows: repeat(3, auto);
        grid-template-areas:
            "program1 program1 program2 program2 program2"
            "program3 program3 program4 program4 program4"
            "fasilitas1 fasilitas2 fasilitas3 fasilitas4 fasilitas5";
    }
    
    .bento-program-item {
        min-height: 160px;
    }
    
    /* Responsive */
    @media (max-width: 1024px) {
        .bento-grid {
            grid-template-columns: repeat(3, 1fr);
            grid-template-rows: repeat(4, 180px);
            grid-template-areas:
                "item1 item1 item2"
                "item1 item1 item3"
                "item4 item5 item6"
                "item4 item5 item6";
        }
        
        .bento-content-grid {
            grid-template-columns: 1fr;
        }
        
        .bento-info-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-areas:
                "visi visi"
                "misi misi"
                "prestasi1 prestasi2"
                "prestasi3 prestasi3";
        }
        
        .bento-program-grid {
            grid-template-columns: repeat(3, 1fr);
            grid-template-areas:
                "program1 program1 program2"
                "program3 program3 program4"
                "fasilitas1 fasilitas2 fasilitas3"
                "fasilitas4 fasilitas5 fasilitas5";
        }
    }
    
    @media (max-width: 768px) {
        .bento-grid {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: repeat(6, 200px);
            grid-template-areas:
                "item1 item1"
                "item1 item1"
                "item2 item3"
                "item4 item4"
                "item5 item6"
                "item5 item6";
        }
        
        .bento-info-grid {
            grid-template-columns: 1fr;
            grid-template-areas:
                "visi"
                "misi"
                "prestasi1"
                "prestasi2"
                "prestasi3";
        }
        
        .bento-program-grid {
            grid-template-columns: 1fr;
            grid-template-areas:
                "program1"
                "program2"
                "program3"
                "program4"
                "fasilitas1"
                "fasilitas2"
                "fasilitas3"
                "fasilitas4"
                "fasilitas5";
        }
    }
    
    @media (max-width: 640px) {
        .bento-grid {
            grid-template-columns: 1fr;
            grid-template-rows: repeat(6, 250px);
            grid-template-areas:
                "item1"
                "item2"
                "item3"
                "item4"
                "item5"
                "item6";
        }
    }
</style>
@endpush

@push('scripts')
@if(isset($heroImages) && $heroImages->count() > 1)
<script>
let currentSlide = 0;
const slides = document.querySelectorAll('.hero-slide');
const dots = document.querySelectorAll('.carousel-dot');
const totalSlides = slides.length;

function goToSlide(index) {
    // Hide current slide
    const currentSlideContent = slides[currentSlide].querySelector('.hero-content');
    if (currentSlideContent) {
        currentSlideContent.style.animation = 'none';
        currentSlideContent.style.opacity = '0';
        currentSlideContent.style.transform = 'translateY(30px)';
    }
    
    slides[currentSlide].style.opacity = '0';
    dots[currentSlide].classList.remove('bg-pink-primary', 'ring-2', 'ring-pink-primary', 'ring-offset-2', 'ring-offset-black/50');
    dots[currentSlide].classList.add('opacity-50');
    
    currentSlide = index;
    
    // Show new slide with animation
    setTimeout(() => {
        slides[currentSlide].style.opacity = '1';
        const heroContent = slides[currentSlide].querySelector('.hero-content');
        if (heroContent) {
            heroContent.style.opacity = '0';
            heroContent.style.transform = 'translateY(30px)';
            heroContent.style.animation = 'fadeInUp 0.8s ease-out 0.3s both';
            
            // Trigger reflow to restart animation
            void heroContent.offsetWidth;
        }
    }, 300);
    
    // Update dots
    dots[currentSlide].classList.add('bg-pink-primary', 'ring-2', 'ring-pink-primary', 'ring-offset-2', 'ring-offset-black/50');
    dots[currentSlide].classList.remove('opacity-50');
}

function nextSlide() {
    const next = (currentSlide + 1) % totalSlides;
    goToSlide(next);
}

// Auto-play carousel (setiap 6 detik untuk memberikan waktu membaca title dan deskripsi)
setInterval(nextSlide, 6000);

// Touch swipe support
let touchStartX = 0;
let touchEndX = 0;

const carousel = document.getElementById('heroCarousel');
if (carousel) {
    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    });

    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    });
}

function handleSwipe() {
    if (touchEndX < touchStartX - 50) {
        nextSlide();
    }
    if (touchEndX > touchStartX + 50) {
        const prev = (currentSlide - 1 + totalSlides) % totalSlides;
        goToSlide(prev);
    }
}
</script>
@endif

@if(isset($stats))
<script>
// Counter Animation
document.addEventListener('DOMContentLoaded', function() {
    const counters = document.querySelectorAll('.counter');
    
    const animateCounter = (counter) => {
        const target = parseInt(counter.getAttribute('data-count'));
        const duration = 2000; // 2 seconds
        const step = target / (duration / 16); // 60fps
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current < target) {
                counter.textContent = Math.floor(current);
                requestAnimationFrame(updateCounter);
            } else {
                counter.textContent = target;
            }
        };
        
        // Trigger animation when element is in viewport
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    updateCounter();
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.5 });
        
        observer.observe(counter);
    };
    
    counters.forEach(animateCounter);
});
</script>
@endif

@if(isset($testimonials) && $testimonials->count() > 1)
<script>
// Testimonial Carousel
let currentTestimonial = 0;
const testimonialSlides = document.querySelectorAll('.testimonial-slide');
const testimonialTrack = document.getElementById('testimonialTrack');
const totalTestimonials = testimonialSlides.length;

function goToTestimonial(index) {
    currentTestimonial = index;
    testimonialTrack.style.transform = `translateX(-${currentTestimonial * 100}%)`;
    
    // Update dots
    document.querySelectorAll('.testimonial-dot').forEach((dot, i) => {
        if (i === currentTestimonial) {
            dot.classList.remove('bg-gray-300');
            dot.classList.add('bg-pink-primary');
        } else {
            dot.classList.remove('bg-pink-primary');
            dot.classList.add('bg-gray-300');
        }
    });
}

function nextTestimonial() {
    currentTestimonial = (currentTestimonial + 1) % totalTestimonials;
    goToTestimonial(currentTestimonial);
}

function prevTestimonial() {
    currentTestimonial = (currentTestimonial - 1 + totalTestimonials) % totalTestimonials;
    goToTestimonial(currentTestimonial);
}

// Auto-play testimonial carousel
if (totalTestimonials > 1) {
    setInterval(nextTestimonial, 6000);
    
    document.getElementById('testimonialNext')?.addEventListener('click', nextTestimonial);
    document.getElementById('testimonialPrev')?.addEventListener('click', prevTestimonial);
    
    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;
    const carousel = document.getElementById('testimonialCarousel');
    
    if (carousel) {
        carousel.addEventListener('touchstart', (e) => {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        carousel.addEventListener('touchend', (e) => {
            touchEndX = e.changedTouches[0].screenX;
            if (touchEndX < touchStartX - 50) {
                nextTestimonial();
            }
            if (touchEndX > touchStartX + 50) {
                prevTestimonial();
            }
        });
    }
}
</script>
@endif
@endpush
@endsection
