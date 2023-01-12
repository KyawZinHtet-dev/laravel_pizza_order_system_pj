@extends('layouts/master')
@section('title')
    <title>Login</title>
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
                            <form action="{{ route('login') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <input class=" form-control  @error('email') is-invalid @enderror" type="email"
                                        name="email" placeholder="Email">
                                    @error('email')
                                        <small class=" text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input class=" form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" placeholder="Password">
                                    @error('password')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>

                                <button class="au-btn au-btn--block au-btn--green m-b-20" type="submit">sign in</button>

                            </form>
                            <div class="register-link">
                                <p>
                                    Don't you have account?
                                    <a href="{{ route('auth#registerPage') }}">Sign Up Here</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
