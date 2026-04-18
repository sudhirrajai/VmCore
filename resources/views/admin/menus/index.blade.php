@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Menus Management')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Menus /</span> Manage Locations</h4>

    <div class="row">
        <!-- Create Menu -->
        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Create Menu</h5>
                <div class="card-body">
                <form method="GET" class="row g-3 mb-3">
                    <div class="col-auto">
                        <select name="per_page" class="form-select" onchange="this.form.submit()">
                            <option value="10" {{ request('per_page', 10) == 10 ? 'selected' : '' }}>10 Per Page</option>
                            <option value="25" {{ request('per_page') == 25 ? 'selected' : '' }}>25 Per Page</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50 Per Page</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100 Per Page</option>
                        </select>
                    </div>
                </form>
                    <form action="{{ route('admin.menus.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label" for="name">Menu Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="E.g. Main Header Menu" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="location">Location</label>
                            <select class="form-select" id="location" name="location" required>
                                @foreach(\App\Enums\MenuLocationEnum::cases() as $loc)
                                    <option value="{{ $loc->value }}">{{ $loc->label() }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Create Menu</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Existing Menus -->
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Existing Menus</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Menu Name</th>
                                <th>Location</th>
                                <th>Root Items</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody class="table-border-bottom-0">
                            @forelse($menus as $menu)
                                <tr>
                                    <td>#{{ $menu->id }}</td>
                                    <td><strong>{{ $menu->name }}</strong></td>
                                    <td><span class="badge bg-label-primary">{{ $menu->location->label() }}</span></td>
                                    <td>{{ $menu->parent_items->count() }}</td>
                                    <td>
                                        <a href="{{ route('admin.menus.builder', $menu) }}"
                                            class="btn btn-sm btn-outline-primary"><i class="bx bx-edit me-1"></i> Build
                                            Menu</a>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-sm btn-outline-danger global-delete-btn"><i
                                                    class="bx bx-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No menus found. Establish menus to use in the dynamic
                                        frontend component.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection