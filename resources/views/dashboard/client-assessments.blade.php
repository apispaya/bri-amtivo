@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('css')
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Client Assessment</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Client Assessment</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @include('partials.error')

    <div class="container-fluid user-list-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-header card-no-border text-end">
                        <div class="card-header-right-icon">
                            {{-- Go to full add-client page --}}
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
                                            <th><span class="c-o-light f-w-600">#</span></th>
                                            <th><span class="c-o-light f-w-600">Auditor's Code</span></th>
                                            <th><span class="c-o-light f-w-600">Auditor's Name</span></th>
                                            <th><span class="c-o-light f-w-600">Company Attended</span></th>
                                            <th><span class="c-o-light f-w-600">Assigned Standard</span></th>
                                            <th><span class="c-o-light f-w-600">Files</span></th>
                                            <th><span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $i => $c)
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td>
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>

                                                <td>
                                                    <p>{{ $c->auditor_code ?: '—' }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $c->auditor_name ?: '—' }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $c->company_name }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $c->assigned_standard ?: '—' }}</p>
                                                </td>

                                                <td>
                                                    {{-- Singles --}}
                                                    <p>Report:
                                                        @if ($c->report_path)
                                                            <a class="pdf" href="{{ Storage::url($c->report_path) }}"
                                                                target="_blank" title="Open Report">
                                                                <i class="icofont icofont-file-pdf"></i>
                                                            </a>
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                    <p>Company Profile:
                                                        @if ($c->company_profile_path)
                                                            <a class="pdf"
                                                                href="{{ Storage::url($c->company_profile_path) }}"
                                                                target="_blank" title="Open Company Profile">
                                                                <i class="icofont icofont-file-pdf"></i>
                                                            </a>
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                    <p>SSM:
                                                        @if ($c->ssm_path)
                                                            <a class="pdf" href="{{ Storage::url($c->ssm_path) }}"
                                                                target="_blank" title="Open SSM">
                                                                <i class="icofont icofont-file-pdf"></i>
                                                            </a>
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                    <p>SOP:
                                                        @if ($c->sop_path)
                                                            <a class="pdf" href="{{ Storage::url($c->sop_path) }}"
                                                                target="_blank" title="Open SOP">
                                                                <i class="icofont icofont-file-pdf"></i>
                                                            </a>
                                                        @else
                                                            —
                                                        @endif
                                                    </p>

                                                    {{-- Arrays --}}
                                                    <p>Licenses:
                                                        @if (!empty($c->licenses_paths))
                                                            @foreach ($c->licenses_paths as $idx => $p)
                                                                <a class="pdf ms-1" href="{{ Storage::url($p) }}"
                                                                    target="_blank" title="License {{ $idx + 1 }}">
                                                                    [{{ $idx + 1 }}]
                                                                </a>
                                                            @endforeach
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                    <p>Forms & Evidence:
                                                        @if (!empty($c->forms_evidence_paths))
                                                            @foreach ($c->forms_evidence_paths as $idx => $p)
                                                                <a class="pdf ms-1" href="{{ Storage::url($p) }}"
                                                                    target="_blank"
                                                                    title="Form/Evidence {{ $idx + 1 }}">
                                                                    [{{ $idx + 1 }}]
                                                                </a>
                                                            @endforeach
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                    <p>ISO Certificates:
                                                        @if (!empty($c->iso_paths))
                                                            @foreach ($c->iso_paths as $idx => $p)
                                                                <a class="pdf ms-1" href="{{ Storage::url($p) }}"
                                                                    target="_blank" title="ISO {{ $idx + 1 }}">
                                                                    [{{ $idx + 1 }}]
                                                                </a>
                                                            @endforeach
                                                        @else
                                                            —
                                                        @endif
                                                    </p>
                                                </td>

                                                <td>
                                                    <div class="common-align gap-2 justify-content-start">
                                                        {{-- EDIT assessment info/files for this client --}}
                                                        <button type="button"
                                                            class="square-white btn btn-link p-0 m-0 edit-assessment"
                                                            data-bs-toggle="modal" data-bs-target="#assessmentModal"
                                                            data-update="{{ route('dashboard.clients.assessment.update', $c) }}"
                                                            data-code="{{ $c->auditor_code ?? '' }}"
                                                            data-name="{{ $c->auditor_name ?? '' }}"
                                                            data-standard="{{ $c->assigned_standard ?? '' }}"
                                                            {{-- existing "open" links can stay if you like --}}
                                                            data-report="{{ $c->report_path ? Storage::url($c->report_path) : '' }}"
                                                            data-companyprofile="{{ $c->company_profile_path ? Storage::url($c->company_profile_path) : '' }}"
                                                            data-ssm="{{ $c->ssm_path ? Storage::url($c->ssm_path) : '' }}"
                                                            data-sop="{{ $c->sop_path ? Storage::url($c->sop_path) : '' }}"
                                                            {{-- NEW: raw storage paths as JSON (used for removal) --}}
                                                            data-licenses-raw='@json($c->licenses_paths ?? [])'
                                                            data-forms-raw='@json($c->forms_evidence_paths ?? [])'
                                                            data-iso-raw='@json($c->iso_paths ?? [])' title="Edit">
                                                            <svg>
                                                                <use href="/assets/svg/icon-sprite.svg#edit-content"></use>
                                                            </svg>
                                                        </button>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div><!-- /table-responsive -->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal: Edit Assessment --}}
    <div class="modal fade modal-bookmark" id="assessmentModal" tabindex="-1" aria-labelledby="assessmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="assessmentModalLabel">Edit Client Assessment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="assessment-form" class="needs-validation" method="POST" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        {{-- PUT injected by JS --}}
                        <div class="row g-3">
                            <div class="col-sm-4">
                                <label class="form-label" for="auditor_code">Auditor's Code</label>
                                <input id="auditor_code" name="auditor_code" class="form-control" type="text">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="auditor_name">Auditor's Name</label>
                                <input id="auditor_name" name="auditor_name" class="form-control" type="text">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="assigned_standard">Assigned Standard</label>
                                <input id="assigned_standard" name="assigned_standard" class="form-control"
                                    type="text">
                            </div>

                            <div class="col-12 mt-2"><label class="form-label">Files</label></div>

                            <div class="col-md-6">
                                <label class="form-label" for="report_file">Report</label>
                                <input id="report_file" name="report_file" class="form-control" type="file"
                                    accept="application/pdf">
                                <div class="form-text" id="help-report">PDF, up to 10MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="company_profile_file">Company Profile</label>
                                <input id="company_profile_file" name="company_profile_file" class="form-control"
                                    type="file" accept="application/pdf">
                                <div class="form-text" id="help-company-profile">PDF, up to 10MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="ssm_file">SSM</label>
                                <input id="ssm_file" name="ssm_file" class="form-control" type="file"
                                    accept="application/pdf">
                                <div class="form-text" id="help-ssm">PDF, up to 10MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="sop_file">SOP</label>
                                <input id="sop_file" name="sop_file" class="form-control" type="file"
                                    accept="application/pdf">
                                <div class="form-text" id="help-sop">PDF, up to 10MB.</div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="licenses_files">Licenses (multiple)</label>
                                <input id="licenses_files" name="licenses_files[]" class="form-control" type="file"
                                    accept="application/pdf" multiple>
                                <div class="form-text" id="help-licenses">PDF, up to 10MB each.</div>
                                <div id="remove-licenses" class="mt-1"></div> {{-- <- checkboxes appear here --}}
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="forms_evidence_files">Forms & Evidence (multiple)</label>
                                <input id="forms_evidence_files" name="forms_evidence_files[]" class="form-control"
                                    type="file" accept="application/pdf" multiple>
                                <div class="form-text" id="help-forms">PDF, up to 10MB each.</div>
                                <div id="remove-forms" class="mt-1"></div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label" for="iso_files">ISO Certificates (multiple)</label>
                                <input id="iso_files" name="iso_files[]" class="form-control" type="file"
                                    accept="application/pdf" multiple>
                                <div class="form-text" id="help-iso">PDF, up to 10MB each.</div>
                                <div id="remove-iso" class="mt-1"></div>
                            </div>
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
        (function() {
            const form = document.getElementById('assessment-form');

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

            function linkOrDash(url, label) {
                return url ?
                    `Current: <a href="${url}" target="_blank">${label}</a>. Upload to replace.` :
                    'No file uploaded.';
            }

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-assessment');
                if (!btn) return;

                setAction(btn.dataset.update);
                setMethod('PUT');

                // text fields
                document.getElementById('auditor_code').value = btn.dataset.code || '';
                document.getElementById('auditor_name').value = btn.dataset.name || '';
                document.getElementById('assigned_standard').value = btn.dataset.standard || '';

                // clear file inputs
                document.getElementById('report_file').value = '';
                document.getElementById('company_profile_file').value = '';
                document.getElementById('ssm_file').value = '';
                document.getElementById('sop_file').value = '';
                document.getElementById('licenses_files').value = '';
                document.getElementById('forms_evidence_files').value = '';
                document.getElementById('iso_files').value = '';

                // single-file helps
                document.getElementById('help-report').innerHTML = linkOrDash(btn.dataset.report, 'open');
                document.getElementById('help-company-profile').innerHTML = linkOrDash(btn.dataset
                    .companyprofile, 'open');
                document.getElementById('help-ssm').innerHTML = linkOrDash(btn.dataset.ssm, 'open');
                document.getElementById('help-sop').innerHTML = linkOrDash(btn.dataset.sop, 'open');

                // multi-file helps: render small list if any
                const renderList = (csv, elId, label) => {
                    const el = document.getElementById(elId);
                    if (!csv) {
                        el.textContent = 'No files uploaded.';
                        return;
                    }
                    const urls = csv.split(',').filter(Boolean);
                    el.innerHTML = label + ': ' + urls.map((u, i) =>
                        `<a class="ms-1" href="${u}" target="_blank">[${i+1}]</a>`).join('');
                };
                renderList(btn.dataset.licenses, 'help-licenses', 'Current');
                renderList(btn.dataset.forms, 'help-forms', 'Current');
                renderList(btn.dataset.iso, 'help-iso', 'Current');
            });

            // Bootstrap validation
            form?.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();
    </script>

    <script>
        (function() {
            const form = document.getElementById('assessment-form');

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

            function linkOrDash(url, label) {
                return url ? `Current: <a href="${url}" target="_blank">${label}</a>. Upload to replace.` :
                    'No file uploaded.';
            }

            function renderRemoveList(paths, containerId, inputName) {
                const el = document.getElementById(containerId);
                if (!paths || !paths.length) {
                    el.innerHTML = '<span class="text-muted small">No files uploaded.</span>';
                    return;
                }
                el.innerHTML =
                    '<div class="small text-muted mb-1">Uncheck nothing if you don\'t want to delete.</div>' +
                    paths.map((p, idx) => {
                        const base = p.split('/').pop(); // just filename
                        const id = containerId + '-' + idx;
                        return `
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="${inputName}[]" value="${p}" id="${id}">
            <label class="form-check-label small" for="${id}">${base}</label>
          </div>`;
                    }).join('');
            }

            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-assessment');
                if (!btn) return;

                setAction(btn.dataset.update);
                setMethod('PUT');

                // text fields
                document.getElementById('auditor_code').value = btn.dataset.code || '';
                document.getElementById('auditor_name').value = btn.dataset.name || '';
                document.getElementById('assigned_standard').value = btn.dataset.standard || '';

                // clear file inputs
                ['report_file', 'company_profile_file', 'ssm_file', 'sop_file', 'licenses_files',
                    'forms_evidence_files', 'iso_files'
                ]
                .forEach(id => document.getElementById(id).value = '');

                // single-file hints
                document.getElementById('help-report').innerHTML = linkOrDash(btn.dataset.report, 'open');
                document.getElementById('help-company-profile').innerHTML = linkOrDash(btn.dataset
                    .companyprofile, 'open');
                document.getElementById('help-ssm').innerHTML = linkOrDash(btn.dataset.ssm, 'open');
                document.getElementById('help-sop').innerHTML = linkOrDash(btn.dataset.sop, 'open');

                // multi-file removable lists (use RAW paths)
                const licensesRaw = btn.dataset.licensesRaw ? JSON.parse(btn.dataset.licensesRaw) : [];
                const formsRaw = btn.dataset.formsRaw ? JSON.parse(btn.dataset.formsRaw) : [];
                const isoRaw = btn.dataset.isoRaw ? JSON.parse(btn.dataset.isoRaw) : [];

                renderRemoveList(licensesRaw, 'remove-licenses', 'remove_licenses');
                renderRemoveList(formsRaw, 'remove-forms', 'remove_forms');
                renderRemoveList(isoRaw, 'remove-iso', 'remove_iso');
            });

            form?.addEventListener('submit', function(e) {
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();
    </script>

@endsection
