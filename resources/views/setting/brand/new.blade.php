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
                    <form method="POST" action="{{ route('admin.brands.store')}}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="category" class="mt-2">Select Category</label>
                                <select class="form-control" name="category_id">
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Brand Name</label>
                                <input id="role_name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter Brand Name" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Brand URL</label>
                                <input id="role_name" type="url" name="brand_url" value="{{ old('name') }}" placeholder="Enter Brand Name" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Brand Logo URL</label>
                                <input id="role_name" type="url" name="brand_logo_url" value="{{ old('name') }}" placeholder="Enter Brand Name" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Brand Fav URL</label>
                                <input id="role_name" type="url" name="brand_fav_url" value="{{ old('name') }}" placeholder="Enter Brand Name" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Publish</label>
                                <select class="form-control" name="publish">
                                    <option value="0">Draft</option>
                                    <option value="1">Publish</option>
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
