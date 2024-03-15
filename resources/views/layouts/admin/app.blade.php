<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Admin | Dashboard')</title>
    @include('layouts.admin.styles')
    @yield('styles')
</head>

<body class="g-sidenav-pinned">
    @include('layouts.admin.modal')
    {{-- Side Nav --}}
    <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header d-flex align-items-center">
                <img class="navbar-brand mt-3 image-fluid rounded-circle"
                    src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}" width="120" alt="avatar"
                    title="{{ auth()->user()->name }}">
                <div class="d-block d-lg-none">
                    <div class="sidenav-toggler" data-action="sidenav-unpin" data-target="#sidenav-main">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <h5 class="font-weight-normal text-muted mt-2 mt-md-0">Administrator
                    </h5>
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.dashboard.index') }}" id="dashboard_nav">
                                <i class="ni ni-tv-2"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.blotters.index') }}" id="blotters_nav">
                                <i class="fas fa-clipboard"></i>
                                <span class="nav-link-text">Blotter Report</span>
                                <span class="badge bg-warning ml-1">{{ $pending_blotters }}</span>
                            </a>
                        </li>


                        <li class="nav-item">
                            <a class="nav-link" href="#to_services" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-tables" id="services_management_nav">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="nav-link-text">
                                    Services Management
                                </span>
                            </a>
                            <div class="collapse" id="to_services">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.services.index') }}" class="nav-link" id="services">
                                            Services
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.requests.index') }}" class="nav-link" id="requests">
                                            Requests <span class="badge bg-warning ml-1">{{ $pending_requests }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#to_official" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-tables" id="official_management_nav">
                                <i class="fas fa-users"></i>
                                <span class="nav-link-text">
                                    Official Management
                                </span>
                            </a>
                            <div class="collapse" id="to_official">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.positions.index') }}" class="nav-link" id="positions">
                                            Positions
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.officials.index') }}" class="nav-link" id="officials">
                                            Officials
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#to_resident" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-tables" id="resident_management_nav">
                                <i class="fas fa-users"></i>
                                <span class="nav-link-text">
                                    Resident Management
                                </span>
                            </a>
                            <div class="collapse" id="to_resident">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.puroks.index') }}" class="nav-link" id="purok">
                                            Purok
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.residents.index') }}" class="nav-link"
                                            id="resident">
                                            Resident
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#to_inventory" data-toggle="collapse" role="button"
                                aria-expanded="false" aria-controls="navbar-tables" id="inventory_management_nav">
                                <i class="fas fa-clipboard"></i>
                                <span class="nav-link-text">
                                    Inventory Management
                                </span>
                            </a>
                            <div class="collapse" id="to_inventory">
                                <ul class="nav nav-sm flex-column">
                                    <li class="nav-item">
                                        <a href="{{ route('admin.categories.index') }}" class="nav-link"
                                            id="category">
                                            Category
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{ route('admin.products.index') }}" class="nav-link"
                                            id="product">
                                            Product
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.users.index') }}" id="auth_management_nav">
                                <i class="fas fa-user-cog"></i>
                                <span class="nav-link-text">Auth Management</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.announcements.index') }}"
                                id="announcement_nav">
                                <i class="fas fa-bell"></i>
                                <span class="nav-link-text">Announcement</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.activity_logs.index') }}"
                                id="activity_logs_nav">
                                <i class="fas fa-history"></i>
                                <span class="nav-link-text">Activity Logs</span>
                            </a>
                        </li>


                    </ul>
                    <!-- Divider -->
                    <hr class="my-3">
                    <!-- Heading -->
                    <h6 class="navbar-heading p-0 text-muted">
                        <span class="docs-normal">Settings</span>
                    </h6>
                    <!-- Navigation -->
                    <ul class="navbar-nav mb-md-3">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.index') }}" id="profile_nav">
                                <i class="ni ni-single-02"></i>
                                <span class="nav-link-text">Profile</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav> {{-- End Side Nav --}}

    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-success border-bottom">
            <div class="container-fluid">
                <h3 class="text-white d-none d-md-block font-weight-normal"><i class="far fa-calendar-alt mr-1"></i>
                    Today:
                    {{ formatDate(now(), 'dateTime') }}
                </h3>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center  ml-md-auto ">
                        <li class="nav-item">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin"
                                data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="ni ni-bell-55"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-xl  dropdown-menu-right  py-0 overflow-hidden">
                                <!-- Dropdown header -->
                                <div class="px-3 py-3">
                                    <h6 class="text-sm text-muted m-0">You have
                                        <strong>{{ $new_requests->count() }}</strong>
                                        notification/s.
                                    </h6>
                                </div>
                                <!-- List group -->
                                @forelse ($new_requests as $request)
                                    <div class="list-group list-group-flush">
                                        <a href="{{ route('admin.requests.show', $request->subject_id) }}"
                                            class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <div class="col-auto">
                                                    <!-- Avatar -->
                                                    <img src="{{ asset('img/noimg.svg') }}"
                                                        class="avatar rounded-circle" alt="avatar">
                                                </div>
                                                <div class="col ml--2">
                                                    <p class="text-sm mb-0">{{ $request->description }}
                                                    </p>
                                                    <small>{{ $request->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </a>

                                    </div>
                                @empty
                                    <div class="list-group list-group-flush">
                                        <a href="javascript:void(0)" class="list-group-item list-group-item-action">
                                            <div class="row align-items-center">
                                                <img class="img-fluid d-block mx-auto"
                                                    src="{{ asset('img/nodata.svg') }}" width="100"
                                                    alt="empty">
                                            </div>
                                        </a>

                                    </div>
                                @endforelse
                                <!-- View all -->
                                <a href="javascript:void(0)"
                                    class="dropdown-item text-center font-weight-bold py-3">View all</a>
                            </div>
                        </li>

                    </ul>
                    <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img src="{{ handleNullAvatar(auth()->user()->avatar_profile) }}"
                                            class="avatar rounded-circle" alt="Image placeholder">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Settings</h6>
                                </div>
                                <a href="{{ route('profile.index') }}" class="dropdown-item">
                                    <i class="ni ni-single-02"></i>
                                    <span>Profile</span>
                                </a>

                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0)" class="dropdown-item"
                                    onclick="confirm('Do you want to Logout?', '', 'Yes').then(res => res.isConfirmed ? $('#logout').submit() : false)">
                                    <i class="fas fa-power-off"></i>
                                    <span>Logout</span>
                                </a>
                                <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->

        @yield('content')

    </div>
    {{-- End Main Content --}}

    @include('layouts.admin.scripts')
    <script src="{{ asset('assets/js/admin/script.js') }}"></script>
    @yield('script')
    @routes

</body>

</html>
