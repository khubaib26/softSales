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
                    <li class="breadcrumb-item active">New</li>
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
                    <h5 class="card-heder">Add New Role</h5>
                    <form class="row g-3 needs-validation" method="POST" action="{{ route('admin.roles.store')}}" novalidate>
                        @csrf
                        @method('post')
                        <div class="col-lg-12">
                            <label for="validationCustom01" class="form-label">Role Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter role" class="form-control" id="validationCustom01" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="validationCustom02" class="form-label">Permissions</label>
                            <div class="form-check d-flex flex-wrap">
                                @foreach($permissions as $permission)
                                <div class="form-check me-3 mb-2">
                                    <input type="checkbox" class="form-check-input p-2" name="permissions[]" value="{{ $permission->id }}" id="permission-{{ $permission->id }}">
                                    <label class="form-check-label p-1" for="permission-{{ $permission->id }}">{{ $permission->name }}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
