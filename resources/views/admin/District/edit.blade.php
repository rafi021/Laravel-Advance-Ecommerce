@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'District',
    'url' => "district.index",
    'section_name' => 'All District'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Brand Page --}}
            <div class="col-md-8 col-lg-8 m-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit District</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('district.update', $district) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <h5>Division Name <span class="text-danger">*</span></h5>
                                <select class="custom-select" aria-label="Default select example" name="division_id">
                                    {{-- <option selected>Open this select menu</option> --}}
                                    @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}" {{ $division->id == $district->division_id ? 'selected': ''}} >{{ $division->division_name}}</option>
                                    @endforeach
                                  </select>
                                @error('division_id')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>District Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="district_name" class="form-control" required=""  value="{{old('district_name',$district->district_name) }}" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('district_name')
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
