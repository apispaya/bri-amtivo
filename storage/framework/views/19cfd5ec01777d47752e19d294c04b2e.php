<?php $__env->startSection('title', 'Admin Dashboard'); ?>

<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Users</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="/dashboard">
                                <svg class="stroke-icon">
                                    <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.error', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Container-fluid starts-->
    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" type="button" id="add-user-btn" data-bs-toggle="modal"
                                data-bs-target="#userModal">
                                <i class="fa-solid fa-plus pe-2"></i>Add User
                            </a>
                        </div>
                    </div>

                    <div class="card-body pt-0 px-0">
                        <div class="list-product user-list-table">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table" id="roles-permission">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th><span class="c-o-light f-w-600">#</span></th>
                                            <th><span class="c-o-light f-w-600">Name</span></th>
                                            <th><span class="c-o-light f-w-600">Email</span></th>
                                            <th><span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td><p><?php echo e($users instanceof \Illuminate\Pagination\AbstractPaginator ? $users->firstItem() + $i : $loop->iteration); ?></p></td>

                                                <td>
                                                    <p><?php echo e($u->name); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e($u->email); ?></p>
                                                </td>
                                                <td>
                                                    <div class="common-align gap-2 justify-content-start">
                                                        
                                                        <button type="button"
                                                            class="square-white btn btn-link p-0 m-0 edit-user"
                                                            data-bs-toggle="modal" data-bs-target="#userModal"
                                                            data-id="<?php echo e($u->id); ?>" data-name="<?php echo e($u->name); ?>"
                                                            data-email="<?php echo e($u->email); ?>"
                                                            data-update="<?php echo e(route('dashboard.users.update', $u)); ?>"
                                                            title="Edit">
                                                            <svg>
                                                                <use href="/assets/svg/icon-sprite.svg#edit-content"></use>
                                                            </svg>
                                                        </button>

                                                        
                                                        <form action="<?php echo e(route('dashboard.users.destroy', $u)); ?>"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Delete this user? This cannot be undone.');">
                                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                            <button class="square-white trash-7 btn btn-link p-0 m-0"
                                                                type="submit" title="Delete">
                                                                <svg>
                                                                    <use href="/assets/svg/icon-sprite.svg#trash1"></use>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

    
    <div class="modal fade modal-bookmark" id="userModal" tabindex="-1" aria-labelledby="userModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="userModalLabel">Add User</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="user-form" class="needs-validation" method="POST" novalidate>
                        <?php echo csrf_field(); ?>
                        
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="user-name">Name</label>
                                <input class="form-control" id="user-name" name="name" type="text" required
                                    autocomplete="off">
                                <div class="invalid-feedback">Please enter a name.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="user-email">Email</label>
                                <input class="form-control" id="user-email" name="email" type="email" required
                                    autocomplete="off">
                                <div class="invalid-feedback">Please enter a valid email.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="user-password" id="password-label">Password</label>
                                <input class="form-control" id="user-password" name="password" type="password"
                                    autocomplete="off">
                                <div class="form-text" id="password-hint">Minimum 8 characters.</div>
                                <div class="invalid-feedback">Please enter a valid password (min 8 characters).</div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary me-2" type="submit" id="modal-save-btn">Save</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function() {
            // Elements
            const modalEl = document.getElementById('userModal');
            const form = document.getElementById('user-form');
            const titleEl = document.getElementById('userModalLabel');
            const nameI = document.getElementById('user-name');
            const emailI = document.getElementById('user-email');
            const passI = document.getElementById('user-password');
            const passHint = document.getElementById('password-hint');
            const addBtn = document.getElementById('add-user-btn');

            // Helpers
            function setFormAction(url) {
                form.setAttribute('action', url);
            }

            function setFormMethod(method) {
                // remove existing _method
                form.querySelector('input[name="_method"]')?.remove();
                if (method && method.toUpperCase() !== 'POST') {
                    const m = document.createElement('input');
                    m.type = 'hidden';
                    m.name = '_method';
                    m.value = method.toUpperCase();
                    form.appendChild(m);
                }
            }

            function setRequired(el, isRequired) {
                if (isRequired) el.setAttribute('required', 'required');
                else el.removeAttribute('required');
            }

            // Add User
            addBtn?.addEventListener('click', function() {
                titleEl.textContent = 'Add User';
                setFormAction(<?php echo json_encode(route('dashboard.users.store'), 15, 512) ?>);
                setFormMethod('POST');

                nameI.value = '';
                emailI.value = '';
                passI.value = '';

                setRequired(passI, true);
                passI.placeholder = '';
                passHint.textContent = 'Minimum 8 characters.';
            });

            // Edit User (event delegation for dynamically created buttons)
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-user');
                if (!btn) return;

                const updateUrl = btn.dataset.update;
                const name = btn.dataset.name || '';
                const email = btn.dataset.email || '';

                titleEl.textContent = 'Edit User';
                setFormAction(updateUrl);
                setFormMethod('PUT');

                nameI.value = name;
                emailI.value = email;
                passI.value = '';
                setRequired(passI, false);
                passI.placeholder = 'Leave blank to keep current password';
                passHint.textContent = 'Leave blank to keep the existing password.';
            });

            // Basic client-side Bootstrap validation (optional, nice UX)
            form?.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/bri-amtivo/resources/views/dashboard/user-list.blade.php ENDPATH**/ ?>