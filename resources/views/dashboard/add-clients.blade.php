@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('css')
@endsection

@section('main_content')

    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Add Clients</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/dashboard"> <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item active">Add Clients</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @include('partials.error')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card create-project-form custom-input">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <form class="row g-3 needs-validation" action="{{ route('dashboard.clients.store') }}"
                                    method="POST" enctype="multipart/form-data" novalidate>
                                    @csrf

                                    <div class="card-body main-divider">
                                        <div class="divider-body divider-body-1 divider-secondary">
                                            <div class="divider-p-secondary">
                                                <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                                <span class="txt-secondary">Company's Information</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="nameofcompany">Name of
                                            Company</label>
                                        <input id="nameofcompany" name="company_name" class="form-control" type="text"
                                            required>
                                        <div class="invalid-feedback">Please enter company's name</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="auditreference">Audit
                                            Reference</label>
                                        <input id="auditreference" name="audit_reference" class="form-control"
                                            type="text">
                                        <div class="invalid-feedback">Please enter audit reference</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="clientpic">Client's PIC</label>
                                        <input id="clientpic" name="pic_name" class="form-control" type="text" required>
                                        <div class="invalid-feedback">Please enter client's PIC</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="contactno">Contact No</label>
                                        <input id="contactno" name="pic_phone" class="form-control" type="text">
                                        <div class="invalid-feedback">Please enter the PIC contact no</div>
                                    </div>

                                    <div class="card-body main-divider">
                                        <div class="divider-body divider-body-1 divider-secondary">
                                            <div class="divider-p-secondary">
                                                <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                                <span class="txt-secondary">Company's Certification</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="contactno">Certificate No</label>
                                        <input name="certificate_no" class="form-control" type="text" required>
                                        <div class="invalid-feedback">Please enter the certificate no</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadcertificate">Upload
                                            Certificate</label>
                                        <input id="uploadcertificate" name="certificate_file" class="form-control"
                                            type="file" accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-12"><label class="form-label" for="validity">Validity</label>
                                    </div>
                                    <div class="col-xxl-4 col-md-6"><label class="form-label">Issued On</label>
                                        <input name="issued_on" class="form-control" type="date">
                                        <div class="invalid-feedback">Please select issued date</div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6"><label class="form-label">Effective Date</label>
                                        <input name="effective_date" class="form-control" type="date">
                                        <div class="invalid-feedback">Please select effective date</div>
                                    </div>
                                    <div class="col-xxl-4 col-md-6"><label class="form-label">Expiry Date</label>
                                        <input name="expiry_date" class="form-control" type="date">
                                        <div class="invalid-feedback">Please select expiry date</div>
                                    </div>

                                    <div class="card-body main-divider">
                                        <div class="divider-body divider-body-1 divider-secondary">
                                            <div class="divider-p-secondary">
                                                <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                                <span class="txt-secondary">Company's Assessment</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6"><label class="form-label" for="auditorcode">Audtior's
                                            Code</label>
                                        <input id="auditorcode" name="auditor_code" class="form-control" type="text">
                                        <div class="invalid-feedback">Please enter the auditor's code</div>
                                    </div>
                                    <div class="col-lg-4 col-md-6"><label class="form-label" for="auditorname">Audtior's
                                            Name</label>
                                        <input id="auditorname" name="auditor_name" class="form-control" type="text">
                                        <div class="invalid-feedback">Please enter the auditor's name</div>
                                    </div>
                                    <div class="col-lg-4 col-md-6"><label class="form-label"
                                            for="assignedstandard">Assigned Standard</label>
                                        <input id="assignedstandard" name="assigned_standard" class="form-control"
                                            type="text">
                                        <div class="invalid-feedback">Please enter the assigned standard</div>
                                    </div>
                                    <div class="col-md-12"><label class="form-label" for="validity">Upload</label>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadreport">Report</label>
                                        <input id="uploadreport" name="report_file" class="form-control" type="file"
                                            accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadcompanyprofile">Company
                                            Profile</label>
                                        <input id="uploadcompanyprofile" name="company_profile_file" class="form-control"
                                            type="file" accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadssm">SSM</label>
                                        <input id="uploadssm" name="ssm_file" class="form-control" type="file"
                                            accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadlicenses">Licenses</label>
                                        <input id="uploadlicenses" name="licenses_files[]" class="form-control"
                                            type="file" accept="application/pdf" multiple>
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your files.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadsop">SOP</label>
                                        <input id="uploadsop" name="sop_file" class="form-control" type="file"
                                            accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadformandevidence">Forms &
                                            Evidence</label>
                                        <input id="uploadformandevidence" name="forms_evidence_files[]"
                                            class="form-control" type="file" accept="application/pdf" multiple>
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your files.</div>
                                    </div>
                                    <div class="col-md-6"><label class="form-label" for="uploadiso">ISO
                                            Certificates</label>
                                        <input id="uploadiso" name="iso_files[]" class="form-control" type="file"
                                            accept="application/pdf" multiple>
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your files.</div>
                                    </div>

                                    {{-- Training Segment --}}
                                    <div class="card-body main-divider">
                                        <div class="divider-body divider-body-1 divider-secondary">
                                            <div class="divider-p-secondary">
                                                <i class="fa-solid fa-info-circle me-2 txt-secondary f-20"></i>
                                                <span class="txt-secondary">Training Segment</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">CPD for Lead Auditor</label>
                                    </div>

                                    <div class="col-12">
                                        <div class="row g-3" id="training-certificates" data-next-index="1">
                                            <!-- Initial row -->
                                            <div class="col-12 year-row border rounded p-3">
                                                <div class="row g-3">
                                                    <div class="col-sm-3 col-md-2">
                                                        <label class="form-label" for="training-year-0">Year</label>
                                                        <input type="number" class="form-control year-input"
                                                            id="training-year-0" name="training_years[]" min="2000"
                                                            max="2099" value="{{ now()->year }}" required>
                                                        <div class="form-text">e.g., {{ now()->year }}</div>
                                                        <div class="invalid-feedback year-error" style="display:none;">
                                                            Year must be unique.</div>
                                                    </div>

                                                    <div class="col-sm-9 col-md-7">
                                                        <label class="form-label"
                                                            for="uploadtrainingcertificate-0">Certificate</label>
                                                        <input class="form-control file-input"
                                                            id="uploadtrainingcertificate-0" type="file"
                                                            name="training_certificates[{{ now()->year }}]"
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
                                            <button type="button" class="btn btn-outline-primary"
                                                id="add-training-year">
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
                                                    <input type="number" class="form-control year-input"
                                                        id="training-year-0" name="training_years[]" min="2000"
                                                        max="2099" required>
                                                    <div class="form-text">e.g., {{ now()->year }}</div>
                                                    <div class="invalid-feedback year-error" style="display:none;">Year
                                                        must be unique.</div>
                                                </div>

                                                <div class="col-sm-9 col-md-7">
                                                    <label class="form-label"
                                                        for="uploadtrainingcertificate-0">Certificate</label>
                                                    <input class="form-control file-input"
                                                        id="uploadtrainingcertificate-0" type="file"
                                                        accept="application/pdf" required>
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


                                    <div class="col-12">
                                        <div class="common-flex justify-content-end"><button class="btn btn-primary"
                                                type="submit">Add </button><button
                                                class="btn btn-secondary">Cancel</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

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
