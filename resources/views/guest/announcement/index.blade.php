@extends('layouts.guest.app')

@section('title', 'Barangay San Gavino | Announcements')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <h2 class="font-weight-normal">
            List Of Announcements
        </h2>
        <br>
        <div class="row justify-content-center">
            @forelse ($announcements as $announcement)
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="row g-0">
                            <div class="d-none d-md-block col-md-2 border-right">
                                <img class="card-img-top" src="{{ handleNullCoverPhoto($announcement->cover_photo) }}"
                                    id="show_img" alt="cover_photo">
                            </div>
                            <div class="col-md-10">
                                <div class="card-body">
                                    <h2 class="fw-bold">
                                        <a class="text-dark"
                                            href="{{ route('guest.announcements.show', $announcement) }}">{{ $announcement->title }}</a>
                                        </h3>
                                        <p class="me-1">
                                            Barangay San Gavino |
                                            {{ formatDate($announcement->created_at) }} <i class="far fa-calendar ml-1"></i>
                                        </p>
                                        <p class="card-text"><small class="text-muted">Last updated
                                                {{ is_null($announcement->updated_at) ? $announcement->created_at->diffForHumans() : $announcement->updated_at->diffForHumans() }}</small>
                                        </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-md-12">
                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/nodata.svg') }}" alt="nodata">
                    <p class="text-center">Record Not Found</p>
                </div>
            @endforelse

        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script>
        $('#announcement_nav').addClass('active')
    </script>
@endsection
