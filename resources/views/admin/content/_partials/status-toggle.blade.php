{{-- Reusable status toggle partial --}}
{{-- Usage: @include('admin.content._partials.status-toggle', ['item' => $item, 'route' =>
'admin.services.toggle-status']) --}}
<form action="{{ route($route, $item->id) }}" method="POST" class="d-inline">
    @csrf
    <button type="submit" class="btn btn-sm {{ $item->status ? 'btn-success' : 'btn-secondary' }}"
        title="Toggle status">
        <i class="bx {{ $item->status ? 'bx-check-circle' : 'bx-x-circle' }}"></i>
        {{ $item->status ? 'Active' : 'Inactive' }}
    </button>
</form>