@extends('layouts.admin.app')

@section('title', 'Admin | Edit Resident')

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
                        Note: On this page, you have the option to edit a resident record by providing the specific
                        credentials listed below.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('admin.residents.index') }}">All Resident</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $resident->full_name }}</li>
                    </ol>
                </nav>

                <div class="card">
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-8">
                                <h1>Edit Resident <i class="fas fa-edit ml-1"></i></h1> <br>
                                @include('layouts.includes.alert')

                                <form class="row" action="{{ route('admin.residents.update', $resident) }}"
                                    method="post" id="resident_form" enctype="multipart/form-data">
                                    @csrf @method('PUT')
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Department *</label>
                                            <select class="form-control" name="purok_id">
                                                <option value=""></option>
                                                @foreach ($puroks as $id => $purok)
                                                    <option value="{{ $id }}"
                                                        @if ($id == $resident->purok_id) selected @endif>
                                                        {{ $purok }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">First Name *</label>
                                            <input type="text" class="form-control" name="first_name"
                                                value="{{ $resident->first_name }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Middle Name *</label>
                                            <input type="text" class="form-control" name="middle_name"
                                                value="{{ $resident->middle_name }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Last Name *</label>
                                            <input type="text" class="form-control" name="last_name"
                                                value="{{ $resident->last_name }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Gender *</label>
                                            <select class="form-control" name="gender">
                                                <option value=""></option>
                                                <option value="male" @if ($resident->gender == 'male') selected @endif>
                                                    Male</option>
                                                <option value="female" @if ($resident->gender == 'female') selected @endif>
                                                    Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Birth Date *</label>
                                            <input type="date" max="2008-01-01" class="form-control" name="birth_date"
                                                value="{{ formatDate($resident->birth_date, 'dateInput') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-2">
                                            <label class="form-label">Address *</label>
                                            <input type="text" class="form-control" name="address"
                                                value="{{ $resident->address }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Contact *</label>
                                            <input type="number" class="form-control" min="0" name="contact"
                                                value="{{ $resident->contact }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Civil Status *</label>
                                            <select class="form-control" name="civil_status">
                                                <option value=""></option>
                                                <option value="single" @if ($resident->civil_status == 'single') selected @endif>
                                                    Single</option>
                                                <option value="married" @if ($resident->civil_status == 'married') selected @endif>
                                                    Married</option>
                                                <option value="divorced" @if ($resident->civil_status == 'divorced') selected @endif>
                                                    Divorced</option>
                                                <option value="widowed" @if ($resident->civil_status == 'widowed') selected @endif>
                                                    Widowed</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Citizenship *</label>
                                            <input type="text" class="form-control" name="citizenship"
                                                value="{{ $resident->citizenship }}">
                                        </div>
                                        <div class="form-group mb-2">
                                            <label class="form-label">Is Registered Voter *</label>
                                            <select class="form-control" name="is_voter">
                                                <option value=""></option>
                                                <option value="1" @if ($resident->is_voter == '1') selected @endif>
                                                    Yes
                                                </option>
                                                <option value="0" @if ($resident->is_voter == '0') selected @endif>No
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label class="form-label">Email *</label>
                                            <input type="email" class="form-control" name="email"
                                                value="{{ $resident->user?->email }}">
                                        </div>
                                        <div class="form-group">
                                            <button type="button" class="btn btn-success"
                                                onclick="promptUpdate(event, '#resident_form')">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-4">
                                <img src="{{ asset('img/crud/manage.svg') }}" alt="">
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
        $("#resident_management_nav").addClass("active");
        $("#resident").addClass("font-weight-bold text-success");
    </script>
@endsection
