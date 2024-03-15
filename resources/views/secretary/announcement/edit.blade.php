@extends('layouts.secretary.app')

@section('title', 'Barangay Secretary | Edit Announcement')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header border-0">
                        <h2 class="text-center">
                            <a class="float-left text-success" href="{{ route('secretary.announcements.index') }}"><i
                                    class="fas fa-arrow-left fa-lg"></i>
                            </a>
                            Edit Announcement <i class="fas fa-edit ml-1"></i>
                        </h2>
                    </div>
                    <div class="card-body">
                        @include('layouts.includes.alert')
                        <form action="{{ route('secretary.announcements.update', $announcement) }}" method="post"
                            enctype="multipart/form-data" id="announcement_form">
                            @csrf @method('PUT')
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="title" placeholder="Add Title"
                                            value="{{ $announcement->title }}">
                                    </div>

                                    <div class="form-group mb-2">
                                        <textarea class="form-control" name="content" id="content_txtarea" rows="10">{!! $announcement->content !!}</textarea>
                                    </div>

                                    <div class="mb-2">
                                        <input type="file" class="content_images" name="image[]" multiple
                                            data-allow-reorder="true" data-max-file-size="1MB" data-max-files="10">
                                    </div>

                                    <button type="button" class="btn btn-sm btn-success form-control"
                                        onclick="confirm('Do you want to update?', '', 'Yes').then(res=>res.isConfirmed ? $('#announcement_form').submit() : false)">
                                        Save </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br><br>
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection
@section('script')
    <script src="https://cdn.tiny.cloud/1/yiv2clsvcw9c4q7y2h8t92t4cuaia1l3383axmfdgovo3kft/tinymce/6/tinymce.min.js"
        referrerpolicy="origin"></script>

    <script>
        initiateFilePond('.content_images', [
                "image/png",
                "image/jpeg",
                "image/jpg",
                "image/webp",
            ],
            'Drag & Drop your files or <b> Browse Photos </b> Note: Uploading of Photos will Overwrite the existing one'
        )
        initiateEditor('textarea')

        $('#announcement_nav').addClass('active')
    </script>
@endsection
