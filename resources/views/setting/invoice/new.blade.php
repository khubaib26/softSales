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
                <li class="breadcrumb-item active">Create</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.invoices.store')}}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-lg-4">
                                <label for="category" class="mt-2">Select Brand</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                            
                                <label for="category" class="mt-2">Select Sales Agent</label>
                                <select class="form-control" name="user_id" id="user_id">
                                        <option value="">&nbsp;&nbsp;&nbsp;Select Agent</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}} - {{$user->pseudonym}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="category" class="mt-2">Select Merchant</label>
                                <select class="form-control" name="merchant_id">
                                    <option value="">Select Merchant</option>
                                    @foreach($merchants as $merchant)
                                    <option value="{{$merchant->id}}">{{$merchant->descriptor}} - {{ $merchant->merchant->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row" id="existing-client">
                            <div class="col-lg-6">
                                <label for="category" class="mt-2">Client</label>
                                <select class="form-control" id= "client" name="client_id">
                                    <option value="">Select Client</option>
                                    @foreach($clients as $client)
                                    <option value="{{$client->id}}">{{$client->name}} - {{$client->email}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <div class="row" id="new-client" style="display:none;" >

                        <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="name" class="mt-2">Name</label>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter name" class="form-control" />
                            </div>
                        
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Email</label>
                                <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="Enter email" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Phone</label>
                                <input id="email" type="text" name="phone" value="{{ old('email') }}" placeholder="Enter Phone" class="form-control" />
                            </div>
                            
                        </div> 

                        <div>
                            <a href="javascript:void(0)" class="client_type" data-type="new">New Client</a> |
                            <a href="javascript:void(0)" class="client_type" data-type="existing">Existing Client</a>
                        </div> 
                          
                        <div class="row">
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Currency</label>
                                <select class="form-control" name="currency">
                                    <option value="">Select Currency</option>
                                    <option value="USD">USD</option>
                                    <option value="CAD">CAD</option>
                                </select>
                            </div>
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Services</label>
                                <select class="form-control" name="service">
                                    <option value="">Select Services</option>
                                    <option value="IT">IT Services</option>
                                    <option value="Digital Services">Digital Services</option>
                                </select>
                            </div>
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Amount</label>
                                <input id="email" type="number" name="amount" value="{{ old('amount') }}" placeholder="Enter Amount" class="form-control" />
                            </div>
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Due Date</label>
                                <input id="email" type="date" name="due_date" value="{{ old('amount') }}" placeholder="Enter Due Date" class="form-control" />
                            </div>

                            <div class="flex flex-col space-y-2 col-lg-12">
                                <label for="email" class="mt-2">Description</label>
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                            <div class="col-lg-12">
                                <button class="btn btn-primary" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('cxmScripts')
@include('setting.invoice.script')
@endpush
