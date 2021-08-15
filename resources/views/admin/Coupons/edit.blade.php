@extends('admin.admin_master')

@section('dashboard_content')
    @include('admin.dashboard_layout.breadcrumb', [
    'name' => 'Coupon',
    'url' => "coupons.index",
    'section_name' => 'All Coupon'
    ])
    <section class="content">
        <div class="row">
            {{-- Edit Coupon Page --}}
            <div class="col-md-8 col-lg-8 offset-2">
                <div class="box">
                    <div class="box-header with-border d-flex justify-content-between align-items-center">
                        <h3 class="box-title">Edit New Coupon</h3>
                        <a href="{{ route('coupons.index') }}" class="btn btn-primary">Back List Coupon</a>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{ route('coupons.update', $coupon) }}" method="post">
                            @method('PUT')
                            @csrf
                            <div class="form-group">
                                <h5>Coupon Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="coupon_name" class="form-control" required="" value="{{ old('coupon_name', $coupon->coupon_name) }}" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('coupon_name')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Coupon Discount (%) <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="number" name="coupon_discount" class="form-control" required="" value="{{ old('coupon_discount', $coupon->coupon_discount) }}" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('coupon_discount')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Coupon Validity <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="date" name="coupon_validity" class="form-control" required="" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" value="{{ old('coupon_validity', $coupon->coupon_validity) }}" data-validation-required-message="This field is required"> <div class="help-block"></div>
                                </div>
                                @error('coupon_validity')
                                    <span class="alert text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <h5>Coupon Status <span class="text-danger"></span></h5>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox"
                                    id="coupon_status" name="coupon_status" checked value="1" {{ $coupon->coupon_status == 1 ? 'checked': '' }}>
                                    <label class="form-check-label" for="coupon_status">Active Status</label>
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
