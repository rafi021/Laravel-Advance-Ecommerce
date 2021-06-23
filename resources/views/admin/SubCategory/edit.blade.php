@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Sub Category',
    'url' => "subcategories.index",
    'section_name' => 'Update Sub Category'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Category Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Update Sub Category</h3>
                        <a href="{{ route('subcategories.index') }}" class="btn btn-primary">Back List Sub Category</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('subcategories.update', $subcategory) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <h5>Sub Category Name EN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('subcategory_name_en', $subcategory->subcategory_name_en) }}" name="subcategory_name_en" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('subcategory_name_en')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Sub Category Name BN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('subcategory_name_bn', $subcategory->subcategory_name_en) }}" name="subcategory_name_bn" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('subcategory_name_bn')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Category Name <span class="text-danger">*</span></h5>
                                {{-- <div class="controls">
                                    <input type="file" name="category_image" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div> --}}
                                <select class="custom-select" aria-label="Default select example" name="category_id">
                                    {{-- <option selected>Open this select menu</option> --}}
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $subcategory->category_id ? 'selected': ''}} >{{ $category->category_name_en }}</option>
                                    @endforeach
                                  </select>
                                @error('category_id')
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
