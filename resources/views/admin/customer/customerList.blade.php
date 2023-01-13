@extends('admin.layouts.master')
@section('title')
    <title>Customer List List</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class=" mb-4 d-flex justify-content-between">
                        <div class=" d-flex justify-content-center">
                            <h2 class="title-1">Customer List</h2>
                        </div>
                        <div>
                            <form class="form-header" action="{{ route('admin#customerList') }}" method="GET">
                                @csrf
                                <input class="au-input" type="text" name="searchKey" placeholder="Search customers..."
                                    value="{{ request('searchKey') }}" />
                                <button class="au-btn--submit" type="submit">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            @if (request('searchKey'))
                                <div class=" col col-12 text-center small mt-1 text-dark">Search Key :
                                    <small class=" text-danger"> {{ request('searchKey') }}</small>
                                </div>
                            @endif
                        </div>
                    </div>
                    @if ($customerList->count() != null)
                        <div class="table-responsive table-responsive-data2 text-center" id="table">
                            <table class="table table-data2 table-hover">
                                <thead class=" bg-success">
                                    <tr>
                                        <th class="col col-2 text-white">Name</th>
                                        <th class="col col-3 text-white">Email</th>
                                        <th class="col col-2 text-white">Address</th>
                                        <th class="col col-2 text-white">Phone</th>
                                        <th class=" col col-1"></th>
                                    </tr>
                                </thead>
                                <tbody class=" orderList">
                                    @foreach ($customerList as $customer)
                                        <tr class="tr-shadow">
                                            <td class=" col col-2">{{ $customer->name }}</td>
                                            <td class=" col col-2">{{ $customer->email }}</td>
                                            <td class=" col col-2">{{ $customer->address }}</td>
                                            <td class=" col col-2">{{ $customer->ph_no }}</td>
                                            <td class=" col col-2">
                                                <a class=" btn btn-sm btn-outline-primary"
                                                    href="{{ route('admin#showCustomerOrderList', $customer->id) }}"><i
                                                        class=" fas fa-history text-warning"></i>
                                                    Order
                                                    History</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <h3 class=" text-center"><i class=" zmdi zmdi-alert-triangle"></i>No Customer Yet!</h3>
                        <!-- END DATA TABLE -->
                    @endif
                    @if (request('searchKey'))
                        <div class=" mt-4">
                            <a href="{{ route('admin#customerList') }}" class=" text-dark"><i
                                    class=" zmdi zmdi-arrow-left"></i>
                                Back</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
