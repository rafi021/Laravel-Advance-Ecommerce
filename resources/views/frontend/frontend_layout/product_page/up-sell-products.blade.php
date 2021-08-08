<section class="section featured-product wow fadeInUp animated" style="visibility: visible; animation-name: fadeInUp;">
    <h3 class="section-title">Related products</h3>
    <div class="owl-carousel home-owl-carousel upsell-product custom-carousel owl-theme outer-top-xs"
        style="opacity: 1; display: block;">

        <div class="owl-wrapper-outer">
            <div class="owl-wrapper" style="width: 2484px; left: 0px; display: block;">
                @foreach ($related_products as $product)
                <div class="owl-item" style="width: 207px;">
                    <div class="item item-carousel">
                        <div class="products">
                            <div class="product">
                                <div class="product-image">
                                    <div class="image">
                                        <a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}"><img src="{{ asset($product->product_thumbnail) }}" alt="">
                                        </a>
                                    </div><!-- /.image -->

                                    <div class="tag sale"><span>sale</span></div>
                                </div><!-- /.product-image -->
                                <div class="product-info text-left">
                                    <h3 class="name"><a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->product_name_bn }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a></h3>
                                    <div class="rating rateit-small rateit"><button id="rateit-reset-6" data-role="none"
                                            class="rateit-reset" aria-label="reset rating"
                                            aria-controls="rateit-range-6" style="display: none;"></button>
                                        <div id="rateit-range-6" class="rateit-range" tabindex="0" role="slider"
                                            aria-label="rating" aria-owns="rateit-reset-6" aria-valuemin="0"
                                            aria-valuemax="5" aria-valuenow="4" aria-readonly="true"
                                            style="width: 70px; height: 14px;">
                                            <div class="rateit-selected" style="height: 14px; width: 56px;"></div>
                                            <div class="rateit-hover" style="height:14px"></div>
                                        </div>
                                    </div>
                                    <div class="description"></div>

                                    <div class="product-price">
                                        @if ($product->discount_price == NULL)
                                        <span class="price">${{ $product->selling_price }}</span>
                                        @else
                                        <span class="price">${{ $product->discount_price }}</span>
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                        @endif
                                    </div><!-- /.product-price -->

                                </div><!-- /.product-info -->
                                <div class="cart clearfix animate-effect">
                                    <div class="action">
                                        <ul class="list-unstyled">
                                            <li class="add-cart-button btn-group">
                                                <button class="btn btn-primary icon" data-toggle="dropdown"
                                                    type="button">
                                                    <i class="fa fa-shopping-cart"></i>
                                                </button>
                                                <button class="btn btn-primary cart-btn" type="button">Add to
                                                    cart</button>
                                            </li>
                                            <li class="lnk wishlist">
                                                <a class="add-to-cart" href="detail.html" title="Wishlist">
                                                    <i class="icon fa fa-heart"></i>
                                                </a>
                                            </li>
                                            <li class="lnk">
                                                <a class="add-to-cart" href="detail.html" title="Compare">
                                                    <i class="fa fa-signal"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div><!-- /.action -->
                                </div><!-- /.cart -->
                            </div><!-- /.product -->

                        </div><!-- /.products -->
                    </div>
                </div>
                @endforeach
            </div>
        </div><!-- /.item -->

        <div class="owl-controls clickable">
            <div class="owl-buttons">
                <div class="owl-prev"></div>
                <div class="owl-next"></div>
            </div>
        </div>
    </div><!-- /.home-owl-carousel -->
</section>
