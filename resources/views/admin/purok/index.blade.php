@extends('layouts.admin.app')

@section('title', 'Admin | Manage Purok')

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
                        Note: On this page showcases the list of purok belonged to the barangay. To create a new
                        purok, simply
                        click the
                        'Create Purok' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_purok', '.purok_form', ['#m_purok_title','Add Purok'], ['.btn_add_purok','.btn_update_purok'])">Create
                            Purok +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover purok_dt">
                                <caption>List of Purok</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>Purok</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Puroks --}}
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
