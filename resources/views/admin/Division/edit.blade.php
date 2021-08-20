@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Division',
    'url' => "division.index",
    'section_name' => 'All Division'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Brand Page --}}
            <div class="col-md-8 col-lg-8 m-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Division</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('division.update', $division) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="division_name" class="form-control" required=""  value="{{old('division_name',$division->division_name) }}" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('division_name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="text-xs-right">
                                <button type="submit" class="btn btn-rounded btn-info">Update</button>
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
