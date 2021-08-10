@extends('frontend.frontend_master')

@section('title')
    Al Araf Fashion - Wishlist Page
@endsection

@section('frontend_content')
<div class="body-content">
	<div class="container">
    <div class="my-wishlist-page">
        <div class="row">
            <div class="col-md-12 my-wishlist">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th colspan="4" class="heading-title">My Wishlist</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wishlists as $wish)
                            @foreach ($wish->products as $product )
                            <tr>
                                <td class="col-md-2"><img src="{{ asset($product->product_thumbnail) }}" alt="imga"></td>
                                <td class="col-md-7">
                                    <div class="product-name"><a href="{{ route('frontend-product-details',['id' => $product->id, 'slug' => $product->product_slug_en]) }}">
                                        @if (session()->get('language') == 'bangla')
                                            {{ $product->product_name_bn }}
                                        @else
                                            {{ $product->product_name_en }}
                                        @endif
                                    </a></div>
                                        @if ($product->discount_price == NULL)
                                        <div class="price">${{ $product->selling_price }}</div>
                                        @else
                                        <div class="price">${{ $product->discount_price }}
                                        <span class="price-before-discount">${{ $product->selling_price }}</span>
                                        </div>
                                        @endif
                                </td>
                                <td class="col-md-2">
                                    <button class="btn-upper btn btn-primary" type="button" data-toggle="modal"
                                    data-target="#productViewModal" onclick="productView(this.id)"
                                    id="{{ $product->id }}">Add to cart</button>
                                </td>
                                <td class="col-md-1 close-btn">
                                    <button type="button" class="" onclick="removeWishlist(this.id)" id={{ $wish->id }}><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
    </div>
</div>
@endsection
