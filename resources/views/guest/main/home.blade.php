@extends('layouts.guest.app')

@section('content')
    <!-- Carousel Start -->
    <div class="container-fluid p-0 pb-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="owl-carousel header-carousel position-relative">
            @forelse ($announcements as $announcement)
                <div class="owl-carousel-item position-relative"
                    data-dot="<img src='{{ handleNullCoverPhoto($announcement->cover_photo) }}'>">
                    <img class="img-fluid" src="{{ handleNullCoverPhoto($announcement->cover_photo) }}" alt="cover_photo">
                    <div class="owl-carousel-inner">
                        <div class="container ">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-1 text-white animated slideInDown">
                                        {{ $announcement->title }}
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-3"> Barangay San Gavino, Victoria, Tarlac
                                    </p>
                                    <a href="{{ route('guest.announcements.show', $announcement) }}"
                                        class="btn btn-success py-3 px-5 animated slideInLeft">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="owl-carousel-item position-relative" data-dot="<img src='{{ asset('img/noimg.png') }}'>">
                    <img class="img-fluid" src="{{ asset('img/noimg.png') }}" alt="">
                    <div class="owl-carousel-inner">
                        <div class="container">
                            <div class="row justify-content-start">
                                <div class="col-10 col-lg-8">
                                    <h1 class="display-1 text-white animated slideInDown"> Example Title
                                    </h1>
                                    <p class="fs-5 fw-medium text-white mb-4 pb-3">Barangay San Gavino, Victoria, Tarlac</p>
                                    <a href="" class="btn btn-success py-3 px-5 animated slideInLeft">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
    <!-- Carousel End -->

    <!-- Announcement Start -->
    <section id="announcement">
        <div class="container-xxl project py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">Announcements</h4>
                    <h1 class="display-6 mb-4">Know The Latest Announcements In Our Barangay</h1>
                </div>
                <div class="row g-4 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="col-lg-4">
                        <div class="nav nav-pills d-flex justify-content-between w-100 h-100 me-4">

                            @foreach ($announcements as $announcement)
                                @if ($loop->first)
                                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4 active"
                                        data-bs-toggle="pill" data-bs-target="#announcement-{{ $loop->index }}"
                                        type="button">
                                        <h3 class="m-0">{{ $announcement->title }}</h3>
                                    </button>
                                @else
                                    <button class="nav-link w-100 d-flex align-items-center text-start p-4 mb-4"
                                        data-bs-toggle="pill" data-bs-target="#announcement-{{ $loop->index }}"
                                        type="button">
                                        <h3 class="m-0">{{ $announcement->title }}</h3>
                                    </button>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content w-100">
                            @foreach ($announcements as $announcement)
                                @if ($loop->first)
                                    <div class="tab-pane fade show active" id="announcement-{{ $loop->index }}">
                                        <div class="row g-4">
                                            <div class="col-md-6" style="min-height: 350px;">
                                                <div class="position-relative h-100">
                                                    <img class="position-absolute img-fluid w-100 h-100"
                                                        src="{{ handleNullCoverPhoto($announcement->cover_photo) }}"
                                                        style="object-fit: cover;" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="mb-3">{{ $announcement->title }}</h1>
                                                {!! Str::limit($announcement->content, 500) !!} <br>

                                                <a href="" class="btn btn-success py-3 px-5 mt-3">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="tab-pane fade show" id="announcement-{{ $loop->index }}">
                                        <div class="row g-4">
                                            <div class="col-md-6" style="min-height: 350px;">
                                                <div class="position-relative h-100">
                                                    <img class="position-absolute img-fluid w-100 h-100"
                                                        src="{{ handleNullCoverPhoto($announcement->cover_photo) }}"
                                                        style="object-fit: cover;" alt="">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <h1 class="mb-3">{{ $announcement->title }}</h1>
                                                {!! Str::limit($announcement->content, 500) !!} <br>

                                                <a href="{{ route('guest.announcements.show', $announcement) }}"
                                                    class="btn btn-success py-3 px-5 mt-3">Read More</a>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Announcement End -->
    </section>
    <section id="officials">
        <!-- Official Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">Officials</h4>
                    <h1 class="display-6 mb-4">We Are Your Barangay Officials</h1>
                </div>
                <div class="row g-0 team-items">
                    @foreach ($officials as $official)
                        <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="team-item position-relative">
                                <div class="position-relative">
                                    <img class="img-fluid d-block mx-auto" src="{{ asset('img/noimg.svg') }}"
                                        width="150" alt="">

                                </div>
                                <div class="bg-light text-center p-4">
                                    <h3 class="mt-2">{{ $official->name }}</h3>
                                    <span class="text-success">{{ $official->position->name }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Official End -->

    </section>

    <!-- Service Start -->
    <section id="issuance">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h4 class="section-title">Issuance</h4>
                    <h1 class="display-6 mb-4">We Focused On Giving You Your Required Documents</h1>
                </div>
                <div class="row g-4">
                    @foreach ($services as $service)
                        <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="service-item d-flex position-relative text-center h-100">
                                <img class="bg-img" src="{{ asset('img/services/default.png') }}" alt="">
                                <div class="service-text p-md-2">
                                    <img class="mb-4" src="{{ asset('img/services/default.png') }}" alt="Icon">
                                    <h3 class="mb-3">{{ $service->name }}</h3>
                                    <h3 class="mb-3">PHP {{ $service->fee }}</h3>
                                    <p class="mb-4">{{ $service->description }}</p>
                                    <a class="btn" href="{{ route('resident.requests.create') }}"><i
                                            class="fa fa-plus text-success me-3"></i>R e q u
                                        e s t</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- Service End -->
    </section>

    <!-- Contact Start -->
    <section id="contactus">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5">
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s">
                        <h4 class="section-title">Contact Us</h4>
                        <h1 class="display-6 mb-4">Contact Us From The Information Given Below</h1>
                        <p class="mb-4">Need help? Our support got you covered on your concern or questions in mind.</p>
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-light"
                                        style="width: 65px; height: 65px;">
                                        <i class="fa fa-2x fa-phone-alt text-success"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">Call Us</p>
                                        <h3 class="mb-0">093 - 5763 - 5307</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-flex">
                                    <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-light"
                                        style="width: 65px; height: 65px;">
                                        <i class="fa fa-2x fa-envelope-open text-success"></i>
                                    </div>
                                    <div class="ms-4">
                                        <p class="mb-2">E-Mail Us</p>
                                        <h3 class="mb-0">barangay.sangavino1928@gmail.com</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.5s">
                        <iframe class="map"
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3843.3287166002287!2d120.68203077591572!3d15.574076352501654!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3396cd7d71291fd5%3A0x7d54472e691046e0!2sSAN%20GAVINO%20BRGY.%20HALL!5e0!3m2!1sen!2sph!4v1704173443246!5m2!1sen!2sph"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- Contact End -->

    <div class="container-fluid bg-dark text-body footer mt-5 pt-5 px-0 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Address</h3>
                    <p class="mb-2"><i class="fa fa-map-marker-alt text-success me-3"></i>Barangay San Gavino, Victoria,
                        Tarlac
                    </p>
                    <p class="mb-2"><i class="fa fa-phone-alt text-success me-3"></i>09357635307</p>
                    <p class="mb-2"><i class="fa fa-envelope text-success me-3"></i>barangay.sangavino@gmail.com
                    </p>

                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Issuance</h3>
                    @foreach ($services as $service)
                        <a class="btn btn-link" href="{{ route('resident.requests.create') }}">{{ $service->name }}</a>
                    @endforeach
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Quick Links</h3>
                    <a class="btn btn-link" href="{{ route('guest.announcements.index') }}">Announcement</a>
                    <a class="btn btn-link" href="{{ route('guest.officials.index') }}">Officials</a>
                    <a class="btn btn-link" href="{{ route('resident.requests.index') }}">Issuance</a>
                    <a class="btn btn-link" href="javascript:void(0)">Contact Us</a>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h3 class="text-light mb-4">Social Media</h3>
                    <div class="d-flex pt-2">
                        <a class="btn btn-square btn-outline-body me-1" href="javascript:void(0)"><i
                                class="fab fa-facebook-f"></i>
                        </a>
                        <a class="btn btn-square btn-outline-body me-1" href="javascript:void(0)"><i
                                class="fab fa-instagram"></i>
                        </a>
                        <a class="btn btn-square btn-outline-body me-1" href="javascript:void(0)"><i
                                class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@section('script')
    <script>
        $('#home_nav').addClass('active')
    </script>
@endsection
