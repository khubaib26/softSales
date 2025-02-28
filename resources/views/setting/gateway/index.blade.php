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
                <li class="breadcrumb-item">Payment Gateways</li>
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
                    @can('Gateway create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{ route('admin.gateways.create') }}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Payment Gateway</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:150px;">ID#</th>
                                <th scope="col" style="width:300px;">Merchant</th>
                                <th scope="col">Descriptor</th>
                                <th scope="col">Email</th>
                                <th scope="col">Limit</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Gateway access')
                            @foreach($paymentGateways as $gateway)
                            <tr>
                                <th scope="row">{{ $gateway->id }}</th>
                                <td>{{ $gateway->merchant->name }}</td>
                                <td>{{ $gateway->descriptor }}</td>
                                <td>{{ $gateway->email }}</td>
                                <td>${{ $gateway->limit }}</td>
                                
                                <td>
                                    @if($gateway->publish)
                                    <span class="badge rounded-pill bg-success">Publish</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('Gateway edit')
                                        <a href="{{ route('admin.brands.edit',$gateway->id) }}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('Gateway delete')
                                        <form action="{{ route('admin.brands.destroy', $gateway->id) }}" method="POST" class="inline">
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
@push('cxmScripts')
@include('setting.gateway.script')
@endpush
