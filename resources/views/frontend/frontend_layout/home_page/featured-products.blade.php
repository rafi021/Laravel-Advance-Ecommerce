<section class="section featured-product wow fadeInUp">
    <h3 class="section-title">
        @if (session()->get('language') == 'bangla')
            বৈশিষ্ট্যযুক্ত পণ্য
        @else
            Featured products
        @endif
    </h3>
    <div class="owl-carousel home-owl-carousel custom-carousel owl-theme outer-top-xs">
        @php
            $featured_products = App\Models\Product::where('featured', 1)
                ->latest()
                ->limit(6)
                ->get();
        @endphp
        @foreach ($featured_products as $product)
            <div class="item item-carousel">
                <div class="products">
                    <div class="product">
                        <div class="product-image">
                            <div class="image"> <a
                                    href="{{ route('frontend-product-details', ['id' => $product->id, 'slug' => $product->product_slug_en]) }}"><img
                                        src="{{ asset($product->product_thumbnail) }}" alt=""></a> </div>
                            <!-- /.image -->

                            <div class="tag hot"><span>hot</span></div>
                        </div>
                        <!-- /.product-image -->

                        <div class="product-info text-left">
                            <h3 class="name"><a
                                    href="{{ route('frontend-product-details', ['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                    @if (session()->get('language') == 'bangla')
                                        {{ $product->product_name_bn }}
                                    @else
                                        {{ $product->product_name_en }}
                                    @endif
                                </a></h3>
                            <div class="rating rateit-small"></div>
                            <div class="description"></div>
                            @if ($product->discount_price == null)
                                <div class="product-price"><span class="price">${{ $product->selling_price }}</span>
                                </div>
                            @else
                                <div class="product-price"> <span class="price">
                                        ${{ $product->discount_price }}</span> <span
                                        class="price-before-discount">${{ $product->selling_price }} </span> </div>
                            @endif
                            <!-- /.product-price -->

                        </div>
                        <!-- /.product-info -->
                        <div class="cart clearfix animate-effect">
                            <div class="action">
                                <ul class="list-unstyled">
                                    <li class="add-cart-button btn-group">
                                        @if ($product->product_qty>0)
                                        <button class="btn btn-primary icon" type="button" data-toggle="modal"
                                            data-target="#productViewModal" onclick="productView(this.id)"
                                            id="{{ $product->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                        </button>
                                        @else
                                        <button class="btn btn-danger" type="button">
                                            <i class="fa fa-close"></i>
                                        </button>
                                        @endif

                                        <!-- Button trigger modal -->
                                        <button class="btn btn-primary cart-btn" type="button">Add to cart</button>
                                    </li>
                                    <li class="lnk wishlist">
                                        <button class="add-to-cart" type="button" title="Wishlist"
                                            onclick="addToWishlist(this.id)" id="{{ $product->id }}">
                                            <i class="icon fa fa-heart"></i> </button>
                                        {{-- <a class="add-to-cart" href="" title="Wishlist"> <i class="icon fa fa-heart"></i> </a> --}}
                                    </li>
                                    <li class="lnk"> <a class="add-to-cart"
                                            href="#" title="Compare"> <i class="fa fa-signal" aria-hidden="true"></i> </a> </li>
                                </ul>
                            </div>
                            <!-- /.action -->
                        </div>
                        <!-- /.cart -->
                    </div>
                    <!-- /.product -->

                </div>
                <!-- /.products -->
            </div>
        @endforeach
        <!-- /.item -->
    </div>
    <!-- /.home-owl-carousel -->
</section>
