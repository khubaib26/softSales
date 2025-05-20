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
<div class="card p-4">
  <h4 class="mb-3">Activate Payment Methods</h4>
  <form id="payment-method-form" method="POST" action="{{ route('admin.merchants.store')}}">
    @csrf
    <div class="row">
       
    @foreach($merchants as $merchant) 
        <!-- PayPal -->
      <div class="col-md-4 mb-3">
        <div class="card text-center p-3 position-relative">
            <!-- Checkbox at top-right -->
            <input type="checkbox" class="form-check-input position-absolute" 
                style="top: 10px; right: 10px;" id="{{$merchant->id}}" 
                name="payment_methods[]" value="{{$merchant->id}}" {{ $merchant->status ? 'checked' : '' }}>
            
            <!-- Logo center -->
            <img src="/images/gateway_logos/{{$merchant->logo}}" alt="{{$merchant->name}}" 
                class="mx-auto mb-2" width="50">

            <!-- Name -->
            <label for="braintree" class="mt-2 fw-bold">{{$merchant->name}}</label>
        </div>
        </div>
    @endforeach
    </div>

    <button type="submit" class="btn btn-success mt-3">Save</button>
  </form>
</div>

</div>
@endsection
@push('cxmScripts')
@include('setting.gateway.script')
@endpush
