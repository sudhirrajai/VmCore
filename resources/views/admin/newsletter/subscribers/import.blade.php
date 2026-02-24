@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Import Subscribers')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4"><span class="text-muted fw-light">Newsletter / Subscribers /</span> Import</h4>

        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Upload CSV File</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.newsletter.subscribers.import') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label" for="csv_file">CSV File <span class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('csv_file') is-invalid @enderror"
                                    id="csv_file" name="csv_file" accept=".csv,.txt" required>
                                @error('csv_file')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div class="form-text mt-2">
                                    Please upload a CSV file without headers or with headers where the first column is
                                    <strong>email</strong>, and the second column is <strong>name</strong>.
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">
                                <i class="bx bx-upload me-1"></i> Import Now
                            </button>
                            <a href="{{ route('admin.newsletter.subscribers.index') }}"
                                class="btn btn-label-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card mb-4 bg-label-secondary">
                    <div class="card-body">
                        <h6 class="mb-3 border-bottom pb-2"><i class="bx bx-info-circle"></i> CSV Format Instructions</h6>
                        <p class="mb-2">Your CSV file should follow this simple structure:</p>
                        <ul>
                            <li><strong>Column 1:</strong> Email Address (Required)</li>
                            <li><strong>Column 2:</strong> Full Name (Optional)</li>
                        </ul>
                        <p class="text-muted mb-0"><small>Note: Duplicate emails will be skipped or skipped during import to
                                prevent duplicates.</small></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection