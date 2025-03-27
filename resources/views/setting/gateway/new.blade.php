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
                <li class="breadcrumb-item">Payment Gateway</li>
                <li class="breadcrumb-item active">New</li>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.gateways.store')}}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="category" class="mt-2">Select Merchant</label>
                                <select id="selectMerchant" class="form-control" name="merchant_id">
                                    <option value="">Select Merchant</option>
                                    @foreach($merchants as $merchant)
                                    <option data-value="{{$merchant->name}}" value="{{$merchant->id}}">{{$merchant->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Descriptor</label>
                                <input id="role_name" type="text" name="descriptor" value="{{ old('name') }}" placeholder="Enter Descriptor Name" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Email</label>
                                <input id="role_name" type="email" name="email" value="{{ old('name') }}" placeholder="Enter Email" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Currency</label>
                                <input id="role_name" type="text" name="currency" value="{{ old('name') }}" placeholder="Enter Currency" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Limit</label>
                                <input id="role_name" type="number" name="limit" value="{{ old('name') }}" placeholder="Enter limit" class="form-control" />
                            </div>
                            <div class="row merchantBox" id="authorize" style="display:none;">
                                <h5>Authorize Net</h5>
                                <hr>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Test Login ID</label>
                                    <input id="role_name" type="text" name="auth_test_login_id" value="{{ old('name') }}" placeholder="Enter Test Login ID" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Test Transaction Key</label>
                                    <input id="role_name" type="text" name="auth_test_transaction_key" value="{{ old('name') }}" placeholder="Enter Test Transaction Key" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Live Login ID</label>
                                    <input id="role_name" type="text" name="auth_live_login_id" value="{{ old('name') }}" placeholder="Enter Live Login ID" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Live Transaction Key</label>
                                    <input id="role_name" type="text" name="auth_live_transaction_key" value="{{ old('name') }}" placeholder="Enter Live Transaction Key" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="row merchantBox" id="stripe" style="display:none;">
                                <h5>Stripe</h5>
                                <hr>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Test Publish Key</label>
                                    <input id="role_name" type="text" name="test_stripe_publishable_key" value="{{ old('name') }}" placeholder="Enter Test Publish Key" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Test Secret Key</label>
                                    <input id="role_name" type="text" name="test_stripe_secret_key" value="{{ old('name') }}" placeholder="Enter Test Secret Key" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Live Publish Key</label>
                                    <input id="role_name" type="text" name="live_stripe_publishable_key" value="{{ old('name') }}" placeholder="Enter Live Publish Key" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Live Secret Key</label>
                                    <input id="role_name" type="text" name="live_stripe_secret_key" value="{{ old('name') }}" placeholder="EnterLive Secret Key" class="form-control" />
                                </div>
                            </div>
                            <div class="row merchantBox" id="square" style="display:none;">
                                <h5>Square</h5>
                                <hr>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Sandbox Application ID</label>
                                    <input id="role_name" type="text" name="square_sandbox_application_id" value="{{ old('name') }}" placeholder="Enter Sandbox Application ID" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Sandbox Access Token</label>
                                    <input id="role_name" type="text" name="square_sandbox_access_token" value="{{ old('name') }}" placeholder="Enter Sandbox Access Token" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Sandbox Location ID</label>
                                    <input id="role_name" type="text" name="square_sandbox_Location_id" value="{{ old('name') }}" placeholder="Enter Sandbox Location ID" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Production Application ID</label>
                                    <input id="role_name" type="text" name="square_production_application_id" value="{{ old('name') }}" placeholder="Enter Production Application ID" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Production Access Token</label>
                                    <input id="role_name" type="text" name="square_production_access_token" value="{{ old('name') }}" placeholder="Enter Production Access Token" class="form-control" />
                                </div>
                                <div class="col-lg-4">
                                    <label for="role_name" class="mt-2">Production Location ID</label>
                                    <input id="role_name" type="text" name="square_production_Location_id" value="{{ old('name') }}" placeholder="Enter Production Location ID" class="form-control" />
                                </div>
                            </div>
                            <?php /*?>
                            <div class="row merchantBox" id="payPal" style="display:none;">
                                <h5>PayPal</h5>
                                <hr>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Currency</label>
                                    <input id="role_name" type="text" name="currency" value="{{ old('name') }}" placeholder="Enter Currency" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Limit</label>
                                    <input id="role_name" type="number" name="limit" value="{{ old('name') }}" placeholder="Enter limit" class="form-control" />
                                </div>
                            </div>
                            <div class="row merchantBox" id="braintree" style="display:none;">
                                <h5>Braintree</h5>
                                <hr>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Currency</label>
                                    <input id="role_name" type="text" name="currency" value="{{ old('name') }}" placeholder="Enter Currency" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Limit</label>
                                    <input id="role_name" type="number" name="limit" value="{{ old('name') }}" placeholder="Enter limit" class="form-control" />
                                </div>
                            </div>
                            
                            <div class="row merchantBox" id="2checkout" style="display:none;">
                                <h5>2 Checkout</h5>
                                <hr>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Currency</label>
                                    <input id="role_name" type="text" name="currency" value="{{ old('name') }}" placeholder="Enter Currency" class="form-control" />
                                </div>
                                <div class="col-lg-6">
                                    <label for="role_name" class="mt-2">Limit</label>
                                    <input id="role_name" type="number" name="limit" value="{{ old('name') }}" placeholder="Enter limit" class="form-control" />
                                </div>
                            </div>
                            <?php */?>

                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Environment</label>
                                <select class="form-control" name="environment">
                                    <option value="0">Sandbox</option>
                                    <option value="1">Production</option>
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Publish</label>
                                <select class="form-control" name="publish">
                                    <option value="0">Draft</option>
                                    <option value="1">Publish</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 mt-3">
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('cxmScripts')
@include('setting.gateway.script')
@endpush