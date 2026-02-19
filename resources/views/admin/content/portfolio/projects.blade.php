@extends('layouts/contentNavbarLayout')

@section('title', 'Manage Projects')

@section('content')

<div class="d-flex align-items-center justify-content-between mb-4">
    <div class="portfolio-page-header">
        <h4 class="fw-bold mb-1">Projects</h4>
        <p class="text-muted mb-0">Manage all portfolio projects</p>
    </div>
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProjectModal">
        <i class="icon-base bx bx-plus me-1"></i> Add Project
    </button>
</div>

{{-- Filter Bar --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <div class="row g-3 align-items-center">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="Search projects..." id="projectSearch">
            </div>
            <div class="col-md-3">
                <select class="form-select" id="categoryFilter">
                    <option value="">All Categories</option>
                    <option>Web Development</option>
                    <option>Mobile App</option>
                    <option>UI/UX Design</option>
                    <option>Cloud</option>
                </select>
            </div>
            <div class="col-md-3">
                <select class="form-select" id="statusFilter">
                    <option value="">All Statuses</option>
                    <option>Published</option>
                    <option>Draft</option>
                    <option>Archived</option>
                </select>
            </div>
        </div>
    </div>
</div>

{{-- Projects Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Project Name</th>
                        <th>Category</th>
                        <th>Client</th>
                        <th>Status</th>
                        <th>Featured</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ([
                        ['id'=>1, 'name'=>'E-Commerce Platform',    'cat'=>'Web Development', 'client'=>'RetailCo Inc.',      'status'=>'Published', 'featured'=>true,  'date'=>'Feb 10, 2025'],
                        ['id'=>2, 'name'=>'Healthcare Mobile App',  'cat'=>'Mobile App',      'client'=>'HealthFirst Clinics', 'status'=>'Published', 'featured'=>true,  'date'=>'Jan 28, 2025'],
                        ['id'=>3, 'name'=>'SaaS Analytics Dashboard','cat'=>'UI/UX Design',   'client'=>'DataStream SaaS',    'status'=>'Draft',     'featured'=>false, 'date'=>'Jan 15, 2025'],
                        ['id'=>4, 'name'=>'Logistics Management',   'cat'=>'Web Development', 'client'=>'LogiTrack Ltd.',     'status'=>'Published', 'featured'=>false, 'date'=>'Jan 5, 2025'],
                        ['id'=>5, 'name'=>'FinTech Wallet App',     'cat'=>'Mobile App',      'client'=>'PaySwift Inc.',      'status'=>'Archived',  'featured'=>false, 'date'=>'Dec 20, 2024'],
                        ['id'=>6, 'name'=>'EdTech Learning Platform','cat'=>'Web Development','client'=>'LearnHub Co.',       'status'=>'Published', 'featured'=>true,  'date'=>'Dec 10, 2024'],
                    ] as $p)
                    <tr>
                        <td class="text-muted small">{{ $p['id'] }}</td>
                        <td class="fw-semibold">{{ $p['name'] }}</td>
                        <td><span class="badge bg-label-primary">{{ $p['cat'] }}</span></td>
                        <td class="text-muted small">{{ $p['client'] }}</td>
                        <td><span class="badge badge-{{ strtolower($p['status']) }}">{{ $p['status'] }}</span></td>
                        <td>
                            @if($p['featured'])
                                <span class="badge bg-label-warning"><i class="icon-base bx bx-star me-1"></i>Yes</span>
                            @else
                                <span class="text-muted small">—</span>
                            @endif
                        </td>
                        <td class="text-muted small">{{ $p['date'] }}</td>
                        <td>
                            <div class="d-flex gap-1">
                                <button class="btn btn-sm btn-icon btn-outline-primary" title="Edit"><i class="icon-base bx bx-edit"></i></button>
                                <button class="btn btn-sm btn-icon btn-outline-danger" title="Delete"><i class="icon-base bx bx-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-transparent d-flex justify-content-between align-items-center">
        <small class="text-muted">Showing 6 of 24 projects</small>
        <nav><ul class="pagination pagination-sm mb-0">
            <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
            <li class="page-item active"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">Next</a></li>
        </ul></nav>
    </div>
</div>

{{-- Add Project Modal --}}
<div class="modal fade" id="addProjectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Add New Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="row g-3">
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Project Name</label>
                            <input type="text" class="form-control" placeholder="e.g. E-Commerce Platform">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Category</label>
                            <select class="form-select">
                                <option>Web Development</option>
                                <option>Mobile App</option>
                                <option>UI/UX Design</option>
                                <option>Cloud</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Client Name</label>
                            <input type="text" class="form-control" placeholder="Client company name">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select class="form-select">
                                <option>Draft</option>
                                <option>Published</option>
                                <option>Archived</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Featured?</label>
                            <select class="form-select">
                                <option>No</option>
                                <option>Yes</option>
                            </select>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Brief project description..."></textarea>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary">Save Project</button>
            </div>
        </div>
    </div>
</div>

@endsection
