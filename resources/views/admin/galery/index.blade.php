@extends('layouts.admin')

@section('title', 'Galeri & Foto - Admin')
@section('page-title', 'Galeri & Foto')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.galery.create') }}" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Galeri</a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Post</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jumlah Foto</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($galeries as $galery)
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4">{{ $galery->post->judul ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $galery->fotos->count() }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-medium {{ $galery->status == 1 ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700' }}">
                            {{ $galery->status == 1 ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $galery->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.galery.show', $galery) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <a href="{{ route('admin.galery.edit', $galery) }}" class="text-pink-primary hover:text-pink-dark">Edit</a>
                            <form action="{{ route('admin.galery.destroy', $galery) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-600">Belum ada galeri.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $galeries->links() }}
    </div>
</div>
@endsection
