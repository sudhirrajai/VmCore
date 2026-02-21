@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Testimonials')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Testimonials</h5>
                <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i>
                    Add</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>@if($item->image)<img src="{{ asset($item->image) }}" class="rounded-circle" width="40"
                                    height="40" style="object-fit:cover;">@else <span
                                            class="badge bg-label-secondary">—</span> @endif</td>
                                    <td><strong>{{ $item->name }}</strong><br><small
                                            class="text-muted">{{ $item->designation }}</small></td>
                                    <td>{{ $item->company }}</td>
                                    <td>{!! str_repeat('⭐', $item->rating) !!}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.testimonials.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.testimonials.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.testimonials.destroy', $item) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Delete?')">@csrf @method('DELETE')<button
                                                class="btn btn-sm btn-outline-danger"><i class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No testimonials.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $items->links() }}
            </div>
        </div>
    </div>
@endsection