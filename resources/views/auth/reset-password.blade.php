{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email', $request->email)" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Reset Password') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout> --}}

@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content">
	<div class="container">
		<div class="sign-in-page">
			<div class="row">
				<!-- Sign-in -->
<div class="col-md-12 col-sm-12 sign-in m-auto">
	<h4 class="">Password Reset Form</h4>
	<p class="">Provide information to all fields</p>
	<form class="register-form outer-top-xs" role="form" action="{{ route('password.update') }}" method="POST">
        @csrf
        <input type="hidden" name="token" value="{{ $request->route('token') }}">
		<div class="form-group">
		<label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		<input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
		</div>
        @error('email')
            <span class="alert text-danger">{{ $message }}</span>
        @enderror
	  	<div class="form-group">
		    <label class="info-title" for="exampleInputPassword1">Password <span>*</span></label>
		    <input type="password" name="password" class="form-control unicase-form-control text-input" id="exampleInputPassword1">
		</div>
        @error('password')
            <span class="alert text-danger">{{ $message }}</span>
        @enderror
        <div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Confirm Password <span>*</span></label>
		    <input type="password" name="password_confirmation" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
		</div>
        @error('password_confirmation')
            <span class="alert text-danger">{{ $message }}</span>
        @enderror
	<button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __("RESET PASSWORD") }}</button>
	</form>
</div>
<!-- Sign-in -->	
</div><!-- /.row -->
		</div><!-- /.sigin-in-->
		</div><!-- /.container -->
</div>
@endsection

