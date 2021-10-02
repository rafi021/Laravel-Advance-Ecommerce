@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Orders',
    'url' => "orders.index",
    'section_name' => 'All Orders'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">
                            @if (Request::is('admin/orders'))
                                All Orders List
                            @else
                                Statuswise Order List
                            @endif
                        </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <div id="example1_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1" class="table table-bordered table-striped dataTable"
                                            role="grid" aria-describedby="example1_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>#</th>
                                                    <th>Date</th>
                                                    <th>Invoice</th>
                                                    <th>Amount</th>
                                                    <th>Method</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($orders as $order)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">
                                                        {{ $loop->index+1 }}
                                                    </td>
                                                    <td class="sorting_1">{{ $order->created_at->diffForHumans() }}</td>
                                                    <td class="soring_1">{{ $order->invoice_number }}</td>
                                                    <td class="sorting_1">{{ $order->amount }}</td>
                                                    <td class="sorting_1">{{ $order->payment_method }}</td>
                                                    <td class="sorting_1">
                                                        @if ($order->status == 'pending')
                                                        <span class="badge badge-primary">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'confirmed')
                                                        <span class="badge badge-secondary">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'processing')
                                                        <span class="badge badge-info">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'picked')
                                                        <span class="badge badge-warning">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'shipped')
                                                        <span class="badge badge-light">{{ $order->status }}</span>
                                                        @elseif ($order->status == 'delivered')
                                                        <span class="badge badge-success">{{ $order->status }}</span>
                                                        @else
                                                        <span class="badge badge-danger">{{ $order->status }}</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <a href="{{ route('orders.show', $order) }}" class="btn btn-success" title="View"><i class="fa fa-eye"></i>
                                                            </a>
                                                            @if ($order->status =='pending')

                                                            @else
                                                            <a href="{{ route('admin-invoice-download', $order->id) }}" class="btn btn-danger" title="Download"><i class="fa fa-download"></i>
                                                            </a>
                                                            @endif
                                                            {{-- <a href="{{ route('orders.edit', $order) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i>
                                                            </a>
                                                            <form action="{{ route('orders.destroy', $order) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="" class="btn btn-danger" title="Delete Data" id="delete" onclick="event.preventDefault();
                                                                this.closest('form').submit();"><i class="fa fa-trash"></i></a>
                                                            </form> --}}
                                                        </div>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </div>
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
