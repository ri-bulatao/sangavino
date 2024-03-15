@extends('layouts.admin.app')

@section('title', 'Admin | Manage Position')

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
                        Note: On this page showcases the list of barangay official positions. To create a new
                        position, simply
                        click the
                        'Create Position' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_position', '.position_form', ['#m_position_title','Add Position'], ['.btn_add_position','.btn_update_position'], {rname:'admin.positions.create', target:['#d_positions'], column:['name']})">Create
                            Position +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover position_dt">
                                <caption>List of Position</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Position</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display positions --}}
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
