@extends('layouts.admin.app')

@section('title', 'Admin | Manage Category')

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
                        Note: On this page showcases the list of product categories . To create a new
                        category, simply
                        click the
                        'Create Category' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <a class="float-right btn btn-sm btn-success me-3" href="javascript:void(0)"
                            onclick="toggle_modal('#m_category', '.category_form', ['#m_category_title','Add Category'], ['.btn_add_category','.btn_update_category'])">Create
                            Category +</a><br><br>
                        <div class="table-responsive">
                            <table class="table table-flush table-hover category_dt">
                                <caption>List of Category</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display Categories --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
