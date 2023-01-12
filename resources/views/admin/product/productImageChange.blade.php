@extends('admin.layouts.master')
@section('title')
    <title>Produt Image Change Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-6 offset-3">
                    <div class="card">
                        <a href="{{ route('product#edit', $product->product_id) }}" class=" text-dark ml-2 mt-2"><i
                                class=" zmdi zmdi-arrow-left"></i> Back</a>
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Add New Product Image</h3>
                            </div>
                            <hr>
                            <div class=" text-center">
                                <img src="{{ asset('storage/product_images/' . $product->image) }}" alt="product image"
                                    class="w-50 img-thumbnail" />
                            </div>
                            <form action="{{ route('product#changeImage', $product->product_id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <label for="image" class=" text-left text-dark">Choose an image</label>
                                <input type="file" name="productImage" id="image"
                                    class=" form-control form-control-sm @error('productImage') is-invalid @enderror">
                                @error('productImage')
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
