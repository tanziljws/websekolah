<?php $__env->startSection('title', 'Agenda - Web Galeri Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Agenda Sekolah</h1>
        
        <?php if($posts->count() > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(route('guest.agenda.show', $post)); ?>" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden border border-gray-200">
                <?php if($post->galery && $post->galery->fotos->count() > 0): ?>
                <div class="relative h-48 bg-gray-200 overflow-hidden">
                    <img src="<?php echo e(asset('storage/' . $post->galery->fotos->first()->file)); ?>" 
                         alt="<?php echo e($post->judul); ?>" 
                         class="w-full h-full object-cover"
                         onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                    <div class="absolute top-2 right-2 bg-pink-primary text-white px-2 py-1 rounded text-xs font-medium flex items-center">
                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"/>
                        </svg>
                        <?php echo e($post->galery->fotos->count()); ?> foto
                    </div>
                </div>
                <?php endif; ?>
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-900 mb-3 line-clamp-2"><?php echo e($post->judul); ?></h2>
                    <p class="text-gray-600 mb-4 line-clamp-3"><?php echo e(Str::limit(strip_tags($post->isi), 150)); ?></p>
                    <div class="flex items-center justify-between text-sm text-gray-500">
                        <span><?php echo e($post->petugas->username ?? 'Admin'); ?></span>
                        <span><?php echo e($post->created_at->format('d M Y')); ?></span>
                    </div>
                </div>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Pagination -->
        <div class="mt-8">
            <?php echo e($posts->links()); ?>

        </div>
        <?php else: ?>
        <div class="text-center py-12">
            <p class="text-gray-600">Belum ada agenda tersedia.</p>
        </div>
        <?php endif; ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/guest/agenda/index.blade.php ENDPATH**/ ?>