@extends('layouts.guest.app')

@section('title', 'E-Barangay System | Login')

@section('content')
    <!-- Page content -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-12">
                    <div class="card" style="border:none">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-6 d-none d-md-block my-auto">
                                <img src="{{ asset('img/auth/login.svg') }}" alt="login" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form action="{{ route('login') }}" method="POST">
                                        @csrf
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <img class="img-fluid rounded-circle me-3"
                                                src="{{ asset('img/logo/logo.png') }}" width="75" alt="logo">
                                            <span class="h2 fw-bold mb-0 text-success">{{ config('app.name') }}</span>

                                            <div class='dropdown ms-auto' title="go to page">
                                                <a class='text-success' href='#' role='button'
                                                    data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                                                    <i class="fas fa-arrow-right"></i>
                                                </a>
                                                <div class='dropdown-menu dropdown-menu-right dropdown-menu-arrow'>
                                                    <a class='dropdown-item' href="/">Home</a>
                                                    <a class='dropdown-item'
                                                        href="{{ route('guest.announcements.index') }}">Announcement</a>
                                                    <a class='dropdown-item'
                                                        href="{{ route('guest.officials.index') }}">Officials</a>
                                                    <a class='dropdown-item'
                                                        href="{{ route('resident.requests.create') }}">Issuance</a>
                                                    <a class='dropdown-item' href="javascript:void(0)">Contact Us</a>
                                                </div>
                                            </div>

                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign in to your account
                                        </h5>

                                        {{-- <div class="alert bg-dark alert-dismissible fade show p-3 text-white"
                                            role="alert">

                                            <p>
                                                Note: Please use the system responsibly, as we do not tolerate any unusual
                                                activity within the system. Everything within the system is owned by us, and
                                                we have the right to terminate your access if we discover that you are
                                                taking advantage of it. Kindly read and understand the information provided.
                                                If you encounter any unusual errors or if you would like to have a
                                                customized version of the demo project , feel free to send a message to
                                                <a class="text-warning" href="mailto:info@dvocapstoneprojectmaker.com">Our
                                                    Support 🔥
                                                </a>
                                            </p>

                                            Default Login:

                                            <ul>
                                                <li>ADMIN - Email: admin@gmail.com | PW: test1234</li>
                                                <li>RESIDENT - Email: resident@gmail.com| PW: test1234</li>
                                            </ul>
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close">
                                            </button>
                                        </div> --}}

                                        @include('layouts.includes.alert')

                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-success text-white"><i
                                                    class="fas fa-envelope fa-xs"></i></span>
                                            <input class="form-control" type="email" name="email" placeholder="Email"
                                                value="">
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text bg-success text-white" id="password"><i
                                                    class="fas fa-eye fa-xs"></i></span>
                                            <input class="form-control" type="password" name="password" placeholder="******"
                                                value="" id="password_field">
                                        </div>

                                        <div class="text-end">
                                            <a class="text-sm text-dark" href="{{ route('password.request') }}">Forgot
                                                Password?</a>
                                        </div>

                                        <div class="mt-3 mb-4">
                                            <button class="btn btn-success btn-lg w-100" type="submit">Login</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Page content -->
@endsection
@section('script')
    <script>
        const password_field = document.getElementById('password_field');
        document.getElementById('password').addEventListener('click', function() {
            return password_field.getAttribute('type') == "password" ?
                password_field.setAttribute('type', 'text') :
                password_field.setAttribute('type', 'password')
        })

        $('#main_login_nav').addClass('active')
    </script>
@endsection
