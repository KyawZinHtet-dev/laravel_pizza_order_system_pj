@extends('admin.layouts.master')
@section('title')
    <title>Account Detail Page</title>
@endsection
@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                @if (session('accountDelMsg'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Attention!</strong> {{ session('accountDelMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('changeRoleMsg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Attention!</strong> {{ session('changeRoleMsg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="col-lg-10 offset-1">
                    <div class=" d-flex justify-content-between mb-2">
                        <a href="@if (request()->searchKey) {{ route('admin#showAccountList') }} @else {{ route('admin#home') }} @endif"
                            class=" text-dark"><i class=" zmdi zmdi-arrow-left mt-2"></i>
                            Back</a>
                        <form class="form-header" action="" method="GET">
                            @csrf
                            <input class="au-input" type="text" name="searchKey" placeholder="Search accounts..."
                                value="{{ request('searchKey') }}" />
                            <button class="au-btn--submit" type="submit">
                                <i class="zmdi zmdi-search"></i>
                            </button>
                        </form>
                    </div>
                    @if (request('searchKey'))
                        <div class=" col-4 offset-8 text-center small mt-1 text-dark">Search Key :
                            <small class=" text-danger"> {{ request('searchKey') }}</small>
                        </div>
                    @endif
                    <div>
                        <h3 class="row border-bottom border-danger">Admin Account List</h3>
                        @if ($adminList->count() != 0)
                            <div class=" row row-cols-2 mt-3">
                                @foreach ($adminList as $admin)
                                    <div class="card p-1 shadow shadow-sm col col-6">
                                        <div class="row no-gutters">
                                            <div class="col-4 mr-2 d-flex align-items-center">
                                                <img src="@if ($admin->profile_image == null) {{ 'https://img.freepik.com/free-icon/user_318-704197.jpg' }} @else {{ asset('storage/profile_image/' . $admin->profile_image) }} @endif"
                                                    class=" img-thumbnail" alt="user photo">
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right mt-2">
                                                    <a class=" btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure to delete this account?')"
                                                        href="{{ route('admin#deleteAccount', ['id' => $admin->id]) }}"
                                                        @if ($admin->id === Auth::user()->id) {{ 'hidden' }} @endif>Delete</a>
                                                </div>
                                                <div class="card-body mt-3">
                                                    <h5 class=" text-dark">Name : {{ $admin->name }}</h5>
                                                    <h5 class=" text-dark mt-1">Email : {{ $admin->email }}</h5>
                                                    <h5 class=" mt-1">Address : {{ $admin->address }}</h5>
                                                    <h5 class=" mt-1">Phone : {{ $admin->ph_no }}</h5>
                                                    <div class=" d-flex justify-content-between align-items-center">
                                                        <h5>Role :</h5>
                                                        <form
                                                            action="{{ route('admin#changeAccountRole', ['id' => $admin->id]) }}"
                                                            method="POST" class=" mt-1">
                                                            @csrf
                                                            <div class=" d-flex">
                                                                <select name="role"
                                                                    id="role"class=" form-control form-control-sm w-50"
                                                                    @if ($admin->id === Auth::user()->id) {{ 'disabled' }} @endif>
                                                                    <option value="admin"
                                                                        @if ($admin->role == 'admin') {{ 'selected' }} @endif>
                                                                        Admin</option>
                                                                    <option value="user"
                                                                        @if ($admin->role == 'user') {{ 'selected' }} @endif>
                                                                        User</option>
                                                                </select>
                                                                <input type="submit" value="Change"
                                                                    class=" btn btn-primary btn-sm ml-2"
                                                                    @if ($admin->id === Auth::user()->id) {{ 'disabled' }} @endif>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class=" d-flex justify-content-center mt-3">
                                <h3 class=" text-danger"><i class=" zmdi zmdi-alert-triangle mt-1"></i>No Match Data!</h3>
                            </div>
                        @endif
                    </div>
                    <div>
                        <h3 class=" row border-bottom border-danger">User Account List</h3>
                        @if ($userList->count() != 0)
                            <div class=" row row-cols-2 mt-3">
                                @foreach ($userList as $user)
                                    <div class="card p-1 shadow shadow-sm col col-6">
                                        <div class="row no-gutters">
                                            <div class="col-4 d-flex align-items-center">
                                                <img src="@if ($user->profile_image == null) {{ 'https://img.freepik.com/free-icon/user_318-704197.jpg' }} @else {{ asset('storage/profile_image/' . $user->profile_image) }} @endif"
                                                    class=" img-thumbnail align-bottom" alt="user photo">
                                            </div>
                                            <div class="col-7">
                                                <div class="float-right mt-2">
                                                    <a class=" btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure to delete this account?')"
                                                        href="{{ route('admin#deleteAccount', ['id' => $user->id]) }}"
                                                        @if ($user->id === Auth::user()->id) {{ 'hidden' }} @endif>Delete</a>
                                                </div>
                                                <div class="card-body mt-3">
                                                    <h5 class=" text-dark">Name : {{ $user->name }}</h5>
                                                    <h5 class=" text-dark mt-1">Email : {{ $user->email }}</h5>
                                                    <h5 class=" mt-1">Address : {{ $user->address }}</h5>
                                                    <h5 class=" mt-1">Phone : {{ $user->ph_no }}</h5>
                                                    <div class=" d-flex justify-content-between align-items-center">
                                                        <h5>Role :</h5>
                                                        <form
                                                            action="{{ route('admin#changeAccountRole', ['id' => $user->id]) }}"
                                                            method="POST" class=" mt-1"
                                                            @if ($user->id === Auth::user()->id) {{ 'disabled' }} @endif>
                                                            @csrf
                                                            <div class=" d-flex">
                                                                <select name="role" id="role"
                                                                    class=" form-control form-control-sm w-50">
                                                                    <option value="admin"
                                                                        @if ($user->role == 'admin') {{ 'selected' }} @endif>
                                                                        Admin</option>
                                                                    <option value="user"
                                                                        @if ($user->role == 'user') {{ 'selected' }} @endif>
                                                                        User</option>
                                                                </select>
                                                                <input type="submit" value="Change"
                                                                    class=" btn btn-primary btn-sm ml-2"
                                                                    @if ($user->id === Auth::user()->id) {{ 'disabled' }} @endif>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class=" d-flex justify-content-center mt-3">
                                <h3 class=" text-danger"><i class=" zmdi zmdi-alert-triangle mt-1"></i>No Match Data!</h3>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
