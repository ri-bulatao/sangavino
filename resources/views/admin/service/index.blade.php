@extends('layouts.admin.app')

@section('title', 'Admin | Manage Services')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="translated_text">
                        Note: This page showcases the list of the official services of the barangay. To create a new
                        service, simply click the
                        'Create Service' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_service', '.service_form', ['#m_service_title','Add Service'], ['.btn_add_service','.btn_update_service'])">Create
                            Service +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover service_dt">
                                <caption>List of Service</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>Service</th>
                                        <th>Description</th>
                                        <th>Fee (₱)</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display services --}}
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
