@extends('layouts.secretary.app')

@section('title', 'Barangay Secretary | Request Info')

@section('styles')
    <style>
        body {
            background: #fff !important;
        }
    </style>
@endsection

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <a class="text-success float-left" href="{{ route('secretary.requests.index') }}">
                                <i class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            <a class="btn btn-sm btn-success float-right" href="javascript:void(0)" onclick="printAsPDF()">
                                Save as PDF <i class="fas fa-print ml-1"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card-body" id="capture">

                        <br><br>
                        {{-- Header --}}
                        <div class="row mb-5">
                            <div class="col-2">
                                <!-- School Logo -->
                                <img class="img-fluid d-block mx-auto mt-3" src="{{ asset('img/logo/logo2.png') }}"
                                    alt="logo">
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="col-12 py-4">
                                        <h3 class="font-weight-normal text-center mb-0">
                                            Republic of The Philippines
                                        </h3>
                                        <h3 class="font-weight-normal text-center mb-0">
                                            Province of Victoria
                                        </h3>
                                        <h3 class="font-weight-normal text-center mb-0">
                                            Municipality of Tarlac
                                        </h3>
                                        <h2 class="text-center mb-0">
                                            <strong>BARANGAY SAN GAVINO</strong>
                                            </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-2">
                                <img class="img-fluid d-block mx-auto mt-3" src="{{ asset('img/logo/logo.png') }}"
                                    alt="logo">
                            </div>
                        </div>
                        <br>
                        <h1 class="text-uppercase text-center">OFFICE OF THE PUNONG BARANGAY</h1>
                        <hr class="m-0" style="height:10px;background:#141D81">
                        <br>
                        {{-- End Header --}}
                        {{-- Content --}}
                        @if ($request->service->name == 'Barangay Business Clearance')
                            <div id="container-wrapper">
                                <h1 class="text-uppercase text-center display-3"><strong>barangay business
                                        clearance</strong>
                                </h1>
                                <br><br><br>
                                <h3 class="text-uppercase">to whom it may concern:</h3>
                                <h3 class="font-weight-normal pl-5">This is to certify that
                                    <strong>{{ $request->user->resident->full_name }}</strong> is bonified at Victoria,
                                    Tarlac,
                                    is hereby allowed to engage a <strong>{{ $request->business_name }}</strong> in
                                    this Barangay.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">This certification has been issued for all legal intents
                                    and
                                    purposes it may serve.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">Issue this day
                                    <strong>{{ now()->format('jS \of F Y') }}</strong> at
                                    the
                                    Office of the Punong Barangay,
                                    Victoria, Tarlac
                                </h3>
                            </div>
                            <br><br>
                            {{-- Footer --}}
                            <div class="row mt-5">
                                <div class="col-6">

                                </div>
                                <div class="col-6 pr-5">
                                    <h3 class="text-center">
                                        Certified By
                                    </h3>
                                    <h2 class="text-center mb-0 text-uppercase">
                                        {{ $punong_barangay->name }}
                                    </h2>
                                    <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                </div>
                            </div>
                            {{-- End Footer --}}
                        @elseif ($request->service->name == 'Barangay Clearance')
                            <div id="container-wrapper">
                                <h1 class="text-uppercase text-center display-3"><strong>barangay
                                        clearance</strong>
                                </h1>
                                <br><br><br>
                                <h3 class="text-uppercase">to whom it may concern:</h3>
                                <h3 class="font-weight-normal pl-5">This is to certify that
                                    <strong>{{ $request->user->resident->full_name }}</strong> legal age
                                    single/married with residence and postal address at Barangay San Gavino, Victoria,
                                    Tarlac
                                    has
                                    no derogatory record field in our Barangay.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">The above-named individiual who is a bonafied resident
                                    in this Barangay has person of good moral character.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">This certification is hereby issued upon the request of
                                    the subject person in connection with his/her legal purposes it may serve.
                                </h3>
                                <h3 class="font-weight-normal pl-5">Given this day
                                    <strong>{{ now()->format('jS \of F Y') }}</strong> at
                                    the
                                    Office of the Punong Barangay,
                                    San Gavino, Victoria, Tarlac
                                </h3>
                            </div>
                            <br><br>
                            {{-- Footer --}}
                            <div class="row mt-5">
                                <div class="col-6">
                                    <h3 class=mb-0">{{ $request->user->resident->full_name }}</h3>
                                    <h3 class="font-weight-normal">Over printed Name of Applicant</h3>
                                    <h3 class="font-weight-normal mb-0">CTC NO.</h3>
                                    <h3 class="font-weight-normal mb-0">Issue on: {{ formatDate(now()) }}</h3>
                                    <h3 class="font-weight-normal mb-0">Issue at: Victoria, </h3>
                                </div>
                                <div class="col-6 pr-5">


                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-6">

                                </div>
                                <div class="col-6 pr-5">
                                    <h3 class="text-center">
                                        Certified By
                                    </h3>
                                    <h2 class="text-center mb-0 text-uppercase">
                                        {{ $punong_barangay->name }}
                                    </h2>
                                    <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                </div>
                            </div>
                            {{-- End Footer --}}
                        @elseif ($request->service->name == 'Certificate of Residency')
                            <div id="container-wrapper">
                                <h1 class="text-uppercase text-center display-3"><strong>barangay
                                        certificate of residency</strong>
                                </h1>
                                <br><br><br>
                                <h3 class="text-uppercase">to whom it may concern:</h3>
                                <h3 class="font-weight-normal pl-5">This is to certify that
                                    <strong>{{ $request->user->resident->full_name }}</strong> legal age
                                    married/single, Filipino citizen whose specimen signature appears below, is a
                                    <span class="text-uppercase"><strong>{{ $request->resident_type }}</strong></span> of
                                    this Barangay.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">Based on the records of this Office she/he has been
                                    residing
                                    at Barangay San Gavino, Victoria, Tarlac for
                                    <strong>{{ $request->residency_year }}</strong> years.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">This certification is being issued upon the request of
                                    the
                                    above-named person for whatever legal purposes it may serve.
                                </h3>
                                <h3 class="font-weight-normal pl-5">Issued
                                    <strong>{{ now()->format('jS \of F Y') }}</strong> at
                                    the
                                    Office of the Punong Barangay,
                                    San Gavino, Victoria, Tarlac
                                </h3>
                            </div>

                            <br><br>
                            {{-- Footer --}}
                            <div class="row mt-5">
                                <div class="col-6">
                                    <h3 class="font-weight-normal border-top w-50">Specimen Signature</h3>
                                </div>
                                <div class="col-6 pr-5">


                                </div>
                            </div>
                            <div class="row mt-5">
                                <div class="col-6">

                                </div>
                                <div class="col-6 pr-5">
                                    <h3 class="text-center">
                                        Certified By
                                    </h3>
                                    <h2 class="text-center mb-0 text-uppercase">
                                        {{ $punong_barangay->name }}
                                    </h2>
                                    <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                </div>
                            </div>
                            {{-- End Footer --}}
                        @else
                            <div id="container-wrapper">
                                <h1 class="text-uppercase text-center display-3"><strong>
                                        certificate of indigency</strong>
                                </h1>
                                <br><br><br>
                                <h3 class="text-uppercase">to whom it may concern:</h3>
                                <h3 class="font-weight-normal pl-5">This is to certify that
                                    <strong>{{ $request->user->resident->full_name }}</strong> according to the record of
                                    this Office the bearer is bonafide resident on this Barangay.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">This is to further certify that
                                    <strong>{{ $request->user->resident->full_name }}</strong> bearer the said
                                    constituent of mine belongs to the <strong>INDIGENT FAMILY</strong> of this Barangay.
                                </h3>
                                <br>
                                <h3 class="font-weight-normal pl-5">This <strong>CERTIFICATION OF INDIGENCE</strong> is
                                    being issued upon the request of <strong>{{ $request->purpose }}</strong> for
                                    her/his <strong><em>REQUIREMENT</em></strong>
                                </h3>
                                <h3 class="font-weight-normal pl-5">Issued {{ now()->format('jS \of F Y') }} at
                                    the
                                    Office of the Punong Barangay,
                                    San Gavino
                                </h3>
                            </div>

                            <br><br>
                            {{-- Footer --}}
                            <div class="row mt-5">
                                <div class="col-6">

                                </div>
                                <div class="col-6 pr-5">
                                    <h3 class="text-center">
                                        Certified By
                                    </h3>
                                    <h2 class="text-center mb-0 text-uppercase">
                                        {{ $punong_barangay->name }}
                                    </h2>
                                    <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                </div>
                            </div>
                            {{-- End Footer --}}
                        @endif
                        {{-- End Content --}}

                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}
@endsection
@section('script')
    <script src="{{ asset('assets/js/utils/html2canvas.esm.js') }}"></script>
    <script src="{{ asset('assets/js/utils/html2canvas.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <script>
        window.jsPDF = window.jspdf.jsPDF;

        function printAsPDF() {
            html2canvas(document.getElementById("capture"), {
                dpi: 300, // Set to 300 DPI
                scale: 3, // Adjusts your resolution

            }).then(res => {
                var w = document.getElementById("capture").offsetWidth / 2.05; // 918
                var h = document.getElementById("capture").offsetHeight / 2.05; // 1274

                var img = res.toDataURL("image/jpeg", 1);
                var doc = new jsPDF('p', 'px', [w, h]);
                doc.addImage(img, 'JPEG', 0, 0, w, h);
                doc.save('printed.pdf');
            });
        }

        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
    </script>
@endsection
