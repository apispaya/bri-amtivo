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
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard.home') }}">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">CPD for Lead Auditor</li>
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
                                            <th><span class="c-o-light f-w-600">Name of Company</span></th>
                                            <th><span class="c-o-light f-w-600">Training Certificates</span></th>
                                            <th><span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $i => $c)
                                            @php
                                                $training = $c->training_certificates ?? [];
                                                krsort($training); // newest year first
                                            @endphp
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td>
                                                    <p>{{ $loop->iteration }}</p>
                                                </td>
                                                <td>
                                                    <p>{{ $c->company_name }}</p>
                                                </td>
                                                <td>
                                                    @if (!empty($training))
                                                        @foreach ($training as $year => $path)
                                                            <p>{{ $year }}
                                                                <a class="pdf ms-1" href="{{ Storage::url($path) }}"
                                                                    target="_blank" title="Open {{ $year }}">
                                                                    <i class="icofont icofont-file-pdf"></i>
                                                                </a>
                                                            </p>
                                                        @endforeach
                                                    @else
                                                        <p class="text-muted">—</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="common-align gap-2 justify-content-start">
                                                        <button type="button"
                                                            class="square-white btn btn-link p-0 m-0 edit-training"
                                                            data-bs-toggle="modal" data-bs-target="#trainingModal"
                                                            data-update="{{ route('dashboard.clients.training.update', $c) }}"
                                                            {{-- convert year => relative path to year => public URL --}}
                                                            data-training='@json(collect($c->training_certificates ?? [])->mapWithKeys(fn($path, $year) => [$year => Storage::url($path)]))' title="Edit">
                                                            <svg>
                                                                <use
                                                                    href="{{ asset('assets/svg/icon-sprite.svg#edit-content') }}">
                                                                </use>
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

    {{-- Modal: Edit Certificate(s) --}}
    <div class="modal fade modal-bookmark" id="trainingModal" tabindex="-1" aria-labelledby="trainingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="trainingModalLabel">Edit Certificate(s)</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="training-form" class="needs-validation" method="POST" enctype="multipart/form-data"
                        novalidate>
                        @csrf
                        {{-- PUT injected by JS --}}

                        {{-- Existing certificates to remove --}}
                        <div class="mb-3">
                            <label class="form-label d-block mb-2">Existing Certificates</label>
                            <div id="existing-training-list" class="border rounded p-3 small text-body">
                                <em>No certificates uploaded yet.</em>
                            </div>
                            <div class="form-text">Tick to remove selected years when saving.</div>
                        </div>

                        {{-- New uploads --}}
                        <div class="border rounded p-3">
                            <div class="row g-3" id="training-certificates" data-next-index="1"></div>

                            <div class="mt-3">
                                <button type="button" class="btn btn-outline-primary" id="add-training-year">
                                    Add another year
                                </button>
                            </div>
                        </div>

                        {{-- Row template for a new upload --}}
                        <template id="training-year-row-template">
                            <div class="col-12 year-row border rounded p-3 mt-3">
                                <div class="row g-3 align-items-start">
                                    <div class="col-sm-3 col-md-2">
                                        <label class="form-label" for="training-year-0">Year</label>
                                        <input type="number" class="form-control year-input" id="training-year-0"
                                            name="training_years[]" min="2000" max="2099">
                                        <div class="form-text">e.g., {{ now()->year }}</div>
                                        <div class="invalid-feedback year-error" style="display:none;">Year must be unique.
                                        </div>
                                    </div>
                                    <div class="col-sm-9 col-md-7">
                                        <label class="form-label" for="uploadtrainingcertificate-0">Certificate</label>
                                        <input class="form-control file-input" id="uploadtrainingcertificate-0"
                                            type="file" accept="application/pdf">
                                        <div class="form-text">PDF, up to 10MB.</div>
                                        <div class="invalid-feedback">Please select your file.</div>
                                    </div>
                                    <div class="col-md-3 text-sm-end">
                                        <button type="button" class="btn btn-outline-danger remove-year">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <div class="mt-3">
                            <button class="btn btn-primary me-2" type="submit">Save</button>
                            <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>
        (function() {
            const form = document.getElementById('training-form');
            const listBox = document.getElementById('existing-training-list');
            const container = document.getElementById('training-certificates');
            const addBtn = document.getElementById('add-training-year');
            const tpl = document.getElementById('training-year-row-template');

            // All existing years for this client (filled when opening the modal)
            let existingYearsAll = new Set();

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

            // Active existing = those NOT checked for removal
            function getActiveExistingYears() {
                const checked = new Set(
                    Array.from(listBox.querySelectorAll('input[name="remove_training[]"]:checked'))
                    .map(i => i.value)
                );
                const active = new Set([...existingYearsAll]);
                checked.forEach(y => active.delete(String(y)));
                return active;
            }

            // Render existing certs (with remove checkboxes) and capture years
            function renderExisting(map) {
                existingYearsAll = new Set(Object.keys(map || {}).map(String));
                if (!map || Object.keys(map).length === 0) {
                    listBox.innerHTML = '<em>No certificates uploaded yet.</em>';
                    return;
                }
                const items = Object.entries(map)
                    .sort((a, b) => b[0] - a[0])
                    .map(([year, url]) => `
        <div class="form-check mb-2">
          <input class="form-check-input" type="checkbox" value="${year}" id="rm-${year}" name="remove_training[]">
          <label class="form-check-label" for="rm-${year}">
            <span class="text-success">Remove ${year}</span>
            &nbsp;–&nbsp;<a href="${url}" target="_blank">${url.split('/').pop()}</a>
          </label>
        </div>
      `);
                listBox.innerHTML = items.join('');
            }

            function updateFileName(row) {
                const year = row.querySelector('.year-input')?.value?.trim();
                const file = row.querySelector('.file-input');
                if (year && file) file.name = `training_certificates[${year}]`;
            }

            // Validate new rows against each other AND against active existing years
            function validateUniqueYears() {
                const activeExisting = getActiveExistingYears();
                const inputs = Array.from(container.querySelectorAll('.year-input'));

                const counts = {};
                inputs.forEach(i => {
                    const v = i.value.trim();
                    if (v) counts[v] = (counts[v] || 0) + 1;
                });

                inputs.forEach(i => {
                    const v = i.value.trim();
                    const feedback = i.closest('.col-sm-3, .col-md-2')?.querySelector('.year-error');
                    i.classList.remove('is-invalid');
                    if (feedback) feedback.style.display = 'none';

                    const duplicateNew = v && counts[v] > 1;
                    const collidesExisting = v && activeExisting.has(v);

                    if (duplicateNew || collidesExisting) {
                        i.classList.add('is-invalid');
                        if (feedback) {
                            feedback.textContent = collidesExisting ? 'Year already exists.' :
                                'Year must be unique.';
                            feedback.style.display = 'block';
                        }
                    }
                });
            }

            // Suggest the next available year (respects checked removals)
            function nextAvailableYear() {
                const activeExisting = getActiveExistingYears();
                const newYears = new Set(
                    Array.from(container.querySelectorAll('.year-input'))
                    .map(i => i.value.trim())
                    .filter(Boolean)
                );
                const used = new Set([...activeExisting, ...newYears]);

                const numbers = [...used].map(Number).filter(n => !isNaN(n));
                let candidate = (numbers.length ? Math.max(...numbers) : new Date().getFullYear()) + 1;

                while (used.has(String(candidate))) candidate++;
                return candidate;
            }

            function attachRowHandlers(row) {
                const y = row.querySelector('.year-input');
                const f = row.querySelector('.file-input');
                const rm = row.querySelector('.remove-year');

                // New rows require both year + file
                y.required = true;
                f.required = true;

                y.addEventListener('input', () => {
                    updateFileName(row);
                    validateUniqueYears();
                });
                rm.addEventListener('click', () => {
                    row.remove();
                    validateUniqueYears();
                });
            }

            function addRow(prefillYear) {
                const idx = Number(container.dataset.nextIndex || 1);
                const frag = tpl.content.cloneNode(true);
                const row = frag.querySelector('.year-row');

                const y = row.querySelector('.year-input');
                const f = row.querySelector('.file-input');
                const yLabel = row.querySelector('label[for="training-year-0"]');
                const fLabel = row.querySelector('label[for="uploadtrainingcertificate-0"]');

                y.id = `training-year-${idx}`;
                f.id = `uploadtrainingcertificate-${idx}`;
                yLabel.setAttribute('for', y.id);
                fLabel.setAttribute('for', f.id);

                const suggest = prefillYear ?? nextAvailableYear();
                y.value = suggest;
                f.name = `training_certificates[${suggest}]`;

                container.appendChild(row);
                attachRowHandlers(row);
                validateUniqueYears();
                container.dataset.nextIndex = idx + 1;
            }

            // Open modal and hydrate from row’s data
            document.addEventListener('click', function(e) {
                const btn = e.target.closest('.edit-training');
                if (!btn) return;

                setAction(btn.dataset.update);
                setMethod('PUT');

                container.innerHTML = '';
                container.dataset.nextIndex = 1;

                let map = {};
                try {
                    map = JSON.parse(btn.dataset.training || '{}');
                } catch {}
                renderExisting(map);
                validateUniqueYears();
            });

            // Keep validation in sync when user checks/unchecks removals
            listBox.addEventListener('change', function(e) {
                if (e.target.matches('input[name="remove_training[]"]')) {
                    validateUniqueYears();
                }
            });

            // Add row: pick the next available year automatically
            addBtn?.addEventListener('click', () => addRow(nextAvailableYear()));

            // Allow “remove only” submits
            form?.addEventListener('submit', function(e) {
                const hasNewRows = container.querySelectorAll('.year-row').length > 0;
                if (!hasNewRows) {
                    container.querySelectorAll('[required]').forEach(el => el.required = false);
                }
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        })();
    </script>

@endsection
