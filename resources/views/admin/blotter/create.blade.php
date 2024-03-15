@extends('layouts.admin.app')

@section('title', 'Admin | Create Blotter')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p class="translated_text">
                            Note: On this page, you have the option to create a blotter report by providing the specific
                            credentials listed below. Additionally, we require you to submit any supporting files/photos
                            related to the report, as they will be helpful for the investigation process.
                        </p>
                        <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                            onclick="translateToTagalog(this)">Click
                            to Translate in Tagalog</a>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h2>
                                <a class="text-success mr-3" href="{{ route('admin.blotters.index') }}"><i
                                        class="fas fa-arrow-left"></i>
                                </a>
                                Create Blotter <i class="fas fa-clipboard-list ml-1"></i>
                            </h2> <br>

                            <div class="row">
                                <div class="col-md-8">

                                    @include('layouts.includes.alert')

                                    <form action="{{ route('admin.blotters.store') }}" method="post" id="blotter_form"
                                        enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label class="form-label">Complainant (Complete Name) *</label>
                                            <input type="text" class="form-control" name="complainant">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Respondent (Complete Name) </label>
                                            <input type="text" class="form-control" name="respondent">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Location * </label>
                                            <input type="text" class="form-control" name="location"
                                                placeholder="Enter Complete Location of Incident">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Date Of Incident * </label>
                                            <input type="datetime-local" class="form-control" name="date_of_incident">
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">Statement *</label>
                                            <textarea class="form-control" name="statement" rows="5" placeholder="Add Statement"></textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label class="form-label">In-Charge *</label>
                                            <select class="form-control" name="official_id">
                                                <option value=""></option>
                                                @foreach ($officials as $id => $official)
                                                    <option value="{{ $id }}">{{ $official }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div>
                                            <input class="blotters" type="file" name="image[]" data-allow-reorder="true"
                                                data-max-files="5" multiple>
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success d-block w-100"
                                                onclick="promptStore(event, '#blotter_form')">Save</button>
                                        </div>
                                    </form>
                                </div>
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
