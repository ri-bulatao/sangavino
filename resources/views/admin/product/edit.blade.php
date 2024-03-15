@extends('layouts.admin.app')

@section('title', 'Admin | Edit Product')

@section('content')

    {{-- CONTAINER --}}
    <div class="container-fluid py-4">
        @include('layouts.includes.alert')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="alert alert-dark alert-dismissible fade show p-3 text-white" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <p class="translated_text">
                        Note: On this page, you have the option to edit the product by providing the specific
                        credentials listed below. You need to also to provide the manufactured and expiration date as the
                        products are based on the medical supplies.
                    </p>
                    <a class="btn btn-sm btn-success text-white translate_btn" href="javascript:void(0)"
                        onclick="translateToTagalog(this)">Click
                        to Translate in Tagalog</a>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h2>
                            <a class="text-success float-left mr-3" href="{{ route('admin.products.index') }}">
                                <i class='fas fa-arrow-left'></i>
                            </a>
                            Edit Product <i class="fas fa-edit ml-1"></i>
                        </h2><br>

                        <form class="row" action="{{ route('admin.products.update', $product) }}" method="post"
                            id="product_form">
                            @csrf @method('PUT')
                            <div class="col-md-6">
                                <div class="form-group mb-2">
                                    <label class="form-label">Select Category *</label>
                                    <select class="form-control" name="category_id">
                                        <option value=""></option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                @if ($product->category_id == $category->id) selected @endif>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group mb-2">
                                    <label class="form-label">Code *</label>
                                    <input type="number" class="form-control" min="0" name="code"
                                        value="{{ $product->code }}" required>
                                </div>


                                <div class="form-group mb-2">
                                    <label class="form-label">Product Name *</label>
                                    <input type="text" class="form-control" name="name" value="{{ $product->name }}"
                                        required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Description *</label>
                                    <input type="text" class="form-control" name="description"
                                        value="{{ $product->description }}" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Price Value (₱) *</label>
                                    <input type="number" class="form-control" min="0" name="price"
                                        value="{{ $product->price }}" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Qty *</label>
                                    <input type="number" class="form-control" min="0" name="qty"
                                        value="{{ $product->qty }}" required>
                                </div>

                                <div class="form-group mb-2">
                                    <label class="form-label">Manufactured Date *</label>
                                    <input type="date" class="form-control" name="manufactured_at"
                                        value="{{ formatDate($product->manufactured_at, 'dateInput') }}" required>
                                </div>

                                <div class="form-group mb-3">
                                    <label class="form-label">Expiration Date *</label>
                                    <input type="date" class="form-control" name="expired_at"
                                        value="{{ formatDate($product->expired_at, 'dateInput') }}" required>
                                </div>

                                <button type="button" class="btn btn-success"
                                    onclick="promptUpdate(event,'#product_form')">
                                    Save
                                </button>
                            </div>
                            <div class="col-md-6">
                                <img class="img-fluid d-block mx-auto" src="{{ asset('img/crud/manage.svg') }}"
                                    alt="create">
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
        $("#inventory_management_nav").addClass("active");
        $("#product").addClass("text-success");
    </script>
@endsection
