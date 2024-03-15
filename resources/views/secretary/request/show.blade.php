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
                <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="translated_text">
                        Note: On this page, you will find the primary details of the chosen request entry retrieved from the
                        database table. We present the residents' information along with the selected service. If you wish
                        to obtain a digital copy of the information, you can save it as a PDF document.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
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
                                            Province of Tarlac
                                        </h3>
                                        <h3 class="font-weight-normal text-center mb-0">
                                            Municipality of Victoria
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
                        <hr class="m-0" style="height:10px;background:#000">
                        <br>
                        {{-- End Header --}}
                        <div class="row">
                            <div class="col-md-3 border border-dark text-center">
                                <h3 class="font-weight-bold text-uppercase">sanguniang barangay members</h3>
                                <h4 class="font-weight-bold text-uppercase">hon. edgar L. santiago</h4>
                                <h5 class="font-weight-normal text-uppercase">Punong Barangay</h5>
                                <br>
                                <br>
                                <h3 class="font-weight-bold text-uppercase">Kagawad</h3>
                                <h4 class="font-weight-bold text-uppercase">hon. emily s. caluya</h4>
                                <h5 class="font-weight-normal text-capitalize">Finance & Appropriation</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. warlie rackman s. dimaporo</h4>
                                <h5 class="font-weight-normal text-capitalize">Commitee on Peace In Order</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. marilou g. gacusan</h4>
                                <h5 class="font-weight-normal text-capitalize">Commitee Education</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. raphael P. magno</h4>
                                <h5 class="font-weight-normal text-capitalize">Health & Sanitation</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. harold g. felipe</h4>
                                <h5 class="font-weight-normal text-capitalize">Infrastructure</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. francis s. galindo</h4>
                                <h5 class="font-weight-normal text-capitalize">Commitee on Sports</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. jose n. agustin</h4>
                                <h5 class="font-weight-normal text-capitalize">Aggriculture</h5>
                                <h4 class="font-weight-bold text-uppercase">hon. angel nino P. layug</h4>
                                <h5 class="font-weight-normal text-capitalize">SK Chairman</h5>
                                <h4 class="font-weight-bold text-uppercase">aring b. gastador</h4>
                                <h5 class="font-weight-normal text-capitalize">barangay secretary</h5>
                                <h4 class="font-weight-bold text-uppercase">dianina c. paradero</h4>
                                <h5 class="font-weight-normal text-capitalize">barangay treasurer</h5>

                            </div>
                            <div class="col-md-9 border ">
                                {{-- Content --}}
                                @if ($request->service->name == 'Barangay Clearance')
                                    <div id="container-wrapper">
                                        <h1 class="text-uppercase text-center display-3"><strong>barangay
                                                clearance</strong>
                                        </h1>
                                        <br><br><br>
                                        <h3 class="text-uppercase">to whom it may concern:</h3>
                                        <h3 class="font-weight-normal pl-5">This is to certify that
                                            <strong>{{ $request->user->resident->full_name }}</strong> is a bonified
                                            resident of
                                            Barangay San Gavino Victoria,
                                        </h3>
                                        <br>

                                        <h3 class="font-weight-normal pl-5">
                                            The said person is known to be of good moral character and not a member of any
                                            subversive organization of this locality.
                                        </h3>
                                        <br>

                                        <h3 class="font-weight-normal pl-5">This certification has been issued at the Office
                                            of the
                                            Punong Barangay this

                                            <strong>{{ now()->format('jS \of F Y') }}</strong>. Upon verabal
                                            request of the subject person for applying for business permit purposes.
                                        </h3>
                                        <br>
                                    </div>
                                    <br><br>
                                    {{-- Footer --}}
                                    <div class="row mt-5">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6 pr-5">
                                            <h2 class="text-center mb-0 text-uppercase">
                                                Hon. {{ $punong_barangay->name }}
                                            </h2>
                                            <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                        </div>
                                    </div>
                                    <br><br><br>
                                    <div class="row mt-5 mb-3">
                                        <div class="col-6">
                                            <h2 class="text-center mb-0 text-uppercase">
                                                _________________________
                                            </h2>
                                            <h4 class="font-weight-bold text-center">Signature of Applicant</h4>
                                            <h4 class="font-weight-bold">Res. Cert. No.___________</h4>
                                            <h4 class="font-weight-bold">Issued at VICTORIA,TARLAC</h4>
                                            <h4 class="font-weight-bold">Issued on _____________</h4>

                                        </div>
                                        <div class="col-6 pr-5">
                                        </div>
                                    </div>
                                    {{-- End Footer --}}
                                @elseif ($request->service->name == 'Business Clearance/Permit')
                                    <div id="container-wrapper">
                                        <h1 class="text-uppercase text-center display-3">
                                            <strong>business clearance/permit</strong>
                                        </h1>
                                        <br><br><br>
                                        <h3 class="text-uppercase">to whom it may concern:</h3>
                                        <h3 class="font-weight-normal pl-5">This is to certify that the business or trade
                                            activity described below:
                                        </h3>
                                        <br>
                                        <h4 class=''>
                                            <span class="font-weight-bold">NAME OF OWNER/OPERATOR:</span>

                                            {{ $request->user->resident->full_name }}
                                        </h4>
                                        <h4 class=''>
                                            <span class="font-weight-bold">ADDRESS:</span>

                                            {{ $request->user->resident->address }}
                                        </h4>
                                        <h4 class=''>
                                            <span class="font-weight-bold">BUSINESS NAME</span>

                                            {{ $request->business_name }}
                                        </h4>
                                        <h4 class=''>
                                            <span class="font-weight-bold">BUSINESS TYPE</span>

                                            {{ $request->business_type }}
                                        </h4>
                                        <h4 class=''>
                                            <span class="font-weight-bold">LOCATION</span>

                                            {{ $request->business_location }}
                                        </h4>
                                        <br>
                                        <h3 class="font-weight-normal">
                                            is hereby given a clearance his/her business operation within this Barangay
                                            interposes no objective for the issuance of the corresponding Mayor's Permit
                                            being applied for.
                                        </h3>
                                        <br>

                                        <h3 class="font-weight-normal">Issued this
                                            <strong>{{ now()->format('jS \of F Y') }}</strong> at
                                            This will be a subject for the continuing compliance with the rules and
                                            regulation and applicable laws of Barangay San Gavino Victoria, Tarlac and the
                                            Republic of the Philippines.
                                        </h3>
                                    </div>
                                    <br><br>

                                    <div class="row mt-5">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6 pr-5">
                                            <h2 class="text-center mb-0 text-uppercase">
                                                Hon. {{ $punong_barangay->name }}
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
                                            single / married is a bonafide resident of Barangay San Gavino, Victoria,
                                            Tarlac.
                                        </h3>
                                        <br>
                                        <h3 class="font-weight-normal pl-5">This certifies further that he/she lives in
                                            this barangay for almost
                                            {{ $request->residency_year }} years.
                                        </h3>
                                        <br>
                                        <h3 class="font-weight-normal pl-5">This certification has been issued upon the
                                            verbal request of {{ $request->resident_type }} for any legal purposes and
                                            intent it may serve.
                                        </h3>
                                        <br>
                                        <h3 class="font-weight-normal pl-5">This certification is being issued upon the
                                            request of
                                            the
                                            above-named person for whatever legal purposes it may serve.
                                        </h3>
                                        <h3 class="font-weight-normal pl-5">Issued this
                                            <strong>{{ now()->format('jS \of F Y') }}</strong> at
                                            the
                                            Office of the Punong Barangay.
                                        </h3>
                                    </div>

                                    <br><br>
                                    {{-- Footer --}}
                                    <div class="row mt-5">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6 pr-5">
                                            <h2 class="text-center mb-0 text-uppercase">
                                                Hon. {{ $punong_barangay->name }}
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
                                            <strong>{{ $request->user->resident->full_name }}</strong> is a bonafide
                                            resident of Barangay San Gavino, Victoria, Tarlac.
                                        </h3>
                                        <br>
                                        <h3 class="font-weight-normal pl-5">I further certify that
                                            <strong>{{ $request->user->resident->full_name }}</strong>is an
                                            <strong>INDIGENT FAMILY</strong> of this
                                            Barangay.
                                        </h3>
                                        <br>
                                        <h3 class="font-weight-normal pl-5">This certification has been
                                            issued upon the request of the subject person for
                                            <strong>{{ $request->purpose }}</strong> purposes.
                                        </h3>
                                        <h3 class="font-weight-normal pl-5">Issued this day
                                            {{ now()->format('jS \of F Y') }} at
                                            the
                                            Barangay San Gavino, Victoria, Tarlac.
                                        </h3>
                                    </div>

                                    <br><br>
                                    {{-- Footer --}}
                                    <div class="row mt-5">
                                        <div class="col-6">

                                        </div>
                                        <div class="col-6 pr-5">
                                            <h2 class="text-center mb-0 text-uppercase">
                                                Hon. {{ $punong_barangay->name }}
                                            </h2>
                                            <h4 class="font-weight-normal text-center">Punong Barangay</h4>

                                        </div>
                                    </div>
                                    {{-- End Footer --}}
                                @endif
                                {{-- End Content --}}

                            </div>
                        </div>
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
