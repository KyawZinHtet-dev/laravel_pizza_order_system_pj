@extends('admin.layouts.master')
@section('title')
    <title>Profile Pic Edit</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <a href="{{ route('adminAccount#editPage') }}" class=" text-dark ml-2 mt-2"><i
                                class=" zmdi zmdi-arrow-left"></i> Back</a>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add New Profile Photo</h3>
                            </div>
                            <hr>
                            <div class=" text-center">
                                <img src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                    alt="user photo" class="w-25 img-thumbnail" />
                            </div>
                            <form action="{{ route('adminAccount#profilePicEdit') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="image" class=" text-left text-dark">Choose an image</label>
                                <input type="file" name="image" id="image"
                                    class=" form-control form-control-sm @error('image') is-invalid @enderror">
                                @error('image')
                                    <small class=" invalid-feedback">{{ $message }}</small>
                                @enderror
                                <br>
                                <button class=" btn btn-primary w-100" type="submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
