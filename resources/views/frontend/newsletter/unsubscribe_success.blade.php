@extends('frontend.layouts.master') <!-- Assumed layout -->

@section('title', 'Unsubscribed Successfully')

@section('content')
    <div class="container py-5 text-center">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-body py-5">
                        <div class="mb-4 text-success">
                            <i class="ti ti-check-circle" style="font-size: 4rem;"></i>
                        </div>
                        <h2 class="mb-3">Successfully Unsubscribed</h2>
                        <p class="text-muted">You have been successfully removed from our newsletter. We're sorry to see you
                            go!</p>
                        <a href="{{ url('/') }}" class="btn btn-primary mt-3">Return to Homepage</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection