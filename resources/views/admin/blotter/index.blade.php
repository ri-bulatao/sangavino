@extends('layouts.admin.app')

@section('title', 'Admin | Manage Blotter')

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
                        Note: On this page showcases the list of blotter reports. To create a new report, simply click the
                        'Create Report' button located in the top right corner.

                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3"
                            href="{{ route('admin.blotters.create') }}">Create
                            Report +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover blotter_dt">
                                <caption>List of Blotter Report</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Complainant</th>
                                        <th>Respondent</th>
                                        <th>In-Charge</th>
                                        <th>Status</th>
                                        <th>Reported At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Blotters --}}
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="5">
                                            <a href="{{ route('print.handle') }}?records=blotter"
                                                class="btn btn-sm btn-success">
                                                Print Record <i class="fas fa-print ml-1"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tfoot>
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
@section('script')
    <script>
        initiateFilePond('.blotters')
        $('#blotters_nav').addClass('active')
    </script>
@endsection
