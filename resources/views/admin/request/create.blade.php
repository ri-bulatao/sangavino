@extends('layouts.admin.app')

@section('title', 'Admin | Create Request')

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
                        Note: On this page, you have the option to create a services request by providing the specific
                        credentials listed below. You need to select a specific resident (who request the service) and the
                        selected service. We also require you to provide the purpose of the request.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success mr-3" href="{{ route('admin.requests.index') }}"><i
                                    class="fas fa-arrow-left"></i>
                            </a>
                            Create Request <i class="fas fa-clipboard-list ml-1"></i>
                        </h2> <br>

                        <div class="row">
                            <div class="col-md-8">
                                @include('layouts.includes.alert')

                                <form action="{{ route('admin.requests.store') }}" method="post">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Resident *</label>
                                        <select class="form-control" name="user_id">
                                            <option value=""></option>
                                            @foreach ($residents as $resident)
                                                <option value="{{ $resident->user->id }}">
                                                    {{ $resident->full_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Select Service *</label>
                                        <select class="form-control" name="service_id" onchange="displayInput(this)">
                                            <option value=""></option>
                                            @foreach ($services as $id => $service)
                                                <option value="{{ $id }}">
                                                    {{ $service }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3" id="business_name" style="display: none">
                                        <label class="form-label">Business Name *</label>
                                        <input class="form-control" type="text" name="business_name"
                                            placeholder="Enter Business Name">
                                    </div>
                                    <div class="form-group mb-3">
                                        <label class="form-label">Purpose *</label>
                                        <textarea class="form-control" name="purpose" rows="5" placeholder="Add Purpose"></textarea>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success d-block w-100">Submit</button>
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
        function displayInput(service) {
            if (service.value && service.value == '4') {
                $('#business_name').css('display', 'block')

            } else {
                $('#business_name').css('display', 'none')
            }
        }

        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
    </script>
@endsection
