@extends('layouts.admin.app')

@section('title', 'Admin | Manage Product')

@section('styles')
    <style>
        td {
            word-wrap: break-word;
            word-break: break-all;
            white-space: normal !important;
            text-align: justify;
        }
    </style>
@endsection

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
                        Note: On this page showcases the list of products in the inventory . To create a new
                        product, simply
                        click the
                        'Create Product' button located in the top right corner.
                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="float-right">
                            <a class="btn btn-sm btn-success" href="{{ route('admin.products.create') }}">Create
                                Product +
                            </a>
                        </div>
                        <br><br>

                        <div class="table-responsive">
                            <table class="table table-flush table-hover product_dt">
                                <caption>List of Product</caption>
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Code</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Value(₱)</th>
                                        <th>Qty</th>
                                        <th>Manufactured At</th>
                                        <th>Expired At</th>
                                        <th>Status</th>
                                        <th>Updated At</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- Display products --}}
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
