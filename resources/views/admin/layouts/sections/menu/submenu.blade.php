@php
  use Illuminate\Support\Facades\Route;
  use Illuminate\Support\Str;
@endphp

<ul class="menu-sub">
  @if (isset($menu))
    @foreach ($menu as $submenu)

      @php
        $activeClass = null;
        $currentRouteName = Route::currentRouteName() ?? '';

        if (is_array($submenu->slug ?? null)) {
          foreach ($submenu->slug as $slug) {
            if (Str::startsWith($currentRouteName, $slug)) {
              $activeClass = isset($submenu->submenu) ? 'active open' : 'active';
              break;
            }
          }
        } elseif (isset($submenu->slug)) {
          if ($currentRouteName === $submenu->slug) {
            $activeClass = 'active';
          } elseif (Str::startsWith($currentRouteName, $submenu->slug . '.')) {
            $activeClass = 'active';
          }
        }
      @endphp

      <li class="menu-item {{$activeClass}}">
        <a href="{{ isset($submenu->url) ? url($submenu->url) : 'javascript:void(0)' }}"
          class="{{ isset($submenu->submenu) ? 'menu-link menu-toggle' : 'menu-link' }}" @if (isset($submenu->target) and !empty($submenu->target)) target="_blank" @endif>
          @if (isset($submenu->icon))
            <i class="{{ $submenu->icon }}"></i>
          @endif
          <div>{{ isset($submenu->name) ? __($submenu->name) : '' }}</div>
          @isset($submenu->badge)
            <div class="badge rounded-pill bg-{{ $submenu->badge[0] }} text-uppercase ms-auto">{{ $submenu->badge[1] }}</div>
          @endisset
        </a>

        {{-- submenu --}}
        @if (isset($submenu->submenu))
          @include('admin.layouts.sections.menu.submenu', ['menu' => $submenu->submenu])
        @endif
      </li>
    @endforeach
  @endif
</ul>