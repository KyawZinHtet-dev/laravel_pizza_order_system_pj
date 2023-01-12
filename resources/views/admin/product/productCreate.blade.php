@extends('admin.layouts.master')
@section('title')
    <title>Product Create Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card shadow shadow-md">
                        <a href="{{ route('admin#home') }}" class=" text-dark ml-2 mt-2"><i class=" zmdi zmdi-arrow-left"></i>
                            Back</a>
                        <div class="card-title">
                            <h3 class="text-center title-2">Create New Product</h3>
                        </div>
                        <hr>
                        <div class="card-body">
                            <form action="{{ route('product#create') }}" method="POST" novalidate="novalidate"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="cc-payment" class=" text-dark">Pizza Name</label>
                                    <input id="cc-pament" name="pizzaName" type="text"
                                        class="form-control form-control-sm @error('pizzaName') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder=""
                                        value="{{ old('pizzaName') }}">
                                    @error('pizzaName')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <label for="cc-payment" class="control-label text-dark mt-3">Pizza Description</label>
                                    <textarea name="pizzaDesc" class=" form-control form-control-sm  @error('pizzaDesc') is-invalid @enderror"
                                        id="cc-payment" cols="30" rows="3">{{ old('pizzaDesc') }}</textarea>
                                    @error('pizzaDesc')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <label for="cc-payment" class="control-label text-dark mt-3">Pizza Category</label>
                                    <select name="category_id" id="cc-payment"
                                        class=" form-control form-control-sm  @error('category_id') is-invalid @enderror">
                                        <option value="">Select Category <li class="nav-item">
                                        </option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}" class=" form-control"
                                                @if (old('category_id') == $category->category_id) {{ 'selected' }} @endif>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <label for="cc-payment" class=" text-dark mt-3">Pizza Image</label>
                                    <input type="file" name="pizzaImage" id="cc-payment"
                                        class=" form-control form-control-sm mb-2  @error('pizzaImage') is-invalid @enderror">
                                    @error('pizzaImage')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <label for="cc-payment" class="text-dark mt-3">Pizza Price</label>
                                    <input id="cc-pament" name="pizzaPrice" type="number"
                                        class="form-control form-control-sm mb-2 @error('pizzaPrice') is-invalid @enderror"
                                        aria-required="true" aria-invalid="false" placeholder=""
                                        value="{{ old('pizzaPrice') }}">
                                    @error('pizzaPrice')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                </div>
                                <div>
                                    <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                        <span id="payment-button-amount">Create</span>
                                        <i class="zmdi zmdi-pizza"></i>
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
