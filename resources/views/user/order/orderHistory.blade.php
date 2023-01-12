@extends('user/layouts/master')
@section('content')
    <!-- Breadcrumb Start -->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <div class="col-12">
                <nav class="breadcrumb bg-light mb-30">
                    <a class="breadcrumb-item text-dark" href="{{ route('user#home') }}">Home</a>
                    <span class="breadcrumb-item active">Order History</span>
                </nav>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 500px">
        <div class="row px-xl-5">
            <div class="table-responsive mb-5">
                <table class="table table-light table-borderless table-hover text-center mb-0" id="cartTable">
                    <thead class="thead-dark">
                        <tr>
                            <th>User Name</th>
                            <th>Order Code</th>
                            <th>Date</th>
                            <th>Carges</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                       @foreach($orders as $order)
                       <tr>
                        <td class="align-middle">{{ $order->user_name }}</td>
                        <td class="align-middle">{{$order->order_code }}</td>
                        <td class="align-middle">{{ $order->created_at->format('d-M-y hA') }}</td>
                        <td class="align-middle  col-2">{{ $order->total_price }}ks</td>
                        <td class=" align-middle">
                            @if ($order->status == 0)
                                <small class=" text-warning"><i class=" fas fa-clock"></i> Pending</small>
                            @elseif($order->status == 1)
                                <small class=" text-success"><i class="fas fa-check"></i> Success</small>
                            @elseif($order->status == 2)
                                <small class=" text-danger"><i class=" fas fa-warning"></i> Rejected</small>
                            @endif
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('order#showOrderedItemsPage',['orderCode' => $order->order_code])}}">
                                <button class="btn btn-info btn-sm"><i class=" fas  fa-book text-white"></i></button>
                            </a>
                        </td>
                    </tr>
                       @endforeach
                    </tbody>
                </table>
                <div class=" mt-5">{{ $orders->links() }}</div>
            </div>
        </div>
    </div>
    <!-- Cart End -->
@endsection
