<?php $__env->startSection('title', $galery->post->judul ?? 'Detail Galeri - Web Galeri Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-6xl mx-auto">
            <!-- Header -->
            <div class="mb-8">
                <a href="<?php echo e(route('guest.galeri')); ?>" class="text-pink-primary hover:text-pink-dark mb-4 inline-block">← Kembali ke Galeri</a>
                <h1 class="text-4xl font-bold text-gray-900"><?php echo e($galery->post->judul ?? 'Galeri'); ?></h1>
            </div>
            
            <!-- Actions (Like, Bookmark, Share) -->
            <?php if(auth()->guard('user')->check()): ?>
            <div class="flex items-center space-x-4 mb-8">
                <form action="<?php echo e(route('galleries.like', $galery)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2 bg-pink-light rounded-lg hover:bg-pink-200 transition">
                        <svg class="w-5 h-5 text-pink-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.834a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                        </svg>
                        <span class="text-pink-primary font-medium"><?php echo e($galery->total_likes ?? 0); ?></span>
                    </button>
                </form>
                <form action="<?php echo e(route('galleries.bookmark', $galery)); ?>" method="POST" class="inline">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="flex items-center space-x-2 px-4 py-2 bg-pink-light rounded-lg hover:bg-pink-200 transition">
                        <svg class="w-5 h-5 text-pink-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                        </svg>
                        <span class="text-pink-primary font-medium">Simpan</span>
                    </button>
                </form>
            </div>
            <?php endif; ?>
            
            <!-- Photo Gallery -->
            <?php if($galery->fotos->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                <?php $__currentLoopData = $galery->fotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200 group">
                    <div class="relative h-64 overflow-hidden">
                        <img src="<?php echo e(asset('storage/' . $foto->file)); ?>" 
                             alt="Foto" 
                             class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                             onerror="this.onerror=null; this.src='data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'400\' height=\'300\'%3E%3Crect fill=\'%23e5e7eb\' width=\'400\' height=\'300\'/%3E%3Ctext x=\'50%25\' y=\'50%25\' font-family=\'Arial\' font-size=\'18\' fill=\'%239ca3af\' text-anchor=\'middle\' dominant-baseline=\'middle\'%3EGambar tidak tersedia%3C/text%3E%3C/svg%3E';">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition flex items-center justify-center">
                            <a href="<?php echo e(route('galleries.fotos.download', ['galery' => $galery->id, 'foto' => $foto->id])); ?>" class="opacity-0 group-hover:opacity-100 transition px-4 py-2 bg-white rounded-lg text-pink-primary font-medium hover:bg-pink-light">
                                Download
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php else: ?>
            <div class="text-center py-12">
                <p class="text-gray-600">Belum ada foto dalam galeri ini.</p>
            </div>
            <?php endif; ?>
            
            <!-- Comments Section -->
            <?php if(auth()->guard('user')->check()): ?>
            <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200 mb-8">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Komentar</h3>
                
                <!-- Add Comment Form -->
                <form action="<?php echo e(route('galleries.comments.store', $galery)); ?>" method="POST" class="mb-6">
                    <?php echo csrf_field(); ?>
                    <textarea name="body" rows="3" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" placeholder="Tulis komentar..." required></textarea>
                    <button type="submit" class="mt-2 px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Kirim Komentar</button>
                </form>
                
                <!-- Comments List -->
                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $galery->comments->whereNull('parent_id'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="border-b border-gray-200 pb-4">
                        <div class="flex items-start space-x-3">
                            <div class="w-10 h-10 bg-pink-primary rounded-full flex items-center justify-center text-white font-bold">
                                <?php echo e(strtoupper(substr($comment->user->name ?? 'U', 0, 1))); ?>

                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-bold text-gray-900"><?php echo e($comment->user->name ?? 'User'); ?></h4>
                                    <span class="text-sm text-gray-500"><?php echo e($comment->created_at->diffForHumans()); ?></span>
                                </div>
                                <p class="text-gray-700 mt-1"><?php echo e($comment->body); ?></p>
                                
                                <!-- Reply Button -->
                                <button onclick="showReplyForm(<?php echo e($comment->id); ?>)" class="text-sm text-pink-primary hover:text-pink-dark mt-2">Balas</button>
                                
                                <!-- Reply Form (Hidden) -->
                                <div id="reply-form-<?php echo e($comment->id); ?>" class="hidden mt-3">
                                    <form action="<?php echo e(route('comments.reply', $comment)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <textarea name="body" rows="2" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary" placeholder="Tulis balasan..." required></textarea>
                                        <div class="flex space-x-2 mt-2">
                                            <button type="submit" class="px-4 py-1 bg-pink-primary text-white rounded hover:bg-pink-dark text-sm">Kirim</button>
                                            <button type="button" onclick="hideReplyForm(<?php echo e($comment->id); ?>)" class="px-4 py-1 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 text-sm">Batal</button>
                                        </div>
                                    </form>
                                </div>
                                
                                <!-- Replies -->
                                <?php $__currentLoopData = $comment->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reply): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="ml-8 mt-3 border-l-2 border-pink-200 pl-3">
                                    <div class="flex items-center justify-between">
                                        <h5 class="font-medium text-gray-900"><?php echo e($reply->user->name ?? 'User'); ?></h5>
                                        <span class="text-sm text-gray-500"><?php echo e($reply->created_at->diffForHumans()); ?></span>
                                    </div>
                                    <p class="text-gray-700 mt-1"><?php echo e($reply->body); ?></p>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-gray-600">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                    <?php endif; ?>
                </div>
            </div>
            <?php else: ?>
            <div class="bg-pink-light rounded-lg p-6 text-center">
                <p class="text-gray-700 mb-4">Login untuk berkomentar dan berinteraksi dengan galeri.</p>
                <a href="<?php echo e(route('user.login')); ?>" class="inline-block px-6 py-2 bg-pink-primary text-white rounded-lg hover:bg-pink-dark transition">Login</a>
            </div>
            <?php endif; ?>
            
            <!-- Recommendations -->
            <?php if($recommendations->count() > 0): ?>
            <div class="mt-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Galeri Lainnya</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <?php $__currentLoopData = $recommendations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('guest.galeri.show', $rec)); ?>" class="block bg-white rounded-lg shadow-md hover:shadow-xl transition overflow-hidden border border-gray-200">
                        <?php if($rec->fotos->count() > 0): ?>
                        <div class="h-48 overflow-hidden">
                            <img src="<?php echo e(asset('storage/' . $rec->fotos->first()->file)); ?>" alt="<?php echo e($rec->post->judul ?? 'Galeri'); ?>" class="w-full h-full object-cover">
                        </div>
                        <?php endif; ?>
                        <div class="p-4">
                            <h3 class="font-bold text-gray-900"><?php echo e($rec->post->judul ?? 'Galeri'); ?></h3>
                            <p class="text-sm text-gray-500 mt-1"><?php echo e($rec->fotos->count()); ?> foto</p>
                        </div>
                    </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<script>
function showReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).classList.remove('hidden');
}

function hideReplyForm(commentId) {
    document.getElementById('reply-form-' + commentId).classList.add('hidden');
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/guest/galeri_show.blade.php ENDPATH**/ ?>