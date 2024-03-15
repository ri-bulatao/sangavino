@extends('layouts.admin.app')

@section('content')
    <!-- Header -->
    <div class="header pb-6">
        <div class="container-fluid">
            <div class="alert alert-dark alert-dismissible fade show p-3 text-white mt-3" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <p class="translated_text">
                    Note: This is the admin dashboard page where we present the initial graphical visualization of various
                    data,
                    such
                    as
                    the total requests by barangay service, monthly user statistics, recent announcements, and activity logs
                    by
                    the administrator.

                </p>
                <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                    onclick="translateToTagalog(this)">Click
                    to Translate in Tagalog</a>
            </div>
            <div class="header-body">
                {{-- row 1 --}}
                <div class="row mt-3">
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Announcement</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_announcement }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-bell"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Blotter</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_blotter }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Services Request</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_request }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-clipboard-list"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Registered Resident</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_resident }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end row 1 --}}

                {{-- row 2 --}}
                <div class="row">
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Voter</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_voter }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Non-Voter</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_non_voter }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total Active User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_active_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-success text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6 col-md-6 d-flex align-self-stretch">
                        <div class="card card-stats w-100">
                            <!-- Card body -->
                            <div class="card-body d-flex and flex-column">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title text-uppercase text-muted mb-0">Total In-Active User</h5>
                                        <span class="h2 font-weight-bold mb-0">{{ $total_inactive_user }}</span>
                                    </div>
                                    <div class="col-auto">
                                        <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                            <i class="fas fa-users"></i>
                                        </div>
                                    </div>
                                </div>
                                <p class="mt-3 mb-0 text-sm">

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- end row 2 --}}
            </div>
        </div>
    </div>

    <!-- Page Content -->
    <div class="container-fluid mt--6">
        <div class="row">
            <div class="col-xl-8 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-success">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0 font-weight-normal">Total Requests by Service</h3>

                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <canvas id="services_requests">{{-- display total request by service --}}</canvas>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-success">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0 font-weight-normal">Monthly User</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <canvas id="monthly_users">{{-- display total monthly user by --}}</canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-8 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-success">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0 font-weight-normal">Recent Announcements</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.announcements.index') }}" class="btn btn-sm btn-warning">See
                                    all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        <div class="table-responsive">
                            <!-- Projects table -->
                            <table class="table align-items-center table-flush">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Cover Photo</th>
                                        <th scope="col">Title</th>
                                        <th>Created At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($announcements as $announcement)
                                        <tr>
                                            <td>{{ $announcement->id }}</td>
                                            <td><img class="img-fluid d-block mx-auto"
                                                    src="{{ handleNullCoverPhoto($announcement->cover_photo) }}"
                                                    width="75" alt="cover_photo"></td>
                                            <td>{{ $announcement->title }}</td>
                                            <td>{{ $announcement->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3">Record Not Found</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 d-flex align-self-stretch">
                <div class="card w-100">
                    <div class="card-header bg-success">
                        <div class="row align-items-center">
                            <div class="col">
                                <h3 class="text-white mb-0 font-weight-normal">Activity Logs</h3>
                            </div>
                            <div class="col text-right">
                                <a href="{{ route('admin.activity_logs.index') }}" class="btn btn-sm btn-warning">See
                                    all</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body d-flex and flex-column">
                        @foreach ($activities as $al)
                            @php
                                $exploaded = explode('-', $al->description);
                            @endphp
                            <div class='border-left border-success'>
                                <p class="m-0 pl-2">{{ $exploaded[0] }} - <span class='txt-lightblue'>
                                        {{ $exploaded[1] }} </span> </p>
                                <p class='pl-2'> {{ $al->created_at->diffForHumans() }} </p>
                            </div>
                            <br>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.includes.footer')
    </div>
    <!-- End Page Content -->
@endsection

@section('script')
    <script>
        const bgc = ['#008000', '#f1c40f', '#95a5a6', '#2c3e50', '#ecf0f1', '#2980b9'];

        const services = {!! json_encode($services_requests[0]) !!};
        const total_request = {!! json_encode($services_requests[1]) !!};

        const services_requests = document.getElementById('services_requests');
        const chart_services_requests = new Chart(services_requests, {
            type: 'bar', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: services,
                datasets: [{
                    label: 'Total Request By Service',
                    data: total_request,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Total Request By Service'
                }
            }
        });


        const months = {!! json_encode($monthly_users[0]) !!};
        const total_user = {!! json_encode($monthly_users[1]) !!};

        const monthly_users = document.getElementById('monthly_users');
        const chart_monthly_users = new Chart(monthly_users, {
            type: 'doughnut', // bar , horizontal, line ,doughnut ,radar , polarArea
            data: {
                labels: months,
                datasets: [{
                    label: 'Monthly User',
                    data: total_user,
                    backgroundColor: bgc
                }],

            },
            options: {
                title: {
                    display: true,
                    text: 'Monthly User'
                }
            }
        });

        $('#dashboard_nav').addClass('active')
    </script>
@endsection
