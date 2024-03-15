@extends('layouts.admin.app')

@section('title', 'Admin | Requests')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="translated_text">
                        Note: On this page showcases the list of services requests (Eg. Barangay Clearance, Certificate of
                        Indigency, Certificate of Residency, etc.). To create a new
                        request, simply
                        click the
                        'Create Request' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3"
                            href="{{ route('admin.requests.create') }}">Create
                            Request +</a><br><br>
                        <form>
                            <div class="form-group">
                                <select class="form-control form-control-sm" onchange="filterRequestsByService(this)">
                                    <option value="0">--- All Services ---
                                    </option>
                                    @foreach ($services as $id => $service)
                                        <option value="{{ $id }}">{{ $service }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </form>

                        <div class="table-responsive">
                            <table class="table table-flush table-hover request_dt">
                                <caption>List of Request</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Paypal Transaction #</th>
                                        <th>Resident</th>
                                        <th>Service</th>
                                        <th>Purpose</th>
                                        <th>Status</th>
                                        <th>Remark</th>
                                        <th>Requested At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display requests --}}
                                </tbody>
                            </table>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
