@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row"> 
            <!--  SIDEBAR  -->
                @include('frontend.frontend_layout.body.sidebar')
            <!--  SIDEBAR : END  --> 
            <!--  CONTENT  -->
            <div class="col-xs-12 col-sm-12 col-md-9 homebanner-holder"> 
                <!-- SECTION – HERO  -->
                @include('frontend.frontend_layout.home_page.hero-section')
                <!--  SECTION – HERO : END  --> 
                
                <!--  INFO BOXES  -->
                @include('frontend.frontend_layout.home_page.info-boxes')
                <!--  INFO BOXES : END  --> 
                <!--  SCROLL TABS  -->
                @include('frontend.frontend_layout.home_page.new-products')
                <!-- /.scroll-tabs --> 
                <!--  SCROLL TABS : END  --> 
                <!--  WIDE PRODUCTS  -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                <div class="row">
                    <div class="col-md-7 col-sm-7">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner1.jpg" alt=""> </div>
                        </div>
                    <!-- /.wide-banner --> 
                    </div>
                    <!-- /.col -->
                    <div class="col-md-5 col-sm-5">
                        <div class="wide-banner cnt-strip">
                            <div class="image"> <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner2.jpg" alt=""> </div>
                        </div>
                    <!-- /.wide-banner --> 
                    </div>
                    <!-- /.col --> 
                    </div>
                <!-- /.row --> 
                </div>
                <!-- /.wide-banners --> 
                
                <!--  WIDE PRODUCTS : END  --> 
                <!--  FEATURED PRODUCTS  -->
                @include('frontend.frontend_layout.home_page.featured-products')
                <!-- /.section --> 
                <!--  FEATURED PRODUCTS : END  --> 
                <!--  WIDE PRODUCTS  -->
                <div class="wide-banners wow fadeInUp outer-bottom-xs">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="wide-banner cnt-strip">
                                <div class="image"> <img class="img-responsive" src="{{ asset('frontend') }}/assets/images/banners/home-banner.jpg" alt="">
                                </div>
                            <div class="strip strip-text">
                                <div class="strip-inner">
                                    <h2 class="text-right">New Mens Fashion<br>
                                    <span class="shopping-needs">Save up to 40% off</span></h2>
                                </div>
                            </div>
                            <div class="new-label">
                                <div class="text">NEW</div>
                            </div>
                        <!-- /.new-label --> 
                            </div>
                        <!-- /.wide-banner --> 
                        </div>
                        <!-- /.col --> 
                    </div>
                    <!-- /.row --> 
                </div>
                <!-- /.wide-banners --> 
                <!--  WIDE PRODUCTS : END  --> 
                <!--  BEST SELLER  -->
                @include('frontend.frontend_layout.home_page.best-seller')
                <!-- /.sidebar-widget --> 
                <!--  BEST SELLER : END  --> 
                
                <!--  BLOG SLIDER  -->
                @include('frontend.frontend_layout.home_page.blog-slider')
                <!--  BLOG SLIDER : END  --> 
                
                <!--  FEATURED PRODUCTS  -->
                @include('frontend.frontend_layout.home_page.new-arrivals')
                <!--  FEATURED PRODUCTS : END  --> 
                
            </div>
            <!-- /.homebanner-holder --> 
            <!--  CONTENT : END  -->
        </div>
        <!-- /.row --> 
        <!--  BRANDS CAROUSEL  -->
        @include('frontend.frontend_layout.home_page.brands-carousel')
        <!-- /.logo-slider --> 
        <!--  BRANDS CAROUSEL : END  -->
    </div>
    <!-- /.container --> 
</div>
<!-- /#top-banner-and-menu --> 
@endsection