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
                    @can('User create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{route('admin.users.create')}}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New User</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table" id="UserTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">User Name / Pseudonym </th>
                                <th scope="col">Designation</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Credits</th>
                                <th scope="col">Role</th> 
                                <th>Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('User access')
                            @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }} <br>{{ $user->pseudonym }} </td>
                                <td>
                                   {{ $user->designation }}<br> 
                                </td>
                                <td>{{ $user->email }}<br>{{ $user->phone }}</td>
                                <td>
                                @php
                                    $credits = json_decode($user->credits->first(), true);
                                    //print_r($credits); 
                                    if(isset($credits)){
                                        echo "Used: ". $credits["used_credits"] . "<br>";
                                        echo "Balance: ". $credits["unused_credits"];
                                    }
                                @endphp  

                                <div class="progress" style="height: 8px;">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 30%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                </td>
                                <td>
                                    @foreach($user->roles as $role)
                                    <span class="badge rounded-pill bg-primary">{{ $role->name }}</span>
                                    @endforeach
                                </td>
                               
                                <td>
                                    <div class="form-check form-switch">
                                        <input data-id="{{$user->id}}" type="checkbox" class="form-check-input toggle-class" style="height: 20px; width:3em;" id="customSwitch{{$user->id}}" {{ $user->active ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="customSwitch{{$user->id}}"></label>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('User edit')
                                        <a href="{{route('admin.users.edit',$user->id)}}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('User delete')
                                        <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('delete')
                                            <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                        @endcan
                                        <button type="button" data-id="{{$user->id}}" class="btn-sm btn-primary userCredit" data-bs-toggle="modal" data-bs-target="#creditModal"><i class="fa-solid fa-credit-card"></i></i></button>
                                        <a class="btn-sm btn-primary" href="{{ route('admin.users.show',$user->id) }}" title="Profile"><i class="fa-solid fa-user"></i></a>
                                        <button type="button" data-id="{{$user->id}}" class="btn-sm btn-primary assignBrand" data-bs-toggle="modal" data-bs-target="#brandModal"><i class="fa-solid fa-plus"></i></i></button>
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
<div class="modal modal-dialog-scrollable" id="creditModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST" id="UserCreditForm">
        <input type="hidden" id="user_hdn" class="form-control" name="user_id" value="">
            <div class="row">
                <div class="col-lg-6">
                    <label for="role_name" class="mt-2">Select Month</label>
                    <input id="role_name" type="date" name="month" class="form-control" />
                </div>
                <div class="col-lg-6">
                    <label for="role_name" class="mt-2">Credits</label>
                    <input id="role_name" type="number" name="credits" placeholder="Enter Credits" class="form-control" />
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

<!-- The Brand Assing Modal -->
<div class="modal modal-dialog-scrollable" id="brandModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Assing Brands</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
      <form method="POST" id="BrandAssingForm">
        <input type="hidden" id="user_hdn2" class="form-control" name="user_id" value="">
        
            <div class="row">
                <div class="col-lg-12">
                    <label for="role_name" class="mt-2">Select Brands</label>
                    <select id="brand_id" name="brand[]" class="form-control show-tick ms select2" multiple data-placeholder="Select" required>
                        @foreach($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
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

@endsection
@push('cxmScripts')
@include('setting.user.script')
@endpush
