@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Coupon',
    'url' => "coupons.index",
    'section_name' => 'All Coupon'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">All Coupons Data Table</h3>
                        <a href="{{ route('coupons.create') }}" class="btn btn-primary">Create New Coupon</a>
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
                                                    <th>Coupon Name</th>
                                                    <th>Coupon Discount</th>
                                                    <th>Coupon Validity</th>
                                                    <th>Coupon Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($coupons as $item)
                                                <tr role="row" class="odd">
                                                    <td>{{ $loop->index+1 }}</td>
                                                    @if ($item->coupon_status == 1)
                                                    <td>{{ $item->coupon_name }}</td>
                                                    @else
                                                    <td class="text-danger">{{ $item->coupon_name }} (Invalid)</td>
                                                    @endif
                                                    <td class="sorting_1">{{ $item->coupon_discount }} %</td>
                                                    <td>{{ Carbon\Carbon::parse($item->coupon_validity)->format('D, d F Y') }}</td>
                                                    <td>
                                                        {{-- @if ($item->status == 1)
                                                            <span class="badge rounded-pill badge bg-success">Active</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-danger">InActive</span>
                                                        @endif --}}
                                                        <input data-id="{{$item->id}}" class="toggle-class" type="checkbox" data-onstyle="success" data-offstyle="danger" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->coupon_status ? 'checked' : '' }}>
                                                    </td>
                                                    <td>
                                                        <div class="input-group">
                                                            <a href="{{ route('coupons.edit', $item) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <form action="{{ route('coupons.destroy', $item) }}" method="post">
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
    @section('dashboard_script')
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
    <script>
        $(function() {
            $('.toggle-class').change(function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var coupon_id = $(this).data('id');

                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/admin/change/coupon/status',
                    data: {'status': status, 'coupon_id': coupon_id},
                    success: function(data){
                        console.log(data.success)
                    }
                });
            })
        })
    </script>
    @endsection
@endsection
