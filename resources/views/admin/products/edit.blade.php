@extends('admin.layouts.main')
@section('content')
@section('title', 'Edit Product')

@push('style')
<style>
    .avtar_img {
        height: 160px;
        width: 160px;
        object-fit: contain;
        border-radius: 20px;
    }

    .avtar {
        border: 1px solid #ced4da;
        border-radius: 10px;
        width: fit-content;
        padding: 10px;
        text-align: center;
        position: relative;
        margin: 0 auto;
    }

    .avtar label {
        position: absolute;
        bottom: -10px;
        right: -10px;
        background: var(--primary);
        color: white;
        padding: 8px;
        border-radius: 50%;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        top: auto;
    }

    .avtar label:hover {
        transform: scale(1.1);
    }

    .avtar_input {
        opacity: 0;
        height: 0px;
        position: absolute;
    }

    .form-control.is-invalid {
        border-color: #dc3545;
        padding-right: calc(1.5em + .75rem);
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5zM6 8.2a.3.3 0 000 .6.3.3 0 000-.6z'/%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right calc(.375em + .1875rem) center;
        background-size: calc(.75em + .375rem) calc(.75em + .375rem);
    }
</style>
@endpush

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Product</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Product list</a></li>
                    <li class="breadcrumb-item active">Edit Product</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" data-action="back" class="row formaction">
                        @csrf
                        @method('PUT')
                        <div class="col-md-12 row">
                            <div class="col-md-4" style="justify-items: center;">
                                <div class="avtar">
                                    <img src="{{ getImage($product->image) }}" class="avtar_img" />
                                    <label for="image" title="Change Image"><i class="far fa-edit"></i></label>
                                </div>
                                <input type="file" name="image" class="avtar_input" id="image" accept="image/png, image/webp, image/jpeg" />
                            </div>

                            <div class="col-md-8 row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Product Name <span class="error">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Product Name" value="{{ $product->name }}" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span class="error">*</span></label>
                                        <select class="form-control" name="status">
                                            @foreach (config('const.common_status') as $value)
                                            <option value="{{ $value }}" {{ $product->status == $value ? 'selected' : '' }}>{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button class="btn btn-danger" type="button" onclick="history.back()">Back</button>
                            <button class="btn btn-primary btn_action" type="submit">
                                <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span id="buttonText">Update</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
<script>
    $('.avtar_input').on('change', function(event) {
        var input = event.target;
        var image = $('.avtar_img');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                image.attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    })
</script>
@endpush
@endsection