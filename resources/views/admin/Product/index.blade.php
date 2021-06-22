@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Product',
    'section_name' => 'All Product'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">All Product Data Table</h3>
                        <a href="{{ route('products.create') }}" class="btn btn-primary">Create New Product</a>
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
                                                    <th>Image</th>
                                                    <th>Product Name EN</th>
                                                    <th>Product Qty</th>
                                                    <th>Purchase Price</th>
                                                    <th>Selling Price</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($products as $item)
                                                <tr role="row" class="odd">
                                                    <td>{{ $loop->index+1 }}</td>
                                                    <td>
                                                        <img src="{{ asset($item->product_thumbnail) }}" alt=""  style="width: 70px; height:70px;">
                                                    </td>
                                                    <td class="sorting_1">{{ $item->product_name_en }}</td>
                                                    <td>{{ $item->product_qty }}</td>
                                                    <td>{{ $item->purchase_price }}</td>
                                                    <td>{{ $item->selling_price }}</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <a href="{{ route('products.edit', $item) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <form action="{{ route('products.destroy', $item) }}" method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="" class="btn btn-danger" title="Delete Data" id="delete" onclick="event.preventDefault();
                                                                this.closest('form').submit();"><i class="fa fa-trash"></i></a>
                                                            </form>
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
