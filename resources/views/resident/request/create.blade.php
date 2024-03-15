@extends('layouts.resident.app')

@section('title', 'E-Barangay System | Create Request')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="translated_text">
                        Note: On this page, you have the option to create a services request by providing the specific
                        credentials listed below. You need to select a specific resident (who request the service) and the
                        selected service. We also require you to provide the purpose of the request.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success mr-3" href="{{ route('resident.requests.index') }}"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                            Request a Service <i class="fas fa-clipboard-list ml-1"></i>
                        </h2> <br>

                        @include('layouts.includes.alert')

                        <form action="{{ route('resident.paymaya.handle') }}" method="post" id="request_form">
                            @csrf

                            <div class="form-group mb-3">
                                <label class="form-label">Select Service *</label>
                                <select class="form-control" name="service_id" onchange="getServiceInfo(this)" required>
                                    <option value=""></option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" data-description='{{ $service->description }}'
                                            data-fee='{{ $service->fee }}'>
                                            {{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" id="description" readonly></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fee (₱) *</label>
                                <input class="form-control" type="number" min="0" id="service_fee" readonly>
                            </div>
                            <div class="form-group mb-3" id="business_name" style="display: none">
                                <label class="form-label">Business Name *</label>
                                <input class="form-control" type="text" name="business_name"
                                    placeholder="Enter Business Name">
                            </div>
                            <div class="form-group mb-3" id="business_type" style="display: none">
                                <label class="form-label">Business Type *</label>
                                <input class="form-control" type="text" name="business_type"
                                    placeholder="Enter Business Type">
                            </div>
                            <div class="form-group mb-3" id="business_location" style="display: none">
                                <label class="form-label">Business Location *</label>
                                <input class="form-control" type="text" name="business_location"
                                    placeholder="Enter Business Location">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Purpose *</label>
                                <textarea class="form-control" name="purpose" rows="5" placeholder="Add Purpose"></textarea>
                            </div>
                            <div class="form-check  mb-3 ">
                                <input class="form-check-input mr-2" type="checkbox" name="terms_of_service" id="terms">
                                <label class="form-check-label text-sm" for="terms">
                                    I understand that the certificate will only be released at the barangay hall and not
                                    available online. Upon requesting, I am willing to wait for the working days and
                                    will be able to understand when declined.
                                </label>
                            </div>


                            <button type="button" class="btn btn-lg btn-dark w-100" id="paypal-button-container"
                                onclick="promptStore(event, '#request_form', 'Proceed to Payment?', 'Please double check your selected service. We do not offer a cancelation of request.', 'Yes')">
                                PayMaya Checkout <i class="fa fa-shopping-cart ms-1 text-warning fa-lg"></i>

                            </button>

                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body">
                    <h2>How to Pay? <i class="fas fa-info-circle ml-1"></i></h2><br>

                    <ol>

                        <div id="display_amount">

                        </div>
                        <li>
                            <h3 class="font-weight-normal">Go to Barangay Hall</h3>
                        </li>
                        <li>
                            <h3 class="font-weight-normal">Look for {{ $secretary->name }} to get your requested
                                document/s.</h3>
                        </li>

                    </ol>
                    <h4 class='font-weight-normal'>Note: The requesting of service will consumed 0-3 working days
                        upon
                        submission.
                        The certificate will be released at the Barangay Hall of Barangay San Gavino, Victoria, Tarlac.</h4>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script>
        function getServiceInfo(service) {

            if (service.value) {
                const description = $(service).find(':selected').attr(
                    'data-description'); // the selected service description
                const fee = $(service).find(':selected').attr('data-fee'); // the selected service fee
                $('#description').text(description);
                $('#service_fee').val(fee);

                $('#display_amount').html(`
                    <li><h3 class="font-weight-normal">Please pay amount of ₱ ${fee} using Paymaya Checkout </h3></li>
                `)

                if (service.value == "4") {
                    $('#business_name').css('display', 'block')
                    $('#business_type').css('display', 'block')
                    $('#business_location').css('display', 'block')
                } else {
                    $('#business_name').css('display', 'none')
                    $('#business_type').css('display', 'none')
                    $('#business_location').css('display', 'none')
                }

            } else {
                $('#description').text('');
                $('#service_fee').val('');
                $('#display_amount').html(`
                    
                `)
                $('#business_name').css('display', 'none')
            }
        }


        $("#issuance_nav").addClass("active");
    </script>
@endsection
