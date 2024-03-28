
@extends('layouts.guest.app')

@section('title', 'E-Barangay System | Email Verification')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Email Verification') }}</div>

                    <div class="card-body">
                        @if ($status == 'verified')
                            <div class="alert alert-success" role="alert">
                                {{ __('Your email has been successfully verified.') }}
                            </div>
                        @elseif ($status == 'already_verified')
                            <div class="alert alert-info" role="alert">
                                {{ __('Your email is already verified.') }}
                            </div>
                        @else
                            <div class="alert alert-danger" role="alert">
                                {{ __('Invalid verification link.') }}
                            </div>
                        @endif
    
                        @if ($status == 'verified' || $status == 'already_verified')
                            <p>Redirecting to dashboard in <span id="countdown">5</span> seconds...</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        // Countdown timer
        var count = 5;
        var countdown = document.getElementById('countdown');

        function redirect() {
            // Redirect to dashboard
            window.location.href = '{{ route("resident.requests.index") }}'; // Adjust the route as needed
        }

        var countdownInterval = setInterval(function() {
            count--;
            countdown.textContent = count;

            if (count <= 0) {
                clearInterval(countdownInterval);
                redirect(); // Redirect after countdown
            }
        }, 1000);

        // Redirect after 5 seconds if the user hasn't verified
        setTimeout(redirect, 5000);
    </script>
@endsection