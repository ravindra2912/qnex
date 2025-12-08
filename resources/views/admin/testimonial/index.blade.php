@extends('admin.layouts.main')
@section('content')
@section('title', 'Testimonial List')

@push('style')
<link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/dist/css/jquery.dataTables.css') }}" />
@endpush

<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Testimonial list</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Testimonial list</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Testimonial list</h3>
                        <div class="float-right">
                            <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary"><i class="fas fa-plus"></i> Add</a>
                        </div>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-hover text-nowrap" id="data-table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Rating</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('js')
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(function() {
        var table = $('#data-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('admin.testimonials.index') }}",
            columns: [{
                    data: 'image',
                    name: 'image',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'designation',
                    name: 'designation'
                },
                {
                    data: 'rating',
                    name: 'rating'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });

    function destroy(url, id) {
        Swal.fire({
                title: 'Are you sure?',
                icon: 'error',
                html: "You want to delete this testimonial?",
                allowOutsideClick: false,
                showCancelButton: true,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
            })
            .then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            '_method': 'DELETE'
                        },
                        dataType: "json",
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            $('.btn_delete-' + id + ' #buttonText').addClass('d-none');
                            $('.btn_delete-' + id + ' #loader').removeClass('d-none');
                            $('.btn_delete-' + id).prop('disabled', true);
                        },
                        success: function(result) {
                            if (result.success) {
                                toastr.success(result.message);
                                // location.reload()
                                $('#data-table').DataTable().ajax.reload(null, false);
                            } else {
                                toastr.error(result.message);
                            }
                            $('.btn_action-' + id + ' #buttonText').removeClass('d-none');
                            $('.btn_action-' + id + ' #loader').addClass('d-none');
                            $('.btn_action-' + id).prop('disabled', false);
                        },
                        error: function(e) {
                            toastr.error('Something Wrong');
                            console.log(e);
                            $('.btn_action-' + id + ' #buttonText').removeClass('d-none');
                            $('.btn_action-' + id + ' #loader').addClass('d-none');
                            $('.btn_action-' + id).prop('disabled', false);
                        }
                    });
                }
            })
    }
</script>
@endpush
@endsection