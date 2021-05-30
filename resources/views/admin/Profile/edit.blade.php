@extends('admin.admin_master')

@section('title', 'Admin Profile Edit')

@section('dashboard_content')
    <section class="content">
        <div class="row">
            <div class="col-md-6 m-auto">
                <div class="box">
                    <div class="box-header with-border">
                        <h4 class="box-title">Admin Profile Edit Form</h4>
                    </div>
                    <div class="box-body">
                                <form action="{{ route('profile.update', $editData) }}" method="POST" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <h5>Admin Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="name" value="{{ $editData->name }}" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                            </div>
                                            @error('name')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <h5>Email Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="email" name="email" value="{{ $editData->email }}" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                            </div>
                                            @error('email')
                                                <span class="alert text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        {{-- <div class="form-group">
                                            <h5>Password Input Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="password" class="form-control" required="" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <h5>Repeat Password Input Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="password" name="confirm_password" data-validation-match-match="password" class="form-control" required=""> <div class="help-block"></div>
                                            </div>
                                        </div> --}}
                                        <div class="form-group">
                                            <h5>File Input Field <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="image" id="image" class="form-control" required=""> <div class="help-block"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 widget-user-image">
                                            <img  id="show-image" class="rounded-circle" src="{{ !empty($editData->profile_photo_path) ? url('upload/admin_images/'.$editData->profile_photo_path) : url('upload/admin_images/blank_profile_photo.jpg') }}" alt="User Avatar" style="float: right" width="100px" height="100px">
                                        </div>
                                        <div class="text-xs-right">
                                            <button type="submit" class="btn btn-rounded btn-primary mb-5">Update</button>
                                        </div>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                </div>
    </section>
    @section('dashboard_script')
    <script type="text/javascript">
        $(document).ready(function(){
        $('#image').change(function(e){
            let reader = new FileReader();
            reader.onload = function(e){
                $('#show-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
    </script>
    @endsection
@endsection
