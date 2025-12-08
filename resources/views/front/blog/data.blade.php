@foreach ($blogs as $blog)
<article class="blog-classic">
    <!--Thumbnail-->
    <div class="post-thumbnail">
        <img src="{{ getImage($blog->image) }}" alt="{{ $blog->title }}">
    </div>
    <!--Post Meta-->
    <div class="post-details alt-font">

        <!-- <span class="post-categories">
            <a href="javascript:void(0);" rel="category tag">Fashion</a>
            <a href="javascript:void(0);" rel="category tag">Travel</a>
        </span> -->

        <span class="post-author">By <a href="javascript:void(0);">{{ config('const.site_setting.name') }}</a></span>
        <span class="post-separator">/</span>
        <span class="post-date">{{ $blog->published_at->format('M d, Y') }}</span>

    </div>

    <h2 class="post-title"><a href="{{ route('blog.show', $blog->slug) }}" rel="bookmark">{{ $blog->title }}</a></h2>

    <div class="post-content">

        <p>{{ Str::limit($blog->short_description, 150) }}</p>

    </div>
</article>
<!-- <div class="col-md-4">
    <div class="card h-100 border-0 shadow-sm">
        @if($blog->image)
        <img src="{{ getImage($blog->image) }}" class="card-img-top" alt="{{ $blog->title }}"
            style="height: 200px; object-fit: cover;">
        @endif
        <div class="card-body p-4 d-flex flex-column">
            <div class="mb-2">
                <small class="text-muted">{{ $blog->published_at->format('M d, Y') }}</small>
            </div>
            <h5 class="fw-semibold mb-3">
                <a href="{{ route('blog.show', $blog->slug) }}"
                    class="text-decoration-none text-dark">{{ $blog->title }}</a>
            </h5>
            <p class="text-muted mb-4 flex-grow-1">{{ Str::limit($blog->short_description, 100) }}</p>
            <a href="{{ route('blog.show', $blog->slug) }}" class="fw-semibold text-primary text-decoration-none">Read
                more <i class="bi bi-arrow-right ms-1"></i></a>
        </div>
    </div>
</div> -->
@endforeach