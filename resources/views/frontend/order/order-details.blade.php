@extends('dashboard')

@section('frontend_style')

@endsection

@section('userdashboard_content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Shipping Details</h4>
                </div>
                <hr>
                <div class="card-body" style="background: #E9EBEC;">
                    <table class="table">
                        <tr>
                            <th> Shipping Name : </th>
                            <th> {{ $order->name }} </th>
                        </tr>

                        <tr>
                            <th> Shipping Phone : </th>
                            <th> {{ $order->phone }} </th>
                        </tr>

                        <tr>
                            <th> Shipping Email : </th>
                            <th> {{ $order->email }} </th>
                        </tr>

                        <tr>
                            <th> Division : </th>
                            <th> {{ $order->division->division_name }} </th>
                        </tr>

                        <tr>
                            <th> District : </th>
                            <th> {{ $order->district->district_name }} </th>
                        </tr>

                        <tr>
                            <th> State : </th>
                            <th>{{ $order->state->state_name }} </th>
                        </tr>

                        <tr>
                            <th> Post Code : </th>
                            <th> {{ $order->post_code }} </th>
                        </tr>

                        <tr>
                            <th> Order Date : </th>
                            <th> {{ $order->order_date }} </th>
                        </tr>

                    </table>
                </div>

            </div>

        </div> <!-- // end col md -6 -->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h4>Order Details
                        <span class="text-danger"> Invoice : {{ $order->invoice_number }}</span>
                    </h4>
                    @if ($order->status == 'pending')

                    @else
                    <ul>
                        <li> Confirmed Date: {{ $order->confirmed_date }}</li>
                        <li> Processing Date: {{ $order->processing_date }}</li>
                        <li> Picked Date: {{ $order->picked_date }}</li>
                        <li> Shipped Date: {{ $order->shipped_date }}</li>
                        <li> Delivered Date: {{ $order->delivered_date }}</li>
                        <li> Cancel Date: {{ $order->cancel_date }}</li>
                        <li> Return Date: {{ $order->return_date }}</li>
                    </ul>
                    @endif
                </div>
                <hr>
                <div class="card-body" style="background: #E9EBEC;">
                    <table class="table">
                        <tr>
                            <th> Name : </th>
                            <th> {{ $order->user->name }} </th>
                        </tr>

                        <tr>
                            <th> Phone : </th>
                            <th> {{ $order->user->phone }} </th>
                        </tr>

                        <tr>
                            <th> Payment Type : </th>
                            <th> {{ $order->payment_method }} </th>
                        </tr>

                        <tr>
                            <th> Tranx ID : </th>
                            <th> {{ $order->transaction_id }} </th>
                        </tr>

                        <tr>
                            <th> Invoice : </th>
                            <th class="text-danger"> {{ $order->invoice_number }} </th>
                        </tr>

                        <tr>
                            <th> Order Total :$ </th>
                            <th>{{ $order->amount }} </th>
                        </tr>

                        <tr>
                            <th> Order : </th>
                            <th>
                                <span class="badge badge-pill badge-warning"
                                    style="background: #418DB9;">{{ $order->status }} </span>
                            </th>
                        </tr>

                    </table>
                </div>
            </div>
        </div> <!-- // 2ND end col md -5 -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <tbody>
                        <tr style="background: #e2e2e2;">
                            <td class="col-md-1">
                                <label for=""> Image</label>
                            </td>
                            <td class="col-md-3">
                                <label for=""> Product Name </label>
                            </td>
                            <td class="col-md-3">
                                <label for=""> Product Code</label>
                            </td>
                            <td class="col-md-2">
                                <label for=""> Color </label>
                            </td>
                            <td class="col-md-2">
                                <label for=""> Size </label>
                            </td>
                            <td class="col-md-1">
                                <label for=""> Quantity </label>
                            </td>
                            <td class="col-md-1">
                                <label for=""> Price </label>
                            </td>
                            <td class="col-md-1">
                                <label for=""> Action </label>
                            </td>
                        </tr>
                        @foreach ($orderItems as $item)
                            <tr>
                                <td class="col-md-1">
                                    <label for=""><img src="{{ asset( $item->product->product_thumbnail ) }}"
                                            height="50px;" width="50px;"> </label>
                                </td>
                                <td class="col-md-3">
                                    <label for=""> {{ $item->product->product_name_en }}</label>
                                </td>
                                <td class="col-md-3">
                                    <label for=""> {{ $item->product->product_code }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->color }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->size }}</label>
                                </td>
                                <td class="col-md-2">
                                    <label for=""> {{ $item->qty }}</label>
                                </td>

                                <td class="col-md-3">
                                    <label for=""> ${{ $item->unit_price }} ( $ {{ $item->unit_price * $item->qty }} ) </label>
                                </td>
                                @php
                                    $file = App\Models\Product::where('id', $item->product_id)->first();
                                @endphp

                                <td class="col-md-1">
                                    @if ($order->status == 'pending')
                                        <strong>
                                            <span class="badge badge-pill badge-success" style="background: #418DB9;"> No
                                                File</span>
                                        </strong>

                                    @elseif($order->status != 'pending')

                                        <a target="_blank" class="btn btn-danger" href="{{ asset('upload/pdf/' . $file->digital_file) }}">
                                            <i class="fa fa-download"></i>Inovice
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div> <!-- / end col md 8 -->
    </div> <!-- // END ORDER ITEM ROW -->
    @if ($order->status == 'delivered')
    Delivered
    @else
        @php
            $order = App\Models\Order::where('id', $order->id)
                ->where('return_reason', '=', null)
                ->first();
        @endphp
        @if ($order)
            <form action="{{ route('return.order', $order->id) }}" method="post">
                @csrf
                <div class="form-group">
                    <label for="label"> Order Return Reason:</label>
                    <textarea name="return_reason" id="" class="form-control" cols="30" rows="05">Return Reason</textarea>
                </div>
                <button type="submit" class="btn btn-danger">Order Return</button>
            </form>
        @else
            <span class="badge badge-pill badge-warning" style="background: red">You Have send return request for this product</span>
        @endif
    @endif
    <br><br>
@endsection

@section('frontend_script')

@endsection
