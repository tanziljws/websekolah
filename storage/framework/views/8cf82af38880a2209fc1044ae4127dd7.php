<?php $__env->startSection('title', 'Profil Saya - SMKN 4 BOGOR'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-8 bg-gradient-to-br from-pink-50 via-white to-pink-50 min-h-screen">
    <div class="container mx-auto px-4">
        <div class="max-w-7xl mx-auto">
            <!-- Profile Header -->
            <div class="bg-white/90 backdrop-blur-sm rounded-3xl shadow-2xl border border-gray-100 p-8 mb-8">
                <div class="flex flex-col md:flex-row items-center md:items-start space-y-6 md:space-y-0 md:space-x-8">
                    <!-- Avatar -->
                    <div class="relative">
                        <?php if($user->profile_photo_path): ?>
                        <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" alt="<?php echo e($user->name); ?>" class="w-32 h-32 rounded-full object-cover border-4 border-pink-primary shadow-lg" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        <?php endif; ?>
                        <div class="w-32 h-32 bg-gradient-to-br from-pink-primary to-pink-600 rounded-full flex items-center justify-center text-white text-4xl font-bold shadow-lg <?php echo e($user->profile_photo_path ? 'hidden' : ''); ?>">
                            <?php echo e(strtoupper(substr($user->name ?? 'U', 0, 1))); ?>

                        </div>
                        <div class="absolute bottom-0 right-0 bg-pink-primary text-white rounded-full p-2 shadow-lg border-4 border-white">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                    </div>
                    
                    <!-- Profile Info -->
                    <div class="flex-1 text-center md:text-left">
                        <h1 class="text-4xl font-bold text-gray-900 mb-2"><?php echo e($user->name); ?></h1>
                        <p class="text-xl text-gray-600 mb-4">
                            <span class="text-pink-primary">@</span><?php echo e($user->username ?? 'N/A'); ?>

                        </p>
                        <div class="flex flex-wrap items-center justify-center md:justify-start gap-4 mb-6 text-sm text-gray-600">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                <span><?php echo e($user->email ?? 'N/A'); ?></span>
                            </div>
                            <?php if($user->phone): ?>
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                <span><?php echo e($user->phone); ?></span>
                            </div>
                            <?php endif; ?>
                            <?php if($user->email_verified_at): ?>
                            <div class="flex items-center space-x-2 text-green-600">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                <span>Verified</span>
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <a href="<?php echo e(route('user.profile.edit')); ?>" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200 ring-2 ring-white/20">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Edit Profil
                        </a>
                    </div>
                </div>
                
                <!-- Statistics -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 pt-8 border-t border-gray-200">
                    <div class="text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-2 mb-2">
                            <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900"><?php echo e($totalLikes); ?></h3>
                        </div>
                        <p class="text-gray-600">Galeri Disukai</p>
                    </div>
                    <div class="text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-2 mb-2">
                            <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900"><?php echo e($totalBookmarks); ?></h3>
                        </div>
                        <p class="text-gray-600">Galeri Disimpan</p>
                    </div>
                    <div class="text-center md:text-left">
                        <div class="flex items-center justify-center md:justify-start space-x-2 mb-2">
                            <svg class="w-6 h-6 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="text-2xl font-bold text-gray-900"><?php echo e($totalComments); ?></h3>
                        </div>
                        <p class="text-gray-600">Komentar</p>
                    </div>
                </div>
            </div>
            
            <!-- Tabs Navigation -->
            <div class="bg-white/90 backdrop-blur-sm rounded-2xl shadow-xl border border-gray-100 mb-8">
                <div class="border-b border-gray-200">
                    <nav class="flex -mb-px">
                        <button onclick="switchTab('likes')" id="tab-likes" class="tab-button flex-1 px-6 py-4 text-center font-semibold text-gray-700 border-b-2 border-pink-primary text-pink-primary transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                                <span>Disukai (<?php echo e($totalLikes); ?>)</span>
                            </div>
                        </button>
                        <button onclick="switchTab('bookmarks')" id="tab-bookmarks" class="tab-button flex-1 px-6 py-4 text-center font-semibold text-gray-600 border-b-2 border-transparent hover:text-pink-primary hover:border-pink-primary transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                </svg>
                                <span>Disimpan (<?php echo e($totalBookmarks); ?>)</span>
                            </div>
                        </button>
                        <button onclick="switchTab('comments')" id="tab-comments" class="tab-button flex-1 px-6 py-4 text-center font-semibold text-gray-600 border-b-2 border-transparent hover:text-pink-primary hover:border-pink-primary transition-all duration-200">
                            <div class="flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                </svg>
                                <span>Komentar (<?php echo e($totalComments); ?>)</span>
                            </div>
                        </button>
                    </nav>
                </div>
                
                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Likes Tab -->
                    <div id="content-likes" class="tab-content">
                        <?php if($likedGaleries->count() > 0): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php $__currentLoopData = $likedGaleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('guest.galeri.show', $galery)); ?>" class="group bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <?php if($galery->fotos->count() > 0): ?>
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    <img src="<?php echo e(asset('storage/' . $galery->fotos->first()->file)); ?>" alt="<?php echo e($galery->post->judul ?? 'Galeri'); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent hidden items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="h-48 bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 group-hover:text-pink-primary transition-colors">
                                        <?php echo e($galery->post->judul ?? 'Galeri'); ?>

                                    </h3>
                                    <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span><?php echo e($galery->fotos->count()); ?> foto</span>
                                        </span>
                                        <span class="flex items-center space-x-1 text-pink-primary">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                            </svg>
                                            <span><?php echo e($galery->likes->count() ?? 0); ?></span>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="mt-6">
                            <?php echo e($likedGaleries->links()); ?>

                        </div>
                        <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Galeri yang Disukai</h3>
                            <p class="text-gray-500 mb-6">Jelajahi galeri dan sukai galeri favorit Anda!</p>
                            <a href="<?php echo e(route('guest.galeri')); ?>" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 shadow-lg transition-all duration-200 ring-2 ring-white/20">
                                Jelajahi Galeri
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Bookmarks Tab -->
                    <div id="content-bookmarks" class="tab-content hidden">
                        <?php if($savedGaleries->count() > 0): ?>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                            <?php $__currentLoopData = $savedGaleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('guest.galeri.show', $galery)); ?>" class="group bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                                <?php if($galery->fotos->count() > 0): ?>
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    <img src="<?php echo e(asset('storage/' . $galery->fotos->first()->file)); ?>" alt="<?php echo e($galery->post->judul ?? 'Galeri'); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300" onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent hidden items-center justify-center">
                                        <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="h-48 bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <div class="p-4">
                                    <h3 class="font-bold text-gray-900 mb-1 line-clamp-2 group-hover:text-pink-primary transition-colors">
                                        <?php echo e($galery->post->judul ?? 'Galeri'); ?>

                                    </h3>
                                    <div class="flex items-center justify-between mt-2 text-sm text-gray-500">
                                        <span class="flex items-center space-x-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                            <span><?php echo e($galery->fotos->count()); ?> foto</span>
                                        </span>
                                        <span class="flex items-center space-x-1 text-pink-primary">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="mt-6">
                            <?php echo e($savedGaleries->links()); ?>

                        </div>
                        <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Galeri yang Disimpan</h3>
                            <p class="text-gray-500 mb-6">Simpan galeri favorit untuk dilihat nanti!</p>
                            <a href="<?php echo e(route('guest.galeri')); ?>" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 shadow-lg transition-all duration-200 ring-2 ring-white/20">
                                Jelajahi Galeri
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Comments Tab -->
                    <div id="content-comments" class="tab-content hidden">
                        <?php if($comments->count() > 0): ?>
                        <div class="space-y-6">
                            <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-6 hover:shadow-xl transition-shadow">
                                <div class="flex items-start space-x-4">
                                    <?php if($comment->galery && $comment->galery->fotos->count() > 0): ?>
                                    <a href="<?php echo e(route('guest.galeri.show', $comment->galery)); ?>" class="flex-shrink-0">
                                        <img src="<?php echo e(asset('storage/' . $comment->galery->fotos->first()->file)); ?>" alt="Galeri" class="w-20 h-20 rounded-lg object-cover border-2 border-gray-200 hover:border-pink-primary transition-colors" onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        <div class="w-20 h-20 rounded-lg bg-gradient-to-br from-pink-100 to-pink-200 hidden items-center justify-center">
                                            <svg class="w-10 h-10 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                    </a>
                                    <?php endif; ?>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center justify-between mb-2">
                                            <h4 class="font-semibold text-gray-900">
                                                <?php if($comment->galery && $comment->galery->post): ?>
                                                    <a href="<?php echo e(route('guest.galeri.show', $comment->galery)); ?>" class="hover:text-pink-primary transition-colors">
                                                        <?php echo e($comment->galery->post->judul); ?>

                                                    </a>
                                                <?php else: ?>
                                                    <span class="text-gray-400">Galeri sudah dihapus</span>
                                                <?php endif; ?>
                                            </h4>
                                            <span class="text-sm text-gray-500">
                                                <?php echo e($comment->created_at->diffForHumans()); ?>

                                            </span>
                                        </div>
                                        <p class="text-gray-700 whitespace-pre-wrap"><?php echo e($comment->body); ?></p>
                                        <div class="mt-3 flex items-center space-x-4 text-sm text-gray-500">
                                            <span class="flex items-center space-x-1">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                                                </svg>
                                                <span><?php echo e($comment->children->count()); ?> balasan</span>
                                            </span>
                                            <?php if($comment->galery): ?>
                                            <a href="<?php echo e(route('guest.galeri.show', $comment->galery)); ?>" class="text-pink-primary hover:text-pink-dark font-medium">
                                                Lihat Galeri →
                                            </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="mt-6">
                            <?php echo e($comments->links()); ?>

                        </div>
                        <?php else: ?>
                        <div class="text-center py-12">
                            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Komentar</h3>
                            <p class="text-gray-500 mb-6">Mulai berkomentar di galeri favorit Anda!</p>
                            <a href="<?php echo e(route('guest.galeri')); ?>" class="inline-flex items-center px-6 py-3 bg-pink-600 text-white font-bold rounded-xl hover:bg-pink-700 shadow-lg transition-all duration-200 ring-2 ring-white/20">
                                Jelajahi Galeri
                            </a>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script>
function switchTab(tab) {
    // Hide all tab contents
    document.querySelectorAll('.tab-content').forEach(content => {
        content.classList.add('hidden');
    });
    
    // Remove active state from all tabs
    document.querySelectorAll('.tab-button').forEach(button => {
        button.classList.remove('border-pink-primary', 'text-pink-primary');
        button.classList.add('border-transparent', 'text-gray-600');
    });
    
    // Show selected tab content
    document.getElementById('content-' + tab).classList.remove('hidden');
    
    // Add active state to selected tab
    const activeTab = document.getElementById('tab-' + tab);
    activeTab.classList.remove('border-transparent', 'text-gray-600');
    activeTab.classList.add('border-pink-primary', 'text-pink-primary');
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/user/profile.blade.php ENDPATH**/ ?>