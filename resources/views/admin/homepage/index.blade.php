@extends('layouts.admin')

@section('title', 'Kelola Homepage - Admin Panel')
@section('page-title', 'Kelola Konten Homepage')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
    <!-- Form Section - Left -->
    <div class="space-y-6">
        <!-- Visi -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </div>
                    Visi Sekolah
                </h3>
                <button onclick="saveContent('visi')" class="px-4 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium">
                    Simpan
                </button>
            </div>
            <form id="visi-form">
                <input type="hidden" name="type" value="visi">
                <div class="mb-4">
                    <label class="block text-gray-700 font-medium mb-2">Konten Visi</label>
                    <textarea name="content" id="visi-content" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-pink-primary focus:border-transparent resize-none" placeholder="Masukkan visi sekolah...">{{ $visi->content ?? 'Menjadi sekolah "tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan."' }}</textarea>
                </div>
            </form>
        </div>
        
        <!-- Misi -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <div class="w-10 h-10 bg-pink-primary rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    Misi Sekolah
                </h3>
                <button onclick="saveMisi()" class="px-4 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium">
                    Simpan
                </button>
            </div>
            <div id="misi-items" class="space-y-3">
                @if($misi && $misi->count() > 0)
                    @foreach($misi as $index => $item)
                    <div class="flex items-start space-x-3" data-misi-id="{{ $item->id }}">
                        <input type="text" name="misi_content" value="{{ $item->content }}" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" onchange="updatePreview('misi', {{ $index }})">
                        <button onclick="deleteMisi({{ $item->id }})" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    @endforeach
                @else
                    <div class="flex items-start space-x-3" data-misi-id="new-0">
                        <input type="text" name="misi_content" value="Menumbuhkan sikap agama / spiritualitas" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" onchange="updatePreview('misi', 0)">
                        <button onclick="deleteMisiItem(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-start space-x-3" data-misi-id="new-1">
                        <input type="text" name="misi_content" value="Mengembangkan literasi sesuai kompetensi siswa" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" onchange="updatePreview('misi', 1)">
                        <button onclick="deleteMisiItem(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex items-start space-x-3" data-misi-id="new-2">
                        <input type="text" name="misi_content" value="Meningkatkan keterampilan kompetensi sesuai jurusan" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" onchange="updatePreview('misi', 2)">
                        <button onclick="deleteMisiItem(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </div>
                @endif
                <button onclick="addMisiItem()" class="w-full px-4 py-2 border-2 border-dashed border-gray-300 rounded-lg text-gray-600 hover:border-pink-primary hover:text-pink-primary transition font-medium">
                    + Tambah Misi
                </button>
            </div>
        </div>
        
        <!-- Prestasi, Program, Fasilitas - Tabs -->
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex space-x-2 mb-6 border-b border-gray-200">
                <button onclick="switchTab('prestasi')" class="tab-btn px-4 py-2 font-medium text-gray-700 hover:text-pink-primary border-b-2 border-transparent hover:border-pink-primary transition" data-tab="prestasi">
                    Prestasi
                </button>
                <button onclick="switchTab('program')" class="tab-btn px-4 py-2 font-medium text-gray-700 hover:text-pink-primary border-b-2 border-transparent hover:border-pink-primary transition" data-tab="program">
                    Program
                </button>
                <button onclick="switchTab('fasilitas')" class="tab-btn px-4 py-2 font-medium text-gray-700 hover:text-pink-primary border-b-2 border-transparent hover:border-pink-primary transition" data-tab="fasilitas">
                    Fasilitas
                </button>
            </div>
            
            <!-- Prestasi Tab -->
            <div id="prestasi-tab" class="tab-content space-y-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Prestasi & Pencapaian</h3>
                    <button onclick="addContentItem('prestasi')" class="px-4 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium text-sm">
                        + Tambah
                    </button>
                </div>
                <div id="prestasi-items" class="space-y-3">
                    @if($prestasi && $prestasi->count() > 0)
                        @foreach($prestasi as $index => $item)
                        <div class="border border-gray-200 rounded-xl p-4" data-item-id="{{ $item->id }}">
                            <input type="text" name="title" value="{{ $item->title }}" placeholder="Judul" class="w-full mb-2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" onchange="updatePreview('prestasi', {{ $index }})">
                            <textarea name="content" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary resize-none" onchange="updatePreview('prestasi', {{ $index }})">{{ $item->content }}</textarea>
                            <div class="flex justify-end mt-2 space-x-2">
                                <button onclick="saveContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
                                <button onclick="deleteContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Program Tab -->
            <div id="program-tab" class="tab-content hidden space-y-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Program Keahlian</h3>
                    <button onclick="addContentItem('program')" class="px-4 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium text-sm">
                        + Tambah
                    </button>
                </div>
                <div id="program-items" class="space-y-3">
                    @if($programs && $programs->count() > 0)
                        @foreach($programs as $index => $item)
                        <div class="border border-gray-200 rounded-xl p-4" data-item-id="{{ $item->id }}">
                            <input type="text" name="title" value="{{ $item->title }}" placeholder="Nama Program" class="w-full mb-2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" onchange="updatePreview('program', {{ $index }})">
                            <textarea name="content" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary resize-none" onchange="updatePreview('program', {{ $index }})">{{ $item->content }}</textarea>
                            <div class="flex justify-end mt-2 space-x-2">
                                <button onclick="saveContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
                                <button onclick="deleteContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            
            <!-- Fasilitas Tab -->
            <div id="fasilitas-tab" class="tab-content hidden space-y-4">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-bold text-gray-900">Fasilitas Sekolah</h3>
                    <button onclick="addContentItem('fasilitas')" class="px-4 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium text-sm">
                        + Tambah
                    </button>
                </div>
                <div id="fasilitas-items" class="space-y-3">
                    @if($fasilitas && $fasilitas->count() > 0)
                        @foreach($fasilitas as $index => $item)
                        <div class="border border-gray-200 rounded-xl p-4" data-item-id="{{ $item->id }}">
                            <input type="text" name="title" value="{{ $item->title }}" placeholder="Nama Fasilitas" class="w-full mb-2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" onchange="updatePreview('fasilitas', {{ $index }})">
                            <textarea name="content" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary resize-none" onchange="updatePreview('fasilitas', {{ $index }})">{{ $item->content }}</textarea>
                            <div class="flex justify-end mt-2 space-x-2">
                                <button onclick="saveContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
                                <button onclick="deleteContentItem({{ $item->id }})" class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Preview Section - Right -->
    <div class="lg:sticky lg:top-6 lg:h-screen lg:overflow-y-auto">
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-xl font-bold text-gray-900 flex items-center">
                    <svg class="w-6 h-6 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Preview Real-time
                </h3>
                <a href="{{ route('guest.home') }}" target="_blank" class="px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition font-medium">
                    Lihat di Website
                </a>
            </div>
            
            <!-- Preview Container -->
            <div id="preview-container" class="space-y-6">
                <!-- Visi Preview -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        Visi
                    </h4>
                    <p id="preview-visi" class="text-gray-700 leading-relaxed">
                        {{ $visi->content ?? 'Menjadi sekolah "tangguh dalam IMTAQ, cerdas, terampil, mandiri, berbasis Teknologi Informasi dan Komunikasi, dan berwawasan lingkungan."' }}
                    </p>
                </div>
                
                <!-- Misi Preview -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-900 mb-3 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Misi
                    </h4>
                    <ul id="preview-misi" class="space-y-2">
                        @if($misi && $misi->count() > 0)
                            @foreach($misi as $item)
                            <li class="flex items-start text-sm text-gray-700">
                                <svg class="w-4 h-4 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>{{ $item->content }}</span>
                            </li>
                            @endforeach
                        @else
                            <li class="flex items-start text-sm text-gray-700">
                                <svg class="w-4 h-4 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Menumbuhkan sikap agama / spiritualitas</span>
                            </li>
                            <li class="flex items-start text-sm text-gray-700">
                                <svg class="w-4 h-4 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Mengembangkan literasi sesuai kompetensi</span>
                            </li>
                            <li class="flex items-start text-sm text-gray-700">
                                <svg class="w-4 h-4 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                                <span>Meningkatkan keterampilan kompetensi</span>
                            </li>
                        @endif
                    </ul>
                </div>
                
                <!-- Prestasi Preview -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-900 mb-3">Prestasi</h4>
                    <div id="preview-prestasi" class="space-y-3">
                        @if($prestasi && $prestasi->count() > 0)
                            @foreach($prestasi->take(3) as $item)
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <h5 class="font-bold text-gray-900 mb-1">{{ $item->title }}</h5>
                                <p class="text-sm text-gray-600">{{ $item->content }}</p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <!-- Program Preview -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-900 mb-3">Program Keahlian</h4>
                    <div id="preview-program" class="space-y-3">
                        @if($programs && $programs->count() > 0)
                            @foreach($programs->take(4) as $item)
                            <div class="bg-white rounded-lg p-4 border border-gray-200">
                                <h5 class="font-bold text-gray-900 mb-1">{{ $item->title }}</h5>
                                <p class="text-sm text-gray-600">{{ $item->content }}</p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                
                <!-- Fasilitas Preview -->
                <div class="bg-gray-50 rounded-xl p-6 border border-gray-200">
                    <h4 class="font-bold text-gray-900 mb-3">Fasilitas</h4>
                    <div id="preview-fasilitas" class="grid grid-cols-2 gap-3">
                        @if($fasilitas && $fasilitas->count() > 0)
                            @foreach($fasilitas->take(6) as $item)
                            <div class="bg-white rounded-lg p-3 border border-gray-200">
                                <h5 class="font-bold text-gray-900 text-sm mb-1">{{ $item->title }}</h5>
                                <p class="text-xs text-gray-600">{{ $item->content }}</p>
                            </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
let currentTab = 'prestasi';
let misiCounter = {{ ($misi && $misi->count() > 0) ? $misi->count() : 3 }};

// Switch tabs
function switchTab(tab) {
    currentTab = tab;
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    document.querySelectorAll('.tab-btn').forEach(btn => {
        btn.classList.remove('border-pink-primary', 'text-pink-primary');
        btn.classList.add('border-transparent');
    });
    document.getElementById(tab + '-tab').classList.remove('hidden');
    document.querySelector(`[data-tab="${tab}"]`).classList.add('border-pink-primary', 'text-pink-primary');
}

// Save Visi
function saveContent(type) {
    const form = document.getElementById(type + '-form');
    const formData = new FormData(form);
    formData.append('type', type);
    
    fetch('{{ route("admin.homepage.store") }}', {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updatePreview(type);
            showNotification('Content berhasil disimpan!', 'success');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan!', 'error');
    });
}

// Save Misi
function saveMisi() {
    const items = document.querySelectorAll('#misi-items [data-misi-id]');
    const misiData = [];
    
    items.forEach(item => {
        const input = item.querySelector('input[name="misi_content"]');
        if (input && input.value.trim()) {
            misiData.push({
                id: item.dataset.misiId,
                content: input.value.trim()
            });
        }
    });
    
    // Save each misi item
    Promise.all(misiData.map((misi, index) => {
        const formData = new FormData();
        formData.append('type', 'misi');
        formData.append('content', misi.content);
        formData.append('order', index);
        
        if (misi.id && !misi.id.startsWith('new-')) {
            return fetch(`/admin/homepage/${misi.id}`, {
                method: 'PUT',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        } else {
            return fetch('{{ route("admin.homepage.store") }}', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            });
        }
    }))
    .then(() => {
        updatePreview('misi');
        showNotification('Misi berhasil disimpan!', 'success');
        location.reload();
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan!', 'error');
    });
}

// Add Misi Item
function addMisiItem() {
    const container = document.getElementById('misi-items');
    const newItem = document.createElement('div');
    newItem.className = 'flex items-start space-x-3';
    newItem.dataset.misiId = 'new-' + misiCounter;
    newItem.innerHTML = `
        <input type="text" name="misi_content" placeholder="Masukkan misi..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" onchange="updatePreview('misi', ${misiCounter})">
        <button onclick="deleteMisiItem(this)" class="px-3 py-2 text-red-600 hover:bg-red-50 rounded-lg transition">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
            </svg>
        </button>
    `;
    container.appendChild(newItem);
    misiCounter++;
    updatePreview('misi');
}

function deleteMisiItem(btn) {
    btn.closest('[data-misi-id]').remove();
    updatePreview('misi');
}

function deleteMisi(id) {
    if (confirm('Hapus misi ini?')) {
        fetch(`/admin/homepage/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(() => {
            location.reload();
        });
    }
}

// Add Content Item
function addContentItem(type) {
    const container = document.getElementById(type + '-items');
    const newItem = document.createElement('div');
    newItem.className = 'border border-gray-200 rounded-xl p-4';
    newItem.dataset.itemId = 'new-' + Date.now();
    newItem.innerHTML = `
        <input type="text" name="title" placeholder="Judul" class="w-full mb-2 px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" onchange="updatePreview('${type}', this)">
        <textarea name="content" rows="2" placeholder="Deskripsi" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary resize-none" onchange="updatePreview('${type}', this)"></textarea>
        <div class="flex justify-end mt-2 space-x-2">
            <button onclick="saveContentItem(null, '${type}', this)" class="px-3 py-1 text-sm bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Simpan</button>
            <button onclick="deleteContentItemElement(this)" class="px-3 py-1 text-sm bg-red-500 text-white rounded-lg hover:bg-red-600 transition">Hapus</button>
        </div>
    `;
    container.appendChild(newItem);
    updatePreview(type);
}

// Save Content Item
function saveContentItem(id, type, element) {
    const item = element ? element.closest('[data-item-id]') : document.querySelector(`[data-item-id="${id}"]`);
    const title = item.querySelector('input[name="title"]').value;
    const content = item.querySelector('textarea[name="content"]').value;
    
    if (!title || !content) {
        showNotification('Judul dan deskripsi wajib diisi!', 'error');
        return;
    }
    
    const formData = new FormData();
    formData.append('type', type);
    formData.append('title', title);
    formData.append('content', content);
    formData.append('order', document.querySelectorAll(`#${type}-items [data-item-id]`).length);
    
    const url = id ? `/admin/homepage/${id}` : '{{ route("admin.homepage.store") }}';
    const method = id ? 'PUT' : 'POST';
    
    fetch(url, {
        method: method,
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (!id && data.content) {
                item.dataset.itemId = data.content.id;
            }
            updatePreview(type);
            showNotification('Content berhasil disimpan!', 'success');
            if (!id) location.reload();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('Terjadi kesalahan!', 'error');
    });
}

// Delete Content Item
function deleteContentItem(id) {
    if (confirm('Hapus item ini?')) {
        fetch(`/admin/homepage/${id}`, {
            method: 'DELETE',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                updatePreview('prestasi');
                location.reload();
            }
        });
    }
}

function deleteContentItemElement(element) {
    element.closest('[data-item-id]').remove();
    updatePreview(currentTab);
}

// Update Preview Real-time
function updatePreview(type, indexOrElement) {
    if (type === 'visi') {
        const content = document.getElementById('visi-content').value;
        document.getElementById('preview-visi').textContent = content;
    } else if (type === 'misi') {
        const items = document.querySelectorAll('#misi-items [data-misi-id] input[name="misi_content"]');
        const preview = document.getElementById('preview-misi');
        preview.innerHTML = '';
        items.forEach((input, index) => {
            if (input.value.trim()) {
                const li = document.createElement('li');
                li.className = 'flex items-start text-sm text-gray-700';
                li.innerHTML = `
                    <svg class="w-4 h-4 text-pink-primary mr-2 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>${input.value}</span>
                `;
                preview.appendChild(li);
            }
        });
    } else {
        const container = document.getElementById(type + '-items');
        const items = container.querySelectorAll('[data-item-id]');
        const preview = document.getElementById('preview-' + type);
        
        if (type === 'fasilitas') {
            preview.innerHTML = '';
            items.forEach((item, index) => {
                const title = item.querySelector('input[name="title"]').value;
                const content = item.querySelector('textarea[name="content"]').value;
                if (title || content) {
                    const div = document.createElement('div');
                    div.className = 'bg-white rounded-lg p-3 border border-gray-200';
                    div.innerHTML = `
                        <h5 class="font-bold text-gray-900 text-sm mb-1">${title || 'Judul'}</h5>
                        <p class="text-xs text-gray-600">${content || 'Deskripsi'}</p>
                    `;
                    preview.appendChild(div);
                }
            });
        } else {
            preview.innerHTML = '';
            items.forEach((item, index) => {
                const title = item.querySelector('input[name="title"]').value;
                const content = item.querySelector('textarea[name="content"]').value;
                if (title || content) {
                    const div = document.createElement('div');
                    div.className = 'bg-white rounded-lg p-4 border border-gray-200';
                    div.innerHTML = `
                        <h5 class="font-bold text-gray-900 mb-1">${title || 'Judul'}</h5>
                        <p class="text-sm text-gray-600">${content || 'Deskripsi'}</p>
                    `;
                    preview.appendChild(div);
                }
            });
        }
    }
}

// Real-time preview listeners
document.addEventListener('DOMContentLoaded', function() {
    // Visi
    const visiInput = document.getElementById('visi-content');
    if (visiInput) {
        visiInput.addEventListener('input', () => updatePreview('visi'));
    }
    
    // Misi
    document.querySelectorAll('#misi-items input[name="misi_content"]').forEach(input => {
        input.addEventListener('input', () => updatePreview('misi'));
    });
    
    // Other tabs
    ['prestasi', 'program', 'fasilitas'].forEach(type => {
        const container = document.getElementById(type + '-items');
        if (container) {
            container.addEventListener('input', (e) => {
                if (e.target.matches('input[name="title"], textarea[name="content"]')) {
                    updatePreview(type);
                }
            });
        }
    });
});

// Notification
function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    switchTab('prestasi');
});
</script>
@endpush
@endsection

