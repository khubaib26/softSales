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
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="page-header-left">
                    <h3>Dashboard</h3>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Roles</li>
                    <li class="breadcrumb-item active">Edit</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.roles.update', $role->id) }}">
                        @csrf
                        @method('put')

                        <div class="mb-4">
                            <label for="role_name" class="form-label text-gray-700 font-medium">Role Name</label>
                            <input id="role_name" type="text" name="name" value="{{ old('name', $role->name) }}" placeholder="Enter role name" class="form-control" />
                        </div>

                        <div class="col-lg-12">
                            <label for="validationCustom02" class="form-label">Permissions</label>
                            @foreach($permissions as $permission)
                            <label class="form-check-label">
                                <input type="checkbox" class="form-check-input me-2" name="permissions[]" value="{{ $permission->id }}" @if($role->permissions->where('id', $permission->id)->count())
                                checked
                                @endif>
                                <span>{{ $permission->name }}</span>
                            </label>
                            @endforeach
                        </div>

                        <button type="submit" class="btn btn-primary">
                            Update
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
