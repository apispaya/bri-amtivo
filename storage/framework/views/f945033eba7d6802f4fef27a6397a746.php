<!DOCTYPE html>
<html lang="en" <?php if(Route::currentRouteName() == 'rtl_layout'): ?> dir="rtl" <?php endif; ?>
    <?php if(Route::currentRouteName() === 'layout_dark'): ?> data-theme="dark" <?php endif; ?>>

<head>
    <?php echo $__env->make('layouts.head', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php echo $__env->make('layouts.css', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
</head>

<body>

    <?php echo $__env->yieldContent('main_content'); ?>

    <?php echo $__env->make('layouts.scripts', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</body>

</html>
<?php /**PATH /var/www/html/bri-amtivo/resources/views/layouts/auth.blade.php ENDPATH**/ ?>