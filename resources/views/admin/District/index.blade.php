@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'District',
    'url' => "district.index",
    'section_name' => 'All District'
    ])
    <section class="content">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">All District Data Table</h3>
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
                                                    <th>Division Name</th>
                                                    <th>District Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($districts as $item)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ $item->division->division_name }}</td>
                                                    <td class="sorting_1">{{ $item->district_name }}</td>
                                                    <td>
                                                        <div class="input-group">
                                                            <a href="{{ route('district.edit', $item) }}" class="btn btn-info" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                            <form action="{{ route('district.destroy', $item) }}" method="post">
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
            {{-- Add Brand Page --}}
            <div class="col-md-4 col-lg-4">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Add New district</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('district.store') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <select class="custom-select" aria-label="Default select example" name="division_id">
                                    <option selected>Select Division Name</option>
                                    @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                    @endforeach
                                  </select>
                                @error('division_id')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('district_name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection
