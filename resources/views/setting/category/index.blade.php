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
                    @can('Category create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.categories.create')}}" class="btn btn-success"><i class="bi bi-plus-lg"></i>New Category</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col" style="width:200px;">Category Name</th>
                                <th scope="col">No. of Brands</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Category access')
                            @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->brands->count()  }} </td>
                                <td>
                                    @if($category->publish)
                                    <span class="badge rounded-pill bg-success">Publish</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('Category edit')
                                        <a href="{{ route('admin.categories.edit',$category->id) }}" class="btn-sm btn-success"><i class="fa fa-pencil  text-white"></i></a>
                                        @endcan

                                        @can('Category delete')
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
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
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
