{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
           Hi..{{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        This is just home page 
    </div>
</x-app-layout> --}}

@extends('frontend.frontend_master')

@section('frontend_content')
<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="col-md-2">
                <img class="rounded-circle" src="{{ !empty($user->profile_photo_path) ? url('storage/profile_photos/'.$user->profile_photo_path) : url('storage/profile_photos/blank_profile_photo.jpg') }}" alt="User Avatar" height="100%" width="100%">
                <ul class="list-group list-group-flush">
                    <a href="" class="btn btn-primary btn-sm btn-block">Home</a>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary btn-sm btn-block">Profile Update</a>
                    <a href="" class="btn btn-primary btn-sm btn-block">Change Password</a>
                    <a href="{{ route('user.logout') }}" class="btn btn-primary btn-sm btn-block">Logout</a>
                </ul>
            </div>
            <div class="col-md-6 m-auto">
                <div class="card">
                    <h3 class="text-center">
                        <span class="text-danger">Hi.....</span>
                        <strong>{{ Auth::user()->name }}</strong>
                        Welcome To Easy Online Shop
                    </h3>
                    @yield('userdashboard_content')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
