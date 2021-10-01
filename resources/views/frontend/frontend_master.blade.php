
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="csrf-token" content="{{ csrf_token() }}">

<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>@yield('title')</title>

@include('frontend.frontend_layout.body.style')

</head>
<body class="cnt-home">
<!--  HEADER  -->
@include('frontend.frontend_layout.body.header')
<!--  HEADER : END  -->
@if (request()->routeIs('home'))
@else
  @include('frontend.frontend_layout.body.breadcrumb')
@endif

@yield('frontend_content')

<!--  FOOTER  -->
@include('frontend.frontend_layout.body.footer')
<!--  FOOTER : END -->

@include('frontend.frontend_layout.body.script')

<!-- Add to Cart Product Modal -->
<div class="modal fade" id="productViewModal" tabindex="-1" aria-labelledby="productViewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="width: 800px; height:300px;">
        <div class="modal-header">
        <h5 class="modal-title" id="productViewModalLabel"><span id="pname"></span></h5>
        <button type="button" id="closeModal" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" src="" id="pimage" alt="" style="width: 180px" height="180px">
                    </div>
                </div>
                <div class="col-md-4">
                    <ul class="list-group">
                        <li class="list-group-item">Price: <strong class="text-danger">BDT
                        <span id="price"></span>
                        </strong>
                        <del id="oldprice"></del>
                    </li>
                        <li class="list-group-item">Code: <strong id="pcode"></strong></li>
                        <li class="list-group-item">Category: <strong id="category"></strong></li>
                        <li class="list-group-item">Brand: <strong id="brand"></strong></li>
                        <li class="list-group-item">Stock:
                        <span id="Instock" class="bdage bdage-pill badge-success" style="background: green; color: white"></span>
                        <span id="Outofstock" class="bdage bdage-pill badge-danger" style="background: red; color: white"></span>
                    </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <div class="form-group" id="colorArea">
                        <label for="color">Choose Color</label>
                        <select class="form-control" id="color" name="color">
                            <option>--Select Color--</option>
                        </select>
                    </div>
                    <div class="form-group" id="sizeArea">
                        <label for="size">Choose Size</label>
                        <select class="form-control" id="size" name="size">
                            <option>--Select Size--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="product_qty">Qty</label>
                        <input type="number" name="quantity" id="product_qty" value="1" min="1">
                    </div>
                    <input type="hidden" id="product_id">
                    <button class="btn btn-primary mb-2" type="submit" onclick="addToCart()">Add to Cart</button>

                </div>
            </div>
        </div>
        {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
    </div>
    </div>
</div>
<!-- Add to Cart Product Modal END-->

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })
    // start product view with Modal
    function productView(id){
        $.ajax({
            type: 'GET',
            url: '/product/view/modal/'+id,
            dataType: 'json',
            success: function(data){
                $('#pname').text(data.product.product_name_en);
                $('#pcode').text(data.product.product_code);
                $('#category').text(data.product.category.category_name_en);
                $('#brand').text(data.product.brand.brand_name_en);
                $('#pimage').attr('src', '/'+data.product.product_thumbnail);

                $('#product_id').val(id);
                $('#product_qty').val(1);

                //product price
                if(data.product.discount_price == null){
                    $('#price').text(data.product.selling_price);
                    $('#oldprice').text('');
                }else{
                    $('#price').text(data.product.discount_price);
                    $('#oldprice').text(data.product.selling_price);
                }

                // product stock
                if(data.product.product_qty > 0)
                {
                    $('#Outofstock').text('');
                    $('#Instock').text('In Stock');
                }else{
                    $('#Instock').text('');
                    $('#Outofstock').text('OUT of Stock');
                }

                // color and size
                $('select[name="color"]').empty();
                $.each(data.colors_en, function(key,value){
                    $('select[name="color"]').append('<option value=" '+value+' ">'+value+'</option>')
                    if(data.colors_en == ""){
                        $('#colorArea').hide()
                    }else{
                        $('#colorArea').show()
                    }
                })
                $('select[name="size"]').empty();
                $.each(data.size_en, function(key,value){
                    $('select[name="size"]').append('<option value=" '+value+' ">'+value+'</option>')
                    if(data.size_en == ""){
                        $('#sizeArea').hide()
                    }else{
                        $('#sizeArea').show()
                    }
                })
            }
        })
    }

    // Add to Cart Product
    function addToCart(){
        var product_name = $('#pname').text();
        var id = $('#product_id').val();
        var color = $('#color option:selected').text();
        var size = $('#size option:selected').text();
        var qty = $('#product_qty').val();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            data:{
                color: color,
                size:size,
                qty: qty,
                product_name: product_name,
            },
            url: '/cart/data/store/'+id,
            success: function(data){
                miniCart()
                $('#closeModal').click();
                // console.log(data)

                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
            }
        })
    }
    // End to Cart Product
</script>
<script type="text/javascript">
    function miniCart(){
        $.ajax({
            type: 'GET',
            dataType: 'json',
            url: '/product/mini/cart',
            success: function(response){
                $('span[id="cartSubTotal"]').text(response.cart_total);
                $('span[id="cartQty"]').text(response.cart_qty);
                var miniCart = "";
                $.each(response.carts, function(key,value){
                    miniCart += `
                    <div class="cart-item product-summary">
                        <div class="row">
                            <div class="col-xs-4">
                                <div class="image">
                                    <a href="#"><img src="/${value.options.image}" alt=""></a>
                                </div>
                            </div>
                            <div class="col-xs-7">
                                <h3 class="name"><a href="index.php?page-detail">${value.name}</a></h3>
                                <div class="price">$${value.price}X${value.qty}</div>
                            </div>
                            <div class="col-xs-1 action"> <button type="submit" id="${value.rowId}" onclick="miniCartRemove(this.id)"><i class="fa fa-trash"></i></button> </div>
                        </div>
                    </div>
                    <!-- /.cart-item -->
                    <div class="clearfix"></div>
                    <hr>
                    `;
                });
                $('#miniCart').html(miniCart);
            }
        })
    }
    miniCart();

    // mini cart remove start
    function miniCartRemove(rowId){
        $.ajax({
            type:'GET',
            dataType: 'json',
            url:'/minicart/product-remove/'+rowId,
            success: function(data){
                miniCart();
                //start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
                //end message
            }
        });
    }
    // mini cart remove end
</script>
<script type="text/javascript">
    // Start Add to Wishlist
    function addToWishlist(id){
        $.ajax({
            type:'POST',
            dataType: 'json',
            url:'/user/add/product/to-wishlist/'+id,
            success: function(data){
                //start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        icon: 'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        icon: 'error',
                        title:data.error,
                    })
                }
                //end message
            }
        });
    }
    // End Add to Wishlist
    // Start remove from wishlist
    function removeWishlist(wish_id){
        $.ajax({
            type:'GET',
            dataType: 'json',
            url:'/user/remove/from-wishlist/'+wish_id,
            success: function(data){
                //location.reload();
                //start message
                const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        showConfirmButton: false,
                        timer: 3000
                })
                if($.isEmptyObject(data.error)){
                    Toast.fire({
                        type:'success',
                        title: data.success,
                    })
                }else{
                    Toast.fire({
                        type: 'error',
                        title:data.error,
                    })
                }
                //end message
            }
        });
    }
    // End remove from wishlist
</script>
</body>
</html>
