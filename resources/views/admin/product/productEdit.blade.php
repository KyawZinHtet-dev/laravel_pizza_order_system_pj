@extends('admin.layouts.master')
@section('title')
    <title>Edit Product Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            @if(session('imgChangeMsg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Attention!</strong> {{ session('imgChangeMsg') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
           @endif
            <div class="container-fluid">
                <div class="col-lg-10 offset-1">
                    <div class="card bg-white shadow shadow-md mt-3">
                        <div class=" card-header">
                            <a href="{{ Session::get('prevUrl') }}" class=" text-dark"><i class=" zmdi zmdi-arrow-left"></i>
                                Back</a>
                            <h3 class="text-center">Edit Product</h3>
                        </div>
                        <div class="card-body row">
                            <div class=" col col-4">
                                <div>
                                    <img src="{{ asset('/storage/product_images/' . $product->image) }}" alt=""
                                        class=" img-thumbnail">
                                </div>
                                <div class=" mt-3 text-center">
                                    <a href="{{ route('product#imageChange', $product->product_id) }}"
                                        class="btn btn-warning">Change
                                        product image</a>
                                </div>
                            </div>
                            <div class=" col col-1"></div>
                            <div class=" col col-7">
                                <form action="{{ route('product#edit', $product->product_id) }}" method="POST">
                                    @csrf
                                    <label for="productName" class=" text-dark">Product Name</label>
                                    <input type="text" name="productName" id="productName"
                                        value="{{ old('productName', $product->name) }}"
                                        class=" form-control @error('productName') {{ 'is-invalid' }} @enderror">
                                    @error('productName')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <label for="productDesc" class=" text-dark">Product Description</label>
                                    <textarea name="productDesc" id="productDesc" cols="30" rows="5"
                                        class=" form-control @error('productDesc') {{ 'is-invalid' }} @enderror">
                                        {{ old('productDesc', $product->description) }}
                                    </textarea>
                                    @error('productDesc')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <label for="productCategory" class=" text-dark">Product Categry</label>
                                    <select name="productCategory" id="productCategory" class=" form-control">
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->category_id }}"
                                                @if ($product->category_id == $category->category_id) {{ 'selected' }} @endif>
                                                {{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('productCategory')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror
                                    <br>
                                    <label for="productPrice" class=" text-dark">Product Price</label>
                                    <input type="number" name="productPrice" id="productPrice"
                                        value="{{ old('productPrice', $product->price) }}"
                                        class=" form-control @error('productPrice') {{ 'is-invalid' }} @enderror">
                                    @error('productPrice')
                                        <small class=" invalid-feedback">{{ $message }}</small>
                                    @enderror

                                    <div class=" text-center mt-2">
                                        <input type="submit" value="Save" class=" btn btn-primary w-100">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
