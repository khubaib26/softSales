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
                            <div class="col-lg-6">
                                <label for="category" class="mt-2">Select Brand</label>
                                <select class="form-control" name="brand_id">
                                    <option value="">Select Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="category" class="mt-2">Select Merchant</label>
                                <select class="form-control" name="brand_id">
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
                                <select class="form-control" name="client_id">
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
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Address</label>
                                <input id="email" type="text" name="address" value="{{ old('address') }}" placeholder="Enter Address" class="form-control" />
                            </div>
                        </div> 

                        <div>
                            <a href="javascript:void(0)" class="client_type" data-type="new">New Client</a> |
                            <a href="javascript:void(0)" class="client_type" data-type="existing">Existing Client</a>
                        </div> 
                          
                        <div class="row">
                            <div class="flex flex-col space-y-2 col-lg-6">
                                <label for="email" class="mt-2">Description</label>
                                <textarea name="client_description" class="form-control"></textarea>
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Publish</label>
                                <select class="form-control" name="publish">
                                    <option value="0">Draft</option>
                                    <option value="1">Publish</option>
                                </select>
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
