@extends('layouts.guest.app')

@section('title', 'E-Barangay System | Register')

@section('content')
    <!-- Page content -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-12">
                    <div class="card" style="border:none">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-6 d-none d-md-block my-auto">
                                <img src="{{ asset('img/auth/mail.svg') }}" alt="login" class="img-fluid"
                                    style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-6 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                <form action="{{ route('register') }}" method="POST">
                                @csrf

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img class="img-fluid rounded-circle me-3"
                                            src="{{ asset('img/logo/logo.png') }}" width="75" alt="logo">
                                        <span class="h2 fw-bold mb-0 text-success">{{ config('app.name') }}</span>
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign up for an account</h5>

                                    @include('layouts.includes.alert')

                                    <div class="input-group mb-3">
                                        <span class="input-group-text bg-success text-white"><i class="fas fa-envelope fa-xs"></i></span>
                                        <input class="form-control" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                                    </div>

                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white" id="password"><i class="fas fa-eye fa-xs"></i></span>
                                                <input class="form-control" type="password" name="password" placeholder="Password" id="password_field" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white" id="confirm_password"><i class="fas fa-eye fa-xs"></i></span>
                                                <input class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password" id="confirm_password_field" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-envelope fa-xs"></i></span>
                                                <input class="form-control" type="text" name="first_name" placeholder="First Name" value="{{ old('first_name') }}" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-envelope fa-xs"></i></span>
                                                <input class="form-control" type="text" name="middle_name" placeholder="Middle Name" value="{{ old('middle_name') }}" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-envelope fa-xs"></i></span>
                                                <input class="form-control" type="text" name="last_name" placeholder="Last Name" value="{{ old('last_name') }}" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-map-marker-alt fa-xs"></i></span>
                                                <input class="form-control" type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
                                            </div>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-map-marker-alt fa-xs"></i></span>
                                                <select class="form-select" name="purok_id" required>
                                                    <option value="" selected disabled>Purok #</option>
                                                    @foreach ($puroks as $id => $purok)
                                                        <option value="{{ $id }}" @if(old('purok_id') == $id) selected @endif>
                                                            {{ $purok }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            
                                            <div class="input-group mb-3">
                                                <div class="input-group-text bg-success text-white" style="margin-right: 12px">
                                                    <input class="form-check-input mt-0" type="checkbox" value="1" name="is_voter" id="is_voter_checkbox" @if(old('is_voter') == '1') checked @endif>
                                                </div>
                                                <label class="form-check-label" for="is_voter_checkbox">Registered Voter</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-phone fa-xs"></i></span>
                                                <input class="form-control" type="number" name="contact" placeholder="Contact" value="{{ old('contact') }}" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-heart fa-xs"></i></span>
                                                <select class="form-select" name="civil_status" required>
                                                    <option value="" selected disabled>Civil Status</option>
                                                    <option value="single" @if(old('civil_status') == 'single') selected @endif>Single</option>
                                                    <option value="married" @if(old('civil_status') == 'married') selected @endif>Married</option>
                                                    <option value="divorced" @if(old('civil_status') == 'divorced') selected @endif>Divorced</option>
                                                    <option value="widowed" @if(old('civil_status') == 'widowed') selected @endif>Widowed</option>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-passport fa-xs"></i></span>
                                                <input class="form-control" type="text" name="citizenship" placeholder="Citizenship" value="{{ old('citizenship') }}" required>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-venus-mars fa-xs"></i></span>
                                                <select class="form-select" id="gender" name="gender" required>
                                                    <option value="" disabled selected>Select Gender</option>
                                                    <option value="male" @if(old('gender') == 'male') selected @endif>Male</option>
                                                    <option value="female" @if(old('gender') == 'female') selected @endif>Female</option>
                                                </select>
                                            </div>

                                            <div class="input-group mb-3">
                                                <span class="input-group-text bg-success text-white"><i class="fas fa-calendar-alt fa-xs"></i></span>
                                                <input class="form-control" type="date" name="birth_date" placeholder="Birth Date" value="{{ old('birth_date') }}" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-3 mb-4">
                                        <button class="btn btn-success btn-lg w-100" type="submit">Register</button>
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

        $('#register_nav').addClass('active')
    </script>
@endsection
