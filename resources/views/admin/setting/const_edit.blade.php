@extends('admin.layouts.main')
@section('title', 'Edit Config')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Edit Config (Raw Mode)</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Config</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">config/const.php</h3>
            </div>
            <div class="card-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle"></i>
                    <strong>Warning:</strong> You are editing a raw PHP configuration file. Syntax errors will crash the application. Please be careful.
                </div>
                <form action="{{ route('admin.setting.const.update') }}" method="POST" class="formaction" data-action="reload">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-control" name="content" rows="30" style="font-family: 'Consolas', 'Monaco', 'Courier New', monospace; font-size: 14px; white-space: pre; background-color: #f8f9fa;">{{ $content }}</textarea>
                    </div>

                    <div class="text-right">
                        <button class="btn btn-primary btn_action" type="submit">
                            <span id="loader" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
                            <span id="buttonText">Save File</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection