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
                    @can('Brand create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{ route('admin.brands.create') }}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Brand</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:150px;">&nbsp;</th>
                                <th scope="col" style="width:300px;">Brand Name</th>
                                <th scope="col">Unit</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Brand access')
                            @foreach($brands as $brand)
                            <tr>
                                <th scope="row"><img src="{{ $brand->logo }}" width="100"></th>
                                <td><a href="{{ $brand->brand_url }}" traget="_blank">{{ $brand->name }}</a></td>
                                <td>{{ $brand->category->name }}</td>
                                <td>
                                    @if($brand->publish)
                                    <span class="badge rounded-pill bg-success">Publish</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('Brand edit')
                                        <a href="{{ route('admin.brands.edit',$brand->id) }}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('Brand delete')
                                        <form action="{{ route('admin.brands.destroy', $brand->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @endcan
                        </tbody>
                    </table>
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
