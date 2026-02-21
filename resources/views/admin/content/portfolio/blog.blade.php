@extends('layouts/contentNavbarLayout')

@section('title', 'Blog Posts')

@section('content')

    <div class="d-flex align-items-center justify-content-between mb-4">
        <div class="portfolio-page-header">
            <h4 class="fw-bold mb-1">Blog Posts</h4>
            <p class="text-muted mb-0">Create and manage blog content</p>
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPostModal">
            <i class="icon-base bx bx-plus me-1"></i> New Post
        </button>
    </div>

    {{-- Filter Bar --}}
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body py-3">
            <div class="row g-3 align-items-center">
                <div class="col-md-5"><input type="text" class="form-control" placeholder="Search posts..."></div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option>All Categories</option>
                        <option>Technology</option>
                        <option>Design</option>
                        <option>Business</option>
                        <option>Tutorial</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <select class="form-select">
                        <option>All Statuses</option>
                        <option>Published</option>
                        <option>Draft</option>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Read Time</th>
                            <th>Status</th>
                            <th>Published</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ([
                                ['id' => 1, 'title' => '10 Web Dev Trends in 2025', 'cat' => 'Technology', 'author' => 'Alex M.', 'read' => '5 min', 'status' => 'Published', 'date' => 'Feb 12, 2025'],
                                ['id' => 2, 'title' => 'Why UI/UX Matters for Startups', 'cat' => 'Design', 'author' => 'Sara K.', 'read' => '4 min', 'status' => 'Published', 'date' => 'Feb 5, 2025'],
                                ['id' => 3, 'title' => 'Building Scalable APIs with Laravel', 'cat' => 'Tutorial', 'author' => 'James R.', 'read' => '8 min', 'status' => 'Published', 'date' => 'Jan 28, 2025'],
                                ['id' => 4, 'title' => 'How We Scaled to 1M Users', 'cat' => 'Business', 'author' => 'Alex M.', 'read' => '6 min', 'status' => 'Draft', 'date' => '—'],
                                ['id' => 5, 'title' => 'Mobile-First Design Principles', 'cat' => 'Design', 'author' => 'Sara K.', 'read' => '5 min', 'status' => 'Published', 'date' => 'Jan 15, 2025'],
                                ['id' => 6, 'title' => 'Cloud Cost Optimization Tips', 'cat' => 'Technology', 'author' => 'James R.', 'read' => '7 min', 'status' => 'Draft', 'date' => '—'],
                            ] as $post)

                                                    <tr>
                                <td class="text-muted small">{{ $post['id'] }}</td>
                                <td class="fw-semibold">{{ $post['title'] }}</td>
                                <td><span class="badge bg-label-info">{{ $post['cat'] }}</span></td>

                                                                       <td class="text-muted small">{{ $post['author'] }}</td>

                                                                       <td class="text-muted small">{{ $post['read'] }}</td>
                                <td><span class="badge badge-{{ strtolower($post['status']) }}">{{ $post['status'] }}</span></td>
                                <td class="text-muted small">{{ $post['date'] }}</td>
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
            </di    v>
        </div>
            <div     clas
            s="card-footer bg-transparent d-flex justify-content-between align-items-center">
            <small class="text-muted">Showing 6 of 47 posts</small>
            <nav><ul class="pagination pagination-sm mb-0">
                <li class="page-item disabled"><a class="page-link" href="#">Prev</a></li>
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">Next</a></li>
            </ul></nav>
        </div>
    </div>

    {{-- Add Post Modal --}}
    <div class="modal fade" id="addPostModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">

                                                   <h5 class="modal-title fw-bold">New Blog Post</h5>






                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>

                                               </div>




                                            <div class="modal-body">

                                                   <form>


                                                <div class="row g-3">
                            <div class="col-12"><label class="form-label fw-semibold">Post Title</label><input type="text" class="form-control" placeholder="Post title"></div>
                            <div class="col-md-4"><label class="form-label fw-semibold">Category</label><select class="form-select"><option>Technology</option><option>Design</option><option>Business</option><option>Tutorial</option></select></div>
                            <div class="col-md-4"><label class="form-label fw-semibold">Author</label><input type="text" class="form-control" placeholder="Author name"></div>
                            <div class="col-md-4"><label class="form-label fw-semibold">Status</label><select class="form-select"><option>Draft</option><option>Published</option></select></div>
                            <div class="col-12"><label class="form-label fw-semibold">Excerpt</label><textarea class="form-control" rows="2" placeholder="Short excerpt..."></textarea></div>
                            <div class="col-12"><label class="form-label fw-semibold">Content</label><textarea class="form-control ckeditor" rows="5" placeholder="Full post content..."></textarea></div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save Post</button>
                </div>
            </div>
        </div>    </div>

    @push('page-scripts')
        @include('admin._partials.ckeditor')
    @endpush

@endsection
