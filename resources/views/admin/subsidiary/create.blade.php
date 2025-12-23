@extends('admin.layouts.main')
@section('content')
@section('title', 'Create Subsidiary')

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
</style>
@endpush

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Create Subsidiary</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.subsidiaries.index') }}">Subsidiary list</a></li>
                    <li class="breadcrumb-item active">Create Subsidiary</li>
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
                    <h3 class="card-title">Create Subsidiary</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.subsidiaries.store') }}" data-action="back" class="row formaction">
                        @csrf
                        <div class="col-md-12 row">
                            <div class="col-md-4" style="justify-items: center;">
                                <div class="avtar">
                                    <img src="{{ getImage('') }}" class="avtar_img" />
                                    <label for="image" title="Change Image"><i class="far fa-edit"></i></label>
                                </div>
                                <input type="file" name="image" class="avtar_input" id="image" accept="image/png, image/webp, image/jpeg" />
                            </div>

                            <div class="col-md-8 row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="error">*</span></label>
                                        <input type="text" class="form-control" name="name" placeholder="Name" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Status <span class="error">*</span></label>
                                        <select class="form-control" name="status">
                                            @foreach (config('const.common_status') as $value)
                                            <option value="{{ $value }}">{{ $value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description <span class="error">*</span></label>
                                        <textarea class="form-control" name="description" rows="5" placeholder="Enter description"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 text-right">
                            <button class="btn btn-danger" type="button" onclick="history.back()">Back</button>
                            <button class="btn btn-primary btn_action" type="submit">
                                <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                                <span id="buttonText">Submit</span>
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