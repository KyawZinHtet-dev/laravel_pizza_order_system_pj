@extends('user/layouts/master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <a class="breadcrumb-item text-dark" href="{{ route('order#showOrderHistoryPage') }}">Order History</a>
                    <span class="breadcrumb-item active">Ordered Items</span>
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
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach($orderedItems as $orderedItem)
                    <tr>
                        <td class="align-middle col-2"><img src="{{ asset('storage/product_images/'.$orderedItem->image) }}" alt="" style="width: 80px;"></td>
                        <td class="align-middle">{{ $orderedItem->product_name }}</td>
                        <td class="align-middle">{{ $orderedItem->product_price }}ks</td>
                        <td class="align-middle">{{ $orderedItem->qty }}</td>
                        <td class="align-middle col-2">{{ $orderedItem->product_price * $orderedItem->qty }}ks</td>
                    </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
