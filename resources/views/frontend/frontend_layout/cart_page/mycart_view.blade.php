@extends('frontend.frontend_master')

@section('title')
    Al Araf Fashion - Cart Page
@endsection

@section('frontend_content')
    <div class="body-content">
        <div class="container">
            <div class="my-wishlist-page">
                <div class="row">
                    <div class="col-md-12 shopping-cart-table">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Color</th>
                                        <th>Size</th>
                                        <th>Qty</th>
                                        <th>Subtotal</th>
                                        <th>Remove</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <td colspan="7">
                                            <div class="shopping-cart-btn">
                                                <span class="">
                                                    <a href="#" class="btn btn-upper btn-primary outer-left-xs">Continue
                                                        Shopping</a>
                                                    <a href="#"
                                                        class="btn btn-upper btn-primary pull-right outer-right-xs">Update
                                                        shopping cart</a>
                                                </span>
                                            </div><!-- /.shopping-cart-btn -->
                                        </td>
                                    </tr>
                                </tfoot>
                                <tbody id="cartPage">
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Estimate shipping and tax</span>
                                        <p>Enter your destination to get shipping and tax.</p>
                                    </th>
                                </tr>
                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label class="info-title control-label">Country <span>*</span></label>
                                            <select class="form-control unicase-form-control selectpicker"
                                                style="display: none;">
                                                <option>--Select options--</option>
                                                <option>India</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">State/Province <span>*</span></label>
                                            <select class="form-control unicase-form-control selectpicker"
                                                style="display: none;">
                                                <option>--Select options--</option>
                                                <option>TamilNadu</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="info-title control-label">Zip/Postal Code</label>
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                placeholder="">
                                        </div>
                                        <div class="pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary">GET A QOUTE</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-4 col-sm-12 estimate-ship-tax">
                        @if (Session::has('coupon'))

                        @else
                        <table class="table" id="applyCouponField">
                            <thead>
                                <tr>
                                    <th>
                                        <span class="estimate-title">Discount Code</span>
                                        <p>Enter your coupon code if you have one..</p>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control unicase-form-control text-input"
                                                placeholder="You Coupon.." id="coupon_name">
                                        </div>
                                        <div class="clearfix pull-right">
                                            <button type="submit" class="btn-upper btn btn-primary"
                                            onclick="applyCoupon()">APPLY COUPON</button>
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                        @endif
                    </div>
                    <div class="col-md-4 col-sm-12 cart-shopping-total">
                        <table class="table">
                            <thead id="couponCalField">

                            </thead><!-- /thead -->
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="cart-checkout-btn pull-right">
                                            <a href="{{ route('checkout-page') }}" type="submit" class="btn btn-primary checkout-btn">PROCCED TO
                                                CHEKOUT</a>
                                            {{-- <span class="">Checkout with multiples address!</span> --}}
                                        </div>
                                    </td>
                                </tr>
                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div><!-- /.row -->
            </div>
        </div>
    </div>
@endsection

@section('frontend_script')
    <script type="text/javascript">
        // START my cart page view
        function cart() {
            $.ajax({
                type: 'GET',
                url: '/my-cart/list',
                dataType: 'json',
                success: function(response) {
                    var rows = ""
                    $.each(response.carts, function(key, value) {
                        rows += `<tr>
                                <td class="col-md-2"><img src="/${value.options.image} " alt="imga" style="width:60px; height:60px;"></td>
                                <td class="col-md-2">
                                    <div class="product-name"><a href="#">${value.name}</a></div>
                                    <div class="price">$${value.price}</div>
                                </td>
                                <td class="col-md-2">${value.options.color == null ? `<span>...</span>`:`<strong>${value.options.color}</strong>`}</td>

                                <td class="col-md-2">${value.options.size == null ? `<span>...</span>`:`<strong>${value.options.size}</strong>`}</td>

                                <td class="col-md-2">
                                ${value.qty > 1
                                ? `<button type="submit" class="btn btn-danger btn-sm" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                                :
                                `<button type="submit" class="btn btn-danger btn-sm" disabled>-</button>`
                                }
                                <input type="text" value="${value.qty}" min="1" max="100" disabled="" style="width:25px;">
                                <button type="submit" class="btn btn-success btn-sm" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
                                </td>

                                <td class="col-md-2"><strong>$${value.subtotal}</strong></td>

                                <td class="col-md-1 close-btn">
                                    <button type="submit" class="" id="${value.rowId}" onclick="cartRemove(this.id)"><i class="fa fa-times"></i></button>
                                </td>
                            </tr>
                            `
                    });
                    $('#cartPage').html(rows);
                    $('#total_bill').text(response.cart_total)
                }
            });
        }
        cart();
        // END my cart page view

        // START product remove from my cart
        function cartRemove(id) {
            $.ajax({
                type: 'GET',
                url: '/remove/from-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    couponCalField();
                    $('#applyCouponField').show();
                    $('#coupon_name').val('');
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        // END product remove from my cart

        // START product qty increment from my cart
        function cartIncrement(id) {
            $.ajax({
                type: 'GET',
                url: '/add/in-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    couponCalField();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        //End product qty increment from my cart

        // START product qty Decrement from my cart
        function cartDecrement(id) {
            $.ajax({
                type: 'GET',
                url: '/reduce/from-cart/' + id,
                dataType: 'json',
                success: function(data) {
                    cart();
                    miniCart();
                    couponCalField();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
        //End product qty Decrement from my cart

        //START applyCoupon
        function applyCoupon(){
            var coupon_name = $('#coupon_name').val();
            $.ajax({
                type: 'POST',
                dataType: 'json',
                data: {coupon_name: coupon_name},
                url: '/coupon/apply/',
                success: function(recv_data) {
                    if(data.validity == true){
                        $('#applyCouponField').hide();
                    }
                    couponCalField();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(recv_data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: recv_data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: recv_data.error
                        })
                    }
                    // End Message
                }
            });
        }
        //END applyCoupon

        //START coupon Calcluation
        function couponCalField(){
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-calculation') }}",
                dataType: 'json',
                success: function(data){
                    miniCart();
                    cart();
                    if(data.total){
                        $('#couponCalField').html(
                            `<tr>
                                    <th>
                                        <div class="cart-sub-total">
                                            Subtotal<span class="inner-left-md">$${data.total}</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Grand Total<span class="inner-left-md">$${data.total}</span>
                                        </div>
                                    </th>
                            </tr>`
                        )
                    }else{
                        $('#couponCalField').html(
                            `<tr>
                                    <th>
                                        <div class="cart-sub-total">Subtotal Amount<span class="inner-left-md">$ ${data.subtotal}</span>
                                        </div>
                                        <div class="cart-sub-total">Coupon Name<span class="inner-left-md">${data.coupon_name}</span>
                                            <button type="submit" onclick="couponRemove()"><i class="fa fa-times"></i></button>
                                        </div>
                                        <div class="cart-sub-total">Discount Amount<span class="inner-left-md">$ ${data.discount_amount}</span>
                                        </div>
                                        <div class="cart-grand-total">
                                            Grand Total Amount<span class="inner-left-md">$ ${data.total_amount}</span>
                                        </div>
                                    </th>
                            </tr>`
                        )
                    }
                }
            });
        }
        couponCalField();
        //END coupon Calcluation

        // Start coupon remove
        // End coupon remove
        function couponRemove(){
            $.ajax({
                type: 'GET',
                url: "{{ url('/coupon-remove') }}",
                dataType: 'json',
                success: function(data){
                    couponCalField();
                    $('#applyCouponField').show();
                    $('#coupon_name').val('');
                    //location.reload();
                    // Start Message
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    })
                    if ($.isEmptyObject(data.error)) {
                        Toast.fire({
                            type: 'success',
                            icon: 'success',
                            title: data.success
                        })
                    } else {
                        Toast.fire({
                            type: 'error',
                            icon: 'error',
                            title: data.error
                        })
                    }
                    // End Message
                }
            });
        }
    </script>
@endsection
