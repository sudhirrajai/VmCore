@php
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Route;
@endphp

<!-- ! Not required for layout-without-menu -->
@if(!isset($navbarHideToggle))
    <div
        class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0 {{ isset($contentNavbar) ? ' d-xl-none ' : '' }}">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
            <i class="icon-base bx bx-menu icon-md"></i>
        </a>
    </div>
@endif

<div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <!-- Search -->
    <div class="navbar-nav align-items-center flex-grow-1" style="max-width: 400px; position: relative;">
        <div class="nav-item d-flex align-items-center w-100">
            <i class="icon-base bx bx-search icon-md"></i>
            <input type="text" class="form-control border-0 shadow-none ps-1 ps-sm-2" id="adminGlobalSearch"
                placeholder="Search projects, blog, team..." aria-label="Search..." autocomplete="off">
        </div>
        <div id="searchResults" class="dropdown-menu w-100 shadow-lg"
            style="display:none; position:absolute; top:100%; left:0; max-height:400px; overflow-y:auto; z-index:9999;">
        </div>
    </div>
    <!-- /Search -->

    <ul class="navbar-nav flex-row align-items-center ms-auto">

        {{-- Clear Cache Button --}}
        <li class="nav-item me-2">
            <form action="{{ route('admin.cache.clear') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-sm btn-outline-warning d-flex align-items-center gap-1"
                    title="Clear all caches (config, views, routes, app)">
                    <i class="bx bx-bolt-circle"></i>
                    <span class="d-none d-md-inline">Clear Cache</span>
                </button>
            </form>
        </li>

        <!-- User -->
        <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
                <div class="avatar avatar-online">
                    <span class="avatar-initial rounded-circle bg-primary"
                        style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;font-size:16px;font-weight:600;">
                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                    </span>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <a class="dropdown-item" href="javascript:void(0);">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar avatar-online">
                                    <span class="avatar-initial rounded-circle bg-primary"
                                        style="width:40px;height:40px;display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:600;">
                                        {{ strtoupper(substr(Auth::user()->name ?? 'A', 0, 1)) }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <h6 class="mb-0">{{ Auth::user()->name ?? 'Admin' }}</h6>
                                <small class="text-muted">{{ Auth::user()->email ?? '' }}</small>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                    <a class="dropdown-item" href="{{ route('admin.settings.index') }}">
                        <i class="icon-base bx bx-cog icon-md me-3"></i><span>Settings</span>
                    </a>
                </li>
                <li>
                    <div class="dropdown-divider my-1"></div>
                </li>
                <li>
                    <form action="{{ route('admin.logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="dropdown-item">
                            <i class="icon-base bx bx-power-off icon-md me-3"></i><span>Log Out</span>
                        </button>
                    </form>
                </li>
            </ul>
        </li>
        <!--/ User -->
    </ul>
</div>

@section('page-script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const searchInput = document.getElementById('adminGlobalSearch');
            const resultsBox = document.getElementById('searchResults');
            let debounceTimer;

            searchInput.addEventListener('input', function () {
                clearTimeout(debounceTimer);
                const q = this.value.trim();

                if (q.length < 2) {
                    resultsBox.style.display = 'none';
                    return;
                }

                debounceTimer = setTimeout(() => {
                    fetch(`{{ route('admin.search') }}?q=${encodeURIComponent(q)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (data.results.length === 0) {
                                resultsBox.innerHTML = '<div class="p-3 text-muted text-center"><i class="bx bx-search me-1"></i>No results found</div>';
                                resultsBox.style.display = 'block';
                                return;
                            }

                            let html = '';
                            data.results.forEach(item => {
                                html += `<a href="${item.url}" class="dropdown-item d-flex align-items-center py-2">
                                                <i class="${item.icon} me-2 text-primary"></i>
                                                <div>
                                                    <div class="fw-semibold">${item.name}</div>
                                                    <small class="text-muted">${item.type}</small>
                                                </div>
                                            </a>`;
                            });

                            resultsBox.innerHTML = html;
                            resultsBox.style.display = 'block';
                        })
                        .catch(() => {
                            resultsBox.style.display = 'none';
                        });
                }, 300);
            });

            // Close results on click outside
            document.addEventListener('click', function (e) {
                if (!searchInput.contains(e.target) && !resultsBox.contains(e.target)) {
                    resultsBox.style.display = 'none';
                }
            });

            // Close on escape
            searchInput.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') {
                    resultsBox.style.display = 'none';
                    this.blur();
                }
            });
        });
    </script>
@endsection