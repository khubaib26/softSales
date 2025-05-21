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
                <li class="breadcrumb-item">Invoice</li>
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
                    @can('Invoice create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.invoices.create')}}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Invoice</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table" id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Client</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Due Date</th>
                                <th scope="col">Amount</th>
                                <th scope="col">Sales Type</th>
                                <th>Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Invoice access')
                            @foreach($invoices as $invoice)
                            @php
                            $color = ($invoice->status == 'due') ? 'bg-warning' : (($invoice->status == 'paid') ? 'bg-success' : (($invoice->status == 'refund') ? 'bg-info' : 'bg-danger'));   
                            @endphp
                            <tr>
                                <th scope="row">{{ $invoice->id }}</th>
                                <td>{{ $invoice->brand->name }}</td>
                                <td>{{ $invoice->client->name }}</td>
                                <td>{{ $invoice->user->name }}</td>
                                <td>{{ $invoice->due_date }}</td>
                                <td>${{ $invoice->amount }}</td>
                                <td>{{ $invoice->sales_type }}</td>
                                <td class="badge rounded-pill {{$color}}">{{ $invoice->status }}</td>
                                <td>
                                    <div class="d-flex flex-row">
                                        <a class="btn-sm btn-primary" href="{{ route('admin.payments.show',$invoice->invoice_number) }}" title="Profile"><i class="fa-solid fa-credit-card"></i></a>
                                        @can('invoices edit')
                                        <a href="{{route('admin.invoices.edit',$invoice->id)}}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('invoices delete')
                                        <form action="{{ route('admin.invoices.destroy', $invoice->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan
                                        <a class="btn-sm btn-primary" href="{{ route('admin.invoices.show',$invoice->id) }}" title="Profile"><i class="fa-solid fa-user"></i></a>
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
@include('setting.invoice.script')
@endpush
