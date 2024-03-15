@extends('layouts.admin.app')

@section('title', 'Admin | Blotter Report Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.blotters.index') }}">All Reports</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">lotter #ID - {{ $blotter->id }}</li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-body">
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <h1>Blotter Report <i class="fas fa-info-circle ml-1"></i></h1> <br>

                                <h3 class="font-weight-normal text-capitalize">Complainant: {{ $blotter->complainant }}
                                </h3>
                                <h3 class="font-weight-normal text-capitalize">Respondent:
                                    {{ $blotter->respondent ?? 'N/A' }}</h3>
                                <h3 class="font-weight-normal">Location of Incident: {{ $blotter->location }}</h3>
                                <h3 class="font-weight-normal">Date of Incident:
                                    {{ formatDate($blotter->date_of_incident, 'dateTime') }}</h3>
                                <h3 class="font-weight-normal">Statement: {{ $blotter->statement }}</h3>
                                <h3 class="font-weight-normal">Reported At:
                                    {{ formatDate($blotter->created_at, 'dateTime') }}</h3>
                                <h3 class="font-weight-normal">In-Charge: {{ $blotter->official->name }}</h3>
                                <h3 class="font-weight-normal">Status: {!! isSolved($blotter->is_solved) !!}</h3>

                            </div>
                            <div class="col-md-6 mt-5 mt-md-0">
                                <h1>Files <i class="fas fa-image ml-1"></i></h1> <br>

                                @forelse ($blotter->getMedia('blotter_images') as $image)
                                    <a href="{{ $image->getUrl() }}" class="glightbox">
                                        <img class="img-fluid" src="{{ $image->getUrl('card') }}" width="400"
                                            alt="image">
                                    </a>
                                @empty
                                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/nodata.svg') }}"
                                        alt="nodata">
                                    <p class="text-center">Image/s Not Found</p>
                                @endforelse

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
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
        $('#blotters_nav').addClass('active')
    </script>
@endsection
