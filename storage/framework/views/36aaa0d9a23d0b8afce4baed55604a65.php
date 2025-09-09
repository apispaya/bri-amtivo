<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Welcome <?php echo e(auth()->user()->name); ?></h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item active"><a href="/dashboard">
                                <svg class="stroke-icon">
                                    <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                                </svg></a></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row starter-main">
            <div class="row">
                <div class="col-xl-3 col-hr-6 col-sm-6">
                    <div class="card widget-11 widget-hover">
                        <div class="card-body">
                            <div class="common-align justify-content-start">
                                <div class="analytics-tread bg-light-primary"><svg class="fill-primary">
                                        <use href="../assets/svg/icon-sprite.svg#analytics-user"></use>
                                    </svg>
                                </div>
                                <div>
                                    <span class="c-o-light">Clients</span>
                                    <h4 class="counter"><?php echo e($clientCount); ?></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Container-fluid Ends-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/bri-amtivo/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>