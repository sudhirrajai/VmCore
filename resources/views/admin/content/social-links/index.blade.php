@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Social Links')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Social Links</h5>
                <a href="{{ route('admin.social-links.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>
                    Add</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Icon</th>
                                <th>Platform</th>
                                <th>URL</th>
                                <th>Order</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td><i class="{{ $item->icon }}" style="font-size:1.3rem;"></i></td>
                                    <td><strong>{{ $item->platform }}</strong></td>
                                    <td><a href="{{ $item->url }}" target="_blank">{{ Str::limit($item->url, 35) }}</a></td>
                                    <td>{{ $item->order }}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.social-links.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.social-links.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.social-links.destroy', $item) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                                class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No social links.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection