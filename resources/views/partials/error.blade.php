{{-- Success --}}
@if (session('success'))
    <div class="alert alert-bg-success alert-dismissible fade show" role="alert">
        <i data-feather="check-circle"></i>
        <p class="mb-0">{{ session('success') }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Danger / Error --}}
@php
    $dangerMsg = session('error') ?? session('danger');
@endphp
@if ($dangerMsg)
    <div class="alert alert-bg-danger alert-dismissible fade show" role="alert">
        <i data-feather="alert-triangle"></i>
        <p class="mb-0">{{ $dangerMsg }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Warning --}}
@if (session('warning'))
    <div class="alert alert-bg-warning alert-dismissible fade show" role="alert">
        <i data-feather="alert-circle"></i>
        <p class="mb-0">{{ session('warning') }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Info --}}
@if (session('info'))
    <div class="alert alert-bg-info alert-dismissible fade show" role="alert">
        <i data-feather="info"></i>
        <p class="mb-0">{{ session('info') }}</p>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Validation errors (default bag) --}}
@if ($errors->any())
    <div class="alert alert-bg-danger alert-dismissible fade show" role="alert">
        <i data-feather="alert-triangle"></i>
        <div>
            {{-- <p class="mb-1 fw-semibold">There is an error on the form:</p> --}}
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button class="btn-close" type="button" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
