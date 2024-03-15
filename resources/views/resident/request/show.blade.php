@extends('layouts.resident.app')

@section('title', 'E-Barangay System | Request Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="text-success" href="{{ route('resident.requests.index') }}"><i
                                class="fas fa-arrow-left fa-lg"></i>
                        </a>

                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('img/crud/show.svg') }}" alt="">
                            </div>
                            <div class="col-md-7">
                                <h1>Issuance <i class="fas fa-info-circle ml-1"></i></h1><br>
                                <h2 class="font-weight-normal">Paypal Transaction #: {{ $request->transaction_id }}
                                </h2>
                                <h2 class="font-weight-normal">Requestor: {{ $request->user->resident->full_name }}</h2>
                                <h2 class="font-weight-normal">Service: {{ $request->service->name }}</h2>
                                <h2 class="font-weight-normal">Service Fee: ₱ {{ $request->service->fee }}</h2>
                                <h2 class="font-weight-normal">Purpose: {{ $request->purpose }}</h2>
                                <h2 class="font-weight-normal">Requested At: {{ formatDate($request->created_at) }}</h2>
                                <h2 class="font-weight-normal">Status: {!! handleRequestStatus($request->status) !!}</h2>
                                @if ($request->remark)
                                    <h2 class="font-weight-normal">Remark: {{ $request->remark }}</h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script>
        $("#issuance_nav").addClass("active");
    </script>
@endsection
