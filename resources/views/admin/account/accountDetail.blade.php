@extends('admin.layouts.master')
@section('title')
    <title>Account Detail Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('updateMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Attention!</strong> {{ session('updateMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-lg-8 offset-2">
                    <div class=" card bg-white shadow shadow-md mt-3">
                        <div class=" card-header">
                            <h4 class=" text-center">Account Profile</h4>
                        </div>
                        <div class=" card-body mt-3 mb-3">
                            <div class=" row">
                                <div class=" col col-4 text-center">
                                    <img src="@if (Auth::user()->profile_image == null) {{ 'https://img.freepik.com/free-icon/user_318-704197.jpg' }} @else {{ asset('storage/profile_image/' . Auth::user()->profile_image) }} @endif"
                                        class=" w-50 img-thumbnail" alt="user photo">
                                    <div>
                                        <h4>{{ Auth::user()->name }}</h4>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                </div>
                                <div class=" col col-8">
                                    <div class=" row offset-3">
                                        <p class=" text-dark">Name : ________ </p>
                                        <p>{{ Auth::user()->name }}</p>
                                    </div>
                                    <div class=" row offset-3 mt-3">
                                        <p class=" text-dark">Email : ________ </p>
                                        <p>{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class=" row offset-3 mt-3">
                                        <p class=" text-dark">Address : ________ </p>
                                        <p>{{ Auth::user()->address }}</p>
                                    </div>
                                    <div class=" row offset-3 mt-3">
                                        <p class=" text-dark">Phone : ________ </p>
                                        <p>{{ Auth::user()->ph_no }}</p>
                                    </div>
                                    <div class=" row offset-3 mt-3">
                                        <p class=" text-dark">Join Date : ________ </p>
                                        <p>{{ Auth::user()->created_at->format('d-M-Y') }}</p>
                                    </div>
                                    <div class=" row offset-3 mt-3">
                                        <p class=" text-dark">Role : ________ </p>
                                        <p>{{ Auth::user()->role }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class=" card-footer">
                            <div class=" d-flex justify-content-between">
                                <a href="{{ route('admin#home') }}" class=" text-dark"><i
                                        class=" zmdi zmdi-arrow-left mt-2"></i> Back</a>

                                <a href="{{ route('adminAccount#edit') }}" class=" btn btn-primary">Edit Profile</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
