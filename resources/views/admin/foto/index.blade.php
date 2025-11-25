@extends('layouts.admin')

@section('title', 'Foto - Admin')
@section('page-title', 'Foto')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.foto.create') }}" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Foto</a>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
    @forelse($fotos as $foto)
    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
        <div class="relative h-48 overflow-hidden">
            <img src="{{ asset('storage/' . $foto->file) }}" alt="Foto" class="w-full h-full object-cover">
        </div>
        <div class="p-4">
            <p class="text-sm text-gray-600 mb-2">Galeri: {{ $foto->galery->post->judul ?? '-' }}</p>
            <p class="text-xs text-gray-500 mb-4">{{ $foto->created_at->format('d M Y') }}</p>
            <div class="flex space-x-2">
                <a href="{{ route('admin.foto.show', $foto) }}" class="text-blue-600 hover:text-blue-800 text-sm">Lihat</a>
                <a href="{{ route('admin.foto.edit', $foto) }}" class="text-pink-primary hover:text-pink-dark text-sm">Edit</a>
                <form action="{{ route('admin.foto.destroy', $foto) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-span-full text-center py-12 text-gray-600">Belum ada foto.</div>
    @endforelse
</div>

<div class="mt-6">
    {{ $fotos->links() }}
</div>
@endsection
