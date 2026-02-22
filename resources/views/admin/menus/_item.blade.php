<li class="dd-item" data-id="{{ $item->id }}">
    <div class="dd-handle">
        <i class="bx bx-move me-2"></i>
        <strong>{{ $item->title }}</strong>
        <small class="text-muted ms-2">
            {{ $item->page_id ? 'Page: ' . $item->page->title . ' (/' . $item->page->slug . ')' : 'URL: ' . $item->custom_url }}
        </small>
        @if(!$item->is_active)
            <span class="badge bg-label-secondary ms-2">Disabled</span>
        @endif
    </div>

    <div class="item-actions dd-nodrag">
        <form action="{{ route('admin.menus.items.destroy', $item) }}" method="POST" style="display:inline;"
            onsubmit="return confirm('Delete item?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-sm btn-icon btn-outline-danger"><i class="bx bx-trash"></i></button>
        </form>
    </div>

    @if($item->children->count() > 0)
        <ol class="dd-list">
            @foreach($item->children as $child)
                @include('admin.menus._item', ['item' => $child])
            @endforeach
        </ol>
    @endif
</li>