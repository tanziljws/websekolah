@extends('layouts.admin')

@section('title', 'Testimonials - Admin')
@section('page-title', 'Testimonials')

@section('content')
<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Nama</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Pesan</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($testimonials as $testimonial)
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4">{{ $testimonial->nama }}</td>
                    <td class="px-6 py-4">{{ $testimonial->email }}</td>
                    <td class="px-6 py-4">{{ Str::limit($testimonial->pesan, 50) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-medium 
                            {{ $testimonial->status === 'approved' ? 'bg-green-100 text-green-700' : ($testimonial->status === 'rejected' ? 'bg-red-100 text-red-700' : 'bg-gray-100 text-gray-700') }}">
                            {{ ucfirst($testimonial->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">{{ $testimonial->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <button onclick="updateStatus({{ $testimonial->id }}, 'approved')" class="text-green-600 hover:text-green-800">Approve</button>
                            <button onclick="updateStatus({{ $testimonial->id }}, 'rejected')" class="text-red-600 hover:text-red-800">Reject</button>
                            <form action="{{ route('admin.testimonials.destroy', $testimonial->id) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-8 text-center text-gray-600">Belum ada testimonial.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $testimonials->links() }}
    </div>
</div>

@push('scripts')
<script>
function updateStatus(id, status) {
    if (!confirm('Yakin ingin mengubah status?')) return;
    
    fetch(`/admin/testimonials/${id}/status`, {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ status })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            location.reload();
        } else {
            alert('Gagal mengubah status');
        }
    });
}
</script>
@endpush
@endsection
