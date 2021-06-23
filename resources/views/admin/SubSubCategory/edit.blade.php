@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Sub-SubCategory',
    'url' => "subsubcategories.index",
    'section_name' => 'Update Sub-SubCategory'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Category Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Update Sub-SubCategory</h3>
                        <a href="{{ route('subsubcategories.index') }}" class="btn btn-primary">Back List Sub Sub-Category</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('subsubcategories.update', $subsubCategory) }}" method="post" enctype="multipart/form-data">
                            @method('put')
                            @csrf
                            <div class="form-group">
                                <h5>Sub Sub-Category Name EN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('subsubcategory_name_en', $subsubCategory->subsubcategory_name_en) }}" name="subsubcategory_name_en" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('subsubcategory_name_en')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Sub Sub-Category Name BN <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" value="{{ old('subsubcategory_name_bn', $subsubCategory->subsubcategory_name_en) }}" name="subsubcategory_name_bn" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('subsubcategory_name_bn')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Category Name <span class="text-danger">*</span></h5>
                                <select name="category_id" class="form-control"  >
                                    <option value="" selected="" disabled="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $subsubCategory->category_id ? 'selected':'' }} >{{ $category->category_name_en }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>SubCategory Select <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <select name="subcategory_id" class="form-control"  >
                                        <option value="" selected="" disabled="">Select SubCategory</option>
                                        @foreach($subcategories as $subsub)
                                        <option value="{{ $subsub->id }}" {{ $subsub->id == $subsubCategory->subcategory_id ? 'selected':'' }} >{{ $subsub->subcategory_name_en }}</option>
                                        @endforeach
                                    </select>
                                    @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
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
