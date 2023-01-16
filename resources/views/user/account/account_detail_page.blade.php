@extends('user.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="col-lg-6 offset-3">
            <div class=" card bg-white shadow shadow-md mt-3">
                <div class=" card-header">
                    <h4 class=" text-center">Account Profile</h4>
                </div>
                <div class=" card-body mt-1 mb-1">
                    <div class=" row">
                        <div class=" col col-4 text-center mt-2">
                            <img src="@if (Auth::user()->profile_image == null) {{ 'https://img.freepik.com/free-icon/user_318-704197.jpg' }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                class=" w-75 img-thumbnail" alt="user photo">
                            <div>
                                <h5 class=" mt-3">{{ Auth::user()->name }}</h5>
                                <p>{{ Auth::user()->email }}</p>
                            </div>
                        </div>
                        <div class=" col col-8">
                            <div class=" row offset-3">
                                <p class=" text-dark">Name : ________ {{ Auth::user()->name }}</p>
                            </div>
                            <div class=" row offset-3 mt-1">
                                <p class=" text-dark">Email : ________ {{ Auth::user()->email }}</p>
                            </div>
                            <div class=" row offset-3 mt-1">
                                <p class=" text-dark">Address : ________ {{ Auth::user()->address }}</p>
                            </div>
                            <div class=" row offset-3 mt-1">
                                <p class=" text-dark">Phone : ________ {{ Auth::user()->ph_no }}</p>
                            </div>
                            <div class=" row offset-3 mt-1">
                                <p class=" text-dark">Join Date : ________ {{ Auth::user()->created_at->format('d-M-Y') }}
                                </p>
                            </div>
                            <div class=" row offset-3 mt-1">
                                <p class=" text-dark">Role : ________ {{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class=" card-footer">
                    <div class=" d-flex justify-content-between">
                        <a href="{{ route('user#home') }}" class=" text-dark"><i class=" fas fa-arrow-left mt-2"></i>
                            Back</a>

                        <a href="{{ route('user#showAccountEditPage') }}" class=" btn btn-primary">Edit Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
