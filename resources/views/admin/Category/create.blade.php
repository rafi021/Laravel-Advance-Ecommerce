@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Category',
    'url' => "categories.index",
    'section_name' => 'All Category'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Category Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Category</h3>
                        <a href="{{ route('categories.index') }}" class="btn btn-primary">Back List Category</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('categories.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <h5>Category Name EN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_en" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('category_name_en')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Category Name BN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="category_name_bn" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('category_name_bn')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Category Icon <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="text" name="category_icon" class="form-control"> <div class="help-block"></div>
                                </div>
                                @error('category_icon')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>category Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="category_image" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('category_image')
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
