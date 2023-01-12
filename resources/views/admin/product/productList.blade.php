@extends('admin.layouts.master')
@section('title')
    <title>Admin Home</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
           @if(session('createMsg'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> {{ session('createMsg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
           @endif
           @if(session('updateMsg'))
           <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> {{ session('updateMsg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
           @endif
           @if(session('deleteMsg'))
           <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Attention!</strong> {{ session('deleteMsg') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
           @endif

            <div class="container-fluid">
                <div class="col-md-12">
                    <!-- DATA TABLE -->
                    <div class="table-data__tool">
                        <div class="table-data__tool-left">
                            <a href="{{ route('product#create') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>add product
                                </button>
                            </a>
                        </div>
                        <div class=" text-center">
                            <h2 class="title-1">Product List</h2>
                        </div>
                        <div class="table-data__tool-right">
                            <div class=" float-right">
                                <form class="form-header" action="{{ route('admin#home') }}" method="GET">
                                    @csrf
                                    <input class="au-input" type="text" name="searchKey" placeholder="Search products..."
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
                    </div>
                    @if ($products->count() != null)
                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-data2 table-hover">
                                <thead class=" bg-c3">
                                    <tr>
                                        <th scope="col" class=" text-dark">Image</th>
                                        <th scope="col" class=" text-dark px-5">Name</th>
                                        <th scope="col" class=" text-dark">Description</th>
                                        <th scope="col" class=" text-dark px-5">Category</th>
                                        <th scope="col" class=" text-dark">Price</th>
                                        <th scope="col" class=" text-dark px-5">Views</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <th style=" border:none; vertical-align:middle;">
                                                <img class=" ml-3"
                                                    src="{{ asset('/storage/product_images/' . $product->image) }}"
                                                    alt="" style="width:80px;">
                                            </th>
                                            <td>
                                                <div>{{ $product->name }}</div>
                                            </td>
                                            <td>
                                                <div>{{ Str::words($product['description'], 3, '...') }}</div>
                                            </td>
                                            <td>
                                                <div class=" px-2">
                                                    {{ $product->category_name }}
                                                </div>
                                            </td>
                                            <td>
                                                <div class=" text-success">{{ $product->price }}Ks</div>
                                            </td>
                                            <td>
                                                <div class=" px-4">{{ $product->view_count }}</div>
                                            </td>
                                            <td>
                                                <div class="table-data-feature ">
                                                    <a class="item" data-toggle="tooltip" data-placement="top"
                                                        title="View"
                                                        href="{{ route('product#about', $product->product_id) }}">
                                                        <i class="zmdi zmdi-eye"></i>
                                                    </a>
                                                    <a class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit"
                                                        href="{{ route('product#edit', $product->product_id) }}">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a class="item" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure to delete this product?')"
                                                        title="Delete"
                                                        href="{{ route('product#delete', $product->product_id) }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-3 row">
                                @if (request('searchKey'))
                                    <div class=" col col-2 text-left">
                                        <a href="{{ route('admin#home') }}" class=" text-dark">
                                            <i class=" zmdi zmdi-arrow-left"></i> Back</a>
                                    </div>
                                @endif
                                <div class=" col @if (request('searchKey')) col-7 offset-3 @else col-12 @endif">
                                    {{ $products->appends(request()->query())->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <h4 class=" text-center"><i class=" zmdi zmdi-alert-triangle"></i>No Product yet! Add Some.</h4>
                        @if (request('searchKey'))
                            <div class=" col col-2 text-left">
                                <a href="{{ route('admin#home') }}" class=" text-dark">
                                    <i class=" zmdi zmdi-arrow-left"></i> Back</a>
                            </div>
                        @endif
                    @endif
                    <!-- END DATA TABLE -->
                </div>
            </div>
        </div>
    </div>
@endsection
