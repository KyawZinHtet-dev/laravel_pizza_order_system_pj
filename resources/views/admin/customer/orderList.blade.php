@extends('admin.layouts.master')
@section('title')
    <title>Customer Order List</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="">
                    <a href="{{ route('admin#customerList') }}" class=" text-dark"><i class=" zmdi zmdi-arrow-left"></i>
                        Back</a>
                </div>
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class=" mb-4">
                        <div class=" d-flex justify-content-center">
                            <h2 class="title-1"> Order History</h2>
                        </div>
                    </div>

                    @if (count($orderList) != 0)
                        <div class="table-responsive table-responsive-data2 text-center" id="table">
                            <table class="table table-data2 table-hover">
                                <thead class=" bg-success">
                                    <tr>
                                        <th class="col col-2 text-white">User Name</th>
                                        <th class="col col-3 text-white">Order Code</th>
                                        <th class="col col-2 text-white">Date</th>
                                        <th class="col col-2 text-white">Charges</th>
                                        <th class="text-white col col-2 pr-5">Status</th>
                                    </tr>
                                </thead>
                                <tbody class=" orderList">
                                    @foreach ($orderList as $order)
                                        <tr class="tr-shadow">
                                            <td class=" col col-2"> {{ $order->name }}</td>
                                            <td class="desc col col-3"><a
                                                    href="{{ route('order#showOrderingItemsPage', $order->order_code) }}">{{ $order->order_code }}</a>
                                            </td>
                                            <td class=" col col-2">{{ $order->created_at->format('d-M-y hA') }}</td>
                                            <td class=" col col-2">{{ $order->total_price }}ks</td>
                                            <td
                                                class=" col col-2 @if ($order->status == 0) text-warning @elseif($order->status == 1) text-success @elseif($order->status == 2) text-danger @endif">
                                                @if ($order->status == 0)
                                                    Pending
                                                @elseif($order->status == 1)
                                                    Success
                                                @elseif($order->status == 2)
                                                    Rejected
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class=" text-center"><i class=" zmdi zmdi-alert-triangle"></i>No Order Yet!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
