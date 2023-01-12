@extends('admin.layouts.master')
@section('title')
    <title>Category Create Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-lg-8 offset-2">
                    <div class="card bg-white shadow shadow-md mt-3">
                        <div class=" card-header">
                            <a href="{{ Session::get('prevUrl') }}" class=" text-dark"><i class=" zmdi zmdi-arrow-left"></i>
                                Back</a>
                            <h3 class="text-center">About Product</h3>
                        </div>
                        <div class="card-body row">
                            <div class=" col col-4">
                                <img src="{{ asset('/storage/product_images/' . $product->image) }}" alt=""
                                    class=" img-thumbnail">
                            </div>
                            <div class=" col col-1"></div>
                            <div class=" col col-6">
                                <div>
                                    <h5 class="border-bottom mb-2">Product Name</h5>
                                    <div>{{ $product->name }}</div>
                                </div><br>
                                <div>
                                    <h5 class=" border-bottom mb-2">Product Description</h5>
                                    <div>{{ $product->description }}</div>
                                </div><br>
                                <div>
                                    <h5 class=" border-bottom mb-2">Product Category</h5>
                                    <div>{{ $product->category_name }}</div>
                                </div><br>
                                <div>
                                    <h5 class=" border-bottom mb-2">Product Price</h5>
                                    <div>{{ $product->price }}ks</div>
                                </div><br>
                                <div>
                                    <h5 class=" border-bottom mb-2">Product Created Date</h5>
                                    <div>{{ $product->created_at->format('d-M-Y h:mA') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
