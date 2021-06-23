@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Slider',
    'url' => "slider.index",
    'section_name' => 'Add New Slider'
    ])
    <section class="content">
        <div class="row">
            {{-- Add Slider Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Add New Slider</h3>
                        <a href="{{ route('slider.index') }}" class="btn btn-primary">Back to Slider List</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <h4 class="text-warning">Slider Image Status Bar</h4>
                            <hr ><hr>
                            <div class="form-group mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                    id="status" name="slider_status" value="1" checked>
                                    <label class="form-check-label" for="status">Active Status</label>
                                </div>
                            </div>
                            <h4 class="text-warning">Slider Image Information</h4>
                            <hr><hr>
                            <div class="form-group">
                                <h5>Slider Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="slider_name" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('slider_name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Slider Title <span class="text-danger"></span></h5>
                                <div class="controls">
                                    <input type="text" name="slider_title" class="form-control">
                                    <div class="help-block"></div>
                                </div>
                                @error('slider_title')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                                <div class="form-group">
                                    <h5>Slider Description<span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <textarea name="slider_description" id="editor5" cols="30" rows="5" class="form-control"></textarea>
                                        <div class="help-block"></div>
                                    </div>
                                    @error('slider_description')
                                        <span class="alert text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                            <h4 class="text-warning">Slider Single Image Upload</h4>
                            <hr><hr>
                            <div class="form-group">
                                <h5>Slider Image <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="file" name="slider_image" class="form-control" required="" data-validation-required-message="This field is required"
                                    onchange="sliderShow(this)"> <div class="help-block"></div>
                                </div>
                                @error('slider_image')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                                <img src="" id="sliderImage" alt="">
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
    @section('dashboard_script')
    <script type="text/javascript">
        function sliderShow(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#sliderImage').attr('src', e.target.result).width(100).height(100);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
    <script src="{{ asset('') }}assets/vendor_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
    <script src="{{ asset('') }}assets/vendor_components/ckeditor/ckeditor.js"></script>
    <script src="{{ asset('') }}assets/vendor_plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js"></script>
    <script src="{{ asset('backend') }}/js/pages/editor.js"></script>
    @endsection
@endsection
