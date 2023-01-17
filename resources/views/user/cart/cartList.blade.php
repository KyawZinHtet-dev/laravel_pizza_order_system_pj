@extends('user/layouts/master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12 noti">
                <div class="alert-msg"></div>
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <span class="breadcrumb-item active">Cart</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Cart Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="cartTable">
                    <thead class="thead-dark">
                        <tr>
                            <th></th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cartDatas as $cartData)
                            <tr>
                                <td class="align-middle"><img
                                        src="{{ asset('storage/product_images/' . $cartData->image) }}" alt=""
                                        style="width: 80px;"></td>
                                <td class="align-middle">{{ $cartData->product_name }}</td>
                                <td class="align-middle" id="productPrice">{{ $cartData->product_price }}ks</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus minusBtn">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text"
                                            class="form-control form-control-sm bg-secondary border-0 text-center"
                                            value="{{ $cartData->qty }}" id="qty">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus plusBtn">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <input type="hidden" id="user_id" value="{{ $cartData->user_id }}">
                                <input type="hidden" class="product_id" value="{{ $cartData->product_id }}">
                                <input type="hidden" id="cart_id" value="{{ $cartData->cart_id }}">
                                <td class="align-middle col-2" id="totalPrice">
                                    {{ $cartData->product_price * $cartData->qty }}ks</td>
                                <td class="align-middle"><button class="btn btn-danger removeBtn"><i
                                            class="fa fa-times"></i></button></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart
                        Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="border-bottom pb-2">
                        <div class="d-flex justify-content-between mb-3">
                            <h6>Subtotal</h6>
                            <h6 id="finalPrice">{{ $totalPrice }}ks</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">Delivery</h6>
                            <h6 class="font-weight-medium">{{ $deliveryFeed }}ks</h6>
                        </div>
                    </div>
                    <div class="pt-2">
                        <div class="d-flex justify-content-between mt-2">
                            <h5>Total</h5>
                            <h5 id="lastPrice">{{ $totalPrice + $deliveryFeed }}ks</h5>
                        </div>
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" id="orderBtn">Proceed To
                            Checkout</button>
                        <button class="btn btn-block btn-danger font-weight-bold my-3 py-3" id="clearBtn">Clear
                            Cart</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
@section('jqueryCode')
    <script>
        $('document').ready(function() {

            // for plus button
            $('.plusBtn').click(function() {
                // get products datas
                let productPrice = parseInt($(this).parents('tr').find('#productPrice').text());
                let productAmount = parseInt($(this).parents('tr').find('#qty').val());

                // find total price and add to Table
                let totalPrice = productPrice * productAmount;
                $(this).parents('tr').find('#totalPrice').text(totalPrice + 'ks')

                summaryPriceCalc();
            })

            // for minus button
            $('.minusBtn').click(function() {
                // get products datas
                let productPrice = parseInt($(this).parents('tr').find('#productPrice').text());
                let productAmount = parseInt($(this).parents('tr').find('#qty').val());

                // find total price and add to Table
                let totalPrice = productPrice * productAmount;
                $(this).parents('tr').find('#totalPrice').text(totalPrice + 'ks')

                summaryPriceCalc();
            })

            // for remove button
            $('.removeBtn').click(function() {
                // remove cart list one row
                let product_id = $(this).parents('tr').find('.product_id').val();
                let cart_id = $(this).parents('tr').find('#cart_id').val();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/cart/remove',
                    data: {
                        productId: product_id,
                        cartId: cart_id
                    },
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            let cartCount = $('#cartCount').text();
                            $('#cartCount').text(parseInt($('#cartCount').text()) - 1);
                        }
                    }

                })

                $(this).parents('tr').remove();

                summaryPriceCalc();
            })

            // clear cart
            $('#clearBtn').click(function() {
                $('#cartTable tbody tr').remove();

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/cart/clear',
                    dataType: 'json',
                    success: function(response) {
                        if (response.status == 'success') {
                            $('#cartCount').text('0');
                        }
                    }
                })

                summaryPriceCalc();
            })

            // common function for final price and last price
            function summaryPriceCalc() {
                // get product total price row by row and get as final price
                let finalPrice = 0;
                $('#cartTable tbody tr').each(function(index, row) {
                    finalPrice += Number($(row).find('#totalPrice').text().replace('ks', ''));
                })

                // add to ui
                $('#finalPrice').text(finalPrice + 'ks');
                $('#lastPrice').text(finalPrice + 3000 + 'ks'); // lastPrice also include delivery price
            }

            //when check out the cart list
            $('#orderBtn').click(function() {

                let orderList = {};
                let randomCode = Math.floor((Math.random() * 10000) + 1);
                let date = new Date().toJSON().slice(2, 10).replace(/-/g, '');



                $('#cartTable tbody tr').each(function(index, row) {
                    orderList[index] = {
                        user_id: parseInt($(row).find('#user_id').val()),
                        product_id: parseInt($(row).find('.product_id').val()),
                        qty: parseInt($(row).find('#qty').val()),
                        total_price: parseInt($(row).find('#totalPrice').text()),
                        order_code: 'PZS' + parseInt($(row).find('#user_id').val()) + date +
                            randomCode,
                    };
                })

                $.ajax({
                    type: 'get',
                    url: '/user/ajax/order',
                    dataType: 'json',
                    data: orderList,
                    success: function(response) {
                        if (response.status == 'success') {

                            $('#cartCount').text('0');
                            $('#orderCount').text(parseInt($('#orderCount').text()) + 1);
                            $('#cartTable tbody tr').remove();
                            $('#finalPrice').text('0ks');
                            $('#lastPrice').text('3000ks');

                            $('.noti .alert-msg').html(`
                            <div class="alert alert-success alert-dismissible fade show col" role="alert">
                                <strong class=" mr-2">Ordering Success!</strong>Please be patient, your orders is under cooking.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            `);
                        }
                    }
                })
            })

        })
    </script>
@endsection
