@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('css')
@endsection

@section('main_content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Senarai Pelesen</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard"> <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item active">Senarai Pelesen</li>
                    </ol>
                </div>
            </div>
        </div>
    </div> <!-- Container-fluid starts-->
    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon"> <a class="btn btn-primary f-w-500" type="button"
                                data-bs-toggle="modal" data-bs-target="#tambahpenggunaModal"> <i
                                    class="fa-solid fa-plus pe-2"></i>Pelesen</a> </div>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <div class="list-product user-list-table">
                            <div class="table-responsive custom-scrollbar">
                                <table class="table" id="roles-permission">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th> <span class="c-o-light f-w-600">#</span></th>
                                            <th> <span class="c-o-light f-w-600">No Lesen</span></th>
                                            <th> <span class="c-o-light f-w-600">Kategori</span></th>
                                            <th> <span class="c-o-light f-w-600">Nama Syarikat</span></th>
                                            <th> <span class="c-o-light f-w-600">Negeri</span></th>
                                            <th> <span class="c-o-light f-w-600">Status</span></th>
                                            <th> <span class="c-o-light f-w-600">Tindakan</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="product-removes inbox-data">
                                            <td></td>
                                            <td>
                                                <p>1</p>
                                            </td>
                                            <td>
                                                <p>666666-666666</p>
                                            </td>
                                            <td>
                                                <p>Kilang Buah Sawit</p>
                                            </td>
                                            <td>
                                                <p>Syarikat Dummy</p>
                                            </td>
                                            <td>
                                                <p>Selangor</p>
                                            </td>
                                            <td> <span class="badge badge-light-success">Aktif</span></td>
                                            <td>
                                                <div class="common-align gap-2 justify-content-start"> <a
                                                        class="square-white" href="add-user.html"><svg>
                                                            <use href="/assets/svg/icon-sprite.svg#edit-content"> </use>
                                                        </svg></a><a class="square-white trash-7" href="#!"><svg>
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

    <div class="modal fade modal-bookmark" id="tambahpenggunaModal" tabindex="-1" role="dialog"
        aria-labelledby="tambahpenggunaModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahpenggunaModalLabel">Tambah Pengguna</h5><button class="btn-close"
                        type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form class="form-bookmark needs-validation" id="tambah-pengguna-form" novalidate="">
                        <div class="row g-3">
                            <div class="col-sm-6"><label for="id-pengguna">ID Pengguna</label><input class="form-control"
                                    id="id-pengguna" type="text" required autocomplete="off"></div>
                            <div class="col-sm-6"> <label for="name">Nama</label><input class="form-control"
                                    id="name" type="text" required autocomplete="off"></div>
                            <div class="col-sm-6"> <label for="password">Kata Laluan</label><input class="form-control"
                                    id="password" type="password" required autocomplete="off"></div>
                            <div class="col-sm-6"> <label for="email">Emel</label><input class="form-control"
                                    id="email" type="email" required autocomplete="off"></div>
                            <div class="col-12">
                                <div class="row g-3">
                                    <div class="col-sm-6"><label for="status">Status</label> <select class="form-select"
                                            id="status" required>
                                            <option value="aktif">Aktif</option>
                                            <option value="tidak-aktif">Tidak Aktif</option>
                                        </select> </div>
                                    <div class="col-sm-6"><label for="role">Peranan</label> <select class="form-select"
                                            id="role" required>
                                            <option disabled selected value>Sila Pilih</option>
                                            <option value="superadmin">Super Admin</option>
                                            <option value="admin">Admin</option>
                                            <option value="staff">Staff</option>
                                        </select> </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="row g-3" id="staff-options" style="display: none;">
                                    <div class="col-sm-6"><label>Kategori Kilang</label>
                                        <div class="card-wrapper border rounded-3 checkbox-checked p-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="kilang-buah-sawit" id="kilang-buah-sawit"> <label
                                                    class="form-check-label" for="kilang-buah-sawit">Kilang Buah
                                                    Sawit</label> </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="kilang-pelumat-isirong-sawit"
                                                    id="kilang-pelumat-isirong-sawit"> <label class="form-check-label"
                                                    for="kilang-pelumat-isirong-sawit">Kilang Pelumat Isirong Sawit</label>
                                            </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="kilang-penapis-minyak" id="kilang-penapis-minyak"> <label
                                                    class="form-check-label" for="kilang-penapis-minyak">Kilang Penapis
                                                    Minyak</label> </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="kilang-biodiesel" id="kilang-biodiesel"> <label
                                                    class="form-check-label" for="kilang-biodiesel">Kilang
                                                    Biodiesel</label> </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="kilang-oleokimia" id="kilang-oleokimia"> <label
                                                    class="form-check-label" for="kilang-oleokimia">Kilang
                                                    Oleokimia</label> </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="pusat-simpanan-minyak" id="pusat-simpanan-minyak"> <label
                                                    class="form-check-label" for="pusat-simpanan-minyak">Pusat Simpanan
                                                    Minyak</label> </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"><label>Kategori Peniaga</label>
                                        <div class="card-wrapper border rounded-3 checkbox-checked p-2">
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="peniaga-buah" id="peniaga-buah"> <label
                                                    class="form-check-label" for="peniaga-buah">Peniaga Buah</label>
                                            </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="peniaga-minyak" id="peniaga-minyak"> <label
                                                    class="form-check-label" for="peniaga-minyak">Peniaga Minyak</label>
                                            </div>
                                            <div class="form-check"> <input class="form-check-input" type="checkbox"
                                                    value="bahan-tanaman-sawit" id="bahan-tanaman-sawit"> <label
                                                    class="form-check-label" for="bahan-tanaman-sawit">Bahan Tanaman
                                                    Sawit</label> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <input id="index_var" type="hidden" value="5"><button class="btn btn-primary me-2"
                            type="submit" onclick="submitContact()">Save</button><button class="btn btn-secondary"
                            type="button" data-bs-dismiss="modal">Cancel</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
@endsection
