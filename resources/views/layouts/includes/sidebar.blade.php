<nav id="sidebar" class="sidebar js-sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="index.html">
          			<span class="align-middle">AdminKit</span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item active">
						<a class="sidebar-link" href="{{ route('admin.dashboard') }}">
						<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
						</a>
					</li>

                    <li class="sidebar-item active">
						<a data-bs-target="#dashboards" data-bs-toggle="collapse" class="sidebar-link" aria-expanded="true">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-sliders align-middle"><line x1="4" y1="21" x2="4" y2="14"></line><line x1="4" y1="10" x2="4" y2="3"></line><line x1="12" y1="21" x2="12" y2="12"></line><line x1="12" y1="8" x2="12" y2="3"></line><line x1="20" y1="21" x2="20" y2="16"></line><line x1="20" y1="12" x2="20" y2="3"></line><line x1="1" y1="14" x2="7" y2="14"></line><line x1="9" y1="8" x2="15" y2="8"></line><line x1="17" y1="16" x2="23" y2="16"></line></svg> <span class="align-middle">Dashboards</span>
						</a>
						<ul id="dashboards" class="sidebar-dropdown list-unstyled collapse show" data-bs-parent="#sidebar" style="">
							<li class="sidebar-item active"><a class="sidebar-link" href="/">Analytics</a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/dashboard-ecommerce">E-Commerce <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
							<li class="sidebar-item"><a class="sidebar-link" href="/dashboard-crypto">Crypto <span class="sidebar-badge badge bg-primary">Pro</span></a></li>
						</ul>
					</li>
                    
                    @canany('Role access','Role add','Role edit','Role delete')
					<li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.roles.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Roles</span>
						</a>
					</li>
                    @endcanany
                    @canany('Permission access','Permission add','Permission edit','Permission delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.permissions.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Permission</span>
						</a>
					</li>
                    @endcanany
                    @canany('Team access','Team add','Team edit','Team delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.teams.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Teams</span>
						</a>
					</li>
                    @endcanany
                    @canany('User access','User add','User edit','User delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.users.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Users</span>
						</a>
					</li>
                    @endcanany
                    @canany('Category access','Category add','Category edit','Category delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.categories.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Categories</span>
						</a>
					</li>
                    @endcanany
                    @canany('Brand access','Brand add','Brand edit','Brand delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.brands.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Brands</span>
						</a>
					</li>
                    @endcanany
                    @canany('Client access','Client add','Client edit','Client delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.clients.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Clients</span>
						</a>
					</li>
                    @endcanany
                    @canany('Lead access','Lead add','Lead edit','Lead delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.leads.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Leads</span>
						</a>
					</li>
                    @endcanany
                    @canany('Invoice access','Invoice add','Invoice edit','Invoice delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.invoices.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Invoice</span>
						</a>
					</li>
                    @endcanany
                    @canany('Merchant access','Merchant add','Merchant edit','Merchant delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.merchants.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Merchants</span>
						</a>
					</li>
                    @endcanany
                    @canany('Gateway access','Gateway add','Gateway edit','Gateway delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.gateways.index') }}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Payment Gateway</span>
						</a>
					</li>
                    @endcanany
                    @canany('Payment access','Payment add','Payment edit','Payment delete')
                    <li class="sidebar-item">
						<a class="sidebar-link" href="{{ route('admin.paymentList')}}">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Payments</span>
						</a>
					</li>
                    @endcanany




                    <li class="sidebar-item">
						<a class="sidebar-link" href="pages-profile.html">
						<i class="align-middle" data-feather="user"></i> <span class="align-middle">Profile</span>
						</a>
					</li>
					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-in.html">
						<i class="align-middle" data-feather="log-in"></i> <span class="align-middle">Sign In</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-sign-up.html">
						<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Sign Up</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="pages-blank.html">
						<i class="align-middle" data-feather="book"></i> <span class="align-middle">Blank</span>
						</a>
					</li>

					<li class="sidebar-header">
						Tools & Components
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-buttons.html">
						<i class="align-middle" data-feather="square"></i> <span class="align-middle">Buttons</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-forms.html">
						<i class="align-middle" data-feather="check-square"></i> <span class="align-middle">Forms</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-cards.html">
						<i class="align-middle" data-feather="grid"></i> <span class="align-middle">Cards</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="ui-typography.html">
						<i class="align-middle" data-feather="align-left"></i> <span class="align-middle">Typography</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="icons-feather.html">
						<i class="align-middle" data-feather="coffee"></i> <span class="align-middle">Icons</span>
						</a>
					</li>

					<li class="sidebar-header">
						Plugins & Addons
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="charts-chartjs.html">
						<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Charts</span>
						</a>
					</li>

					<li class="sidebar-item">
						<a class="sidebar-link" href="maps-google.html">
						<i class="align-middle" data-feather="map"></i> <span class="align-middle">Maps</span>
						</a>
					</li>
				</ul>

				<div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<div class="d-grid">
							<a href="upgrade-to-pro.html" class="btn btn-primary">Upgrade to Pro</a>
						</div>
					</div>
				</div>
			</div>
		</nav>