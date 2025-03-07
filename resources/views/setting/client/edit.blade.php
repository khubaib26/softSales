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
                <li class="breadcrumb-item">User</li>
                <li class="breadcrumb-item active">Edit</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.users.update',$user->id)}}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="mt-2">User Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name',$user->name) }}" placeholder="Enter name" class="form-control" />
                            </div>

                            <div class="col-lg-6">
                                <label for="email" class="mt-2">Email</label>
                                <input id="email" type="text" name="email" value="{{ old('email',$user->email) }}" placeholder="Enter email" class="form-control" />
                            </div>

                            <div class="col-lg-6">
                                <label for="password" class="mt-2">Password</label>
                                <input id="password" type="text" name="password" value="{{ old('password') }}" placeholder="Enter password" class="form-control" />
                            </div>

                            <div class="col-lg-6">
                                <label for="password_confirmation" class="mt-2">Confirm Password</label>
                                <input id="password_confirmation" type="text" name="password_confirmation" placeholder="Re-enter password" class="form-control" />
                            </div>

                            <h3 class="text-xl my-4 text-gray-600">Role</h3>
                            <div class="grid grid-cols-3 gap-4">
                                @foreach($roles as $role)
                                <div class="flex flex-col justify-cente">
                                    <div class="flex flex-col">
                                        <label class="inline-flex items-center mt-3">
                                            <input type="checkbox" class="form-checkbox m-1" name="roles[]" value="{{$role->id}}" @if(count($user->roles->where('id',$role->id)))
                                            checked
                                            @endif
                                            ><span class="ml-2 text-gray-700">{{ $role->name }}</span>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            <div class="col-lg-12 m-2">
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
