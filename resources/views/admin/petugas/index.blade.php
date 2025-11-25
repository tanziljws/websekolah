@extends('layouts.admin')

@section('title', 'Petugas - Admin')
@section('page-title', 'Petugas')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.petugas.create') }}" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Petugas</a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Jumlah Posts</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($petugas as $p)
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4 font-medium">{{ $p->username }}</td>
                    <td class="px-6 py-4">{{ $p->posts_count ?? 0 }}</td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $p->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="{{ route('admin.petugas.show', $p) }}" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <a href="{{ route('admin.petugas.edit', $p) }}" class="text-pink-primary hover:text-pink-dark">Edit</a>
                            <form action="{{ route('admin.petugas.destroy', $p) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-600">Belum ada petugas.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $petugas->links() }}
    </div>
</div>
@endsection
