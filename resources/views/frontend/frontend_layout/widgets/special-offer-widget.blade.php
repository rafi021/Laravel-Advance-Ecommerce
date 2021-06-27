<div class="sidebar-widget outer-bottom-small wow fadeInUp">
    <h3 class="section-title">
        @if (session()->get('language') == 'bangla')
        বিশেষ প্রস্তাব
        @else
        Special Offer
        @endif
    </h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="owl-carousel sidebar-carousel special-offer custom-carousel owl-theme outer-top-xs">
            <div class="item">
                <div class="products special-product">
                    @php
                    $special_offer_products = App\Models\Product::where('special_offer', 1)->latest()->limit(3)->get();
                    @endphp
                    @foreach ($special_offer_products as $product)
                    <div class="product">
                        <div class="product-micro">
                            <div class="row product-micro-row">
                                <div class="col col-xs-5">
                                    <div class="product-image">
                                        <div class="image"> <a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}"> <img src="{{ asset($product->product_thumbnail) }}" alt=""> </a> </div>
                                        <!-- /.image -->

                                    </div>
                                    <!-- /.product-image -->
                                </div>
                                <!-- /.col -->
                                <div class="col col-xs-7">
                                    <div class="product-info">
                                        <h3 class="name"><a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                            @if (session()->get('language') == 'bangla')
                                            {{ $product->product_name_bn }}
                                            @else
                                            {{ $product->product_name_en }}
                                            @endif
                                        </a></h3>
                                        <div class="rating rateit-small"></div>
                                        <div class="product-price">
                                            @if ($product->discount_price == NULL)
                                            <span class="price"> ${{ $product->selling_price }} </span>
                                            @else
                                            <span class="price"> ${{ $product->discount_price }} </span>
                                            <span class="price"> ${{ $product->selling_price }} </span>
                                            @endif
                                        </div>
                                        <!-- /.product-price -->

                                    </div>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.product-micro-row -->
                        </div>
                        <!-- /.product-micro -->
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- /.sidebar-widget-body -->
</div>
