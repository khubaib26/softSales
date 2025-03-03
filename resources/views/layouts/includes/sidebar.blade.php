<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="index.html"><img class="blur-up lazyloaded" src="https://themes.pixelstrap.com/multikart/back-end/assets/images/dashboard/multikart-logo.png" alt></a></div>
    </div>
    <div class="sidebar custom-scrollbar" style="background-color: black;">
        <a href="javascript:void(0)" class="sidebar-back d-lg-none d-block"><i class="fa fa-times" aria-hidden="true"></i></a>
        <ul class="sidebar-menu">

            <li>
                <a class="sidebar-header" href="{{ route('admin.dashboard') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                    <span>Dashboard</span>
                </a>
            </li>
            @canany('Role access','Role add','Role edit','Role delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.roles.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <span>Roles</span>
                </a>
            </li>
            @endcanany


            @canany('Permission access','Permission add','Permission edit','Permission delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.permissions.index') }}">
                    <!-- Updated SVG for Permissions (Key Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key">
                        <circle cx="7.5" cy="15.5" r="5.5"></circle>
                        <line x1="21" y1="2" x2="11.5" y2="11.5"></line>
                        <line x1="16" y1="7" x2="20" y2="7"></line>
                        <line x1="18" y1="5" x2="18" y2="9"></line>
                    </svg>
                    <span>Permission</span>
                </a>
            </li>
            @endcanany
            
            @canany('Team access','Team add','Team edit','Team delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.teams.index') }}">
                    <!-- Updated SVG for Brands (Tag Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                        <path d="M20 12v6a2 2 0 0 1-2 2h-6"></path>
                        <path d="M12 2H6a2 2 0 0 0-2 2v6"></path>
                        <line x1="2" y1="2" x2="22" y2="22"></line>
                    </svg>
                    <span>Teams</span>
                </a>
            </li>
            @endcanany

            @canany('User access','User add','User edit','User delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.users.index') }}">
                    <!-- Updated SVG for Users (User Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H7a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                    </svg>
                    <span>Users</span>
                </a>
            </li>
            @endcanany

            

            @canany('Category access','Category add','Category edit','Category delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.categories.index') }}">
                    <!-- Updated SVG for Categories (Grid Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid">
                        <rect x="3" y="3" width="7" height="7"></rect>
                        <rect x="14" y="3" width="7" height="7"></rect>
                        <rect x="14" y="14" width="7" height="7"></rect>
                        <rect x="3" y="14" width="7" height="7"></rect>
                    </svg>
                    <span>Categories</span>
                </a>
            </li>
            @endcanany

            @canany('Brand access','Brand add','Brand edit','Brand delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.brands.index') }}">
                    <!-- Updated SVG for Brands (Tag Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag">
                        <path d="M20 12v6a2 2 0 0 1-2 2h-6"></path>
                        <path d="M12 2H6a2 2 0 0 0-2 2v6"></path>
                        <line x1="2" y1="2" x2="22" y2="22"></line>
                    </svg>
                    <span>Brands</span>
                </a>
            </li>
            @endcanany

            @canany('Lead access','Lead add','Lead edit','Lead delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.leads.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                    <span>Leads</span>
                </a>
            </li>
            @endcanany

            @canany('Gateway access','Gateway add','Gateway edit','Gateway delete')
            <li>
                <a class="sidebar-header" href="{{ route('admin.gateways.index') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive">
                        <polyline points="21 8 21 21 3 21 3 8"></polyline>
                        <rect x="1" y="3" width="22" height="5"></rect>
                        <line x1="10" y1="12" x2="14" y2="12"></line>
                    </svg>
                    <span>Payment Gateway</span>
                </a>
            </li>
            @endcanany
            <li>
                <a class="sidebar-header" href="pages-error-404.html">
                    <!-- Updated SVG for 404 (Alert Triangle Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path>
                        <line x1="12" y1="9" x2="12" y2="13"></line>
                        <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>
                    <span>404</span>
                </a>
            </li>
            <li>
                <a class="sidebar-header" href="pages-blank.html">
                    <!-- Updated SVG for Blank Page (File Icon) -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                    <span>Blank</span>
                </a>
            </li>
        </ul>
    </div>
</div>
