<div class="col-xs-12 col-sm-12 col-md-3 sidebar"> 
    <!--  TOP NAVIGATION  -->
    @include('frontend.frontend_layout.body.side-menu')
    <!--  TOP NAVIGATION : END  --> 


@if (request()->routeIs('home'))
    <!--  HOT DEALS  -->    
    @include('frontend.frontend_layout.widgets.hot-deals-widget')
    <!--  HOT DEALS: END  --> 
    <!--  SPECIAL OFFER  -->
    @include('frontend.frontend_layout.widgets.special-offer-widget')
    <!--  SPECIAL OFFER : END  --> 
    <!--  PRODUCT TAGS  -->
    @include('frontend.frontend_layout.widgets.product-tags-widget')
    <!--  PRODUCT TAGS : END  -->   
    <!--  SPECIAL DEALS  -->
    @include('frontend.frontend_layout.widgets.special-deals-widget')
    <!--  SPECIAL DEALS : END  --> 
    <!--  NEWSLETTER  -->
    @include('frontend.frontend_layout.widgets.newsletter-widget')
    <!--  NEWSLETTER: END  --> 
    <!--  Testimonials -->
    @include('frontend.frontend_layout.widgets.testimonial-widget')
    <!--  Testimonials: END  -->
    <div class="home-banner"> <img src="{{ asset('frontend') }}/assets/images/banners/LHS-banner.jpg" alt="Image">
    </div>
@elseif (request()->routeIs('category'))
    <!--  SHOP BY START  -->
    @include('frontend.frontend_layout.category_page.shop-by-widget')
    <!--  SHOP BY END  -->
@endif
<!-- /.sidebar-widget --> 
</div>
<!-- /.sidemenu-holder --> 