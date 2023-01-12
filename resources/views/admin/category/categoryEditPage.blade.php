@extends('admin.layouts.master')
@section('title')
    <title>Category Create Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <a href="{{ Session::get('prevUrl') }}" class=" text-dark ml-2 mt-2"><i
                                class=" zmdi zmdi-arrow-left"></i> Back</a>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Edit Category Name</h3>
                            </div>
                            <hr>
                            <form action="{{ route('category#update', $category->category_id) }}" method="POST"
                                novalidate="novalidate">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class="control-label mb-1">Name</label>
                                    <input id="cc-pament" name="categoryName" type="text"
                                        class="form-control @error('categoryName') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder="Seafood..."
                                        value="{{ old('categoryName', $category->name) }}">
                                    @error('categoryName')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Update</span>
                                        <i class=" zmdi zmdi-upload"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
