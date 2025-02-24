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
                          <small>Multikart Admin panel</small>
                      </h3>
                  </div>
              </div>
              <div class="col-lg-6">
                  <ol class="breadcrumb pull-right">
                      <li class="breadcrumb-item">
                          <a href="index.html">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home">
                                  <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                  <polyline points="9 22 9 12 15 12 15 22"></polyline>
                              </svg>
                          </a>
                      </li>
                      <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
              </div>
          </div>
      </div>
  </div>
  <div class="container-fluid">
      <div class="row">
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="warning-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-navigation font-warning">
                                      <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                                  </svg>
                              </div>
                          </div>
                          <div class="media-body media-doller">
                              <span class="m-0">Leads</span>
                              <h3 class="mb-0"><span class="counter">{{$data['todayLead']}}</span><small> Today
                                      </small>
                              </h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="secondary-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-box font-secondary">
                                      <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                      <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                      <line x1="12" y1="22.08" x2="12" y2="12"></line>
                                  </svg>
                              </div>
                          </div>
                          <div class="media-body media-doller">
                              <span class="m-0">Leads</span>
                              <h3 class="mb-0"><span class="counter">{{$data['monthLead']}}</span><small> This
                                      Month</small>
                              </h3>
                              <p>{{$data['LeadMonthGrowth']}} <span><i class="fa fa-angle-{{($data['LeadMonthGrowth'])?'up':'down'}}"></i></span></p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="primary-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-message-square font-primary">
                                      <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                  </svg></div>
                          </div>
                          <div class="media-body media-doller"><span class="m-0">Leads</span>
                              <h3 class="mb-0"> <span class="counter">{{$data['yearleadCount']}}</span><small>This Year</small></h3>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div class="col-xxl-3 col-md-6 xl-50">
              <div class="card o-hidden">
                  <div class="danger-box card-body">
                      <div class="media static-top-widget align-items-center">
                          <div class="icons-widgets">
                              <div class="align-self-center text-center"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-danger">
                                      <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                      <circle cx="9" cy="7" r="4"></circle>
                                      <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                                      <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                  </svg></div>
                          </div>
                          <div class="media-body media-doller"><span class="m-0">Converted Lead</span>
                              <h3 class="mb-0"><span class="counter">{{$data['convertedLead']}}</span><small> This
                                      Month</small></h3>
                                      <p>{{$data['leadConvertRate']}}% <span><i class="fa fa-angle-{{($data['leadConvertRate'])?'up':'down'}}"></i></span></p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Start -->
        @can('User access')
        <div class="col-xl-6 xl-100">
                            <div class="card height-equal" style="min-height: 516px;">
                                <div class="card-header">
                                    <h5>Sales Performance</h5>
                                    <div class="card-header-right">
                                        <ul class="list-unstyled card-option">
                                            <li><i class="icofont icofont-simple-left"></i></li>
                                            <li><i class="view-html fa fa-code"></i></li>
                                            <li><i class="icofont icofont-maximize full-card"></i></li>
                                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                                            <li><i class="icofont icofont-error close-card"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="user-status table-responsive products-table">
                                        <table class="table table-bordernone mb-0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Representative</th>
                                                    <th scope="col">Deals Closed</th>
                                                    <th scope="col">Leads</th>
                                                    <th scope="col" style="width:100px;">Rate (%)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            
                                            @foreach($data['userList'] as $user)
                                                <tr>
                                                    <td class="bd-t-none u-s-tb">
                                                        <div class="align-middle image-sm-size">                                                            <div class="d-inline-block">
                                                                <h6 class="mb-0">{{$user->name}}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>{{ $user->current_month_converted_leads_count }} {{-- $user->convertedLead --}}</td>
                                                    <td>{{ $user->current_month_leads_count }}{{-- $user->leads->count()  --}}</td>
                                                    <td class="digits">
                                                            @php
                                                            $lcr = conversion_rate($user->current_month_converted_leads_count, $user->current_month_leads_count);
                                                            echo $lcr;
                                                            @endphp
                                                        <i class="fa fa-angle-{{($lcr>0)?'up':'down'}}"></i>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
        <!--  End -->
        </div>
        @endcan
        @can('Lead access')
        <div class="col-xl-12 xl-100">
            <div class="card height-equal" style="min-height: 516px;">
                <div class="card-header">
                    <h5>Leads Report</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="user-status table-responsive products-table">
                        <table class="table table-bordernone mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Brand</th>
                                    <th scope="col">Contact</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Assing Lead</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Value</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data['recentLeads'] as $lead)
                                    <tr>
                                        <td><img src="{{$lead->brand->logo}}" width="100"><br>{{$lead->brand->name}}</td>
                                        <td class="digits">{{ $lead->name }}<br>
                                                {{ $lead->email }}<br>
                                                {{ $lead->phone }}
                                        </td>
                                        <td class="font-primary"> 
                                            {{$lead->created_at->format('j F, Y')}}
                                            <br>{{$lead->created_at->format('h:i:s A')}}
                                            <br>{{$lead->created_at->diffForHumans()}}
                                        </td>
                                        <td class="digits">{{ $lead->user->name ?? 'None' }}</td>
                                        <td class="digits">{{ $lead->status->status ?? 'None' }}</td>
                                        <td class="digits">${{ $lead->value }}</td>
                                    </tr>
                                @endforeach     
                            </tbody>
                        </table>
                    </div>                            
            </div>  
        </div>
        @endcan
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Sales Status</h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                        </ul>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-xl-6 col-sm-6 xl-50">
                            <div class="order-graph sm-order-space">
                                <h6>Sales By Location</h6>
                                <div class="peity-chart-dashboard text-center">
                                    <span class="pie-colours-1" style="display: none;">4,7,6,5</span><svg class="peity" height="180" width="250"><path d="M 125 0 A 60 60 0 0 1 179.57791972127112 35.075099219886816 L 125 60" fill="#ec8951"></path><path d="M 179.57791972127112 35.075099219886816 A 60 60 0 0 1 125 120 L 125 60" fill="#02cccd"></path><path d="M 125 120 A 60 60 0 0 1 65.61071348714404 51.4611097036029 L 125 60" fill="#ffbc58"></path><path d="M 65.61071348714404 51.4611097036029 A 60 60 0 0 1 124.99999999999999 0 L 125 60" fill="#a5a5a5"></path></svg>
                                </div>
                                <div class="order-graph-bottom sales-location">
                                    <div class="media">
                                        <div class="order-shape-primary"></div>
                                        <div class="media-body">
                                            <h6 class="mb-0 me-0">Germany <span class="pull-right">25%</span></h6>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="order-shape-secondary"></div>
                                        <div class="media-body">
                                            <h6 class="mb-0 me-0">Brasil <span class="pull-right">10%</span></h6>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="order-shape-danger"></div>
                                        <div class="media-body">
                                            <h6 class="mb-0 me-0">United Kingdom<span class="pull-right">34%</span></h6>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="order-shape-warning"></div>
                                        <div class="media-body">
                                            <h6 class="mb-0 me-0">Australia<span class="pull-right">5%</span></h6>
                                        </div>
                                    </div>
                                    <div class="media">
                                        <div class="order-shape-success"></div>
                                        <div class="media-body">
                                            <h6 class="mb-0 me-0">Canada <span class="pull-right">25%</span></h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>      
  @endsection
