@extends('admin.layouts.master')
@section('title')
    <title>Category List</title>
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
                        <div class="table-data__tool-right">
                            <a href="{{ route('category#createPage') }}">
                                <button class="au-btn au-btn-icon au-btn--green au-btn--small">
                                    <i class="zmdi zmdi-plus"></i>Add Category
                                </button>
                            </a>
                        </div>
                        <div class=" text-center">
                            <h2 class="title-1">Category List</h2>
                        </div>
                        <div>
                            <form class="form-header" action="{{ route('category#list') }}" method="GET">
                                @csrf
                                <input class="au-input" type="text" name="searchKey" placeholder="Search categories..."
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

                    @if (count($categories) != 0)
                        <div class="table-responsive table-responsive-data2 text-center">
                            <table class="table table-data2 table-hover">
                                <thead class=" bg-c3">
                                    <tr>
                                        <th class="">Category Id</th>
                                        <th class="">Category Name</th>
                                        <th class="">Created_at</th>
                                        <th class=""></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr class="tr-shadow">
                                            <td>
                                                {{ $category->category_id }}
                                            </td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->created_at->format('d-M-Y') }}</td>
                                            <td>
                                                <div class="table-data-feature">
                                                    <a class="item" data-toggle="tooltip" data-placement="top"
                                                        title="Edit"
                                                        href="{{ route('category#edit', $category->category_id) }}">
                                                        <i class="zmdi zmdi-edit"></i>
                                                    </a>
                                                    <a class="item" data-toggle="tooltip" data-placement="top" onclick="return confirm('Are you sure to delete this category?')"
                                                        title="Delete"
                                                        href="{{ route('category#delete', $category->category_id) }}">
                                                        <i class="zmdi zmdi-delete"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="spacer"></tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class=" mt-5 row">
                                @if (request('searchKey'))
                                    <div class=" col col-2 text-left">
                                        <a href="{{ route('category#list') }}" class=" text-dark">
                                            <i class=" zmdi zmdi-arrow-left"></i> Back</a>
                                    </div>
                                @endif
                                <div class=" col @if (request('searchKey')) col-7 offset-3 @else col-12 @endif">
                                    {{ $categories->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        <h4 class=" text-center"><i class=" zmdi zmdi-alert-triangle"></i>No Category yet! Add Some.</h4>
                        @if (request('searchKey'))
                            <div class=" col col-2 text-left">
                                <a href="{{ route('category#list') }}" class=" text-dark">
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
