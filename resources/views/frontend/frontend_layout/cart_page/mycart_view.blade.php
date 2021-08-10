@extends('frontend.frontend_master')

@section('title')
    Al Araf Fashion - Cart Page
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
                                <th colspan="4" class="heading-title">My Cart
                                    <strong>($<span id="total_bill"></span>)</strong>
                                </th>
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
                                <td class="col-md-2"><img src="/${value.options.image} " alt="imga"></td>
                                <td class="col-md-7">
                                    <div class="product-name"><a href="#">${value.name}</a></div>
                                    <div class="price">$${value.price} X ${value.qty} = $${value.price*value.qty}</div>
                                </td>
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
 // End Wishlist remov
    // END product remove from my cart

</script>
@endsection
