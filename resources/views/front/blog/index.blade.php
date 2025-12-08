@extends('front.layouts.main', [
'seo' => [
'title' => 'Blog',
'description' => 'Latest updates and articles from Quietly',
'keywords' => 'blog, updates, articles',
'city' => '',
'state' => '',
'position' => ''
]
])

@section('content')

<!--Banner Start-->
<section class="page-title cursor-light">
    <!-- Pattern Layers -->
    <div class="pattern-layers">
        <div class="layer-one"></div>
        <div class="layer-two"></div>
    </div>
    <div class="auto-container">
        <h2 class="hide-cursor">Blogs</h2>
        <ul class="page-breadcrumb link">
            <li><a href="{{ route('home') }}"><span class="icon fas fa-home"></span> home</a></li>
            <li>Blogs</li>
        </ul>
    </div>
</section>
<!--Banner End-->

<!--Blog Start-->
<section class="blog-default">
    <h2 class="d-none">hidden</h2>
    <div class="container">
        <div class="row">
            <div class="col-lg-8" id="blog-data">
                @include('front.blog.data')
            </div>
            <div class="col-lg-4">

                <div class="agency-widget" id="secondary" role="complementary">

                    <!--Search Form-->
                    <!-- <aside class="widget widget_search">
                        <form method="get" id="searchform" action="javascript:void(0);" role="search">
                            <label class="sr-only" for="s">Search</label>
                            <div class="input-group">
                                <input class="field form-control" id="s" name="s" type="text" placeholder="Search …" value="">
                                <span class="input-group-append">
                                    <button class="submit btn-search" id="searchsubmit" name="submit" type="submit"><i class="fas fa-search"></i></button>
                                </span>
                            </div>
                        </form>
                    </aside>

                    <aside class="widget widget_categories">
                        <h3 class="widget-title">Topics</h3>
                        <ul>
                            <li class="cat-item"><a href="javascript:void(0);">Art</a> <span class="dots"></span><span class="counts">5</span></li>
                            <li class="cat-item"><a href="javascript:void(0);">Fashion</a> <span class="dots"></span><span class="counts">4</span></li>
                            <li class="cat-item"><a href="javascript:void(0);">Lifestyle</a> <span class="dots"></span><span class="counts">2</span></li>
                            <li class="cat-item"><a href="javascript:void(0);">Motivation</a> <span class="dots"></span><span class="counts">5</span></li>
                            <li class="cat-item"><a href="javascript:void(0);">Travel</a> <span class="dots"></span><span class="counts">7</span></li>
                        </ul>
                    </aside>

                    <aside class="widget latest_post_widget">
                        <h3 class="widget-title">Popular Post</h3>
                        <ul class="blog-latest-post">
                            <li>
                                <figure><a href="javascript:void(0);">
                                        <img width="150" height="150" src="img/news-1-150x150.jpg" class="attachment-thumbnail" alt="image">
                                    </a></figure>
                                <div class="post-head"><a class="title" href="javascript:void(0);">Minimal Post With A Preview Image</a><span class="clearfix"></span>July 24, 2020 | by <a href="javascript:void(0);">Mark Anderson</a></div>
                            </li>
                            <li>
                                <figure><a href="javascript:void(0);">
                                        <img width="150" height="150" src="img/news-2-150x150.jpg" class="attachment-thumbnail" alt="image">
                                    </a></figure>
                                <div class="post-head"><a class="title" href="javascript:void(0);">Minimal Post With A Preview Image</a><span class="clearfix"></span>July 24, 2020 | by <a href="javascript:void(0);">Mark Anderson</a></div>
                            </li>
                            <li>
                                <figure><a href="javascript:void(0);">
                                        <img width="150" height="150" src="img/news-3-150x150.jpg" class="attachment-thumbnail" alt="image">
                                    </a></figure>
                                <div class="post-head"><a class="title" href="javascript:void(0);">Minimal Post With A Preview Image</a><span class="clearfix"></span>July 24, 2020 | by <a href="javascript:void(0);">Mark Anderson</a></div>
                            </li>
                        </ul>
                    </aside>

                    <aside id="archives-2" class="widget widget_archive">
                        <h3 class="widget-title">Archives</h3>
                        <ul>
                            <li><a href="javascript:void(0);">July 2020</a>&nbsp;<span class="dots"></span><span class="counts">2</span></li>
                            <li><a href="javascript:void(0);">May 2020</a>&nbsp;<span class="dots"></span><span class="counts">1</span></li>
                            <li><a href="javascript:void(0);">June 2018</a>&nbsp;<span class="dots"></span><span class="counts">3</span></li>
                            <li><a href="javascript:void(0);">March 2017</a>&nbsp;<span class="dots"></span><span class="counts">3</span></li>
                            <li><a href="javascript:void(0);">May 2016</a>&nbsp;<span class="dots"></span><span class="counts">4</span></li>
                            <li><a href="javascript:void(0);">August 2015</a>&nbsp;<span class="dots"></span><span class="counts">2</span></li>
                        </ul>
                    </aside> -->
                </div><!-- #secondary -->
            </div>
        </div>
    </div>
</section>
<!--Blog End-->

<section class="py-5 bg-light">
    <div class="container">
        <div class="row g-4" id="blog-data">
            @include('front.blog.data')
        </div>
        <div class="ajax-load text-center mt-5" style="display:none">
            <p>
                <!-- <img src="{{ asset('assets/img/loader.gif') }}" width="50">  -->
                Loading More post...
            </p>
        </div>
    </div>
</section>

@endsection

@push('js')
<script>
    var page = 1;
    var noMoreData = false;
    var isLoading = false;

    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            if (!noMoreData && !isLoading) {
                page++;
                loadMoreData(page);
            }
        }
    });

    function loadMoreData(page) {
        isLoading = true;
        $.ajax({
                url: '?page=' + page,
                type: "get",
                beforeSend: function() {
                    $('.ajax-load').show();
                }
            })
            .done(function(data) {
                isLoading = false;
                if (data.html.trim() == "") {
                    // $('.ajax-load').html("No more records found");
                    $('.ajax-load').hide();
                    noMoreData = true;
                    return;
                }
                $('.ajax-load').hide();
                $("#blog-data").append(data.html);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                isLoading = false;
                alert('server not responding...');
            });
    }
</script>
@endpush