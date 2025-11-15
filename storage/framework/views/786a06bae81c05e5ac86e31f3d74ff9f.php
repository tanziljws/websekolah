<?php $__env->startSection('title', 'Edit Profil - Web Galeri Sekolah'); ?>

<?php $__env->startSection('content'); ?>
<section class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-bold text-gray-900 mb-8 text-center">Edit Profil</h1>
            
            <?php if(session('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('success')); ?>

            </div>
            <?php endif; ?>
            
            <?php if(session('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('error')); ?>

            </div>
            <?php endif; ?>
            
            <div class="bg-white rounded-lg shadow-lg p-8 border border-gray-200">
                <form action="<?php echo e(route('user.profile.update')); ?>" method="POST" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <!-- Profile Photo -->
                    <div class="mb-6">
                        <label class="block text-gray-700 font-medium mb-2">Foto Profil</label>
                        <div class="flex items-center space-x-4">
                            <?php if($user->profile_photo_path): ?>
                            <img src="<?php echo e(asset('storage/' . $user->profile_photo_path)); ?>" alt="<?php echo e($user->name); ?>" class="w-20 h-20 rounded-full object-cover border-2 border-pink-primary">
                            <?php else: ?>
                            <div class="w-20 h-20 bg-pink-primary rounded-full flex items-center justify-center text-white text-xl font-bold">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </div>
                            <?php endif; ?>
                            <div>
                                <input type="file" id="profile_photo" name="profile_photo" accept="image/*" class="text-sm text-gray-600">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG, GIF (Max: 5MB)</p>
                            </div>
                        </div>
                        <?php $__errorArgs = ['profile_photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-medium mb-2">Nama Lengkap</label>
                        <input type="text" id="name" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    
                    <!-- Username -->
                    <div class="mb-6">
                        <label for="username" class="block text-gray-700 font-medium mb-2">Username</label>
                        <input type="text" id="username" name="username" value="<?php echo e(old('username', $user->username)); ?>" pattern="[a-z0-9_]+" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-pink-primary focus:border-transparent" required>
                        <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="text-red-600 text-sm mt-1"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-xs text-gray-500 mt-1">Hanya huruf kecil, angka, dan underscore</p>
                    </div>
                    
                    <div class="flex space-x-4">
                        <button type="submit" class="flex-1 px-6 py-3 bg-gradient-to-r from-pink-600 to-pink-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl hover:bg-pink-700 transition-all duration-200 ring-2 ring-white/20">Simpan Perubahan</button>
                        <a href="<?php echo e(route('user.profile')); ?>" class="flex-1 px-6 py-3 bg-gray-200 text-gray-800 rounded-xl hover:bg-gray-300 transition-all duration-200 font-semibold text-center shadow">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/tanziljws/Documents/backend/resources/views/user/edit_profile.blade.php ENDPATH**/ ?>