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
                    @can('Team create')
                    <h5 class="card-title" style="text-align:right;">
                        <a href="{{ route('admin.teams.create') }}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Team</a>
                    </h5>
                    @endcan

                    <!-- Default Table -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col" style="width:150px;">ID #</th>
                                <th scope="col" style="width:300px;">Team Name</th>
                                <th scope="col">Team Head</th>
                                <th scope="col">Status</th>
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Team access')
                            @foreach($teams as $team)
                            <tr>
                                <th scope="row">{{$team->id}}</th>
                                <td>{{ $team->name }}</td>
                                <td>{{ $team->teamLead->name }}</td>
                                <td>
                                    @if($team->publish)
                                    <span class="badge rounded-pill bg-success">Publish</span>
                                    @else
                                    <span class="badge rounded-pill bg-danger">Draft</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-row">
                                        @can('Team edit')
                                        <a href="{{ route('admin.teams.edit',$team->id) }}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                        @endcan

                                        @can('Team delete')
                                        <form action="{{ route('admin.teams.destroy', $team->id) }}" method="POST" class="inline">
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
