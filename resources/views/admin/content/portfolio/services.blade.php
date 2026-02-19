@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Services')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Services</h4>
        <p class="text-muted mb-0">Manage the services your company offers</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addServiceModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Service
    </button>
</div>

<div class="row g-4">
    @foreach ([
        ['id'=>1, 'icon'=>'bx-globe',       'title'=>'Web Development',       'desc'=>'Custom web apps, e-commerce, CMS, and API development.',        'status'=>'Active',   'order'=>1],
        ['id'=>2, 'icon'=>'bx-mobile-alt',  'title'=>'Mobile App Development','desc'=>'Native and cross-platform iOS & Android applications.',          'status'=>'Active',   'order'=>2],
        ['id'=>3, 'icon'=>'bx-palette',     'title'=>'UI/UX Design',          'desc'=>'User-centered design, wireframing, and prototyping.',            'status'=>'Active',   'order'=>3],
        ['id'=>4, 'icon'=>'bx-cloud',       'title'=>'Cloud & DevOps',        'desc'=>'AWS, GCP, Docker, Kubernetes, and CI/CD pipelines.',            'status'=>'Active',   'order'=>4],
        ['id'=>5, 'icon'=>'bx-search-alt',  'title'=>'SEO & Marketing',       'desc'=>'Technical SEO, content strategy, and analytics reporting.',     'status'=>'Inactive', 'order'=>5],
        ['id'=>6, 'icon'=>'bx-support',     'title'=>'Consulting',            'desc'=>'Tech stack audits, digital strategy, and architecture reviews.', 'status'=>'Active',   'order'=>6],
    ] as $service)
    <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body">
                <div class="d-flex align-items-start justify-content-between mb-3">
                    <div class="avatar avatar-md">
                        <span class="avatar-initial rounded-circle bg-label-primary">
                            <i class="icon-base bx {{ $service['icon'] }} text-primary"></i>
                        </span>
                    </div>
                    <div class="d-flex gap-1">
                        <span class="badge badge-{{ strtolower($service['status']) }}">{{ $service['status'] }}</span>
                    </div>
                </div>
                <h6 class="fw-bold mb-1">{{ $service['title'] }}</h6>
                <p class="text-muted small mb-3">{{ $service['desc'] }}</p>
                <div class="d-flex align-items-center justify-content-between">
                    <small class="text-muted">Order: {{ $service['order'] }}</small>
                    <div class="d-flex gap-1">
                        <button class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="icon-base bx bx-edit"></i></button>
                        <button class="btn btn-sm btn-icon btn-outline-danger" title="Delete"><i class="icon-base bx bx-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Add Service Modal --}}
<div class="modal fade" id="addServiceModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Service</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Service Title</label>
                            <input type="text" class="form-control" placeholder="e.g. Web Development">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Icon Class (Boxicons)</label>
                            <input type="text" class="form-control" placeholder="e.g. bx-globe">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select"><option>Active</option><option>Inactive</option></select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Order</label>
                            <input type="number" class="form-control" value="1" min="1">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Brief service description..."></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Service</button>
            </div>
        </div>
    </div>
</div>

@endsection
