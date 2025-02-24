@extends('layouts.app')

@section('header')
@include('layouts.includes.header')
@endsection

@section('sidebar')
@include('layouts.includes.sidebar')
@endsection

@section('content')

<div class="container-fluid">
    <div class="page-header">
        <div class="row">
            <div class="col-lg-6">
                <div class="page-header-left">
                    <h3>Dashboard
                    </h3>
                </div>
                <li class="breadcrumb-item">Permissions</li>
                <li class="breadcrumb-item active">List</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.store')}}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="name" class="mt-2">User Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter name" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="name" class="mt-2">Pseudonym</label>
                                <input id="name" type="text" name="pseudonym" value="{{ old('name') }}" placeholder="Enter Pseudonym" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="name" class="mt-2">Designation</label>
                                <input id="name" type="text" name="designation" value="{{ old('name') }}" placeholder="Enter designation" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Email</label>
                                <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Phone</label>
                                <input id="email" type="text" name="phone" value="{{ old('email') }}" placeholder="Enter Phone" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="password" class="mt-2">Password</label>
                                <input id="password" type="password" name="password" value="{{ old('password') }}" placeholder="Enter password" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="password_confirmation" class="mt-2">Confirm Password</label>
                                <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Re-enter password" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 mt-3">
                                <div class="icheck-success"><input type="checkbox" id="cxmHODCheckBox" name="hod" value="1">
                                    <label for="cxmHODCheckBox">Head Of Department</label>
                                </div>
                            </div>

                            <h3 class="text-xl my-4 text-gray-600">Role</h3>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($roles as $role)
                                <div class="flex flex-col justify-cente">
                                    <div class="flex flex-col">
                                        <label class="inline-flex items-center mt-3">
                                        </label>
                                        <input type="checkbox" class="form-checkbox m-1" name="roles[]" value="{{$role->id}}"><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
