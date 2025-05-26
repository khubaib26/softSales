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
                <li class="breadcrumb-item">Payments</li>
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
                    <!-- Default Table -->
                    <table class="table" id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Client</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Payment access')
                            @foreach($payments as $payment)
                            <tr>
                                <th scope="row">{{ $payment->id }}</th>
                                <td>{{ $payment->brand->name }}</td>
                                <td>{{ $payment->client->name }}</td>
                                <td>{{ $payment->user->name }}</td>
                                <td>{{ $payment->paid_at }}</td>
                                <td>${{ $payment->amount }}</td>
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
@include('setting.invoice.script')
@endpush
