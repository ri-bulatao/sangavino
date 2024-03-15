<!DOCTYPE html>
<html lang="en">

<title>@yield('title', 'Barangay San Gavino')</title>
@include('layouts.guest.styles')

<body>

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-success position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border position-relative text-white" style="width: 6rem; height: 6rem;" role="status">
        </div>
        <img class="position-absolute top-50 start-50 translate-middle" src="{{ asset('img/logo/logo.png') }}"
            alt="Icon" width="250">
    </div>
    <!-- Spinner End -->

    @if (url()->current() !== route('login') && !Route::is('password.*'))
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg bg-success navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn"
            data-wow-delay="0.1s">
            <a href="/" class="navbar-brand ms-4 ms-lg-0">
                <h1 class="text-white m-0"><img class="img-fluid me-3" src="{{ asset('img/logo/logo.png') }}"
                        alt="Icon" width="100">Barangay San Gavino
                </h1>
            </a>
            <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse"
                data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto p-4 p-lg-0">
                    <a href="/" class="nav-item nav-link" id="home_nav">Home</a>
                    <a href="{{ route('guest.announcements.index') }}" class="nav-item nav-link"
                        id="announcement_nav">Announcement</a>
                    <a href="{{ route('guest.officials.index') }}" class="nav-item nav-link"
                        id="officials_nav">Officials</a>
                    <a href="{{ route('resident.requests.index') }}" class="nav-item nav-link"
                        id="issuance_nav">Issuance</a>
                    <a href="/#contactus" class="nav-item nav-link">Contact Us</a>
                    @guest
                        <a href="{{ route('login') }}" class="nav-item nav-link" id="login_nav">Login</a>
                    @endguest
                    @auth
                        <div class="dropdown nav-item">
                            <a class="dropdown-toggle nav-item nav-link" href="javascript:void(0)" role="button"
                                id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                                Account
                            </a>

                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)"
                                        onclick="confirm('Do you want to Logout?', '', 'Yes').then(res => res.isConfirmed ? $('#logout').submit() : false)">Logout</a>
                                </li>
                            </ul>
                        </div>

                        <form action="{{ route('logout') }}" method="post" id="logout">@csrf</form>

                    @endauth
                </div>
            </div>
        </nav>
        <!-- Navbar End -->
    @endif
    <main>
        @yield('content')
    </main>

    @include('layouts.guest.scripts')
    @yield('script')

</body>

</html>
