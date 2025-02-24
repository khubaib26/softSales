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
                    @can('Permission create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.permissions.create')}}" class="btn btn-success"><i class="fa fa-circle-plus"></i> New Permission</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Permission Name</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Permission access')
                            @foreach($permissions as $permission)
                            <tr>
                                <th scope="row">{{ $permission->id }}</th>
                                <td>{{ $permission->name }}</td>
                                <td class="d-flex flex-row">
                                    @can('Permission edit')
                                    <a href="{{route('admin.permissions.edit',$permission->id)}}" class="btn-sm btn-success"><i class="fa fa-edit text-white"></i></a>
                                    @endcan

                                    @can('Permission delete')
                                    <form action="{{ route('admin.permissions.destroy', $permission->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endcan
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
