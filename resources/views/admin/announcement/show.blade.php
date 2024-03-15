@extends('layouts.admin.app')

@section('title', "Admin | $announcement->title")

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a class="float-left text-success" href="{{ route('admin.announcements.index') }}"><i
                                class="fas fa-arrow-left fa-lg"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <h2>{{ $announcement->title }}</h2><br>
                        {!! $announcement->content !!}
                        <br><br>
                        <h4 class="text-muted" data-toggle="collapse" data-target="#view_photos" style="cursor: pointer"
                            title="click to view photos"><i class="fas fa-link mr-1"> </i>
                            View Photos
                        </h4>

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
                                    {{-- Comments --}}
                                    <div class="mt-2" id="d_comments-{{ $announcement->id }}">

                                        <a href="javascript:void(0)">Most Recent <i class="fas fa-caret-down ml-1"></i>
                                        </a>

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
                                                            <div class="px-2 float-right">
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
                                                            <h4 class="font-weight-normal">
                                                                {{ $comment->user->resident->full_name ?? 'Admin' }} <span
                                                                    class="text-muted ml-1">
                                                                    -
                                                                    {{ $comment->created_at->longAbsoluteDiffForHumans() }}</span>

                                                            </h4>
                                                            <h3 class="font-weight-normal" id="d_comment">
                                                                {{ $comment->comment }}
                                                            </h3>
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
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });

        $('#announcement_nav').addClass('active')
    </script>
@endsection
