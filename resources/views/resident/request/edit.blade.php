@extends('layouts.resident.app')

@section('title', 'E-Barangay System | Edit Request')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success mr-3" href="{{ route('resident.requests.index') }}"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                            Edit Request <i class="fas fa-edit ml-1"></i>
                        </h2> <br>

                        @include('layouts.includes.alert')

                        <form action="{{ route('resident.requests.update', $request) }}" method="post" id="request_form">
                            @csrf @method('PUT')

                            <div class="form-group mb-3">
                                <label class="form-label">Select Service *</label>
                                <select class="form-control" name="service_id" onchange="getServiceInfo(this)">
                                    <option value=""></option>
                                    @foreach ($services as $service)
                                        <option value="{{ $service->id }}" data-description='{{ $service->description }}'
                                            data-fee='{{ $service->fee }}'
                                            @if ($request->service_id == $service->id) selected @endif>
                                            {{ $service->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" id="description" readonly>{{ $request->service->description }}</textarea>
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Fee (₱) *</label>
                                <input class="form-control" type="number" min="0" id="service_fee"
                                    value="{{ $request->service->fee }}" readonly>
                            </div>
                            <div class="form-group mb-3" id="business_name" style="display: none">
                                <label class="form-label">Business Name *</label>
                                <input class="form-control" type="text" name="business_name"
                                    placeholder="Enter Business Name" value="{{ $request->business_name }}">
                            </div>
                            <div class="form-group mb-3">
                                <label class="form-label">Purpose *</label>
                                <textarea class="form-control" name="purpose" rows="5" placeholder="Add Purpose">{{ $request->purpose }}</textarea>
                            </div>
                            <div class="form-check  mb-3 ">
                                <input class="form-check-input mr-2" type="checkbox" name="terms_of_service" id="terms">
                                <label class="form-check-label text-sm text-success" for="terms">
                                    I understand that the certificate will only be released at the Barangay Hall and not
                                    available online. Upon requesting, I am willing to wait for the working days and
                                    will be able to understand when declined.
                                </label>
                            </div>


                            <div class="form-group">
                                <button type="button" class="btn btn-success d-block w-100"
                                    onclick="promptUpdate(event, '#request_form')">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card card-body">
                    <h2>How to Pay? <i class="fas fa-info-circle ml-1"></i></h2><br>

                    <ol>
                        <li>
                            <h3 class="font-weight-normal">Go to Barangay Hall</h3>
                        </li>
                        <li>
                            <h3 class="font-weight-normal">Look for {{ $secretary->name }}</h3>
                        </li>
                        <div id="display_amount">
                            <li>
                                <h3 class="font-weight-normal">Please pay amount of ₱ {{ $request->service->fee }} </h3>
                            </li>
                        </div>
                    </ol>
                    <h4 class='font-weight-normal'>Note: The requesting of service will consumed 0-3 working days
                        upon
                        submission.
                        The certificate will be released at the Barangay Hall of Barangay San Gavino.</h4>
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
                    <li><h3 class="font-weight-normal">Please pay amount of ₱ ${fee} </h3></li>
                `)

                if (service.value == "4") {
                    $('#business_name').css('display', 'block')
                } else {
                    $('#business_name').css('display', 'none')
                }

            } else {
                $('#description').text('');
                $('#service_fee').val('');
                $('#display_amount').html(`
                    
                `)
                $('#business_name').css('display', 'none')
            }
        }


        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
    </script>
@endsection
