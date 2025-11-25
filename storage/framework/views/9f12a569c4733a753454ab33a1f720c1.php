<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Web Galeri Sekolah'); ?></title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-pink: #ec4899;
            --primary-pink-light: #fce7f3;
            --primary-pink-dark: #db2777;
        }
        
        .bg-pink-primary {
            background-color: var(--primary-pink);
        }
        
        .bg-pink-light {
            background-color: var(--primary-pink-light);
        }
        
        .text-pink-primary {
            color: var(--primary-pink);
        }
        
        .border-pink-primary {
            border-color: var(--primary-pink);
        }
        
        .hover\:bg-pink-dark:hover {
            background-color: var(--primary-pink-dark);
        }
    </style>
    
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="bg-white text-gray-900">
    <!-- Navigation -->
    <?php echo $__env->make('components.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Main Content -->
    <main>
        <?php echo $__env->yieldContent('content'); ?>
    </main>
    
    <!-- Footer -->
    <?php echo $__env->make('components.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH /Users/tanziljws/Documents/backend/resources/views/layouts/app.blade.php ENDPATH**/ ?>