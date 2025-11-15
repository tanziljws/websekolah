<?php $__env->startSection('title', 'Tambah Agenda - Admin'); ?>
<?php $__env->startSection('page-title', 'Tambah Agenda'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Tambah Agenda</h2>
            <p class="text-sm text-gray-600 mt-1">Isi form di bawah untuk menambahkan agenda sekolah baru</p>
        </div>
        
        <form action="<?php echo e(route('admin.agenda.store')); ?>" method="POST" class="p-6 space-y-6">
            <?php echo csrf_field(); ?>
            
            <!-- Judul -->
            <div>
                <label for="judul" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Agenda <span class="text-red-500">*</span>
                </label>
                <input type="text" id="judul" name="judul" value="<?php echo e(old('judul')); ?>" placeholder="Contoh: Upacara Bendera Senin, Rapat Orang Tua, dll" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none" required>
                <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?php echo e($message); ?>

                </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Isi -->
            <div>
                <label for="isi" class="block text-sm font-semibold text-gray-700 mb-2">
                    Isi/Keterangan Agenda <span class="text-red-500">*</span>
                </label>
                <textarea id="isi" name="isi" rows="8" placeholder="Tulis detail agenda, waktu, tempat, dan informasi penting lainnya..." class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none resize-none" required><?php echo e(old('isi')); ?></textarea>
                <?php $__errorArgs = ['isi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?php echo e($message); ?>

                </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Link ke Galeri -->
            <div>
                <label for="galery_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Link ke Galeri (Opsional)
                </label>
                <select id="galery_id" name="galery_id" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer">
                    <option value="">-- Tidak ada link galeri --</option>
                    <?php $__currentLoopData = $galeries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galery): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($galery->id); ?>" <?php echo e(old('galery_id') == $galery->id ? 'selected' : ''); ?>>
                        <?php echo e($galery->post->judul ?? 'Galeri #' . $galery->id); ?> (<?php echo e($galery->fotos->count()); ?> foto)
                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <p class="text-xs text-gray-500 mt-1">Pilih galeri jika agenda ini terkait dengan galeri foto tertentu</p>
                <?php $__errorArgs = ['galery_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?php echo e($message); ?>

                </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer" required>
                    <option value="published" <?php echo e(old('status', 'published') == 'published' ? 'selected' : ''); ?>>Published (Tampilkan di halaman agenda)</option>
                    <option value="draft" <?php echo e(old('status') == 'draft' ? 'selected' : ''); ?>>Draft (Simpan sebagai draft)</option>
                </select>
                <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <p class="mt-2 text-sm text-red-600 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <?php echo e($message); ?>

                </p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <!-- Action Buttons -->
            <div class="flex items-center justify-end space-x-4 pt-4 border-t border-gray-200">
                <a href="<?php echo e(route('admin.agenda.index')); ?>" class="px-6 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-pink-primary rounded-lg hover:bg-pink-dark shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    Simpan Agenda
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/admin/agenda/create.blade.php ENDPATH**/ ?>