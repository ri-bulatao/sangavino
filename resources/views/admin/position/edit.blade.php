@extends('layouts.admin.app')

@section('title', 'Admin | Edit Position')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="text-success" href="{{ route('admin.positions.index') }}"><i
                                class="fas fa-arrow-left fa-lg"></i>
                        </a>

                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('img/crud/manage.svg') }}" alt="">
                            </div>
                            <div class="col-md-8">
                                <h1>Edit Position <i class="fas fa-edit ml-1"></i></h1> <br>
                                @include('layouts.includes.alert')

                                <form action="{{ route('admin.positions.update', $position) }}" method="post"
                                    id="position_form" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="form-group mb-2">
                                        <label class="form-label">Select Parent Position *</label>
                                        <select class="form-control" name="pid" id="d_positions">
                                            <option value="0" @if ($position->pid == 0) selected @endif>No
                                                Parent</option>
                                            @foreach ($parent_positions as $id => $parent_position)
                                                <option value="{{ $id }}"
                                                    @if ($position->pid == $id) selected @endif>
                                                    {{ $parent_position }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Position *</label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ $position->name }}">
                                    </div>

                                    <div class="form-group">
                                        <button type="button" class="btn btn-success d-block w-100"
                                            onclick="promptUpdate(event, '#position_form')">Save</button>
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
        $("#official_management_nav").addClass("active");
        $("#positions").addClass("font-weight-bold text-success");
    </script>
@endsection
