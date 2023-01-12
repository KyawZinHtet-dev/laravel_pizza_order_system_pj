@extends('user/layouts/master')
@section('content')
<div class="container-fluid">
    <div class="col-lg-6 offset-3">
        <div class="card bg-white shadow shadow-md mt-3">
            <div class=" card-header">
                <h3 class="text-center">Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('user#changePass') }}" method="POST" novalidate="novalidate">
                    @csrf
                    <div class="form-group">
                        <label for="cc-payment" class="control-label mb-1">Current Password</label>
                        <input id="cc-pament" name="currentPass" type="password"
                            class="form-control @error('currentPass') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" value="">
                        @error('currentPass')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror
                        @if (session('wrongOldPass'))
                            <small class=" text-danger">{{ session('wrongOldPass') }}</small><br>
                        @endif

                        <label for="cc-payment" class="control-label mb-1">New Password</label>
                        <input id="cc-pament" name="newPass" type="password"
                            class="form-control @error('newPass') is-invalid @enderror" aria-required="true"
                            aria-invalid="false" value="">
                        @error('newPass')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror

                        <label for="cc-payment" class="control-label mb-1">Confirm New Password</label>
                        <input id="cc-pament" name="confirmNewPass" type="password"
                            class="form-control @error('confirmNewPass') is-invalid @enderror"
                            aria-required="true" aria-invalid="false" value="">
                        @error('confirmNewPass')
                            <small class=" invalid-feedback">{{ $message }}</small>
                        @enderror
                    </div>
                    <hr>
                    <div class=" d-flex justify-content-between">
                        <a href="{{ route('user#home') }}" class=" text-dark ml-2 mt-2"><i
                                class=" fas fa-arrow-left"></i>
                            Back</a>
                        <button id="payment-button" type="submit" class="btn btn-primary">
                            <i class=" fas fa-key"></i> <span id="payment-button-amount">Submit</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
