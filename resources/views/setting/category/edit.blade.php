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
                <li class="breadcrumb-item">Categories</li>
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
                    <form method="POST" action="{{ route('admin.categories.update',$category->id)}}">
                        @csrf
                        @method('put')
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="role_name" class="">Category Name</label>
                                <input id="role_name" type="text" name="name" value="{{ old('name',$category->name) }}" placeholder="Enter Category" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="">Publish</label>
                                <select class="form-control" name="publish">
                                    <option value="0" {{$category->publish == '0' ? 'selected' : ''}}>Draft</option>
                                    <option value="1" {{$category->publish == '1' ? 'selected' : ''}}>Publish</option>
                                </select>
                            </div>
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
