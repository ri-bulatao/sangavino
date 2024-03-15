@extends('layouts.guest.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <a class="text-warning" href="{{ route('login') }}"><i class="fas fa-arrow-left"></i></a>
                        <span class="ms-3">{{ __('Reset Password') }}</span>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{-- {{ session('status') }} --}}
                                <p>
                                    A password reset link has been sent to your email address. Email not found? Please check
                                    your email spam folder.
                                </p>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <div class="row mt-5">
                                <div class="col-md-6 ">
                                    <img class="img-fluid" src="{{ asset('img/auth/mail.svg') }}" alt="password_reset.svg">
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" required autocomplete="email"
                                            placeholder="you@email.com" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror

                                        <button type="submit" class="btn btn-success btn-rounded">
                                            Reset <i class="fas fa-key ms-1"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
