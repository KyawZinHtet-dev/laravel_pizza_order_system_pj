@extends('user.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row col-lg-8 offset-2 bg-white shadow shadow-md mt-5">
        <div class="col-md-3 border-right mb-3">
            <div class="d-flex flex-column align-items-center text-center p-3"><img
                    class="rounded-circle mt-3 img-thumbnail"
                    src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                     alt="user photo">
                <span class="font-weight-bold mt-3">{{ Auth::user()->name }}</span>
                <span class="text-black-50">{{ Auth::user()->email }}</span>
                <div class=" mt-3">
                    <a href="{{ route('user#showProfilePicChangePage') }}" class=" text-warning">Add
                        Profile Photo</a>
                </div>
                <div class=" mt-1">
                    <a href="{{ route('user#deleteProfilePic') }}" class=" text-danger">Delete Profile
                        Photo</a>
                </div>
            </div>
        </div>
        <div class="col-md-7 offset-1 mb-3">
            <div class="p-3">
                <div class="d-flex justify-content-center align-items-center mb-3 mt-2">
                    <h4 class="text-right">Edit Profile</h4>
                </div>
                <hr>
                <form action="{{ route('user#editAccount') }}" method="POST">
                    @csrf
                    <div class="row mt-2">
                        <div class="col-md-6">
                            <label for="name">User Name</label>
                            <input type="text" class="form-control  @error('name') is-invalid @enderror"
                                id="name" value="{{ old('name', Auth::user()->name) }}" name="name">
                            @error('name')
                                <small class=" invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="email">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="email" value="{{ old('email', Auth::user()->email) }}" name="email">
                            @error('email')
                                <small class=" invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="address">Address</label>
                            <input type="text" class="form-control @error('address') is-invalid @enderror"
                                id="address" value="{{ old('address', Auth::user()->address) }}"
                                name="address">
                            @error('address')
                                <small class=" invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="phone">Phone Number</label>
                            <input type="text"
                                class="form-control @error('phone_number') is-invalid @enderror" id="phone"
                                value="{{ old('phone_number', Auth::user()->ph_no) }}" name="phone_number">
                            @error('phone_number')
                                <small class=" invalid-feedback">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="mt-5 d-flex justify-content-between">
                        <a href="{{ route('user#showAccountDetailPage') }}" class=" text-dark mt-2"><i
                                class=" fas fa-arrow-left"></i>
                            Back</a>
                        <button class="btn btn-primary" type="submit">Save Profile</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
