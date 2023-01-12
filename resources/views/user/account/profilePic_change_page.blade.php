@extends('user.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="col-lg-6 offset-3 mt-5">
        <div class="card shadow shadow-md">
            <a href="{{ route('user#showAccountEditPage') }}" class=" text-dark ml-2 mt-2"><i
                    class=" fas fa-arrow-left"></i> Back</a>
            <div class="card-body">
                <div class="card-title">
                    <h3 class="text-center title-2">Add New Profile Photo</h3>
                </div>
                <hr>
                <div class=" text-center">
                    <img src="@if (Auth::user()->profile_image == null) {{ asset('storage/default_user.jpg') }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                        alt="user photo" class="w-25 img-thumbnail" />
                </div>
                <form action="{{ route('user#changeProfilePic') }}" method="POST"
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
@endsection
