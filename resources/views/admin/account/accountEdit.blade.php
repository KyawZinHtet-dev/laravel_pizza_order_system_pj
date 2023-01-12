@extends('admin.layouts.master')
@section('title')
    <title>Account Edit</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
                @if(session('photoUpdateMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Attention!</strong> {{ session('photoUpdateMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if(session('deletePpMsg'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Attention!</strong> {{ session('deletePpMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            <div class="container-fluid">
                <div class="row bg-white shadow shadow-md mt-3">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3"><img
                                class="rounded-circle mt-5 img-thumbnail"
                                src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                width="90" alt="user photo">
                            <span class="font-weight-bold">{{ Auth::user()->name }}</span>
                            <span class="text-black-50">{{ Auth::user()->email }}</span>
                            <div class=" mt-5">
                                <a href="{{ route('adminAccount#profilePic') }}" class=" text-warning">Add
                                    Profile Photo</a>
                            </div>
                            <div class=" mt-1">
                                <a href="{{ route('adminAccount#profilePicDelete') }}" class=" text-danger" onclick="return confirm('Are you sure to delete your profile photo?')">Delete Profile
                                    Photo</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7 offset-1">
                        <div class="p-3">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <h4 class="text-right">Edit Profile</h4>
                            </div>
                            <hr>
                            <form action="{{ route('adminAccount#edit') }}" method="POST">
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
                                    <a href="{{ route('adminAccount#detail') }}" class=" text-dark mt-2"><i
                                            class=" zmdi zmdi-arrow-left"></i>
                                        Back</a>
                                    <button class="btn btn-primary" type="submit">Save Profile</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
