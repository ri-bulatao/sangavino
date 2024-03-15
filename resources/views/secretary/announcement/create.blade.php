@extends('layouts.secretary.app')

@section('title', 'Barangay Secretary | Manage Announcement')

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
                            Create Announcement <i class="far fa-bell ml-1"></i>
                        </h2>
                    </div>
                    <div class="card-body">
                        @include('layouts.includes.alert')
                        <form action="{{ route('secretary.announcements.store') }}" method="post"
                            enctype="multipart/form-data" id="announcement_form">
                            @csrf
                            <div class="row justify-content-center">
                                <div class="col-md-10">
                                    <br>
                                    <div class="form-group mb-2">
                                        <input type="text" class="form-control" name="title" placeholder="Add Title">
                                    </div>

                                    {{-- <div class="form-group mb-2">
                                        <textarea class="form-control" name="content" id="content_txtarea" rows="10"></textarea>
                                    </div> --}}

                                    <div class="form-group mb-2">
                                        <textarea class="form-control" name="content" rows="10"></textarea>
                                    </div>

                                    <div class="mb-2">
                                        <input type="file" class="content_images" name="image[]" multiple
                                            data-allow-reorder="true" data-max-file-size="1MB" data-max-files="10">
                                    </div>


                                    <div class="form-group mb-2">
                                        <label class="form-label font-weight-bold text-success">Do you want to send SMS to
                                            Barangay
                                            Officials?</label>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="yes" name="has_sms" class="custom-control-input"
                                                value="1" onclick="toggleSMSAnnouncement(true)">
                                            <label class="custom-control-label" for="yes">Yes</label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input type="radio" id="no" name="has_sms" class="custom-control-input"
                                                value="0" onclick="toggleSMSAnnouncement(false)" checked>
                                            <label class="custom-control-label" for="no">No</label>
                                        </div>
                                    </div>

                                    <div class="form-group" id="sms_announcement" style="display:none">
                                        <textarea name="sms_announcement" id="sms_announcement_textarea" rows="5" class="form-control"
                                            placeholder="Type your SMS anouncement" oninput="limitTextareaCharacters(150)"></textarea>

                                        <small class="text-muted">SMS characters remaining: <span
                                                id="char_count">150</span></small>
                                    </div>

                                    <button type="button" class="btn btn-sm btn-success form-control"
                                        onclick="confirm('Do you want to submit?', '', 'Yes').then(res=>res.isConfirmed ? $('#announcement_form').submit() : false)">
                                        Submit </button>
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
        function limitTextareaCharacters(maxChars) {
            var textarea = document.getElementById("sms_announcement_textarea");
            var charCountSpan = document.getElementById("char_count");

            var remainingChars = maxChars - textarea.value.length;
            charCountSpan.textContent = remainingChars;

            if (remainingChars < 0) {
                textarea.value = textarea.value.slice(0, maxChars);
                charCountSpan.textContent = 0;
            }
        }


        function toggleSMSAnnouncement(show) {
            var smsAnnouncementDiv = document.getElementById("sms_announcement");
            smsAnnouncementDiv.style.display = show ? "block" : "none";
        }

        // Set the initial visibility based on the checked radio button
        var initialChecked = document.querySelector('input[name="has_sms"]:checked');
        toggleSMSAnnouncement(initialChecked.id === "yes");

        initiateFilePond('.content_images')
        initiateEditor('#content_txtarea')
        $('#announcement_nav').addClass('active')
    </script>
@endsection
