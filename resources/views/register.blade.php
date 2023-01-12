@extends('layouts.master')
@section('title')
    <title>Register</title>
@endsection
@section('content')
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    <div class="login-content">
                        <div class="login-logo">
                            <a href="#">
                                <img src="{{ asset('admin_dashboard/images/icon/logo.png') }}" alt="CoolAdmin">
                            </a>
                        </div>
                        <div class="login-form">
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                @error('terms')
                                    <small class=" text-danger">{{ $message }}</small>
                                @enderror
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class=" form-control form-control-sm" type="text" name="name"
                                        placeholder="Username" value="{{ old('name') }}">
                                    @error('name')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Phone Number</label>
                                    <input class="form-control form-control-sm" type="number" name="ph_no"
                                        placeholder="09xxxxxxxxx" value="{{ old('ph_no') }}">
                                    @error('ph_no')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <input class="form-control form-control-sm auin" type="text" name="address"
                                        placeholder="Address" value="{{ old('address') }}">
                                    @error('address')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control form-control-sm" type="email" name="email"
                                        placeholder="Email" value="{{ old('email') }}">
                                    @error('email')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control form-control-sm" type="password" name="password"
                                        placeholder="Password">
                                    @error('password')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class="form-control form-control-sm" type="password" name="password_confirmation"
                                        placeholder="Confirm Password">
                                    @error('password_confirmation')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <input class=" au-btn au-btn--block au-btn--green m-b-20" type="submit" value="Register">

                            </form>
                            <div class="register-link">
                                <p>
                                    Already have account?
                                    <a href="{{ route('auth#loginPage') }}">Sign In</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
