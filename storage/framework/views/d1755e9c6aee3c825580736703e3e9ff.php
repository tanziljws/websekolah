<?php $__env->startSection('title', 'Tambah Galeri - Admin'); ?>
<?php $__env->startSection('page-title', 'Tambah Galeri'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto">
    <!-- Info Box -->
    <div class="mb-6 bg-white border-l-4 border-pink-primary rounded-lg shadow-sm p-5">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="h-6 w-6 text-pink-primary" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-semibold text-gray-900 mb-1">Tentang Galeri</h3>
                <ul class="text-sm text-gray-600 space-y-1">
                    <li>• <strong>Galeri</strong> = Album/wadah untuk foto-foto (terkait dengan Post)</li>
                    <li>• <strong>Foto</strong> = Foto-foto yang masuk ke dalam galeri</li>
                    <li>• Bisa upload foto saat buat galeri, atau tambah foto nanti dari halaman detail galeri</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-lg border border-gray-100 overflow-hidden">
        <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
            <h2 class="text-lg font-semibold text-gray-900">Form Tambah Galeri</h2>
        </div>
        
        <form action="<?php echo e(route('admin.galery.store')); ?>" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
            <?php echo csrf_field(); ?>
            
            <!-- Post Selection -->
            <div>
                <label for="post_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Pilih Post <span class="text-red-500">*</span>
                </label>
                <select id="post_id" name="post_id" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer" required>
                    <option value="">-- Pilih Post --</option>
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($post->id); ?>" <?php echo e(old('post_id') == $post->id ? 'selected' : ''); ?>>
                        <?php echo e($post->judul); ?> (<?php echo e($post->kategori->judul ?? '-'); ?>)
                    </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['post_id'];
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
            
            <!-- Status Selection -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-lg text-gray-900 focus:border-pink-primary focus:ring-2 focus:ring-pink-primary focus:ring-opacity-20 transition-all duration-200 outline-none appearance-none cursor-pointer" required>
                    <option value="1" <?php echo e(old('status', '1') == '1' ? 'selected' : ''); ?>>Aktif</option>
                    <option value="0" <?php echo e(old('status') == '0' ? 'selected' : ''); ?>>Nonaktif</option>
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
            
            <!-- File Upload -->
            <div>
                <label for="files" class="block text-sm font-semibold text-gray-700 mb-2">
                    Upload Foto (Opsional)
                </label>
                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-200 border-dashed rounded-lg hover:border-pink-primary transition-colors duration-200">
                    <div class="space-y-1 text-center w-full">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div class="flex text-sm text-gray-600 justify-center">
                            <label for="files" class="relative cursor-pointer bg-white rounded-md font-medium text-pink-primary hover:text-pink-dark focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-pink-primary">
                                <span>Upload foto</span>
                                <input id="files" name="files[]" type="file" multiple accept="image/*" class="sr-only">
                            </label>
                            <p class="pl-1">atau drag and drop</p>
                        </div>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF hingga 10MB (bisa multiple)</p>
                        <p class="text-xs text-gray-400 mt-2">💡 Bisa upload sekarang atau tambah nanti dari halaman detail galeri</p>
                    </div>
                </div>
                <?php $__errorArgs = ['files.*'];
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
                <a href="<?php echo e(route('admin.galery.index')); ?>" class="px-6 py-2.5 text-sm font-semibold text-gray-700 bg-white border-2 border-gray-300 rounded-lg hover:bg-gray-50 hover:border-gray-400 transition-all duration-200">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 text-sm font-semibold text-white bg-pink-primary rounded-lg hover:bg-pink-dark shadow-md hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                    Simpan Galeri
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('styles'); ?>
<style>
    select:focus {
        box-shadow: 0 0 0 3px rgba(236, 72, 153, 0.1);
    }
</style>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/admin/galery/create.blade.php ENDPATH**/ ?>