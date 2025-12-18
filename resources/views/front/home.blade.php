@extends('front.layouts.main', ['seo' => [
'title' => 'Home',
'description' => 'Home',
'keywords' => 'Home' ,
'city' => '',
'state' => '',
'position' => ''
]
])
@push('style')
<style>
    /* Mimic ajax.js error styling if not already global */
    .text-danger.errors {
        display: block;
        /* Ensure it is visible */
        width: 100%;
        margin-top: .25rem;
        font-size: 80%;
        color: #dc3545;
    }

    .form-control.is-invalid {
        border-color: #dc3545 !important;
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5zM6 8.2a.3.3 0 000 .6.3.3 0 000-.6z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }
</style>
@endpush

@section('content')


<!--Slider Start-->
<section class="p-0 no-transition cursor-light" id="home">
    <h2 class="d-none">hidden</h2>
    <div class="rev_slider_wrapper fullscreen-container" data-alias="agency-1" data-source="gallery"
        id="rev_slider_17_1_wrapper" style="background:transparent;padding:0px;">
        <!-- START REVOLUTION SLIDER 5.4.8.1 fullscreen mode -->
        <div class="rev_slider fullscreenbanner" data-version="5.4.8.1" id="rev_slider_17_1" style="display:none;">
            <ul> <!-- SLIDE  -->
                <li data-description="" data-easein="default" data-easeout="default" data-hideafterloop="0"
                    data-hideslideonmobile="off" data-index="rs-43" data-masterspeed="default" data-param1=""
                    data-param10="" data-param2="" data-param3="" data-param4="" data-param5=""
                    data-param6="" data-param7="" data-param8="" data-param9="" data-rotate="0" data-saveperformance="off"
                    data-slotamount="default" data-title="Slide" data-transition="fade">
                    <!--OVERLAY-->
                    <div class="gradient-bg1 bg-overlay"></div>

                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption   tp-resizeme"
                        data-frames='[{"delay":220,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;rZ:339;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['-26','-26','83','83']"
                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['98','98','60','60']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['left','left','left','left']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        id="slide-43-layer-5"

                        style="z-index: 7;">
                        <div class="rs-looped rs-slideloop" data-easing="" data-speed="5" data-xe="0" data-xs="0"
                            data-ye="15" data-ys="-15"><img alt="" data-hh="['87px','87px','87px','87px']"
                                data-no-retina
                                data-ww="['44px','44px','44px','44px']" src="{{ asset('assets/front/agency/img/shape-6.png') }}">
                        </div>
                    </div>

                    <!-- LAYER NR. 4 -->
                    <div class="tp-caption   tp-resizeme"
                        data-basealign="slide"
                        data-frames='[{"delay":210,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;rZ:358;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-height="none"
                        data-hoffset="['700','700','700','530']" data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"

                        data-responsive_offset="on"
                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['148','148','148','148']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-6"

                        style="z-index: 8;">
                        <div class="rs-looped rs-slideloop" data-easing="Power0.easeIn" data-speed="5" data-xe="0"
                            data-xs="0" data-ye="20" data-ys="0"><img alt="" data-hh="['87px','87px','87px','87px']"
                                data-no-retina
                                data-ww="['24px','24px','24px','24px']"
                                src="{{ asset('assets/front/agency/img/shape-5.png') }}"></div>
                    </div>

                    <!-- LAYER NR. 5 -->
                    <div class="tp-caption   tp-resizeme"
                        data-fontsize="['20','20','20','20']"
                        data-frames='[{"delay":220,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-height="none"
                        data-hoffset="['275','275','171','120']" data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['270','270','261','190']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-7"

                        style="z-index: 9;">
                        <div class="rs-looped rs-wave" data-angle="0" data-origin="50% 50%" data-radius="15px"
                            data-speed="12"><img alt="" data-hh="['67px','67px','67px','67px']"
                                data-no-retina
                                data-ww="['68px','68px','68px','68px']" src="{{ asset('assets/front/agency/img/shape-4.png') }}"></div>
                    </div>

                    <!-- LAYER NR. 6 -->
                    <div class="tp-caption   tp-resizeme"
                        data-frames='[{"delay":190,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['413','413','268','204']"
                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['-205','-205','-259','-145']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-8"

                        style="z-index: 10;">
                        <div class="rs-looped rs-rotate" data-easing="Power0.easeIn" data-enddeg="360" data-origin="50% 50%"
                            data-speed="15" data-startdeg="0"><img alt="" data-hh="['69px','69px','69px','69px']"
                                data-no-retina
                                data-ww="['67px','67px','67px','67px']"
                                src="{{ asset('assets/front/agency/img/shape-3.png') }}"></div>
                    </div>

                    <!-- LAYER NR. 7 -->
                    <div class="tp-caption   tp-resizeme"
                        data-frames='[{"delay":190,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['436','436','259','145']"
                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['204','204','96','73']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['left','left','left','left']"
                        data-y="['top','top','top','top']"
                        id="slide-43-layer-9"

                        style="z-index: 11;">
                        <div class="rs-looped rs-pendulum" data-easing="" data-enddeg="20" data-origin="50% 50%"
                            data-speed="12" data-startdeg="-20"><img alt="" data-hh="['52px','52px','52px','52px']"
                                data-no-retina
                                data-ww="['51px','51px','51px','51px']"
                                src="{{ asset('assets/front/agency/img/shape-1.png') }}"></div>
                    </div>

                    <!-- LAYER NR. 8 -->
                    <div class="tp-caption   tp-resizeme"
                        data-basealign="slide"
                        data-frames='[{"delay":170,"speed":500,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-height="none"
                        data-hoffset="['39','39','94','58']" data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"

                        data-responsive_offset="on"
                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="image"

                        data-voffset="['109','109','64','69']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['right','right','right','right']"
                        data-y="['top','top','top','top']"
                        id="slide-43-layer-10"

                        style="z-index: 12;">
                        <div class="rs-looped rs-slideloop" data-easing="" data-speed="2" data-xe="15" data-xs="0"
                            data-ye="0" data-ys="0"><img alt="" data-hh="['14px','14px','14px','14px']"
                                data-no-retina
                                data-ww="['50px','50px','50px','50px']" src="{{ asset('assets/front/agency/img/shape-2.png') }}"></div>
                    </div>

                    <!-- LAYER NR. 9 -->
                    <div class="tp-caption tp-resizeme gradient-text1"
                        data-fontsize="['70','65','60','50']"
                        data-frames='[{"delay":660,"speed":1500,"frame":"0","from":"y:[100%];z:0;rX:0deg;rY:0;rZ:0;sX:1;sY:1;skX:0;skY:0;opacity:0;","mask":"x:0px;y:[100%];s:inherit;e:inherit;","to":"o:1;","ease":"Power2.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-height="none"
                        data-hoffset="['320','250','0','0']" data-lineheight="['80','75','70','60']"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['left','left','center','center']"
                        data-type="text"

                        data-voffset="['-125','-125','-125','-110']"
                        data-whitespace="nowrap"
                        data-width="['650','650','600','500']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-13"

                        style="z-index: 13; min-width: 650px; max-width: 650px; white-space: nowrap; font-size: 70px; line-height: 80px; font-weight: 800; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">
                        Qnex
                    </div>

                    <!-- LAYER NR. 10 -->
                    <div class="tp-caption   tp-resizeme"
                        data-fontsize="['70','65','60','50']"
                        data-frames='[{"delay":1840,"split":"chars","splitdelay":0.1,"speed":1000,"split_direction":"forward","frame":"0","from":"sX:0.8;sY:0.8;opacity:0;","to":"o:1;","ease":"Power4.easeOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"nothing"}]' data-height="none"
                        data-hoffset="['320','250','0','0']" data-lineheight="['70','75','70','60']"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['left','left','center','center']"
                        data-type="text"

                        data-voffset="['-40','-40','-40','-40']"
                        data-whitespace="nowrap"
                        data-width="['650','650','600','500']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-11"

                        style="z-index: 14; min-width: 650px; max-width: 650px; white-space: nowrap; font-size: 70px; line-height: 70px; font-weight: 700; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">
                        is a Wholesaler
                    </div>

                    <!-- LAYER NR. 11 -->
                    <div class="tp-caption   tp-resizeme"
                        data-fontsize="['20','20','18','17']"
                        data-frames='[{"delay":2360,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]' data-height="none"
                        data-hoffset="['325','210','0','0']" data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"

                        data-textAlign="['left','left','center','center']"
                        data-type="text"

                        data-voffset="['80','75','65','57']"
                        data-whitespace="normal"
                        data-width="['651','550','600','500']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-14"

                        style="z-index: 15; min-width: 651px; max-width: 651px; white-space: normal; font-size: 20px; line-height: 30px; font-weight: 300; color: #ffffff; letter-spacing: 0px;font-family:Roboto;">
                        We supply reliable and affordable products for PCB Repairing Labs and Spare Part Shops across India.
                        Our focus is to provide quality parts, fast availability and smooth repair solutions — making your work easier and business stronger.
                    </div>

                    <!-- LAYER NR. 12 -->
                    <div class="tp-caption   tp-resizeme"
                        data-frames='[{"delay":2970,"speed":1500,"frame":"0","from":"y:50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['325','260','0','0']"
                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-textAlign="['left','left','center','center']"
                        data-type="text"
                        data-voffset="['200','186','176','156']"
                        data-whitespace="nowrap"
                        data-width="['650','650','600','500']"
                        data-x="['center','center','center','center']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-15"

                        style="z-index: 16; white-space: nowrap;">
                        <a class="btn btn-slider btn-rounded btn-blue btn-hvr-white" href="javascript:void(0);">Trusted Since 2012
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

                    <!-- LAYER NR. 13 -->
                    <div class="tp-caption   tp-resizeme"
                        data-frames='[{"delay":990,"speed":1500,"frame":"0","from":"x:-50px;opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['0','0','-412','-412']"
                        data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"
                        data-responsive_offset="on"
                        data-textAlign="['inherit','inherit','inherit','inherit']"

                        data-type="image"
                        data-visibility="['on','on','off','off']"

                        data-voffset="['-1','-1','72','72']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['left','left','left','left']"
                        data-y="['middle','middle','middle','middle']"
                        id="slide-43-layer-16"

                        style="z-index: 17;">
                        <div class="rs-looped rs-slideloop" data-easing="" data-speed="5" data-xe="15" data-xs="-10"
                            data-ye="0" data-ys="0"><img alt="" data-hh="['604px','510','510','510']"
                                data-no-retina
                                data-ww="['434px','350','350','350']" src="{{ asset('assets/front/agency/img/vector-art-1.webp') }}"></div>
                    </div>

                    <!-- LAYER NR. 14 -->
                    <div class="tp-caption tp-resizeme hide-cursor"
                        data-actions='[{"event":"click","action":"scrollbelow","offset":"-50px","delay":"","speed":"1200","ease":"Power3.easeInOut"}]'
                        data-fontsize="['20','20','20','17']" data-frames='[{"delay":10,"speed":300,"frame":"0","from":"opacity:0;","to":"o:1;","ease":"Power3.easeInOut"},{"delay":"wait","speed":300,"frame":"999","to":"opacity:0;","ease":"Power3.easeInOut"}]'
                        data-height="none" data-hoffset="['0','0','0','0']"
                        data-paddingbottom="[0,0,0,0]"
                        data-paddingleft="[0,0,0,0]"
                        data-paddingright="[0,0,0,0]"
                        data-paddingtop="[0,0,0,0]"

                        data-responsive_offset="on"
                        data-textAlign="['inherit','inherit','inherit','inherit']"
                        data-type="text"

                        data-voffset="['25','25','5','5']"
                        data-whitespace="nowrap"
                        data-width="none"
                        data-x="['center','center','center','center']"
                        data-y="['bottom','bottom','bottom','bottom']"
                        id="slide-43-layer-17"

                        style="z-index: 18; white-space: nowrap; cursor: pointer; font-size: 20px; line-height: 30px; font-weight: 400; color: #ffffff; letter-spacing: 0px;font-family:Montserrat;">
                        Scroll Down <i class="ml-2 fas fa-long-arrow-alt-down"></i></div>
                </li>
            </ul>
            <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
        </div>
    </div><!-- END REVOLUTION SLIDER -->
</section>
<!--Slider End-->

<!--About Us-->
<section class="pb-0" id="about-us">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInLeft">
                <div class="heading-area">
                    <span class="sub-title">Welcome to {{ config('const.site_setting.name') }}</span>
                    <h2 class="title">Empowering Excellence in Every AC <span class="alt-color js-rotating">Solution, Manufacturer</span></h2>

                    <p class="para">
                    <h2>Mission</h2>
                    To serve our customers with the best products, quick support,
                    honest guidance, and technical expertise, ensuring timely delivery,
                    fair prices, and care in every interaction, while continuously Innovating
                    to meet their needs.

                    <h2 class="mt-3">Vision</h2>
                    To become a trusted name loved by our customers and
                    partners for quality, reliability, technical expertise, and innovation,|
                    creating long-lasting relationships built on trust and care.</p>
                    <!-- <a class="btn btn-large btn-rounded btn-pink btn-hvr-blue mt-3" href="javascript:void(0);">Learn
                        More
                        <div class="btn-hvr-setting">
                            <ul class="btn-hvr-setting-inner">
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                                <li class="btn-hvr-effect"></li>
                            </ul>
                        </div>
                    </a> -->
                </div>
            </div>
            <div class="col-lg-6 wow fadeInRight">
                <div class="half-img mt-5 pt-4 mt-lg-0 pt-lg-0">
                    <div style="position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden;">
                        <iframe
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%;"
                            src="https://www.youtube.com/embed/7_44YAz5HXs"
                            title="YouTube video player"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--About Us End-->

<!--Services Start-->
<section id="services">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg col-md-4 col-sm-6 mb-4 mb-lg-0">
                <div class="process-wrapp">
                    <span class="pro-step blue"><i aria-hidden="true" class="fas fa-headset"></i></span>
                    <h4 class="service-heading">Technical Support</h4>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4 mb-lg-0">
                <div class="process-wrapp">
                    <span class="pro-step midnight"><i aria-hidden="true" class="fas fa-truck-fast"></i></span>
                    <h4 class="service-heading">Same Day Dispatch</h4>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4 mb-lg-0">
                <div class="process-wrapp">
                    <span class="pro-step purple"><i aria-hidden="true" class="fas fa-flask"></i></span>
                    <h4 class="service-heading">Lab Tested Products</h4>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4 mb-lg-0">
                <div class="process-wrapp">
                    <span class="pro-step pink"><i aria-hidden="true" class="fas fa-tags"></i></span>
                    <h4 class="service-heading">Affordable Price</h4>
                </div>
            </div>
            <div class="col-lg col-md-4 col-sm-6 mb-4 mb-lg-0">
                <div class="process-wrapp">
                    <span class="pro-step blue"><i aria-hidden="true" class="fas fa-shipping-fast"></i></span>
                    <h4 class="service-heading">Fast Safe Delivery</h4>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Services End-->

<!--Counters Start-->
<section class="gradient-bg2" id="counters">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 pl-lg-4 order-lg-2 wow fadeInRight">
                <div class="heading-area">
                    <span class="sub-title text-white">Growing Every Day. Expanding Every City.</span>
                    <h2 class="title text-white">Our Strong Network Across <span class="js-rotating">India, World</span>.
                    </h2>
                    <p class="para text-white">Qnex is trusted by businesses all over India. Our wide distribution network helps Technicians get quality AC electronic spare parts on time, every time.</p>
                </div>
                <ul class="counter-list list-unstyled">
                    <li class="counter-item">
                        <i aria-hidden="true" class="fas fa-store text-white"></i>
                        <h6 class="counter-number text-white"><span class="count">7153</span>+</h6>
                        <p class="sub-title text-white">Spare Part Shops served</p>
                    </li>
                    <li class="counter-item">
                        <i aria-hidden="true" class="fas fa-microchip text-white"></i>
                        <h6 class="counter-number text-white"><span class="count">927</span>+</h6>
                        <p class="sub-title text-white">PCB Repair Shops connected</p>
                    </li>
                    <li class="counter-item">
                        <i aria-hidden="true" class="fas fa-map-marked-alt text-white"></i>
                        <h6 class="counter-number text-white"><span class="count">384</span>+</h6>
                        <p class="sub-title text-white">Dealers across major cities</p>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6 wow fadeInLeft">
                <div class="half-img mt-5 pt-4 mt-lg-0 pt-lg-0">
                    <img alt="vector" src="{{ asset('assets/front/agency/img/vector-art-3.webp') }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!--Counters End-->

<!--Team Start-->
<section class="text-center" id="team">
    <div class="container">
        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="heading-area mx-570 mb-5">
                    <span class="sub-title">Welcome to {{ config('const.site_setting.name') }}</span>
                    <h2 class="title">India’s Most Reliable Support <span class="alt-color js-rotating">Teams, Family</span> for AC Spare Parts</h2>
                    <p class="para">Our experienced Team members handle Sales, Technical Support, Manufacturing, R&D, and Logistics — so you get fast service, every time.</p>
                </div>
            </div>
        </div>
        <!--Row-->
        <div class="row wow fadeInUp">
            @foreach($staffs as $staff)
            <div class="col-md-4">
                <div class="team-item">
                    <!--Team Image-->
                    <img alt="{{ $staff->name }}" class="team-image" src="{{ getImage($staff->image) }}">
                    <!--Name-->
                    <div class="name">
                        <img alt="shape" src="{{ asset('assets/front/agency/img/shape-'.rand(9,11).'.png') }}">
                        <h6>{{ $staff->name }}</h6>
                    </div>
                    <!--Designation-->
                    <p class="designation mb-2">{{ $staff->position }}</p>
                    <!--Team Social-->
                    <div class="team-social social-icon-bg-hvr">
                        @if($staff->facebook_url)
                        <a href="{{ $staff->facebook_url }}" target="_blank"><i aria-hidden="true" class="fab fa-facebook-f"></i></a>
                        @endif
                        @if($staff->linkedin_url)
                        <a href="{{ $staff->linkedin_url }}" target="_blank"><i aria-hidden="true" class="fab fa-linkedin-in"></i></a>
                        @endif
                        @if($staff->x_url)
                        <a href="{{ $staff->x_url }}" target="_blank"><i aria-hidden="true" class="fab fa-x-twitter"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--Team End-->

<!--Parallax Start-->
<section class="bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 wow fadeInLeft">
                <div class="heading-area">
                    <span class="sub-title">Welcome to {{ config('const.site_setting.name') }}</span>
                    <h2 class="title"><span class="main-color js-rotating">Innovation, Revolution</span> That Elevates the Quality of Every AC Spare Part</h2>
                    <p class="para">Our R&D team combines advanced testing, smart diagnostics, and modern engineering to refine PCBs, motors, sensors, and every critical AC component. We innovate with one goal in mind—delivering parts that perform better, last longer, and create real value for our customers.</p>
                    <a class="btn btn-large btn-rounded btn-blue btn-hvr-pink mt-3" href="https://forms.gle/155b1skMaEuhCELD6">Your Input
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
            <div class="col-lg-6 wow fadeInRight">
                <div class="half-img mt-5 pt-4 mt-lg-0 pt-lg-0">
                    <img alt="image" src="{{ asset('assets/front/agency/img/vector-art-4.webp') }}">
                </div>
            </div>
        </div>
    </div>
</section>
<!--Parallax End-->

<!--Portfolio Start-->
<section class="cube-portfolio1 text-center no-transition" id="portfolio">
    <div class="container">
        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="heading-area mx-570 mb-lg-4 mb-3">
                    <span class="sub-title">Welcome to {{ config('const.site_setting.name') }}</span>
                    <h2 class="title">Qnex choose karo, business grow karo</h2>
                    <p class="para">Low-quality spare parts cause breakdowns, customer complaints, and loss of trust for PCB repairing shop and spare part shops. Qnex solves this with lab-tested, ISO 9001:2015 certified AC electronic spare parts made from the best raw materials.</p>
                </div>
            </div>
        </div>
        <!--Row-->
        <div class="row wow fadeIn">
            <div class="col-md-12">

                <!--Portfolio Filters-->
                <div class="cbp-l-filters-button" id="js-filters-mosaic-flat">

                    <div class="cbp-filter-item-active cbp-filter-item" data-filter="*">All</div>
                    <span class="text-blue">/</span>
                    <div class="cbp-filter-item" data-filter=".graphic">Graphic Design</div>
                    <span class="text-blue"> / </span>
                    <div class="cbp-filter-item" data-filter=".web-design">Web design</div>
                    <span class="text-blue"> / </span>
                    <div class="cbp-filter-item" data-filter=".graphic">SEO</div>
                    <span class="text-blue"> / </span>
                    <div class="cbp-filter-item" data-filter=".marketing">Marketing</div>
                </div>

                <!--Portfolio Items-->
                <div class="cbp cbp-l-grid-mosaic-flat" id="js-grid-mosaic-flat">

                    <div class="cbp-item web-design graphic">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-1.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-1" src="{{ asset('assets/front/agency/img/work-1.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>

                        </a>
                    </div>
                    <div class="cbp-item seo marketing">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-2.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-2" src="{{ asset('assets/front/agency/img/work-2.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item seo marketing">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-3.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-4" src="{{ asset('assets/front/agency/img/work-3.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item graphic seo marketing">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-4.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-3" src="{{ asset('assets/front/agency/img/work-4.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item web-design graphic">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-5.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-5" src="{{ asset('assets/front/agency/img/work-5.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item seo marketing graphic ">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-6.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-6" src="{{ asset('assets/front/agency/img/work-6.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item web-design seo">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-7.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-7" src="{{ asset('assets/front/agency/img/work-7.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="cbp-item web-design graphic">
                        <a class="cbp-caption cbp-lightbox" href="agency/img/work-8.jpg">
                            <div class="cbp-caption-defaultWrap">
                                <img alt="port-8" src="{{ asset('assets/front/agency/img/work-8.jpg') }}">
                            </div>
                            <div class="cbp-caption-activeWrap"></div>
                            <div class="cbp-l-caption-alignCenter center-block">
                                <div class="cbp-l-caption-body">
                                    <div class="plus"></div>
                                    <h5 class="text-white mb-1">Latest Work</h5>
                                    <p class="text-white">See Our Amazing Work</p>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>
<!--Portfolio End-->

<!--Testimonial Start-->
<section class="gradient-bg1 text-center" id="clients">
    <div class="container">

        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="heading-area mx-570 mb-5">
                    <h2 class="title text-white m-0">Some <span class="js-rotating">great, ideal</span> words from
                        our clients</h2>
                </div>
            </div>
        </div>

        <!--Row-->
        <div class="row">
            <div class="col-md-12">
                <div class="owl-carousel wow zoomIn" id="testimonial-slider">
                    @foreach($testimonials as $testimonial)
                    <div class="item">
                        <p class="para">{{ $testimonial->review }}</p>
                        <h5 class="name gradient-text1">{{ $testimonial->name }}</h5>
                        <span class="designation">{{ $testimonial->designation }}</span>
                        <ul class="ratings list-unstyled">
                            @for($i = 1; $i <= 5; $i++)
                                @if($i <=$testimonial->rating)
                                <li><i aria-hidden="true" class="fas fa-star"></i></li>
                                @else
                                <li><i aria-hidden="true" class="far fa-star"></i></li>
                                @endif
                                @endfor
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!--Testimonial Thumbs-->
        <div class="owl-dots" id="testimonials-avatar">
            <!--data-position[top,right,bottom,left]-->
            @php
            $positions = [
            '22%,auto,auto,5%',
            '30%,auto,auto,16%',
            'auto,auto,38%,7%',
            'auto,auto,23%,18%',
            '20%,19%,auto,auto',
            '28%,6%,auto,auto',
            '40%,15%,auto,auto',
            'auto,21%,22%,auto'
            ];
            @endphp
            @foreach($testimonials as $key => $testimonial)
            @if(isset($positions[$key]))
            <button class="owl-dot active" data-position="{{ $positions[$key] }}">
                <img alt="{{ $testimonial->name }}" src="{{ getImage($testimonial->image) }}"></button>
            @endif
            @endforeach
        </div>
    </div>
</section>
<!--Testimonial End-->

<!--Blog Start-->
<section class="bg-light" id="blog">
    <div class="container">
        <!--Row-->
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="heading-area mx-570 pb-lg-5 mb-5">
                    <span class="sub-title">Welcome to {{ config('const.site_setting.name') }}</span>
                    <h2 class="title mb-0">Our <span class="alt-color js-rotating">latest blogs,recent news</span> will
                        keep
                        everyone updated</h2>
                </div>
            </div>
        </div>
        <!--Row-->
        <div class="row wow fadeInUp">
            <!--News Item-->
            @foreach ($latestBlogs as $blog)
            <div class="col-lg-4">
                <div class="news-item">
                    <img alt="image" class="news-img" src="{{ getImage($blog->image) }}" alt="{{ $blog->title }}">
                    <div class="news-text-box">
                        <span class="date main-color">{{ $blog->published_at->format('M d, Y') }}</span>
                        <a href="{{ route('blog.show', $blog->slug) }}">
                            <h4 class="news-title">{{ $blog->title }}</h4>
                        </a>
                        <p class="para">{{ Str::limit($blog->short_description, 100) }}</p>

                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>
</section>
<!--Blog End-->

<!--Client Map-->
<section class="gradient-bg2" id="client">
    <h2 class="d-none">hidden</h2>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="title mb-5 text-white">Trusted By Prominent Brands</h2>
                <!--Client Slider-->
                <div class="owl-carousel partners-slider">
                    @foreach($clients as $client)
                    <!--Item-->
                    <div class="logo-item"><img alt="{{ $client->name }}" src="{{ getImage($client->image) }}"></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!--Client End-->

<!--Map Start-->
<div class="p-0 gradient-bg2 map-area">
    <div class="container">
        <!--Map Initialize-->
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.512046631849!2d72.8641712!3d21.211534500000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04f0d77f6ffff%3A0x6a0ca367a5d1d697!2sQnex!5e0!3m2!1sen!2sin!4v1765187653444!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</div>
<!--Map End-->

<!--Contact Start-->
<section class="contact-us" id="contact">

    <div class="container">

        <div class="row align-items-top">

            <div class="col-lg-5 order-lg-2 wow fadeInRight">
                <div class="contact-detail">
                    <div class="contact-dots" data-dots=""></div>
                    <!--Heading-->
                    <div class="heading-area pb-5">
                        <h2 class="title mt-0 pb-1">Our Location</h2>
                        <p class="para">There are many variations of passages of Lorem Ipsum available, but the majority
                            have suffered .</p>
                    </div>

                    <!--Address-->
                    <ul class="address list-unstyled">
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                    class="fas fa-map-marker-alt"></i></span>
                            <span class="address-text">{{ config('const.contactUs.address') }}</span>
                        </li>
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                    class="fas fa-phone-volume"></i></span>
                            <span class="address-text">
                                @foreach (config('const.contactUs.contact') as $contact)
                                <a class="mr-3" href="tel:+91{{ $contact }}">+91 {{ $contact }}</a>
                                @endforeach
                            </span>
                        </li>
                        <li>
                            <span class="address-icon gradient-text2"><i aria-hidden="true"
                                    class="fas fa-paper-plane"></i></span>
                            <span class="address-text">
                                <a class="mr-3 alt-color" href="mailto:{{ config('const.contactUs.email') }}">{{ config('const.contactUs.email') }}</a>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-7 mt-4 pt-3 mt-lg-0 pt-lg-0 wow fadeInLeft">
                <!--Heading-->
                <div class="heading-area pb-2">
                    <h2 class="title mt-0">Get In Touch</h2>
                </div>
                <!--Contact Form-->
                <form class="contact-form" id="contact-form-data">
                    <div class="row">
                        <!--Left Column-->
                        <div class="col-md-5">
                            <div class="form-group">
                                <input class="form-control mb-0 required" id="your_name" name="userName" placeholder="Name" required=""
                                    type="text">
                            </div>
                            <div class="form-group">
                                <input class="form-control mb-0 required" id="your_email" name="userEmail" placeholder="Email" required=""
                                    type="email">
                            </div>
                            <div class="form-group">
                                <input class="form-control mb-0 required" id="subject" name="userSubject" placeholder="Subject" required=""
                                    type="text">
                            </div>
                        </div>

                        <!--Right Column-->
                        <div class="col-md-7">
                            <div class="form-group">
                                <textarea class="form-control required" id="message" name="userMessage"
                                    placeholder="Message"></textarea>
                            </div>
                        </div>

                        <!--Button-->
                        <div class="col-md-12">
                            <a class="btn btn-large btn-rounded btn-purple btn-hvr-blue d-block mt-4 contact_btn" href="javascript:void(0);"
                                id="submit_btn"><i class="fa fa-spinner fa-spin mr-2 d-none" aria-hidden="true"></i><b>Send Message</b>
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
            </div>

        </div>

    </div>

</section>
<!--Contact End-->

@push('js')
<script>
    $(document).ready(function() {
        // Remove error on input change (mimicking ajax.js)
        $("#contact-form-data input, #contact-form-data textarea").on('change keyup', function() {
            $(this).removeClass("is-invalid");
            $(this).siblings(".errors").remove();
        });

        $('#submit_btn').on('click', function(e) {
            e.preventDefault();

            // Remove existing errors
            $(".form-control").removeClass("is-invalid");
            $(".errors").remove();

            var form = $('#contact-form-data');
            var nameInput = $('#your_name');
            var emailInput = $('#your_email');
            var subjectInput = $('#subject');
            var messageInput = $('#message');

            var isValid = true;

            // Validate Name
            if (!nameInput.val().trim()) {
                isValid = false;
                nameInput.addClass('is-invalid');
                nameInput.after('<div class="text-danger errors">The Name field is required.</div>');
            }

            // Validate Email
            var emailValue = emailInput.val().trim();
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailValue) {
                isValid = false;
                emailInput.addClass('is-invalid');
                emailInput.after('<div class="text-danger errors">The Email field is required.</div>');
            } else if (!emailPattern.test(emailValue)) {
                isValid = false;
                emailInput.addClass('is-invalid');
                emailInput.after('<div class="text-danger errors">Please enter a valid email address.</div>');
            }

            // Validate Subject
            if (!subjectInput.val().trim()) {
                isValid = false;
                subjectInput.addClass('is-invalid');
                subjectInput.after('<div class="text-danger errors">The Subject field is required.</div>');
            }

            // Validate Message
            if (!messageInput.val().trim()) {
                isValid = false;
                messageInput.addClass('is-invalid');
                messageInput.after('<div class="text-danger errors">The Message field is required.</div>');
            }

            if (isValid) {
                // WhatsApp Number from Config
                var phoneNumber = "91{{ config('const.contactUs.whatsapp') }}";

                // Add Title to Message
                var title = "*New Inquiry from Website*";

                var text = title + "%0a%0a" +
                    "*Name:* " + nameInput.val().trim() + "%0a" +
                    "*Email:* " + emailValue + "%0a" +
                    "*Subject:* " + subjectInput.val().trim() + "%0a" +
                    "*Message:* " + messageInput.val().trim();

                var whatsappUrl = "https://wa.me/" + phoneNumber + "?text=" + text;

                window.open(whatsappUrl, '_blank');

                // Optional: Clear form after sending
                form[0].reset();
            }
        });
    });
</script>
@endpush

@endsection