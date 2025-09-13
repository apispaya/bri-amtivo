<?php $__env->startSection('title', 'Admin Dashboard'); ?>
<?php $__env->startSection('css'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main_content'); ?>
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Client's Certification</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="<?php echo e(route('dashboard.home')); ?>">
                                <svg class="stroke-icon">
                                    <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Client's Certification</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?php echo $__env->make('partials.error', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="<?php echo e(route('dashboard.clients.create')); ?>">
                                <i class="fa-solid fa-plus pe-2"></i>Client
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
                                            <th><span class="c-o-light f-w-600">Name of Company</span></th>
                                            <th><span class="c-o-light f-w-600">Client's PIC</span></th>
                                            <th><span class="c-o-light f-w-600">Audit Reference</span></th>
                                            <th><span class="c-o-light f-w-600">Certificate No.</span></th>
                                            <th><span class="c-o-light f-w-600">Validity</span></th>
                                            <th><span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $certs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td>
                                                    <p><?php echo e($loop->iteration); ?></p>
                                                </td>
                                                <td>
                                                    <p><?php echo e($c->company_name); ?></p>
                                                </td>

                                                <td>
                                                    <p><?php echo e($c->pic_name); ?></p>
                                                    <?php if($c->pic_phone): ?>
                                                        <p>Contact No: <?php echo e($c->pic_phone); ?></p>
                                                    <?php endif; ?>
                                                </td>

                                                <td>
                                                    <p><?php echo e($c->audit_reference ?? '—'); ?></p>
                                                </td>

                                                <td>
                                                    <p>
                                                        <?php echo e($c->certificate_no); ?>

                                                        <?php if($c->certificate_path): ?>
                                                            <a class="pdf ms-1"
                                                                href="<?php echo e(Storage::url($c->certificate_path)); ?>"
                                                                target="_blank" title="Open certificate">
                                                                <i class="icofont icofont-file-pdf"></i>
                                                            </a>
                                                        <?php endif; ?>
                                                    </p>
                                                </td>

                                                <td>
                                                    <p>Issued On
                                                        :<br><strong><?php echo e(optional($c->issued_on)->format('d F Y') ?? '—'); ?></strong>
                                                    </p>
                                                    <p>Effective Date
                                                        :<br><strong><?php echo e(optional($c->effective_date)->format('d F Y') ?? '—'); ?></strong>
                                                    </p>
                                                    <p>Expiry Date
                                                        :<br><strong><?php echo e(optional($c->expiry_date)->format('d F Y') ?? '—'); ?></strong>
                                                    </p>
                                                </td>

                                                <td>
                                                    <div class="common-align gap-2 justify-content-start">
                                                        
                                                        <button type="button"
                                                            class="square-white btn btn-link p-0 m-0 edit-cert"
                                                            data-bs-toggle="modal" data-bs-target="#clientModal"
                                                            data-update="<?php echo e(route('dashboard.client-certs.update', $c)); ?>"
                                                            data-company="<?php echo e($c->company_name); ?>"
                                                            data-picname="<?php echo e($c->pic_name); ?>"
                                                            data-picphone="<?php echo e($c->pic_phone); ?>"
                                                            data-audit="<?php echo e($c->audit_reference); ?>"
                                                            data-certno="<?php echo e($c->certificate_no); ?>"
                                                            data-issued="<?php echo e(optional($c->issued_on)->format('Y-m-d')); ?>"
                                                            data-effective="<?php echo e(optional($c->effective_date)->format('Y-m-d')); ?>"
                                                            data-expiry="<?php echo e(optional($c->expiry_date)->format('Y-m-d')); ?>"
                                                            data-fileurl="<?php echo e($c->certificate_path ? Storage::url($c->certificate_path) : ''); ?>"
                                                            title="Edit">
                                                            <svg>
                                                                <use
                                                                    href="<?php echo e(asset('assets/svg/icon-sprite.svg#edit-content')); ?>">
                                                                </use>
                                                            </svg>
                                                        </button>

                                                        
                                                        <form action="<?php echo e(route('dashboard.client-certs.destroy', $c)); ?>"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Delete this certification? This cannot be undone.');">
                                                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                            <button class="square-white trash-8 btn btn-link p-0 m-0"
                                                                type="submit" title="Delete">
                                                                <svg>
                                                                    <use
                                                                        href="<?php echo e(asset('assets/svg/icon-sprite.svg#trash1')); ?>">
                                                                    </use>
                                                                </svg>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    
    <div class="modal fade modal-bookmark" id="clientModal" tabindex="-1" aria-labelledby="clientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="clientModalLabel">Add Client</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="client-form" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        <?php echo csrf_field(); ?>
                        
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label for="company_name">Name of Company</label>
                                <input class="form-control" id="company_name" name="company_name" type="text" required
                                    autocomplete="off">
                                <div class="invalid-feedback">Please enter the company name.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="audit_reference">Audit Reference</label>
                                <input class="form-control" id="audit_reference" name="audit_reference" type="text"
                                    autocomplete="off">
                            </div>

                            <div class="col-sm-6">
                                <label for="pic_name">Client's PIC</label>
                                <input class="form-control" id="pic_name" name="pic_name" type="text" required
                                    autocomplete="off">
                                <div class="invalid-feedback">Please enter the PIC name.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="pic_phone">Contact No</label>
                                <input class="form-control" id="pic_phone" name="pic_phone" type="text"
                                    autocomplete="off">
                            </div>

                            <div class="col-sm-6">
                                <label for="certificate_no">Certificate No.</label>
                                <input class="form-control" id="certificate_no" name="certificate_no" type="text"
                                    required autocomplete="off">
                                <div class="invalid-feedback">Certificate number is required.</div>
                            </div>
                            <div class="col-sm-6">
                                <label for="certificate_file">Upload Certificate (PDF)</label>
                                <input class="form-control" id="certificate_file" name="certificate_file" type="file"
                                    accept="application/pdf">
                                <div class="form-text" id="file-help"></div>
                            </div>

                            <div class="card-body main-divider">
                                <div class="divider-body divider-body-1 divider-secondary">
                                    <div class="divider-p-secondary">
                                        <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                        <span class="txt-secondary">Validity</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <label for="issued_on">Issued On</label>
                                <input class="form-control digits" id="issued_on" name="issued_on" type="date">
                            </div>
                            <div class="col-sm-4">
                                <label for="effective_date">Effective Date</label>
                                <input class="form-control digits" id="effective_date" name="effective_date"
                                    type="date">
                            </div>
                            <div class="col-sm-4">
                                <label for="expiry_date">Expiry Date</label>
                                <input class="form-control digits" id="expiry_date" name="expiry_date" type="date">
                            </div>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary me-2" type="submit" id="client-save-btn">Save</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div><!-- /modal-body -->
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
    <script>
        (function() {
            const form = document.getElementById('client-form');
            const title = document.getElementById('clientModalLabel');

            const fields = {
                company_name: document.getElementById('company_name'),
                pic_name: document.getElementById('pic_name'),
                pic_phone: document.getElementById('pic_phone'),
                audit_ref: document.getElementById('audit_reference'),
                cert_no: document.getElementById('certificate_no'),
                file: document.getElementById('certificate_file'),
                issued_on: document.getElementById('issued_on'),
                effective: document.getElementById('effective_date'),
                expiry: document.getElementById('expiry_date'),
                fileHelp: document.getElementById('file-help'),
            };

            function setAction(url) {
                form.setAttribute('action', url);
            }

            function setMethod(method) {
                form.querySelector('input[name="_method"]')?.remove();
                if (method && method.toUpperCase() !== 'POST') {
                    const el = document.createElement('input');
                    el.type = 'hidden';
                    el.name = '_method';
                    el.value = method.toUpperCase();
                    form.appendChild(el);
                }
            }

            // EDIT (event delegation)
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-cert');
                if (!btn) return;

                title.textContent = 'Edit Client Certification';
                setAction(btn.dataset.update);
                setMethod('PUT');

                fields.company_name.value = btn.dataset.company || '';
                fields.pic_name.value = btn.dataset.picname || '';
                fields.pic_phone.value = btn.dataset.picphone || '';
                fields.audit_ref.value = btn.dataset.audit || '';
                fields.cert_no.value = btn.dataset.certno || '';
                fields.file.value = ''; // upload new file to replace existing
                fields.fileHelp.innerHTML = btn.dataset.fileurl ?
                    `Current file: <a href="${btn.dataset.fileurl}" target="_blank">open PDF</a>. Upload to replace.` :
                    'No certificate uploaded yet.';

                fields.issued_on.value = btn.dataset.issued || '';
                fields.effective.value = btn.dataset.effective || '';
                fields.expiry.value = btn.dataset.expiry || '';
            });

            // Bootstrap client-side validation (nice UX)
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

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/bri-amtivo/resources/views/dashboard/client-certifications.blade.php ENDPATH**/ ?>