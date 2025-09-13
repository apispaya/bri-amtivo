@extends('layouts.master')
@section('title', 'Admin Dashboard')
@section('css')
@endsection

@section('main_content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-sm-6">
                    <h3>Endorsement by Governing Body of BRI Amtivo</h3>
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
                        <li class="breadcrumb-item active">Endorsement by Governing Body of BRI Amtivo</li>
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
                                            <th><span class="c-o-light f-w-600">ISO Certificate(s)</span></th>
                                            <th><span class="c-o-light f-w-600">Action</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($clients as $i => $c)
                                            <tr class="product-removes inbox-data">
                                                <td></td>
                                                <td><p>{{ $loop->iteration }}</p></td>

                                                <td><p>{{ $c->company_name }}</p></td>

                                                <td>
                                                    @if (!empty($c->iso_paths))
                                                        @foreach ($c->iso_paths as $idx => $p)
                                                            <p>
                                                                ISO Certificate - {{ $idx + 1 }}
                                                                <a class="pdf ms-1" href="{{ Storage::url($p) }}" target="_blank" title="Open ISO">
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
                                                        {{-- Edit ISO certificates for this client --}}
                                                        <button type="button"
                                                            class="square-white btn btn-link p-0 m-0 edit-iso"
                                                            data-bs-toggle="modal" data-bs-target="#isoModal"
                                                            data-update="{{ route('dashboard.clients.assessment.update', $c) }}"
                                                            {{-- index => public URL (we keep the original index so delete_iso[] matches) --}}
                                                            data-iso='@json(collect($c->iso_paths ?? [])->mapWithKeys(fn($p,$i) => [$i => Storage::url($p)]))'
                                                            title="Edit">
                                                            <svg><use href="{{ asset('assets/svg/icon-sprite.svg#edit-content') }}"></use></svg>
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

    {{-- Modal: ISO certificates (remove / add) --}}
    <div class="modal fade modal-bookmark" id="isoModal" tabindex="-1" aria-labelledby="isoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content custom-input">
                <div class="modal-header">
                    <h5 class="modal-title" id="isoModalLabel">Edit ISO Certificate(s)</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="iso-form" class="needs-validation" method="POST" enctype="multipart/form-data" novalidate>
                        @csrf
                        {{-- PUT injected by JS --}}

                        {{-- Existing ISO list with remove checkboxes --}}
                        <div class="mb-3">
                            <label class="form-label d-block mb-2">Existing Certificates</label>
                            <div id="iso-existing" class="border rounded p-3 small text-body">
                                <em>No ISO certificates uploaded yet.</em>
                            </div>
                            <div class="form-text">
                                Tick to remove selected certificates when saving.<br>
                                To <strong>replace</strong> a certificate, tick it to remove and upload the new file below.
                            </div>
                        </div>

                        {{-- Add new ISO(s) --}}
                        <div class="mb-3">
                            <label class="form-label" for="iso_files">Add new ISO certificate(s)</label>
                            <input id="iso_files" name="iso_files[]" class="form-control" type="file" accept="application/pdf" multiple>
                            <div class="form-text">PDF, up to 10MB each.</div>
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
(function () {
    const form   = document.getElementById('iso-form');
    const listEl = document.getElementById('iso-existing');

    function setAction(url){ form.setAttribute('action', url); }
    function setMethod(method){
        form.querySelector('input[name="_method"]')?.remove();
        if(method && method.toUpperCase() !== 'POST'){
            const el = document.createElement('input');
            el.type = 'hidden'; el.name = '_method'; el.value = method.toUpperCase();
            form.appendChild(el);
        }
    }

    // Render existing ISO rows (with delete checkboxes)
    function renderIsoList(map){
        if(!map || Object.keys(map).length === 0){
            listEl.innerHTML = '<em>No ISO certificates uploaded yet.</em>';
            return;
        }
        const rows = Object.entries(map).map(([idx, url]) => {
            const name = url.split('/').pop();
            return `
              <div class="d-flex align-items-center justify-content-between border rounded p-2 mb-2">
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="del-iso-${idx}" name="delete_iso[]" value="${idx}">
                  <label class="form-check-label" for="del-iso-${idx}">
                    <span class="text-danger">Remove</span>
                    &nbsp;–&nbsp;<a href="${url}" target="_blank">${name}</a>
                  </label>
                </div>
              </div>`;
        });
        listEl.innerHTML = rows.join('');
    }

    // Open modal
    document.addEventListener('click', function(e){
        const btn = e.target.closest('.edit-iso');
        if(!btn) return;

        setAction(btn.dataset.update);
        setMethod('PUT');

        // Clear file input
        const fileInput = document.getElementById('iso_files');
        if (fileInput) fileInput.value = '';

        // Render existing map
        let map = {};
        try { map = JSON.parse(btn.dataset.iso || '{}'); } catch(e){}
        renderIsoList(map);
    });

    // Bootstrap validation (allow remove-only submit)
    form?.addEventListener('submit', function(e){
        // nothing required, but still show bootstrap styles if HTML5 validation fails
        if(!form.checkValidity()){
            e.preventDefault(); e.stopPropagation();
        }
        form.classList.add('was-validated');
    }, false);
})();
</script>
@endsection
