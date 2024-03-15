@extends('layouts.admin.app')

@section('title', 'Admin | Request Info')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <a class="text-success" href="{{ route('admin.requests.index') }}"><i
                                class="fas fa-arrow-left fa-lg"></i>
                        </a>

                        <div class="row">
                            <div class="col-md-5">
                                <img src="{{ asset('img/crud/show.svg') }}" alt="">
                            </div>
                            <div class="col-md-7">
                                <h1>Issuance <i class="fas fa-info-circle ml-1"></i></h1><br>
                                <h2 class="font-weight-normal">Transaction #: {{ $request->transaction_id }}
                                </h2>
                                <h2 class="font-weight-normal">Requestor: {{ $request->user->resident->full_name }}</h2>
                                <h2 class="font-weight-normal">Service: {{ $request->service->name }}</h2>
                                <h2 class="font-weight-normal">Fee: ₱ {{ $request->service->fee }}</h2>
                                <h2 class="font-weight-normal">Purpose: {{ $request->purpose }}</h2>
                                <h2 class="font-weight-normal">Requested At: {{ formatDate($request->created_at) }}</h2>
                                <h2 class="font-weight-normal">Status: {!! handleRequestStatus($request->status) !!}</h2>
                                @if ($request->remark)
                                    <h2 class="font-weight-normal">Remark: {{ $request->remark }}</h2>
                                @endif
                                <hr>
                                <h3 data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                                    aria-controls="collapseExample" style="cursor: pointer"><i
                                        class="fas fa-chevron-right mr-1"></i>Manage Request <i class="fas fa-cog ml-1"></i>
                                </h3>
                                <div class="collapse" id="collapseExample">
                                    <form action="{{ route('admin.requests.update', $request) }}" method="post"
                                        id="request_form">
                                        @csrf @method('PUT')
                                        @include('layouts.includes.alert')

                                        <div class="form-group mb-3">
                                            <select class="form-control" name="status">
                                                <option value="">---Select Status---</option>
                                                <option value="1">Mark as Approved</option>
                                                <option value="2">Mark as Declined</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <textarea class="form-control" name="remark" rows="5" placeholder="Add Remark"></textarea>
                                        </div>
                                        <button type="button" class="btn btn-success"
                                            onclick="promptUpdate(event, '#request_form')">Save</button>
                                    </form>
                                </div>
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
        $("#services_management_nav").addClass("active");
        $("#requests").addClass("font-weight-bold text-success");
    </script>
@endsection
