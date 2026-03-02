<aside class="blog__sidebar custom-sidebar">
    {{-- Search --}}
    <div class="sidebar__widget sidebar__widget-two custom-widget-box mt-3">
        <div class="sidebar__search">
            <form action="{{ route('blog') }}" method="GET">
                <input type="text" name="search" placeholder="Search . . ." value="{{ request('search') }}">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M19.0002 19.0002L14.6572 14.6572M14.6572 14.6572C15.4001 13.9143 15.9894 13.0324 16.3914 12.0618C16.7935 11.0911 17.0004 10.0508 17.0004 9.00021C17.0004 7.9496 16.7935 6.90929 16.3914 5.93866C15.9894 4.96803 15.4001 4.08609 14.6572 3.34321C13.9143 2.60032 13.0324 2.01103 12.0618 1.60898C11.0911 1.20693 10.0508 1 9.00021 1C7.9496 1 6.90929 1.20693 5.93866 1.60898C4.96803 2.01103 4.08609 2.60032 3.34321 3.34321C1.84288 4.84354 1 6.87842 1 9.00021C1 11.122 1.84288 13.1569 3.34321 14.6572C4.84354 16.1575 6.87842 17.0004 9.00021 17.0004C11.122 17.0004 13.1569 16.1575 14.6572 14.6572Z"
                            stroke="currentcolor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
            </form>
        </div>
    </div>

    {{-- Categories --}}
    @if(isset($categories) && $categories->count())
        <div class="sidebar__widget custom-widget-box">
            <h4 class="sidebar__widget-title custom-widget-title">Categories</h4>
            <div class="sidebar__cat-list">
                <ul class="list-wrap">
                    @foreach($categories as $cat)
                        <li>
                            <a href="{{ route('blog', ['category' => $cat->slug]) }}">{{ $cat->name }}
                                ({{ $cat->posts_count }})</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    {{-- Recent Posts --}}
    @if(isset($recentPosts) && $recentPosts->count())
        <div class="sidebar__widget custom-widget-box">
            <h4 class="sidebar__widget-title custom-widget-title">Recent Posts</h4>
            <div class="sidebar__post-list">
                @foreach($recentPosts as $recent)
                    <div class="sidebar__post-item">
                        <div class="sidebar__post-thumb">
                            <a href="{{ route('blog.detail', $recent->slug) }}">
                                <img src="{{ $recent->image ? asset($recent->image) : asset('assets/img/blog/sb_post01.jpg') }}"
                                    alt="{{ $recent->title }}">
                            </a>
                        </div>
                        <div class="sidebar__post-content">
                            <h5 class="title"><a
                                    href="{{ route('blog.detail', $recent->slug) }}">{{ Str::limit($recent->title, 40) }}</a>
                            </h5>
                            <span class="date"><i
                                    class="flaticon-time"></i>{{ ($recent->published_at ?? $recent->created_at)->format('M d, Y') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Tags --}}
    @if(isset($tags) && $tags->count())
        <div class="sidebar__widget custom-widget-box">
            <h4 class="sidebar__widget-title custom-widget-title">Tags</h4>
            <div class="sidebar__tag-list">
                <ul class="list-wrap">
                    @foreach($tags as $tag)
                        <li><a href="javascript:void(0)">{{ $tag->title }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
</aside>