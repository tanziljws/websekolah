<?php $__env->startSection('title', 'Agenda Sekolah - Admin'); ?>
<?php $__env->startSection('page-title', 'Agenda Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<?php if(session('success')): ?>
<div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
    </svg>
    <?php echo e(session('success')); ?>

</div>
<?php endif; ?>

<?php if(session('error')): ?>
<div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg flex items-center">
    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
    </svg>
    <?php echo e(session('error')); ?>

</div>
<?php endif; ?>

<div class="mb-6">
    <a href="<?php echo e(route('admin.agenda.create')); ?>" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Tambah Agenda</a>
</div>

<div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Judul</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Galeri</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="hover:bg-pink-light transition">
                    <td class="px-6 py-4 font-medium"><?php echo e(Str::limit($post->judul, 60)); ?></td>
                    <td class="px-6 py-4">
                        <?php if($post->galery): ?>
                        <a href="<?php echo e(route('admin.galery.show', $post->galery)); ?>" class="text-pink-primary hover:text-pink-dark text-sm">
                            <?php echo e($post->galery->post->judul ?? 'Galeri #' . $post->galery->id); ?>

                        </a>
                        <?php else: ?>
                        <span class="text-gray-400 text-sm">-</span>
                        <?php endif; ?>
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded text-xs font-medium <?php echo e($post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'); ?>">
                            <?php echo e($post->status === 'published' ? 'Published' : 'Draft'); ?>

                        </span>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600"><?php echo e($post->created_at->format('d M Y')); ?></td>
                    <td class="px-6 py-4">
                        <div class="flex space-x-2">
                            <a href="<?php echo e(route('admin.agenda.show', $post)); ?>" class="text-blue-600 hover:text-blue-800 text-sm">Lihat</a>
                            <a href="<?php echo e(route('admin.agenda.edit', $post)); ?>" class="text-pink-primary hover:text-pink-dark text-sm">Edit</a>
                            <form action="<?php echo e(route('admin.agenda.destroy', $post)); ?>" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-800 text-sm">Hapus</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="px-6 py-8 text-center text-gray-600">Belum ada agenda. <a href="<?php echo e(route('admin.agenda.create')); ?>" class="text-pink-primary hover:text-pink-dark">Tambah agenda pertama</a></td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="px-6 py-4 border-t border-gray-200">
        <?php echo e($posts->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/admin/agenda/index.blade.php ENDPATH**/ ?>