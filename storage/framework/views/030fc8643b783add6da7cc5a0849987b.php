<?php $__env->startSection('title', 'Login'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid p-0">
        <div class="row m-0">
            <div class="col-12 p-0">
                <div class="login-card login-dark">
                    <div>
                        <div>
                            <a class="logo" href="<?php echo e(route('login')); ?>"><img class="img-fluid for-light"
                                    src="<?php echo e(asset('assets/images/logo/logo_crop.png')); ?>" style="height: 95px"
                                    alt="looginpage"><img class="img-fluid for-dark"
                                    src="<?php echo e(asset('assets/images/logo/logo_crop.png')); ?>" style="height: 95px"
                                    alt="looginpage"></a>
                        </div>
                        <div class="login-main">
                            <?php echo $__env->make('partials.error', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <form class="theme-form" method="POST" action="<?php echo e(route('login.perform')); ?>" novalidate>
                                <?php echo csrf_field(); ?>
                                <h4>Sign in to account</h4>
                                <p>Enter your email & password to login</p>
                                <div class="form-group"><label class="col-form-label">Email Address</label>
                                    <input class="form-control" id="email" type="email" name="email"
                                        value="<?php echo e(old('email')); ?>" required autocomplete="username" autofocus
                                        placeholder="you@example.com">
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label" for="password">Password</label>
                                    <div class="form-input position-relative">
                                        <input class="form-control" id="password" type="password" name="password" required
                                            autocomplete="current-password" placeholder="********">
                                        <div class="show-hide" role="button" tabindex="0"
                                            aria-label="Show or hide password">
                                            <span class="show"></span>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group mb-0">
                                    <div class="form-check">
                                        <input class="checkbox-primary form-check-input" id="remember" type="checkbox"
                                            name="remember">
                                        <label class="text-muted form-check-label" for="remember">Remember me</label>
                                    </div>
                                    <div class="text-end"><button class="btn btn-primary btn-block w-100 mt-3"
                                            type="submit">Login</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        document.addEventListener('click', function(e) {
            const toggle = e.target.closest('.show-hide');
            if (!toggle) return;

            const input = toggle.closest('.form-input')?.querySelector('input');
            if (!input) return;

            if (input.type === 'password') {
                input.type = 'text';
                toggle.querySelector('span')?.classList.remove('show');
                toggle.setAttribute('aria-pressed', 'true');
            } else {
                input.type = 'password';
                toggle.querySelector('span')?.classList.add('show');
                toggle.setAttribute('aria-pressed', 'false');
            }
        });

        document.addEventListener('keydown', function(e) {
            if ((e.key === 'Enter' || e.key === ' ') && e.target.closest('.show-hide')) {
                e.preventDefault();
                e.target.click();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.auth', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/bri-amtivo/resources/views/auth/login.blade.php ENDPATH**/ ?>