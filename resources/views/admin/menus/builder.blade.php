@extends('admin.layouts.contentNavbarLayout')

@section('title', 'Menu Builder - ' . $menu->name)

@section('vendor-style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css" />
    <style>
        .dd {
            max-width: 100%;
        }

        .dd-item>button {
            margin-top: 5px;
        }

        .item-actions {
            position: absolute;
            right: 10px;
            top: 8px;
        }

        .dd-handle {
            display: block;
            height: 40px;
            margin: 5px 0;
            padding: 10px 15px;
            text-decoration: none;
            border: 1px solid #d9dee3;
            background: #fff;
            border-radius: 0.375rem;
            color: #566a7f;
            cursor: move;
        }

        .dd-handle:hover {
            color: #696cff;
            background: #f8f9fa;
        }
    </style>
@endsection

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light"><a href="{{ route('admin.menus.index') }}">Menus</a> /</span>
        Builder - {{ $menu->name }}</h4>

    <div class="row">
        <!-- Add Item Form -->
        <div class="col-md-4">
            <div class="card mb-4">
                <h5 class="card-header">Add Menu Item</h5>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.menus.items.store', $menu) }}" method="POST">
                        @csrf
                        <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                        <div class="mb-3">
                            <label class="form-label" for="title">Label / Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Link Type</label>
                            <select class="form-select" id="link_type" onchange="toggleLinkInput()">
                                <option value="page">Dynamic CMS Page</option>
                                <option value="custom">Custom URL</option>
                            </select>
                        </div>

                        <div class="mb-3" id="page_selector">
                            <label class="form-label" for="page_id">Select Page</label>
                            <select class="form-select" id="page_id" name="page_id">
                                <option value="">-- Choose Page --</option>
                                @foreach($pages as $page)
                                    <option value="{{ $page->id }}">{{ $page->title }} ({{ $page->slug }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3 d-none" id="custom_url_input">
                            <label class="form-label" for="custom_url">Custom URL</label>
                            <input type="url" class="form-control" id="custom_url" name="custom_url"
                                placeholder="https://...">
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="target">Open In</label>
                            <select class="form-select" id="target" name="target">
                                <option value="_self">Same Window</option>
                                <option value="_blank">New Tab</option>
                            </select>
                        </div>

                        <div class="form-check mb-3">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" checked>
                            <label class="form-check-label" for="is_active"> Active / Visible </label>
                        </div>

                        <button type="submit" class="btn btn-primary w-100">Add to Menu</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Menu Structure -->
        <div class="col-md-8">
            <div class="card mb-4">
                <h5 class="card-header">Drag & Drop Menu Structure</h5>
                <div class="card-body">
                    <div class="dd" id="nestable">
                        <ol class="dd-list">
                            @foreach($menu->parent_items as $item)
                                @include('admin.menus._item', ['item' => $item])
                            @endforeach
                        </ol>
                    </div>

                    @if($menu->parent_items->count() === 0)
                        <div class="alert alert-warning mt-3">No items in this menu yet. Add some items on the left.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@section('page-script')
    <script>
        function toggleLinkInput() {
            const type = document.getElementById('link_type').value;
            if (type === 'page') {
                document.getElementById('page_selector').classList.remove('d-none');
                document.getElementById('custom_url_input').classList.add('d-none');
                document.getElementById('custom_url').value = '';
            } else {
                document.getElementById('page_selector').classList.add('d-none');
                document.getElementById('custom_url_input').classList.remove('d-none');
                document.getElementById('page_id').value = '';
            }
        }

        function initMenuBuilder() {
            if (typeof window.$ === 'undefined') {
                setTimeout(initMenuBuilder, 50);
                return;
            }
            
            // Vite ESM exposes $ but sometimes omits window.jQuery which CDN scripts rely on
            if (typeof window.jQuery === 'undefined') {
                window.jQuery = window.$;
            }

            // Load Nestable plugin dynamically after jQuery is available
            $.getScript("https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.js", function() {
                $('#nestable').nestable({
                    maxDepth: 5
                }).on('change', function () {
                    let data = $(this).nestable('serialize');
                    let flatData = [];

                    function flatten(items, parent_id = null) {
                        for (let i = 0; i < items.length; i++) {
                            flatData.push({
                                id: items[i].id,
                                parent_id: parent_id,
                                sort_order: i
                            });
                            if (items[i].children) {
                                flatten(items[i].children, items[i].id);
                            }
                        }
                    }

                    flatten(data);

                    $.ajax({
                        url: '{{ route("admin.menus.reorder", $menu) }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            items: flatData
                        },
                        success: function (res) {
                            console.log('Menu reordered');
                        }
                    });
                });
            });
        }
        
        // Start polling for jQuery
        initMenuBuilder();
    </script>
@endsection