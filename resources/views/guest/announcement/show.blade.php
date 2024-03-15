@extends('layouts.guest.app')

@section('title', "Barangay San Gavino | $announcement->title")

@section('content')
    @include('layouts.resident.modal')
    {{-- CONTAINER --}}
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="float-start text-success" href="{{ route('guest.announcements.index') }}"><i
                                class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h2>{{ $announcement->title }}</h2><br>
                        {!! $announcement->content !!}
                        <br><br>
                        <h5 class="text-muted" data-bs-toggle="collapse" data-bs-target="#view_photos"
                            style="cursor: pointer" title="click to view photos"><i class="fas fa-link me-1"> </i>
                            View Photos
                        </h5>
                        <br>

                        <div class="collapse" id="view_photos">
                            @forelse ($announcement->getMedia('announcement_images') as $image)
                                <a href="{{ $image->getUrl() }}" class="glightbox">
                                    <img class="img-fluid" src="{{ $image->getUrl() }}" width="100" alt="image">
                                </a>
                            @empty
                                <img class="img-fluid" src="{{ asset('img/nodata.svg') }}" width="100" alt="image">
                                <p>Record Not Found</p>
                            @endforelse
                        </div>

                        <br>
                        <p class="card-text">
                            <small class="text-muted">Last updated
                                {{ is_null($announcement->updated_at) ? $announcement->created_at->diffForHumans() : $announcement->updated_at->diffForHumans() }}
                                <i class="fas fa-clock ml-1"></i>
                            </small>
                        </p>
                    </div>


                </div>


            </div>
        </div>

        <div class="row" id="d_announcement">
            <div class="w-100" id="announcement_row-1">
                <div class="col-md-12 pb-3">
                    @auth
                        <div class="card">
                            <div class="card-footer">
                                <div class="d-flex justify-content-end">
                                    <div>
                                        {{-- Comments count --}}
                                        <span class="comments mr-1">
                                            <span id="comment_count-{{ $announcement->id }}">
                                                {{ $announcement->comments->count() }}
                                            </span>
                                            <span class="ml-1" role="button">
                                                <i class="far fa-comment-alt"
                                                    onclick="showComments({{ $announcement->id }})"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                                <div>
                                    <br>
                                    <form class="announcement_form" autocomplete="off">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <img class="rounded-circle avatar"
                                                src="{{ handleNullAvatar(auth()->user()?->avatar_profile) }}" width="50"
                                                alt="avatar.jpg">
                                            <div class="input-group input-group-outline mt-3 mx-3 w-100 ">
                                                <input class="form-control textarea" type="text"
                                                    id="comment_input-{{ $announcement->id }}">
                                            </div>
                                        </div>
                                        <button class="btn btn-sm btn-outline-success float-end mt-2" type="button"
                                            onclick="addComment({{ $announcement->id }}, event)">Comment</button>

                                    </form>
                                    <br>

                                    <a href="javascript:void(0)">Most Recent <i class="fas fa-caret-down ml-1"></i>
                                    </a>

                                    {{-- Comments --}}
                                    <div class="mt-2" id="d_comments-{{ $announcement->id }}"
                                        style="display:none !important">
                                        @foreach ($announcement->comments as $comment)
                                            {{-- Comment Wrapper --}}
                                            <div class="bg-gray-100 rounded" id="comment_row-{{ $comment->id }}">
                                                <div class="d-flex justify-content-start align-items-center p-2 mt-2">
                                                    <img class="rounded-circle"
                                                        src="{{ handleNullAvatar($comment->user->avatar_profile) }}"
                                                        width="30" data-toggle="tooltip" data-html="true"
                                                        title="{{ $comment->user->resident->full_name ?? 'Admin' }}">
                                                    <div class="mx-3 w-100">
                                                        {{-- Comment Settings --}}
                                                        @if (auth()->id() === $comment->user_id)
                                                            <div class="px-2 float-end">
                                                                <div class="dropdown d-flex justify-content-end text-end">
                                                                    <a class='btn btn-sm btn-icon-only text-dark' href='#'
                                                                        role='button' data-bs-toggle='dropdown'
                                                                        data-display="static" aria-expanded='false'>
                                                                        <i class='fas fa-ellipsis-v'></i>
                                                                    </a>

                                                                    <div class="dropdown-menu dropdown-menu-end"
                                                                        aria-labelledby="dropdownMenu">
                                                                        <button class="dropdown-item" type="button"
                                                                            onclick="editComment({{ $comment }})">Edit</button>
                                                                        <button class="dropdown-item" type="button"
                                                                            onclick="removeComment({{ $announcement->id }}, {{ $comment->id }})">Delete</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                        <div class="comment_body">
                                                            <h6 class="fw-light">
                                                                {{ $comment->user->resident->full_name ?? 'Admin' }} <span
                                                                    class="text-muted ml-1">
                                                                    -
                                                                    {{ $comment->created_at->longAbsoluteDiffForHumans() }}</span>

                                                            </h6>
                                                            <h5 class="fw-light" id="d_comment">
                                                                {{ $comment->comment }}
                                                            </h5>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- End Comment Wrapper --}}
                                        @endforeach
                                    </div>
                                </div>
                                {{-- End Comments --}}
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </div>
    </div>
    {{-- End CONTAINER --}}

@endsection

@section('script')
    @routes()

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        // Comment

        function showComments(announcement) {
            $(".comment_form-" + announcement).toggle();
            $("#d_comments-" + announcement).toggle();
        }

        // Comment
        async function addComment(announcement_id, event) {
            const keyPressed = event.keyCode || event.which;
            // if (keyPressed === 13) {
            event.preventDefault();
            if (isNotEmpty($("#comment_input-" + announcement_id))) {
                try {
                    // execute
                    const res = await axios.post(route("comments.store"), {
                        announcement_id,
                        comment: $("#comment_input-" + announcement_id).val(),
                    });
                    $("#comment_input-" + announcement_id).val("");
                    const comment = res.data.result;
                    let output = `<div class='rounded' id='comment_row-${comment.id}'>
                            <div class="d-flex justify-content-start align-items-center px-2 mt-2">
                            ${handleNullAvatar(comment.avatar, "", "30")}
                                        <div class="mx-3 w-100">
                                            <div class="px-2 float-right">
                                            <div class="dropdown dropdown d-flex justify-content-end text-right">
                                                    <a class='btn btn-sm btn-icon-only text-dark'
                                                    href='#' role='button' data-bs-toggle='dropdown'
                                                    data-bs-display="static" aria-expanded='false'>
                                                    <i class='fas fa-ellipsis-v'></i>
                                                </a>
                                                
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu">
                                                <button class="dropdown-item" type="button" onclick='editComment(${JSON.stringify(
                                                    comment
                                                )})'>Edit</button>
                                                <button class="dropdown-item" type="button" onclick="removeComment(${
                                                    comment.announcement_id
                                                }, ${
                comment.id
            })">Delete</button>
                                                </div>
                                            </div>
                                    </div>
                                    <div class="comment_body">
                                        <h6 class='fw-light mt-2'>${
                                            comment.user
                                        }
                                            <span class="text-muted ml-1"> - just now </span>
                                        </h6>
                                        <h5 class='fw-light'>${
                                            comment.comment
                                        }</h5>
                                    </div>
                                </div>
                            </div>
                         </div>
                        `;
                    $("#d_comments-" + announcement_id).prepend(output); // append newly added comment
                    $("#comment_count-" + announcement_id).html(comment.count); // update comment count
                    $("div.emojionearea-editor").data("emojioneArea").setText("");
                } catch (e) {
                    log(e);
                    const responses = e.response.data.errors;
                    if (responses) {
                        const errors = Object.values(responses);
                        errors.forEach((e) => {
                            toastDanger(e);
                        });
                    } else {
                        error(e.response.data.message);
                    }
                }
            }
            //}
        }

        function editComment(comment) {

            $("#m_comment").modal("show");
            $(".modal-header").removeClass("bg-info").addClass("bg-primary");
            $(".btn_update_comment").attr("data-id", comment.id);
            $("#comment").val(comment.comment);
            $("#announcement_id").val(comment.announcement_id);
        }

        async function updateComment(form, route_name, event) {
            // convert the first form in the parameter into a form data object
            const form_data = new FormData($(form)[0]);
            form_data.append("_method", "PUT");
            const model_id = event.target.getAttribute("data-id");

            try {
                // request
                const res = await axios.post(
                    `${route(route_name, model_id)}`,
                    form_data
                ); // fake update request

                const comment = res.data.result;

                let output = `
                        <div class="d-flex justify-content-start align-items-center px-2" id="comment_row-${
                            comment.id
                        }">
                        ${handleNullAvatar(comment.avatar, "", "30")}
                            <div class="mx-3 w-100">
                                <div class="px-2 float-right">
                                    <div class="dropdown dropdown d-flex justify-content-end text-right">
                                            <a class='btn btn-sm btn-icon-only text-dark'
                                            href='#' role='button' data-bs-toggle='dropdown'
                                            data-bs-display="static" aria-expanded='false'>
                                            <i class='fas fa-ellipsis-v'></i>
                                        </a>
                                        
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu">
                                        <button class="dropdown-item" type="button" onclick='editComment(${JSON.stringify(
                                            comment
                                        )})'>Edit</button>
                                        <button class="dropdown-item" type="button" onclick="removeComment(${
                                            comment.announcement_id
                                        }, ${comment.id})">Delete</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="comment_body">
                                <h6 class='fw-light'>${comment.user}
                                    <span class="text-muted ml-1"> - just now </span>
                                </h6>
                                <h5 class='fw-light'>${
                                    comment.comment
                                }</h5>
                                </div>
                            </div>
                        </div>
        
                      `;
                $("#comment_row-" + comment.id).html(output);

                $("#m_comment").modal("hide");
                $(form)[0].reset(); // clear input field
                success("Your comment updated successfully");
            } catch (e) {
                log(e);
                error(e.response.data.message);
            }
        }
        async function removeComment(announcement, comment) {
            const result = await confirm();
            if (result.isConfirmed) {
                try {
                    const res = await axios.delete(route("comments.destroy", comment), {
                        params: {
                            announcement,
                        },
                    });
                    success("Your comment has deleted successfully");
                    $("#comment_row-" + comment).remove(); // remove specific comment
                    $("#comment_count-" + announcement).html(res.data.result); // update comment count
                } catch (e) {
                    log(e);
                    error(e.response.data.message);
                }
            }
        }
        // End Comment

        $(() => {


            $('.textarea').emojioneArea();

            const lightbox = GLightbox({
                selector: '.glightbox'
            });



            $('#announcement_nav').addClass('active')

        })
    </script>
@endsection
