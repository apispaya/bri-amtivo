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
                        <li class="breadcrumb-item"><a href="/dashboard"> <svg class="stroke-icon">
                                    <use href="<?php echo e(asset('assets/svg/icon-sprite.svg#stroke-home')); ?>"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item active">Client's Certification</li>
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
                        <div class="card-header-right-icon"> <a class="btn btn-primary f-w-500" type="button"
                                data-bs-toggle="modal" data-bs-target="#addclientModal"> <i
                                    class="fa-solid fa-plus pe-2"></i>Client</a> </div>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <div class="list-product user-list-table">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table" id="roles-permission">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th> <span class="c-o-light f-w-600">#</span></th>
                                            <th> <span class="c-o-light f-w-600">Name of Company</span></th>
                                            <th> <span class="c-o-light f-w-600">Client's PIC</span></th>
                                            <th> <span class="c-o-light f-w-600">Audit Reference</span></th>
                                            <th> <span class="c-o-light f-w-600">Certificate No.</span></th>
                                            <th> <span class="c-o-light f-w-600">Validity</span></th>
                                            <th> <span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="product-removes inbox-data">
                                            <td></td>
                                            <td>
                                                <p>1</p>
                                            </td>
                                            <td>
                                                <p>ANALYTX SDN. BHD.</p>
                                            </td>
                                            <td>
                                                <p>Syaiful Hafiz</p>
                                                <p>Contact No: 0136926823</p>
                                            </td>
                                            <td>
                                                <p>BRI/EAR/DFMSB-001</p>
                                            </td>
                                            <td>
                                                <p>BRI-MY-2025110107 <a class="pdf" href="../assets/pdf/certification/sample.pdf"
                                                        target="_blank"><i class="icofont icofont-file-pdf">
                                                        </i></a></p>
                                            </td>
                                            <td>
                                                <p>Issued On :<br><strong>14 July 2025</strong></p>
                                                <p>Effective Date :<br><strong>13 July 2026</strong></p>
                                                <p>Expiry Date :<br><strong>13 July 2028</strong></p>
                                            </td>
                                            <td>
                                                <div class="common-align gap-2 justify-content-start"> <a
                                                        class="square-white" href="add-user.html"><svg>
                                                            <use href="/assets/svg/icon-sprite.svg#edit-content"> </use>
                                                        </svg></a><a class="square-white trash-8" href="#!"><svg>
                                                            <use href="/assets/svg/icon-sprite.svg#trash1"> </use>
                                                        </svg></a></div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Container-fluid Ends-->

    <div class="modal fade modal-bookmark" id="addclientModal" tabindex="-1" role="dialog"
        aria-labelledby="addclientModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="addclientModalLabel">Add Client</h5><button class="btn-close"
                        type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation" id="tambah-pengguna-form" novalidate="">
                        <div class="row g-3">
                            <div class="col-sm-6"><label for="id-pengguna">Name of Company</label>
                                <input class="form-control" id="id-pengguna" type="text" required autocomplete="off">
                            </div>
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"> <label for="name">Client's PIC</label><input class="form-control"
                                    id="name" type="text" required autocomplete="off">
                            </div>
                            <div class="col-sm-6"> <label for="name">Contact No</label><input class="form-control"
                                    id="name" type="text" required autocomplete="off">
                            </div>
                            <div class="col-sm-6"> <label for="name">Certificate No.</label><input class="form-control"
                                    id="name" type="text" required autocomplete="off">
                            </div>
                            <div class="col-sm-6"> <label class="form-label" for="formFile">Upload
                                    Certificate</label><input class="form-control" id="formFile" type="file">
                            </div>
                            <div class="col-sm-6"><label for="status">Audit Reference</label>
                                <input class="form-control" id="name" type="text" required autocomplete="off">
                            </div>

                            <div class="card-body main-divider">
                                <div class="divider-body divider-body-1 divider-secondary">
                                    <div class="divider-p-secondary">
                                        <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                        <span class="txt-secondary">Validity </span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6"> <label for="name">Issued On</label><input
                                    class="form-control digits" type="date" value="">
                            </div>
                            <div class="col-sm-6"> <label for="name">Effective Date</label><input
                                    class="form-control digits" type="date" value="">
                            </div>
                            <div class="col-sm-6"> <label for="name">Expiry Date</label><input
                                    class="form-control digits" type="date" value="">
                            </div>
                        </div> <input id="index_var" type="hidden" value="5"><button class="btn btn-primary me-2"
                            type="submit" onclick="submitContact()">Save</button><button class="btn btn-secondary"
                            type="button" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /var/www/html/bri-amtivo/resources/views/dashboard/kosong.blade.php ENDPATH**/ ?>