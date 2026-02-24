@extends('frontend.layouts.master') <!-- Assumed layout -->

@section('title', 'Unsubscribe Failed')

@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-5">
                        <div class="mb-4 text-danger">
                            <i class="ti ti-x" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="mb-3">Unsubscribe Failed</h2>
                        <p class="text-muted">We could not process your request. The link might be invalid or expired.</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection