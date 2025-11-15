<?php $__env->startSection('title', 'Petugas - Admin'); ?>
<?php $__env->startSection('page-title', 'Petugas'); ?>

<?php $__env->startSection('content'); ?>
<div class="mb-6">
    <a href="<?php echo e(route('admin.petugas.create')); ?>" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Petugas</a>
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
                <?php $__empty_1 = true; $__currentLoopData = $petugas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4 font-medium"><?php echo e($p->username); ?></td>
                    <td class="px-6 py-4"><?php echo e($p->posts_count ?? 0); ?></td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($p->created_at->format('d M Y')); ?></td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('admin.petugas.show', $p)); ?>" class="text-blue-600 hover:text-blue-800">Lihat</a>
                            <a href="<?php echo e(route('admin.petugas.edit', $p)); ?>" class="text-pink-primary hover:text-pink-dark">Edit</a>
                            <form action="<?php echo e(route('admin.petugas.destroy', $p)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-gray-600">Belum ada petugas.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        <?php echo e($petugas->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/admin/petugas/index.blade.php ENDPATH**/ ?>