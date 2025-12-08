@extends('front.layouts.main', ['seo' => [
'title' => $blog->title,
'description' => Str::limit($blog->short_description, 160),
'keywords' => '',
'city' => '',
'state' => '',
'position' => ''
]
])

@section('content')

<section class="page-title cursor-light">
    <!-- Pattern Layers -->
    <div class="pattern-layers">
        <div class="layer-one"></div>
        <div class="layer-two"></div>
    </div>
    <div class="auto-container">
        <h2 class="hide-cursor" style="z-index: 100;">{{ $blog->title }}</h2>
        <ul class="page-breadcrumb link">
            <li><a href="{{ route('home') }}"><span class="icon fas fa-home"></span> home</a></li>
            <li><a href="{{ route('blog.index') }}"><span class="icon fas fa-home"></span> Blog</a></li>
            <li>{{ $blog->title }}</li>
        </ul>
    </div>
</section>
<!--Banner End-->

<!--Blog Start-->
<section class="blog-single">
    <h2 class="d-none">hidden</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <!--Post-->
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
                        <span class="post-date">On {{ $blog->published_at->format('M d, Y') }}</span>

                    </div>

                    <h2 class="post-title"><a href="javascript:void(0);" rel="bookmark">{{ $blog->title }}</a></h2>

                    <div class="post-content">
                        {!! $blog->content !!}
                    </div>

                    <!-- <div class="footer-meta">
                        <div class="row">
                            <div class="col-6">
                                <div class="post-tags">
                                    <span class="post_meta_item post_tags"><a href="javascript:void(0);" rel="tag">Image</a>
                                        <a href="javascript:void(0);" rel="tag">Project</a>
                                        <a href="javascript:void(0);" rel="tag">Studio</a>
                                    </span>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="post-social social-icon-bg">
                                    <ul class="share-icons">
                                        <li><a class="facebook" target="_blank" href="javascript:void(0);" title="Minimal Post With A Preview Image"><i class="fab fa-facebook-f"></i></a></li>
                                        <li><a class="twitter" target="_blank" href="javascript:void(0);"><i class="fab fa-twitter"></i></a></li>
                                        <li><a class="pinterest" target="_blank" href="javascript:void(0);"><i class="fab fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>


                        </div>
                    </div> -->

                </article>

                <!--Post Navigation-->
                <!-- <div class="post-navigation alt-font">
                    <div class="row d-flex align-items-center">

                        <div class="col-6">
                            <div class="post-previous">
                                <a href="javascript:void(0);" class="single-post-nav left d-flex align-items-center">
                                    <i class="fa fa-angle-left"></i>
                                    <div class="post-nav-content">
                                        <p>Previous Post</p>
                                        <h6>Standard Post With A Image Gallery</h6>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="post-next">
                                <a href="javascript:void(0);" class="single-post-nav right d-flex align-items-center">
                                    <div class="post-nav-content">
                                        <p>Next Post</p>
                                        <h6>Minimal Post With A Preview Image</h6>
                                    </div>
                                    <i class="fa fa-angle-right"></i>
                                </a>

                            </div>
                        </div>

                    </div>
                </div> -->

                <!--Author-->
                <!-- <div class="agency-author">
                    <div class="author-avatar">
                        <img alt="image" src="img/author.jpg" class="avatar">
                    </div>
                    <div class="author-content">
                        <span class="text-small">Written By</span>
                        <h6><a href="javascript:void(0);">Mark Anderson</a></h6>
                        <div class="author-description">
                            <p>Maecenas sit amet purus eget ipsum elementum venenatis. Aenean maximus urna magna, quis rutrum mi semper non.</p>
                        </div>
                    </div>
                </div> -->

                <!--Comment Area-->
                <!-- <div class="comments-area blog-comment" id="comments">
                    <div class="comment-form-title alt-font">
                        <span class="text-outside-line-full">Write a comment </span>
                    </div>
                    <form action="https://megaone.acrothemes.com/" method="post" id="commentform" class="comment-form blog-comment-form" novalidate="">
                        <div class="row">
                            <div class="col-lg-4">
                                <input id="author" placeholder="Name *" class="input-field comment-fields" name="author" type="text" value="">
                            </div>
                            <div class="col-lg-4">
                                <input id="email" placeholder="Email *" class="input-field comment-fields" name="email" type="email" value="">
                            </div>
                            <div class="col-lg-4">
                                <input id="url" placeholder="Website" class="input-field medium-input comment-fields" name="url" type="url" value="">
                            </div>
                            <div class="col-md-12">
                                <textarea id="comment" placeholder="Enter your comment here..." rows="8" class="input-field comment-fields" name="comment" required="required"></textarea>
                                <a href="javascript:void(0);" id="submit_btn" class="btn btn-large btn-rounded btn-purple btn-hvr-blue d-block">Send Message
                                    <div class="btn-hvr-setting">
                                        <ul class="btn-hvr-setting-inner">
                                            <li class="btn-hvr-effect"></li>
                                            <li class="btn-hvr-effect"></li>
                                            <li class="btn-hvr-effect"></li>
                                            <li class="btn-hvr-effect"></li>
                                        </ul>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </form>
                </div> -->

            </div>

            <div class="col-lg-4">

                <div class="agency-widget" id="secondary" role="complementary">



                    @if($latestBlogs->count() > 0)
                    <aside class="widget latest_post_widget">
                        <h3 class="widget-title">Popular Post</h3>
                        <ul class="blog-latest-post">
                            <!--Recent Post-->
                            @foreach ($latestBlogs as $latestBlog)
                            <li>
                                <figure><a href="javascript:void(0);">
                                        <img width="150" height="150" src="{{ getImage($latestBlog->image) }}" class="attachment-thumbnail" alt="{{ $latestBlog->title }}">
                                    </a></figure>
                                <div class="post-head"><a class="title" href="javascript:void(0);">{{ $latestBlog->title }}</a><span class="clearfix"></span>{{ $latestBlog->published_at->format('M d, Y') }} | by <a href="javascript:void(0);">{{ config('const.site_setting.name') }}</a></div>
                            </li>
                            @endforeach
                        </ul>
                    </aside>
                    @endif
                </div><!-- #secondary -->
            </div>
        </div>
    </div>
</section>
<!--Blog End-->
@endsection