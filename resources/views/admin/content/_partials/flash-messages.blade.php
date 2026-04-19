{{-- Reusable admin flash messages partial --}}
@if (session('success') || session('cache_cleared'))
    <div class="alert alert-success alert-dismissible d-flex align-items-center" role="alert">
        <i class="bx bx-check-circle me-2 fs-5"></i>
        <span>{{ session('success') ?? session('cache_cleared') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible d-flex align-items-center" role="alert">
        <i class="bx bx-error-circle me-2 fs-5"></i>
        <span>{{ session('error') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('warning'))
    <div class="alert alert-warning alert-dismissible d-flex align-items-center" role="alert">
        <i class="bx bx-error me-2 fs-5"></i>
        <span>{{ session('warning') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('info'))
    <div class="alert alert-info alert-dismissible d-flex align-items-center" role="alert">
        <i class="bx bx-info-circle me-2 fs-5"></i>
        <span>{{ session('info') }}</span>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger alert-dismissible d-flex align-items-start" role="alert">
        <i class="bx bx-error-circle me-2 fs-5 mt-1"></i>
        <div class="d-flex flex-column">
            <span class="fw-semibold">Please clear the following errors:</span>
            <ul class="mb-0 ps-3 mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif