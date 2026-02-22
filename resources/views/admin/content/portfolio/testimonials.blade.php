@extends('layouts/contentNavbarLayout')

@section('title', 'Testimonials')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Testimonials</h4>
        <p class="text-muted mb-0">Manage client testimonials and reviews</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTestimonialModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Testimonial
    </button>
</div>

<div class="row g-4">
    @foreach ([
        ['id'=>1,'name'=>'John Smith',    'role'=>'CEO, RetailCo Inc.',      'rating'=>5, 'text'=>'Exceptional work! They delivered our e-commerce platform on time and exceeded all expectations. Revenue tripled within 6 months.',    'status'=>'Published'],
        ['id'=>2,'name'=>'Sarah Lee',     'role'=>'CTO, HealthFirst',        'rating'=>5, 'text'=>'The mobile app they built for us has over 50,000 active users. The team was professional, responsive, and highly skilled.',          'status'=>'Published'],
        ['id'=>3,'name'=>'Mike Johnson',  'role'=>'COO, LogiTrack Ltd.',     'rating'=>5, 'text'=>'Their logistics system saved us 40% in operational costs. Highly recommend for any complex enterprise project.',                     'status'=>'Published'],
        ['id'=>4,'name'=>'Emma Davis',    'role'=>'Founder, DataStream SaaS','rating'=>4, 'text'=>'Great UI/UX redesign. Our user retention improved by 65% after launch. Would definitely work with them again.',                     'status'=>'Published'],
        ['id'=>5,'name'=>'Chris Wilson',  'role'=>'CEO, PaySwift Inc.',      'rating'=>5, 'text'=>'They built our entire FinTech wallet from scratch. Secure, scalable, and beautiful. Best tech partner we have worked with.',         'status'=>'Draft'],
    ] as $t)
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="d-flex align-items-center gap-3">
                        <div class="avatar avatar-md">
                            <span class="avatar-initial rounded-circle bg-label-primary fw-bold text-primary">
                                {{ substr($t['name'], 0, 1) }}
                            </span>
                        </div>
                        <div>
                            <h6 class="fw-bold mb-0">{{ $t['name'] }}</h6>
                            <small class="text-muted">{{ $t['role'] }}</small>
                        </div>
                    </div>
                    <span class="badge badge-{{ strtolower($t['status']) }}">{{ $t['status'] }}</span>
                </div>
                <div class="mb-2">
                    @for($i = 1; $i <= 5; $i++)
                        <i class="icon-base bx {{ $i <= $t['rating'] ? 'bxs-star text-warning' : 'bx-star text-muted' }}"></i>
                    @endfor
                </div>
                <p class="text-muted small mb-3">"{{ $t['text'] }}"</p>
                <div class="d-flex gap-1">
                    <button class="btn btn-sm btn-outline-primary"><i class="icon-base bx bx-edit me-1"></i>Edit</button>
                    <button class="btn btn-sm btn-outline-danger"><i class="icon-base bx bx-trash me-1"></i>Delete</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Add Testimonial Modal --}}
<div class="modal fade" id="addTestimonialModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add Testimonial</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label fw-semibold">Client Name</label><input type="text" class="form-control" placeholder="Full name"></div>
                        <div class="col-md-6"><label class="form-label fw-semibold">Role / Company</label><input type="text" class="form-control" placeholder="e.g. CEO, Acme Inc."></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Rating (1–5)</label><input type="number" class="form-control" min="1" max="5" value="5"></div>
                        <div class="col-md-4"><label class="form-label fw-semibold">Status</label><select class="form-select"><option>Draft</option><option>Published</option></select></div>
                        <div class="col-12"><label class="form-label fw-semibold">Testimonial Text</label><textarea class="form-control" rows="4" placeholder="Client's testimonial..."></textarea></div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Testimonial</button>
            </div>
        </div>
    </div>
</div>

@endsection
