@extends('layouts.admin.app')

@section('title', 'Admin | Edit Blotter')

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
                        Note: Even when the blotter report status is ongoing or pending, you can still edit the provided
                        credentials below. Additionally, we request you to submit any supporting files/photos related to the
                        report, as they will assist in the investigation process.
                    </p>
                    <a class="btn btn-sm btn-success text-white" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success mr-3" href="{{ route('admin.blotters.index') }}"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                            Edit Blotter <i class="fas fa-edit ml-1"></i>
                        </h2> <br>

                        <div class="row">
                            <div class="col-md-8">

                                @include('layouts.includes.alert')

                                <form action="{{ route('admin.blotters.update', $blotter) }}" method="post"
                                    id="blotter_form" enctype="multipart/form-data">
                                    @csrf @method('PUT')

                                    <div class="form-group mb-3">
                                        <label class="form-label">Complainant (Complete Name) *</label>
                                        <input type="text" class="form-control" name="complainant"
                                            value="{{ $blotter->complainant }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Respondent (Complete Name) </label>
                                        <input type="text" class="form-control" name="respondent"
                                            value="{{ $blotter->respondent }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Location * </label>
                                        <input type="text" class="form-control" name="location"
                                            placeholder="Enter Complete Location of Incident"
                                            value="{{ $blotter->location }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Date Of Incident * </label>
                                        <input type="datetime-local" class="form-control" name="date_of_incident"
                                            value="{{ formatDate($blotter->date_of_incident, 'dateTimeLocal') }}">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Statement *</label>
                                        <textarea class="form-control" name="statement" rows="5" placeholder="Add Statement">{{ $blotter->statement }}</textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">In-Charge *</label>
                                        <select class="form-control" name="official_id">
                                            <option value=""></option>
                                            @foreach ($officials as $id => $official)
                                                <option value="{{ $id }}"
                                                    @if ($blotter->official_id == $id) selected @endif>{{ $official }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label class="form-label">Manage Status *</label>
                                        <select class="form-control" name="is_solved">
                                            <option value=""></option>
                                            <option value="0" @if ($blotter->is_solved == '0') selected @endif>Mark as
                                                On Going</option>
                                            <option value="1" @if ($blotter->is_solved == '1') selected @endif>Mark as
                                                Solved</option>
                                        </select>
                                    </div>
                                    <div>
                                        <input class="blotters" type="file" name="image[]" data-allow-reorder="true"
                                            data-max-files="5" multiple>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-success d-block w-100"
                                            onclick="promptUpdate(event, '#blotter_form')">Save</button>
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
        initiateFilePond('.blotters',
            ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            'Note: Uploading of New Files will overwrite the existing one. <br>Drag & Drop your files or <span class="filepond--label-action"> Browse </span>'
        )
        $('#blotters_nav').addClass('active')
    </script>
@endsection
