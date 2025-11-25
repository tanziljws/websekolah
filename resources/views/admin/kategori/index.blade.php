@extends('layouts.admin')

@section('title', 'Kategori - Admin')
@section('page-title', 'Kategori')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.kategori.create') }}" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Kategori</a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jumlah Posts</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($kategoris as $kategori)
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4 font-medium">{{ $kategori->judul }}</td>
                    <td class="px-6 py-4">{{ $kategori->posts_count ?? 0 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $kategori->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.kategori.show', $kategori) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <a href="{{ route('admin.kategori.edit', $kategori) }}" class="text-pink-primary hover:text-pink-dark">Edit</a>
                            <form action="{{ route('admin.kategori.destroy', $kategori) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-600">Belum ada kategori.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $kategoris->links() }}
    </div>
</div>
@endsection
