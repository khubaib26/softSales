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
                  <li class="breadcrumb-item">Categories</li>
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
                    @can('Lead create')
                    {{-- <h5 class="card-title" style="text-align:right;">
                        <a href="{{ route('admin.leads.create') }}" class="btn btn-success"><i class="fa fa-plus-lg"></i>New Lead</a>
                    </h5> --}}
                    @endcan

                    <!-- Default Table -->
                    <table class="table" id="LeadTable">
                        <thead>
                            <tr>
                                <th scope="col" style="width:50px;">ID #</th>
                                <th scope="col" style="width:200px;">Brand</th>
                                <th scope="col">Contact</th>
                                <th scope="col">Date</th>
                                <th scope="col">Platform</th>
                                @can('Lead assign')<th scope="col">Assing Lead</th>@endcan
                                <th scope="col">Value</th>
                                @can('Lead status')<th scope="col">Status</th>@endcan
                                <th scope="col" style="width:200px;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @can('Lead access')
                            @foreach($leads as $lead)
                            <tr>
                                <th scope="row">{{ $lead->id }}</th>
                                <td>
                                    <img src="{{$lead->brand->logo}}" width="100"><br>{{$lead->brand->name}}
                                </td>
                                <td>{{ $lead->name }}<br>
                                    {{ $lead->email }}<br>
                                    {{ $lead->phone }}
                                </td>
                                <td>
                                    {{$lead->created_at->format('j F, Y')}}
                                    <br>{{$lead->created_at->format('h:i:s A')}}
                                    <br>{{$lead->created_at->diffForHumans()}}
                                </td>
                                <td>{{ $lead->platform }}</td>
                                @can('Lead assign')
                                <td>
                                    <select class='assingUser form-select' name="assingUser" data-cxm-lead-id="{{$lead->id}}">
                                        <option value="">Select User</option>
                                        @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ ($user->id == $lead->user_id)  ? 'selected' : '' }}>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endcan
                                <td>${{ $lead->value }}</td>
                                @can('Lead status')
                                <td>
                                    {{-- $lead->status->status ?? 'None' --}} 
                                    <select class='changeStatus form-select' name="lead_status" data-cxm-lead-id="{{$lead->id}}">
                                        <option value="">Select Status</option>
                                        @foreach($status as $stat)
                                        <option value="{{ $stat->id }}" {{ ($stat->id == $lead->status_id)  ? 'selected' : '' }}>{{ $stat->status }}</option>
                                        @endforeach
                                    </select>
                                </td>
                                @endcan
                                <td class="d-flex flex-row">
                                    @can('Lead edit')
                                    <a href="{{ route('admin.leads.edit',$lead->id) }}" class="btn-sm btn-success"><i class="fa fa-pencil text-white"></i></a>
                                    @endcan

                                    @can('Lead delete')
                                    <form action="{{ route('admin.leads.destroy', $lead->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endcan
                        </tbody>
                    </table>
                    @can('Lead access')
                        <div class="dataTables_paginate paging_simple_numbers" id="basic-1_paginate">
                            {{ $leads->links() }}
                        </div>
                    @endcan
                    <!-- End Default Table Example -->
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('cxmScripts')
@include('setting.lead.script')
@endpush
