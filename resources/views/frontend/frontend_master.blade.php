
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
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content" style="width: 800px; height:300px;">
        <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><span id="pname"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
                        <label for="exampleFormControlSelect1">Choose Color</label>
                        <select class="form-control" id="exampleFormControlSelect1" name="color">
                            <option>--Select Color--</option>
                        </select>
                    </div>
                    <div class="form-group" id="sizeArea">
                        <label for="exampleFormControlSelect2">Choose Size</label>
                        <select class="form-control" id="exampleFormControlSelect2" name="size">
                            <option>--Select Size--</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Qty</label>
                        <input type="number" name="quantity" id="" value="1" min="1">
                    </div>
                    <button class="btn btn-primary mb-2" type="submit">Add to Cart</button>
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
</script>
</body>
</html>
