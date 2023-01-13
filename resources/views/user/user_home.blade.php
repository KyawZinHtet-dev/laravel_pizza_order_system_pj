@extends('user.layouts.master')
@section('content')
    <!-- Shop Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Product Start -->
            <div class="col-lg-12 col-md-12">
                <div class="row pb-3">
                    <div class="col-2 offset-10 mb-3">
                        <select name="sortOption" id="sortOption"
                            class=" form-control form-control-sm w-75 bg-dark text-white rounded-bottom">
                            <option value='0' selected>Filter With Price...(All)</option>
                            <option value="10000">10000ks</option>
                            <option value="20000">20000ks</option>
                            <option value="30000">30000ks</option>
                            <option value="40000">40000ks</option>
                        </select>
                    </div>
                    <span class=" row" id="productList">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6 pb-1" id="products">
                                <div class="product-item bg-light mb-4">
                                    <div class="product-img position-relative overflow-hidden">
                                        <img class="img-fluid w-100"
                                            src="{{ asset('storage/product_images/' . $product->image) }}" alt=""
                                            style="height: 220px">
                                        <div class="product-action">
                                            <input type="hidden" class="productId" value="{{ $product->product_id }}">
                                            <a class="btn btn-outline-dark btn-square addToCartBtn"><i
                                                    class="fa fa-shopping-cart"></i></a>
                                            <a class="btn btn-outline-dark btn-square"
                                                href="{{ route('user#showProductDetailPage', $product->product_id) }}"><i
                                                    class="fas fa-info-circle"></i></a>
                                        </div>
                                    </div>
                                    <div class="text-center py-4">
                                        <a class="h6 text-decoration-none text-truncate"
                                            href="">{{ $product->name }}</a>
                                        <div class="d-flex align-items-center justify-content-center mt-2">
                                            <h5>{{ $product->price }}ks</h5>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-center mb-1">
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                            <small class="fa fa-star text-primary mr-1"></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </span>
                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->
@endsection
@section('jqueryCode')
    <script>
        $(document).ready(function() {

            // when choose filter option
            $('#sortOption').change(function() {
                let sortOption = $('#sortOption').val();
                console.log(sortOption);
                $.ajax({
                    type: 'get',
                    url: '/user/ajax/product/list',
                    dataType: 'json',
                    data: {
                        'sortOpt': sortOption
                    },

                    success: function(response) {
                        console.log(response);
                        let productList = '';
                        response.forEach(product => {
                            productList += `
                                    <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                                        <div class="product-item bg-light mb-4">
                                            <div class="product-img position-relative overflow-hidden">
                                                <img class="img-fluid w-100" src="{{ asset('storage/product_images/${product.image}') }}" alt="" style="height: 220px">
                                                <div class="product-action">
                                                    <input type="hidden" class="productId" value="${product.product_id}">
                                                    <a class="btn btn-outline-dark btn-square addToCartBtn"><i class="fa fa-shopping-cart"></i></a>
                                                    <a class="btn btn-outline-dark btn-square" href="http://127.0.0.1:8000/user/product/detail/${product.product_id}"><i class="fas fa-info-circle"></i></a>
                                                </div>
                                            </div>
                                            <div class="text-center py-4">
                                                <a class="h6 text-decoration-none text-truncate" href="">${product.name}</a>
                                                <div class="d-flex align-items-center justify-content-center mt-2">
                                                    <h5>${ product.price}ks</h5><h6 class="text-muted ml-2"></h6>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-center mb-1">
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                    <small class="fa fa-star text-primary mr-1"></small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            $('#productList').html(productList);
                        });
                    }
                })
            })


            // when click cart icon
            $('#productList').on("click", ".addToCartBtn", function() {

                let product_id = $(this).parents('div .product-action').find('.productId').val();
                $.ajax({
                    type: 'get',
                    url: 'http://127.0.0.1:8000/user/ajax/cart/add',
                    dataType: 'json',
                    data: {
                        'productId': product_id
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#cartCount').text(parseInt($('#cartCount').text()) + 1);
                        }
                    }
                })
            })
        })
    </script>
@endsection
