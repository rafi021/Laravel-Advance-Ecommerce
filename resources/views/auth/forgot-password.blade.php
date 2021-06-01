{{-- <x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-jet-button>
                    {{ __('Email Password Reset Link') }}
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
            <h4 class="">Forget Password</h4>
            <p class="">{{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}</p>
            <form class="register-form outer-top-xs" role="form" action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
                    <input type="email" name="email" class="form-control unicase-form-control text-input" id="exampleInputEmail1">
                </div>
                <button type="submit" class="btn-upper btn btn-primary checkout-page-button">{{ __('Email Password Reset Link') }}</button>
            </form>
        </div>
        <!-- Sign-in -->
    </div><!-- /.row -->
</div><!-- /.sigin-in-->
</div><!-- /.container -->
</div>
@endsection
