@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Order Details',
    'url' => "orders.index",
    'section_name' => 'View Order'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-6 col-lg-6">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Shipping Details</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-6 col-lg-6">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order Details</h3>
                        <span class="text-danger"> Invoice : {{ $order->invoice_number }}</span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
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
                                <th> Order Total : </th>
                                <th>$ {{ $order->amount }} </th>
                            </tr>
                            <tr>
                                <th> Status : </th>
                                <th>
                                    <span class="badge badge-success">{{ $order->status }}
                                    </span>
                                </th>
                            </tr>
                            <tr>
                                <th>Return Reason: <p>{{ $order->return_reason }}</p></th>
                                <th>
                                    @if ($order->status == 'pending')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'confirmed'
                                    ]) }}" class="btn btn-block btn-success">Confirm Order</a>
                                    @elseif ($order->status == 'confirmed')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'processing'
                                    ]) }}" class="btn btn-block btn-success">Process Order</a>
                                    @elseif ($order->status == 'processing')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'picked'
                                    ]) }}" class="btn btn-block btn-success">Pick Order</a>
                                    @elseif ($order->status == 'picked')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'shipped'
                                    ]) }}" class="btn btn-block btn-success">Ship Order</a>
                                    @elseif ($order->status == 'shipped')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'delivered'
                                    ]) }}" class="btn btn-block btn-success">Deliverd Order</a>
                                    @elseif ($order->status == 'cancel')
                                    <a href="{{ route('order-status.update', [
                                        'order_id' => $order->id,
                                        'status' => 'return'
                                    ]) }}" class="btn btn-block btn-danger">Return Order</a>
                                    @endif
                                </th>
                            </tr>
                        </table>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
            <div class="col-md-12 col-lg-12">
                <div class="box box-bordered border-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Order View</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr style="background: #e3e3e3;">
                                        <td class="text-dark">
                                            <label for=""> Image</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Product Name </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Product Code</label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Color </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Size </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Quantity </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Price </label>
                                        </td>
                                        <td class="text-dark">
                                            <label for=""> Download </label>
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
                                                            File</span> </strong>

                                                @elseif($order->status == 'confirm')

                                                    <a target="_blank" href="{{ asset('upload/pdf/' . $file->digital_file) }}">
                                                        <strong>
                                                            <span class="badge badge-pill badge-success" style="background: #FF0000;">
                                                                Download Ready</span> </strong> </a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
