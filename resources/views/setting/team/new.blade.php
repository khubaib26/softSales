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
                <li class="breadcrumb-item">Team</li>
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
                    <form method="POST" action="{{ route('admin.teams.store')}}">
                        @csrf
                        @method('post')
                        <div class="row">
                            <div class="col-lg-12">
                                <label for="category" class="mt-2">Select Team Head</label>
                                <select class="form-control" name="team_lead_id">
                                    <option value="">Select Team Head</option>
                                    @foreach($users as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-6">
                                <label for="role_name" class="mt-2">Team Name</label>
                                <input id="role_name" type="text" name="name" value="{{ old('name') }}" placeholder="Enter Brand Name" class="form-control" />
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
