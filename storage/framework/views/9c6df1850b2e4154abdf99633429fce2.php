
<?php if(session('success')): ?>
    <div class="alert alert-bg-success alert-dismissible fade show" role="alert">
        <i data-feather="check-circle"></i>
        <p class="mb-0"><?php echo e(session('success')); ?></p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<?php
    $dangerMsg = session('error') ?? session('danger');
?>
<?php if($dangerMsg): ?>
    <div class="alert alert-bg-danger alert-dismissible fade show" role="alert">
        <i data-feather="alert-triangle"></i>
        <p class="mb-0"><?php echo e($dangerMsg); ?></p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<?php if(session('warning')): ?>
    <div class="alert alert-bg-warning alert-dismissible fade show" role="alert">
        <i data-feather="alert-circle"></i>
        <p class="mb-0"><?php echo e(session('warning')); ?></p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<?php if(session('info')): ?>
    <div class="alert alert-bg-info alert-dismissible fade show" role="alert">
        <i data-feather="info"></i>
        <p class="mb-0"><?php echo e(session('info')); ?></p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>


<?php if($errors->any()): ?>
    <div class="alert alert-bg-danger alert-dismissible fade show" role="alert">
        <i data-feather="alert-triangle"></i>
        <div>
            
            <ul class="mb-0 ps-3">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>
<?php /**PATH /var/www/html/bri-amtivo/resources/views/partials/error.blade.php ENDPATH**/ ?>