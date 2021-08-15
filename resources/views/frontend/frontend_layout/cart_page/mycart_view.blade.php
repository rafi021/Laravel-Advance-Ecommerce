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
                        <tbody id="cartPage">
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!-- /.row -->
    </div>
    </div>
</div>
@endsection

@section('frontend_script')
<script type="text/javascript">
    // START my cart page view
        function cart(){
            $.ajax({
                type: 'GET',
                url: '/my-cart/list',
                dataType:'json',
                success:function(response){
                var rows = ""
                $.each(response.carts, function(key,value){
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
    function cartRemove(id){
        $.ajax({
            type: 'GET',
            url: '/remove/from-cart/'+id,
            dataType:'json',
            success:function(data){
            cart();
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
                }else{
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
    function cartIncrement(id){
        $.ajax({
            type: 'GET',
            url: '/add/in-cart/'+id,
            dataType:'json',
            success:function(data){
            cart();
            miniCart();
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
                }else{
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
        function cartDecrement(id){
        $.ajax({
            type: 'GET',
            url: '/reduce/from-cart/'+id,
            dataType:'json',
            success:function(data){
            cart();
            miniCart();
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
                }else{
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
</script>
@endsection
