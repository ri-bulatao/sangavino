@extends('layouts.admin.app')

@section('title', 'Admin | Create Official')

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
                        Note: On this page, you have the option to create an official by providing the specific
                        credentials listed below. You need to select a specific position and provice the official's basic
                        info . We also require you to upload the official's avatar or featured photo to display on the
                        officials page of the {{ config('app.name') }}
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success float-left mr-3" href="{{ route('admin.officials.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            Create Official <i class="fas fa-user ml-1"></i>
                        </h2><br>

                        <form class="row" action="{{ route('admin.officials.store') }}" method="post" id="official_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="form-label">Select Position *</label>
                                    <select class="form-control" name="position_id">
                                        <option value=""></option>
                                        @foreach ($positions as $id => $position)
                                            <option value="{{ $id }}">
                                                {{ $position }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group mb-2">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Complete Name"
                                        required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Contact *</label>
                                    <input type="number" class="form-control" min="0" name="contact" required>
                                </div>

                                <div>
                                    <input class="avatar_image" type="file" name="image" multiple
                                        data-max-file-size="1MB">
                                </div>
                                <button type="button" class="btn btn-success"
                                    onclick="promptStore(event,'#official_form')">
                                    Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- End CONTAINER --}}

@endsection

@section('script')
    <script>
        initiateFilePond(
            ".avatar_image",
            ["image/png", "image/jpeg", "image/jpg", "image/webp"],
            `Drag & Drop your files or <span class="filepond--label-action"> Browse Avatar</span>`
        );

        $("#official_management_nav").addClass("active");
        $("#officials").addClass("font-weight-bold text-success");
    </script>
@endsection
