@extends('admin.layouts.contentNavbarLayout')
@section('title', 'Team Members')
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        @include('admin.content._partials.flash-messages')
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Team Members</h5>
                <a href="{{ route('admin.team.create') }}" class="btn btn-primary"><i class="bx bx-plus me-1"></i> Add
                    Member</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Position</th>
                                <th>Order</th>
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
                                                class="avatar-initial rounded-circle bg-label-primary">{{ substr($item->name, 0, 1) }}</span>
                                            @endif</td>
                                    <td><strong>{{ $item->name }}</strong></td>
                                    <td>{{ $item->position }}</td>
                                    <td>{{ $item->order }}</td>
                                    <td>@include('admin.content._partials.status-toggle', ['item' => $item, 'route' => 'admin.team.toggle-status'])
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.team.edit', $item) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit"></i></a>
                                        <form action="{{ route('admin.team.destroy', $item) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">No team members.</td>
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