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
                <li class="breadcrumb-item active">New</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.permissions.store')}}">
                        @csrf
                        @method('post')
                        <div class="col-lg-12">
                            <label for="validationCustom01" class="form-label">Permission Name</label>
                            <input id="role_name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter permission" class="form-control" />
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
