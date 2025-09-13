@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('css')
@endsection

@section('main_content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>CPD for Lead Auditor</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard"> <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item active">CPD for Lead Auditor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @include('partials.error')
    <!-- Container-fluid starts-->
    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            <a class="btn btn-primary f-w-500" href="{{ route('dashboard.clients.create') }}">
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
                                            <th> <span class="c-o-light f-w-600">#</span></th>
                                            <th> <span class="c-o-light f-w-600">Name of Company</span></th>
                                            <th> <span class="c-o-light f-w-600">Certificate</span></th>
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
                                                <p>2025 <a class="pdf" href="../assets/pdf/certification/sample.pdf"
                                                        target="_blank"><i class="icofont icofont-file-pdf">
                                                        </i></a></p>
                                            </td>

                                            <td>
                                                <div class="common-align gap-2 justify-content-start">
                                                    <button type="button"
                                                        class="square-white btn btn-link p-0 m-0 edit-assessment"
                                                        data-bs-toggle="modal" data-bs-target="#assessmentModal">
                                                        <svg>
                                                            <use href="/assets/svg/icon-sprite.svg#edit-content"> </use>
                                                        </svg>
                                                    </button>
                                                </div>

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
    </div>
    <!-- Container-fluid Ends-->

    {{-- Modal: Edit Assessment --}}
    <div class="modal fade modal-bookmark" id="assessmentModal" tabindex="-1" aria-labelledby="assessmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="assessmentModalLabel">Edit Certificate</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="assessment-form" class="needs-validation" method="POST" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        {{-- PUT injected by JS --}}
                        <div class="row g-3">
                            <div class="col-12">
                                <div class="row g-3" id="training-certificates" data-next-index="1">
                                    <!-- Initial row -->
                                    <div class="col-12 year-row border rounded p-3">
                                        <div class="row g-3">
                                            <div class="col-sm-3 col-md-2">
                                                <label class="form-label" for="training-year-0">Year</label>
                                                <input type="number" class="form-control year-input" id="training-year-0"
                                                    name="training_years[]" min="2000" max="2099"
                                                    value="{{ now()->year }}" required>
                                                <div class="form-text">e.g., {{ now()->year }}</div>
                                                <div class="invalid-feedback year-error" style="display:none;">
                                                    Year must be unique.</div>
                                            </div>

                                            <div class="col-sm-9 col-md-7">
                                                <label class="form-label"
                                                    for="uploadtrainingcertificate-0">Certificate</label>
                                                <input class="form-control file-input" id="uploadtrainingcertificate-0"
                                                    type="file" name="training_certificates[{{ now()->year }}]"
                                                    accept="application/pdf" required>
                                                <div class="form-text">PDF, up to 10MB.</div>
                                                <div class="invalid-feedback">Please select your file.</div>
                                            </div>

                                            <div class="col-md-3 text-sm-end">
                                                <button type="button"
                                                    class="btn btn-outline-danger remove-year d-none">Remove</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /Initial row -->
                                </div>

                                <div class="mt-3 d-flex gap-2">
                                    <button type="button" class="btn btn-outline-primary" id="add-training-year">
                                        Add another year
                                    </button>
                                </div>
                            </div>

                            {{-- Template for extra rows --}}
                            <template id="training-year-row-template">
                                <div class="col-12 year-row border rounded p-3">
                                    <div class="row g-3">
                                        <div class="col-sm-3 col-md-2">
                                            <label class="form-label" for="training-year-0">Year</label>
                                            <input type="number" class="form-control year-input" id="training-year-0"
                                                name="training_years[]" min="2000" max="2099" required>
                                            <div class="form-text">e.g., {{ now()->year }}</div>
                                            <div class="invalid-feedback year-error" style="display:none;">Year
                                                must be unique.</div>
                                        </div>

                                        <div class="col-sm-9 col-md-7">
                                            <label class="form-label"
                                                for="uploadtrainingcertificate-0">Certificate</label>
                                            <input class="form-control file-input" id="uploadtrainingcertificate-0"
                                                type="file" accept="application/pdf" required>
                                            <div class="form-text">PDF, up to 10MB.</div>
                                            <div class="invalid-feedback">Please select your file.</div>
                                        </div>

                                        <div class="col-md-3 text-sm-end">
                                            <button type="button"
                                                class="btn btn-outline-danger remove-year">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            </template>
                        </div>

                        <div class="mt-3">
                            <button class="btn btn-primary me-2" type="submit">Save</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div><!-- /modal-body -->
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script>
        // Form Validation JS

        (function() {
            (() => {
                "use strict";
                const forms = document.querySelectorAll(".needs-validation");
                Array.from(forms).forEach((form) => {
                    form.addEventListener(
                        "submit",
                        (event) => {
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            }

                            form.classList.add("was-validated");
                        },
                        false
                    );
                });
            })();
        })();

        (function() {
            (() => {
                "use strict";
                const forms = document.querySelectorAll(".needs-validation");
                Array.from(forms).forEach((form) => {
                    form.addEventListener("submit", (event) => {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add("was-validated");
                    }, false);
                });
            })();
        })();

        // ---- Training certificates (add year) ----
        (function() {
            const container = document.getElementById('training-certificates');
            const addBtn = document.getElementById('add-training-year');
            const template = document.getElementById('training-year-row-template');
            const MAX_SIZE = 10 * 1024 * 1024; // 10 MB

            function updateFileName(row) {
                const year = row.querySelector('.year-input')?.value?.trim();
                const fileInput = row.querySelector('.file-input');
                if (year && fileInput) fileInput.name = `training_certificates[${year}]`;
            }

            function validateUniqueYears() {
                const inputs = Array.from(container.querySelectorAll('.year-input'));
                const counts = {};
                inputs.forEach(i => {
                    const v = i.value.trim();
                    if (v) counts[v] = (counts[v] || 0) + 1;
                });
                inputs.forEach(i => {
                    const v = i.value.trim();
                    const col = i.closest('.col-sm-3, .col-md-2') || i.parentElement;
                    const feedback = col.querySelector('.year-error');
                    i.classList.remove('is-invalid');
                    if (feedback) feedback.style.display = 'none';
                    if (v && counts[v] > 1) {
                        i.classList.add('is-invalid');
                        if (feedback) feedback.style.display = 'block';
                    }
                });
            }

            function toggleRemoveButtons() {
                const rows = container.querySelectorAll('.year-row');
                rows.forEach(r => {
                    const btn = r.querySelector('.remove-year');
                    if (btn) btn.classList.toggle('d-none', rows.length === 1);
                });
            }

            function attachRowHandlers(row) {
                const y = row.querySelector('.year-input');
                const f = row.querySelector('.file-input');
                const rm = row.querySelector('.remove-year');

                y.addEventListener('input', () => {
                    updateFileName(row);
                    validateUniqueYears();
                });
                f.addEventListener('change', () => validateFile(row));
                rm.addEventListener('click', () => {
                    row.remove();
                    validateUniqueYears();
                    toggleRemoveButtons();
                });
            }

            function addRow(prefillYear = '') {
                const idx = Number(container.dataset.nextIndex || 1);
                const frag = template.content.cloneNode(true);
                const row = frag.querySelector('.year-row');

                const y = row.querySelector('.year-input');
                const f = row.querySelector('.file-input');
                const yLabel = row.querySelector('label[for="training-year-0"]');
                const fLabel = row.querySelector('label[for="uploadtrainingcertificate-0"]');

                y.id = `training-year-${idx}`;
                f.id = `uploadtrainingcertificate-${idx}`;
                yLabel.setAttribute('for', y.id);
                fLabel.setAttribute('for', f.id);

                const suggest = prefillYear || new Date().getFullYear();
                y.value = suggest;
                f.name = `training_certificates[${suggest}]`;

                container.appendChild(row);
                attachRowHandlers(row);
                validateUniqueYears();
                toggleRemoveButtons();
                container.dataset.nextIndex = idx + 1;
            }

            // Init first row
            const firstRow = container.querySelector('.year-row');
            if (firstRow) {
                attachRowHandlers(firstRow);
                updateFileName(firstRow);
            }
            toggleRemoveButtons();

            // Add new year on click (suggest next year)
            addBtn?.addEventListener('click', () => {
                const years = Array.from(container.querySelectorAll('.year-input')).map(i => Number(i.value) ||
                    new Date().getFullYear());
                const maxYear = years.length ? Math.max(...years) : new Date().getFullYear();
                addRow(maxYear + 1);
            });
        })();
    </script>
@endsection
