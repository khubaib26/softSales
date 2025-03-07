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
                <li class="breadcrumb-item">Client</li>
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
                    @can('Client create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.clients.create')}}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Client</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table" id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name </th>
                                <th scope="col">Contact</th>
                                <th scope="col">Brand</th>
                                <th>Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Client access')
                            @foreach($clients as $client)
                            <tr>
                                <th scope="row">{{ $client->id }}</th>
                                <td>{{ $client->name }}</td>
                                <td>{{ $client->email }}<br>{{ $client->phone }}</td>
                                <td>{{ $client->brand->name }}</td>
                                <td>
                                    @if($client->status)
                                    <span class="badge rounded-pill bg-success">Publish</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('Client edit')
                                        <a href="{{route('admin.clients.edit',$client->id)}}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('Client delete')
                                        <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan
                                        <a class="btn-sm btn-primary" href="{{ route('admin.clients.show',$client->id) }}" title="Profile"><i class="fa-solid fa-user"></i></a>
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

<!-- The Modal -->


<!-- The Brand Assing Modal -->

@endsection
@push('cxmScripts')
@include('setting.client.script')
@endpush
