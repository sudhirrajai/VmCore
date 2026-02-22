@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Dashboard')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome back, {{ auth()->user()->name ?? 'Admin' }}! 🎉
                                </h5>
                                <p class="mb-4">Your portfolio CMS is ready. Manage your content below.</p>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="Dashboard">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Stats Cards --}}
        <div class="row">
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-primary">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2"><span class="avatar-initial rounded bg-label-primary"><i
                                        class="bx bx-briefcase"></i></span></div>
                            <h4 class="ms-1 mb-0">{{ $stats['projects'] }}</h4>
                        </div>
                        <p class="mb-0">Total Projects</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2"><span class="avatar-initial rounded bg-label-info"><i
                                        class="bx bx-cog"></i></span></div>
                            <h4 class="ms-1 mb-0">{{ $stats['services'] }}</h4>
                        </div>
                        <p class="mb-0">Services</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2"><span class="avatar-initial rounded bg-label-success"><i
                                        class="bx bx-news"></i></span></div>
                            <h4 class="ms-1 mb-0">{{ $stats['blog_posts'] }}</h4>
                        </div>
                        <p class="mb-0">Blog Posts</p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-lg-3 mb-4">
                <div class="card card-border-shadow-warning">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2 pb-1">
                            <div class="avatar me-2"><span class="avatar-initial rounded bg-label-warning"><i
                                        class="bx bx-envelope"></i></span></div>
                            <h4 class="ms-1 mb-0">{{ $stats['unread_inquiries'] }}</h4>
                        </div>
                        <p class="mb-0">Unread Inquiries</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            {{-- Recent Inquiries --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Recent Inquiries</h5>
                        <a href="{{ route('admin.inquiries.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentInquiries as $inquiry)
                                        <tr>
                                            <td>{{ $inquiry->name }}</td>
                                            <td>{{ $inquiry->email }}</td>
                                            <td><span
                                                    class="badge bg-label-{{ $inquiry->is_read ? 'success' : 'warning' }}">{{ $inquiry->is_read ? 'Read' : 'New' }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No inquiries yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Recent Blog Posts --}}
            <div class="col-md-6 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="card-title mb-0">Recent Blog Posts</h5>
                        <a href="{{ route('admin.blog.index') }}" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentPosts as $post)
                                        <tr>
                                            <td>{{ Str::limit($post->title, 30) }}</td>
                                            <td>{{ $post->category->title ?? '—' }}</td>
                                            <td><span
                                                    class="badge bg-label-{{ $post->status ? 'success' : 'secondary' }}">{{ $post->status ? 'Published' : 'Draft' }}</span>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">No posts yet</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats Row --}}
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bx bx-group bx-lg text-primary mb-2"></i>
                        <h4>{{ $stats['team_members'] }}</h4>
                        <p class="mb-0">Team Members</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bx bx-mail-send bx-lg text-info mb-2"></i>
                        <h4>{{ $stats['subscribers'] }}</h4>
                        <p class="mb-0">Newsletter Subscribers</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bx bx-envelope bx-lg text-warning mb-2"></i>
                        <h4>{{ $stats['inquiries'] }}</h4>
                        <p class="mb-0">Total Inquiries</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection