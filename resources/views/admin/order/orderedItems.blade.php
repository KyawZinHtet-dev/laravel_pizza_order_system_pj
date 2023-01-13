@extends('admin.layouts.master')
@section('title')
    <title>Ording Items</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="">
                    <a href="{{ Session::get('prevUrl') }}" class=" text-dark"><i class=" zmdi zmdi-arrow-left"></i>
                        Back</a>
                </div>
                <div class="card card-body col-md-5 offset-3">
                    <h4 class="text-center">Order Info</h4>
                    <small class=" text-warning text-center mt-2">(Already include delivery feed!)</small>
                    <div class=" row mt-3">
                        <b class=" col col-6"><i class=" fas fa-user mr-2 text-info"></i> Customer Name</b>
                        <span class=" col col-1">:</span>
                        <p class=" col">{{ $orderInfo->name }}</p>
                    </div>
                    <div class="row mt-1">
                        <b class=" col col-6"><i class=" fas fa-qrcode mr-2 text-primary"></i>Order Code</b>
                        <span class=" col col-1">:</span>
                        <p class=" col">{{ $orderInfo->order_code }}</p>
                    </div>
                    <div class="row mt-1">
                        @if ($orderInfo->status == 0)
                            <b class=" col col-6"><i class=" fas fa-circle mr-2 text-warning"></i>Order Status</b>
                            <span class=" col col-1">:</span>
                            <p class=" col text-warning">Pending</p>
                        @elseif($orderInfo->status == 1)
                            <b class=" col col-6"><i class=" fas fa-circle mr-2 text-success"></i>Order Status</b>
                            <span class=" col col-1">:</span>
                            <p class=" col text-success">Success</p>
                        @elseif($orderInfo->status == 2)
                            <b class=" col col-6"><i class=" fas fa-circle mr-2 text-danger"></i>Order Status</b>
                            <span class=" col col-1">:</span>
                            <p class=" col text-danger">Reject</p>
                        @endif
                    </div>
                    <div class="row mt-1">
                        <b class=" col col-6"><i class=" fas fa-calendar-alt mr-2 text-secondary"></i>Ordering Date</b>
                        <span class=" col col-1">:</span>
                        <p class=" col">{{ $orderInfo->created_at->format('d-M-y hA') }}</p>
                    </div>
                    <div class="row mt-1">
                        <b class=" col col-6"><i class=" fas fa-money mr-2 text-success"></i>Total Charges</b>
                        <span class=" col col-1">:</span>
                        <p class=" col">{{ $orderInfo->total_price }}ks</p>
                    </div>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-responsive table-responsive-data2">
                        <table class="table table-data2 table-hover">
                            <thead class=" bg-c3">
                                <tr>
                                    <th scope="col" class=" text-dark"></th>
                                    <th scope="col" class=" text-dark">Product Name</th>
                                    <th scope="col" class=" text-dark">Quantity</th>
                                    <th scope="col" class=" text-dark">Price</th>
                                    <th scope="col" class=" text-dark">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderingItems as $orderingItem)
                                    <tr>
                                        <th style=" border:none; vertical-align:middle;">
                                            <img class=" ml-3"
                                                src="{{ asset('/storage/product_images/' . $orderingItem->image) }}"
                                                alt="" style="width:80px;">
                                        </th>
                                        <td>
                                            <div>{{ $orderingItem->product_name }}</div>
                                        </td>
                                        <td>
                                            <div class="mx-4">{{ $orderingItem->qty }}</div>
                                        </td>
                                        <td>
                                            <div>{{ $orderingItem->product_price }}ks</div>
                                        </td>
                                        <td>
                                            <div>{{ $orderingItem->total_price }}Ks</div>
                                        </td>
                                    </tr>
                                    <tr class="spacer"></tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
