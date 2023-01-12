@extends('admin.layouts.master')
@section('title')
    <title>Order List</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class=" mb-4">
                        <div class=" d-flex justify-content-between">
                            <h2 class="title-1">Order List</h2>
                            <select name="sortOpt" id="sortOpt" class=" form-control-sm col col-2">
                                <option value="">Sort by status (All)</option>
                                <option value="0">Pending</option>
                                <option value="1">Accepted</option>
                                <option value="2">Rejected</option>
                            </select>
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
                                        <th class="col col-2 text-white">Status</th>
                                        <th class=" col col-1"></th>
                                    </tr>
                                </thead>
                                <tbody class=" orderList">
                                    @foreach ($orderList as $order)
                                        <tr class="tr-shadow">
                                            <td class=" col col-2"> {{ $order->name }}</td>
                                            <td class="desc col col-3"><a href="{{ route('order#showOrderingItemsPage',$order->order_code) }}">{{ $order->order_code }}</a></td>
                                            <td class=" col col-2">{{ $order->created_at->format('d-M-y hA') }}</td>
                                            <td class=" col col-2">{{ $order->total_price }}ks</td>
                                            <td>
                                                <input type="hidden" class="orderId" value="{{ $order->order_id }}">
                                                <select class="form-control-sm w-75 text-center orderStatus">
                                                    <option value="0" @if($order->status == 0) {{ 'selected' }} @endif>Pending</option>
                                                    <option value="1" @if($order->status == 1) {{ 'selected' }} @endif>Accept</option>
                                                    <option value="2" @if($order->status == 2) {{ 'selected' }} @endif>Reject</option>
                                                </select>
                                            </td>
                                            <td class=" col col-1">
                                                <i class=" fas fa-circle-o
                                                    @if($order->status == 0) text-warning
                                                    @elseif($order->status == 1) text-success
                                                    @elseif($order->status == 2) text-danger @endif">
                                                </i>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="warningMsg"></div>
                        </div>
                    @else
                        <h3 class=" text-center"><i class=" zmdi zmdi-alert-triangle"></i>No Order Now!</h3>
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jqueryCode')
    <script>
        $(document).ready(function(){
            // sorting
            $('#sortOpt').change(function(){
                let sortOptValue = $('#sortOpt').val();

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/product/order/list/sort',
                    dataType : 'json',
                    data : {'sortOptValue' : sortOptValue},
                    success : function(response){
                        if (response.length != 0) {

                            let orderList = '';
                            response.forEach(order => {
                                let orderDate = moment.utc(new Date(order.created_at)).format('DD-MMM-YY hhA');

                                let selectedForVal0 = '';
                                let selectedForVal1 = '';
                                let selectedForVal2 = '';

                                let forColor = '';

                                switch (order.status) {
                                    case 0: selectedForVal0 = 'selected'; forColor = "text-warning"; break;
                                    case 1: selectedForVal1 = 'selected'; forColor = "text-success"; break;
                                    case 2: selectedForVal2 = 'selected'; forColor = "text-danger"; break;
                                    default: break;
                                }

                                orderList += `
                                            <tr class="tr-shadow">
                                                <td>${order.name}</td>
                                                <td>
                                                    <a href="http://127.0.0.1:8000/product/ordered/items/${order.order_code}">${order.order_code}</a>
                                                </td>
                                                <td>${orderDate}</td>
                                                <td>${order.total_price}ks</td>
                                                <td>
                                                    <input type="hidden" class="orderId" value="${order.order_id}">
                                                    <select name="" class="form-control-sm w-75 text-center orderStatus">
                                                        <option value="0" ${selectedForVal0}>Pending</option>
                                                        <option value="1" ${selectedForVal1}>Accept</option>
                                                        <option value="2" ${selectedForVal2}>Reject</option>
                                                    </select>
                                                </td>
                                                <td class=" col col-1"><i class=" fas fa-circle-o ${forColor}"></i></td>
                                            </tr>
                                        `;
                                $('.orderList').html(orderList);
                                $('.warningMsg').html("");
                            });
                        }else if (response.length == 0){
                            $('.orderList').html("");
                            $('.warningMsg').html('<h4 class=" text-center mt-5"><i class=" zmdi zmdi-alert-triangle"></i>No Order Data!</h4>');
                        }
                    }

                })
            })

            // change order status
            $('.orderList').on("change",".orderStatus", function(){

                let statusData = {
                    'orderStatus' : $(this).parents('td').find('.orderStatus').val(),
                    'orderId' : $(this).parents('td').find('.orderId').val(),
                }

                $.ajax({
                    type : 'get',
                    url : 'http://127.0.0.1:8000/product/order/status/change',
                    dataType : 'json',
                    data : statusData,
                    // success : function(response){
                    //     if (response.status == 'success') {
                    //        window.location.href = 'http://127.0.0.1:8000/product/order/list';
                    //     }
                    // }
                })
            })

        })
    </script>
@endsection
