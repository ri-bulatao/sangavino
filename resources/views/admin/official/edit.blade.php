@extends('layouts.admin.app')

@section('title', 'Admin | Edit Official')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success float-left mr-3" href="{{ route('admin.officials.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            Edit Official <i class="fas fa-edit ml-1"></i>
                        </h2><br>

                        <form class="row" action="{{ route('admin.officials.update', $official) }}" method="post"
                            id="official_form" enctype="multipart/form-data">
                            @csrf @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="form-label">Select Position *</label>
                                    <select class="form-control" name="position_id">
                                        <option value=""></option>
                                        @foreach ($positions as $id => $position)
                                            <option value="{{ $id }}"
                                                @if ($official->position_id == $id) selected @endif>
                                                {{ $position }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group mb-2">
                                    <label class="form-label">Name *</label>
                                    <input type="text" class="form-control" name="name" placeholder="Complete Name"
                                        value="{{ $official->name }}" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Contact *</label>
                                    <input type="number" class="form-control" min="0" name="contact"
                                        placeholder="Ex. 09659312004" value="{{ $official->contact }}" required>
                                </div>

                                <div>
                                    <input class="avatar_image" type="file" name="image" multiple
                                        data-max-file-size="1MB">
                                </div>
                                <button type="button" class="btn btn-success"
                                    onclick="promptUpdate(event,'#official_form', 'Do you want to Update?', 'Note: Uploading new avatar will overwrite the existing one', 'Yes')">
                                    Save
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
