@extends('frontend.frontend_master')

@section('title')
    Al Araf Fashion - Checkout Page
@endsection

@section('frontend_content')
    <div class="checkout-box ">
        <div class="row">
            <div class="col-md-8">
                <div class="panel-group checkout-steps" id="accordion">
                    <!-- checkout-step-01  -->
                    <div class="panel panel-default checkout-step-01">

                        <div id="collapseOne" class="panel-collapse collapse in">
                            <!-- panel-body  -->
                            <div class="panel-body">
                                <div class="row">

                                    <!-- guest-login -->
                                    <div class="col-md-6 col-sm-6 already-registered-login">
                                        <h4 class="checkout-subtitle"><b>Shipping Address</b></h4>

                                        <form class="shipping-form" method="POST" action="{{ route('checkout.store') }}">
                                            @csrf
                                            <div class="form-group">
                                                <label class="info-title" for="shippingName">Shipping
                                                    Name<span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shippingName" placeholder="Enter your name here"
                                                    name="shipping_name" value="{{ Auth::user()->name }}">
                                                    @error('shipping_name')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingEmail">Shipping email
                                                    <span>*</span></label>
                                                <input type="email" class="form-control unicase-form-control text-input"
                                                    id="shippingEmail" placeholder="Enter your email here"
                                                    name="shipping_email" value="{{ Auth::user()->email }}">
                                                    @error('shipping_email')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                            <div class="form-group">
                                                <label class="info-title" for="shippingPhone">Shipping
                                                    Phone<span>*</span></label>
                                                <input type="phone" class="form-control unicase-form-control text-input"
                                                    id="shippingPhone" placeholder="Enter your phone number"
                                                    name="shipping_phone" value="{{ Auth::user()->phone_number }}">
                                                    @error('shipping_phone')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>

                                            <div class="form-group">
                                                <label class="info-title" for="shippingPostCode">Shipping Post
                                                    Code<span>*</span></label>
                                                <input type="text" class="form-control unicase-form-control text-input"
                                                    id="shippingPostCode" placeholder="Enter your name here"
                                                    name="shipping_postCode">
                                                    @error('shipping_postCode')
                                                        <span class="alert text-danger">{{ $message }}</span>
                                                    @enderror
                                            </div>
                                    </div>
                                    <!-- guest-login -->

                                    <!-- already-registered-login -->
                                    <div class="col-md-6 col-sm-6 already-registered-login">
                                        <h4 class="checkout-subtitle"><b>Address Bar</b></h4>

                                        <div class="form-group">
                                            <h5>Division Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="custom-select form-control unicase-form-control" aria-label="Division Select" name="division_id">
                                                    <option selected>Select Division Name</option>
                                                    @foreach ($divisions as $division)
                                                        <option value="{{ $division->id }}">
                                                            {{ $division->division_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('division_id')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <div class="form-group">
                                            <h5>District Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="custom-select form-control unicase-form-control" aria-label="District Select" name="district_id">
                                                    <option selected="" disabled="">Select district Name</option>
                                                </select>
                                            </div>
                                            @error('district_id')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>State Select <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <select class="custom-select form-control unicase-form-control" aria-label="State Select" name="state_id">
                                                    <option selected="" disabled="">Select state Name</option>
                                                </select>
                                            </div>
                                            @error('state_id')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                        <label class="info-title" for="shippingAddrees">Shipping
                                            Addres<span>*</span></label>
                                        <textarea name="shipping_address" id="" cols="30" rows="10"
                                            class="form-control unicase-form-control text-input" id="shippingAddrees"
                                            placeholder="Example: H#05,R#02, Uttara Sector: 11, Uttara"></textarea>
                                            @error('shipping_address')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                            <div class="form-group">
                                                <label class="info-title" for="shippingNotes">Shipping Notes<span></span></label>
                                                <textarea name="shipping_notes" id="" cols="30" rows="10" class="form-control unicase-form-control text-input" id="shippingNotes" placeholder="any Shipping notes"></textarea>
                                            </div>
                                    </div>
                                    <!-- already-registered-login -->

                                </div>
                            </div>
                            <!-- panel-body  -->

                        </div><!-- row -->
                    </div>
                    <!-- checkout-step-01  -->

                </div><!-- /.checkout-steps -->
            </div>
            <div class="col-md-4">
                <!-- checkout-progress-sidebar -->
                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                            </div>
                            <div class="___class_+?71___">
                                <ul class="nav nav-checkout-progress list-unstyled">
                                    @foreach ($carts as $item)
                                        <li>
                                            <strong>Image: </strong>
                                            <img src="{{ asset($item->options->image) }}"
                                                style="height: 50px; width: 50px;" alt="">
                                        </li>
                                        <li>
                                            <strong>Qty:</strong>
                                            {{ $item->qty }}
                                            <strong>Color:</strong>
                                            {{ $item->options->color }}
                                            <strong>Size:</strong>
                                            {{ $item->options->size }}
                                        </li>
                                    @endforeach
                                    <hr>
                                    <li>
                                        @if (Session::has('coupon'))
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Coupon Name: </strong> {{ session()->get('coupon')['coupon_name'] }}
                                            ( {{ session()->get('coupon')['coupon_discount'] }} %)
                                            <hr>
                                            <strong>Coupon Discount:
                                            </strong>(-)${{ session()->get('coupon')['discount_amount'] }}
                                            <hr>
                                            <strong>Grand Total: </strong>${{ session()->get('coupon')['total_amount'] }}
                                            <hr>
                                        @else
                                            <strong>SubTotal: </strong> ${{ $cart_total }}
                                            <hr>
                                            <strong>Grand Total: </strong> ${{ $cart_total }}
                                            <hr>
                                        @endif

                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- checkout-progress-sidebar -->

                <div class="checkout-progress-sidebar ">
                    <div class="panel-group">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="unicase-checkout-title">Select Payment Method</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="">Stripe</label>
                                    <input type="radio" name="payment_method" id="" value="stripe">
                                    <img src="{{ asset('frontend/assets/images/payments/4.png') }}" alt="">
                                </div>
                                <div class="col-md-4">
                                    <label for="">Card</label>
                                    <input type="radio" name="payment_method" id="" value="card">
                                    <img src="{{ asset('frontend/assets/images/payments/1.png') }}" alt="">
                                </div>
                                <div class="col-md-4">
                                    <label for="">COD</label>
                                    <input type="radio" name="payment_method" id="" value="cod">
                                    <img src="{{ asset('frontend/assets/images/payments/6.png') }}" alt="">
                                </div>
                                @error('payment_method')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <button type="submit" class="btn btn-primary checkout-page-button">Order
                Confirm</button>
            </form>
        </div><!-- /.row -->
    </div>
@section('frontend_script')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">
            $(document).ready(function() {
                $('select[name="division_id"]').on('change', function(){
                    var division_id = $(this).val();
                    if(division_id) {
                        $.ajax({
                            url: "{{  url('/division/district/ajax') }}/"+division_id,
                            type:"GET",
                            dataType:"json",
                            success:function(data) {
                                $('select[name="state_id"]').html('');
                                var d =$('select[name="district_id"]').empty();
                                    $.each(data, function(key, value){
                                        $('select[name="district_id"]').append('<option value="'+ value.id +'">' + value.district_name + '</option>');
                                    });
                            },
                        });
                    } else {
                        alert('danger');
                    }
                });
            });
        $(document).ready(function() {
            $('select[name="district_id"]').on('change', function(){
                var district_id = $(this).val();
                if(district_id) {
                    $.ajax({
                        url: "{{  url('/district/state/ajax') }}/"+district_id,
                        type:"GET",
                        dataType:"json",
                        success:function(data) {
                            var d =$('select[name="state_id"]').empty();
                                $.each(data, function(key, value){
                                    $('select[name="state_id"]').append('<option value="'+ value.id +'">' + value.state_name + '</option>');
                                });
                        },
                    });
                } else {
                    alert('danger');
                }
            });
        });
    </script>
@endsection
@endsection
