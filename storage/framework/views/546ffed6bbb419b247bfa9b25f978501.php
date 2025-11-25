<?php $__env->startSection('title', 'Profil Sekolah - SMKN 4 BOGOR'); ?>

<?php $__env->startSection('content'); ?>
<!-- Header Section -->
<section class="py-16 bg-white border-b border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto text-center">
            <div class="flex justify-center mb-6">
                <img src="<?php echo e(asset('logo.png')); ?>" alt="SMKN 4 BOGOR" class="h-32 w-auto object-contain">
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">Profil Sekolah</h1>
            <p class="text-xl text-gray-600">SMK Negeri 4 Kota Bogor</p>
        </div>
    </div>
</section>

<!-- Main Content -->
<?php if($profile): ?>
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <!-- Title -->
            <div class="mb-12 text-center border-b border-gray-200 pb-8">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4"><?php echo e($profile->judul ?? 'Profil Sekolah'); ?></h2>
                <div class="w-24 h-1 bg-pink-primary mx-auto"></div>
            </div>
            
            <!-- Content Sections -->
            <div class="prose prose-lg max-w-none">
                <?php
                    $content = $profile->isi ?? '';
                    $paragraphs = preg_split('/\n\s*\n/', $content);
                ?>
                
                <?php $__currentLoopData = $paragraphs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(trim($paragraph)): ?>
                    <div class="mb-8 p-6 bg-gray-50 rounded-xl border border-gray-200 hover:border-pink-primary transition-colors duration-300">
                        <p class="text-gray-700 leading-relaxed text-lg whitespace-pre-line"><?php echo e(trim($paragraph)); ?></p>
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
                <?php if(empty(trim($content))): ?>
                <div class="text-center py-12">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <p class="text-gray-600 text-lg">Profil sekolah akan segera tersedia.</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php else: ?>
<!-- Empty State -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto text-center">
            <div class="bg-gray-50 rounded-2xl p-12 border border-gray-200">
                <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Profil Sekolah</h3>
                <p class="text-gray-600 text-lg mb-8">Informasi profil sekolah akan segera tersedia.</p>
                <a href="<?php echo e(route('guest.home')); ?>" class="inline-flex items-center px-6 py-3 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition font-medium">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Additional Info Section -->
<section class="py-12 bg-gray-50 border-t border-gray-200">
    <div class="container mx-auto px-4">
        <div class="max-w-5xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Contact Card -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-pink-primary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Kontak</h3>
                    <p class="text-gray-600">Hubungi kami untuk informasi lebih lanjut</p>
                    <a href="<?php echo e(route('guest.kontak')); ?>" class="inline-flex items-center mt-4 text-pink-primary hover:text-pink-dark font-medium">
                        Lihat Kontak
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                
                <!-- Gallery Card -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-pink-primary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Galeri</h3>
                    <p class="text-gray-600">Lihat berbagai kegiatan sekolah</p>
                    <a href="<?php echo e(route('guest.galeri')); ?>" class="inline-flex items-center mt-4 text-pink-primary hover:text-pink-dark font-medium">
                        Lihat Galeri
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
                
                <!-- Information Card -->
                <div class="bg-white rounded-xl p-6 border border-gray-200 hover:shadow-lg transition-shadow">
                    <div class="w-12 h-12 bg-pink-primary rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Informasi</h3>
                    <p class="text-gray-600">Update terbaru dari sekolah</p>
                    <a href="<?php echo e(route('guest.informasi')); ?>" class="inline-flex items-center mt-4 text-pink-primary hover:text-pink-dark font-medium">
                        Lihat Informasi
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/guest/profil.blade.php ENDPATH**/ ?>