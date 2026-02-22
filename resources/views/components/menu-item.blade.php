@props(['item', 'isMobile' => false])

@php
    $url = $item->page_id ? url($item->page->slug) : ($item->custom_url ?: '#');
    $path = parse_url($url, PHP_URL_PATH);
    $isActive = request()->is(ltrim($path ?: '', '/')) ? 'active' : '';
@endphp

<li class="{{ $isActive }} {{ $item->children->count() > 0 ? 'menu-item-has-children' : '' }}">
    <a href="{{ $url }}" target="{{ $item->target }}">
        @if($isMobile)
            {{ $item->title }}
        @else
            <span class="link-effect">
                <span class="effect-1">{{ $item->title }}</span>
                <span class="effect-1">{{ $item->title }}</span>
            </span>
        @endif
    </a>
    @if ($item->children->count() > 0)
        <ul class="sub-menu">
            @foreach($item->children as $child)
                <x-menu-item :item="$child" :isMobile="$isMobile" />
            @endforeach
        </ul>
    @endif
</li>