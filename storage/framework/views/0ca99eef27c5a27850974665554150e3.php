<?php $__env->startSection('title', 'Dashboard Admin - Web Galeri Sekolah'); ?>
<?php $__env->startSection('page-title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
    <!-- Stats Cards -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Posts</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($totalPosts); ?></p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Galeri</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($totalGaleries); ?></p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Foto</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($totalFotos); ?></p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-600 text-sm font-medium">Total Petugas</p>
                <p class="text-3xl font-bold text-gray-900 mt-2"><?php echo e($totalPetugas); ?></p>
            </div>
            <div class="w-12 h-12 bg-pink-light rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                </svg>
            </div>
        </div>
    </div>
</div>

<!-- Recent Posts -->
<div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-xl font-bold text-gray-900">Post Terbaru</h2>
        <a href="<?php echo e(route('admin.posts.index')); ?>" class="text-pink-primary hover:text-pink-dark font-medium">Lihat Semua →</a>
    </div>
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead>
                <tr class="border-b border-gray-200">
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Judul</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Kategori</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Status</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-700">Tanggal</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $recentPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-b border-gray-100 hover:bg-pink-light transition">
                    <td class="py-3 px-4"><?php echo e(Str::limit($post->judul, 40)); ?></td>
                    <td class="py-3 px-4"><?php echo e($post->kategori->judul ?? '-'); ?></td>
                    <td class="py-3 px-4">
                        <span class="px-2 py-1 rounded text-xs font-medium <?php echo e($post->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-700'); ?>">
                            <?php echo e(ucfirst($post->status)); ?>

                        </span>
                    </td>
                    <td class="py-3 px-4 text-sm text-gray-600"><?php echo e($post->created_at->format('d M Y')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="4" class="py-8 text-center text-gray-600">Belum ada post.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Statistics Charts -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
    <!-- Posts by Status Chart -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Posts by Status</h3>
        <div class="h-64 flex items-end justify-around space-x-2">
            <?php
                $publishedCount = \App\Models\Post::where('status', 'published')->count();
                $draftCount = \App\Models\Post::where('status', 'draft')->count();
                $maxCount = max($publishedCount, $draftCount, 1);
            ?>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gray-200 rounded-t-lg flex items-end" style="height: 200px;">
                    <div class="w-full bg-green-500 rounded-t-lg transition-all duration-500" style="height: <?php echo e(($publishedCount / $maxCount) * 100); ?>%"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Published</p>
                <p class="text-2xl font-bold text-gray-900"><?php echo e($publishedCount); ?></p>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gray-200 rounded-t-lg flex items-end" style="height: 200px;">
                    <div class="w-full bg-gray-500 rounded-t-lg transition-all duration-500" style="height: <?php echo e(($draftCount / $maxCount) * 100); ?>%"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Draft</p>
                <p class="text-2xl font-bold text-gray-900"><?php echo e($draftCount); ?></p>
            </div>
        </div>
    </div>
    
    <!-- Gallery Status Chart -->
    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Galeri by Status</h3>
        <div class="h-64 flex items-end justify-around space-x-2">
            <?php
                $activeGaleries = \App\Models\Galery::where('status', 1)->count();
                $inactiveGaleries = \App\Models\Galery::where('status', 0)->count();
                $maxGaleries = max($activeGaleries, $inactiveGaleries, 1);
            ?>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gray-200 rounded-t-lg flex items-end" style="height: 200px;">
                    <div class="w-full bg-pink-primary rounded-t-lg transition-all duration-500" style="height: <?php echo e(($activeGaleries / $maxGaleries) * 100); ?>%"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Aktif</p>
                <p class="text-2xl font-bold text-gray-900"><?php echo e($activeGaleries); ?></p>
            </div>
            <div class="flex-1 flex flex-col items-center">
                <div class="w-full bg-gray-200 rounded-t-lg flex items-end" style="height: 200px;">
                    <div class="w-full bg-gray-500 rounded-t-lg transition-all duration-500" style="height: <?php echo e(($inactiveGaleries / $maxGaleries) * 100); ?>%"></div>
                </div>
                <p class="mt-2 text-sm font-medium text-gray-700">Nonaktif</p>
                <p class="text-2xl font-bold text-gray-900"><?php echo e($inactiveGaleries); ?></p>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>