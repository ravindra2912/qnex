@extends('seller.layouts.index')

@section('custom_css')
  <link rel="stylesheet" href="{{ asset('admin_theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin_theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sub Category1 List</h1>
          </div>
        </div>
      </div>
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @include('seller/layouts/alerts')
            <div class="card">
                <div class="card-header">
                  <a href="{{ route('subcategory.create') }}" class="btn btn-primary">Add Sub Category1</a>
                </div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped w-100">
                  <thead>
                    <tr>
                      <th>Sr. No</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>Status</th>
					  @if(Auth::user()->role_id == 1)
						<th>Action</th>
					  @endif
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if(isset($subCategoryLists) && !empty($subCategoryLists))
                      @foreach($subCategoryLists as $subCategoryList)
                        <tr>
                          <td>{{ $i++ }}</td>
                          <td>{{ (isset($subCategoryList->category_data) && !empty($subCategoryList->category_data) && isset($subCategoryList->category_data->name)) ? ucfirst($subCategoryList->category_data->name) : '' }}</td>
                          <td>{{ (isset($subCategoryList->name) && !empty($subCategoryList->name)) ? ucfirst($subCategoryList->name) : '' }}</td>
                          <td>{{ (isset($subCategoryList->status) && !empty($subCategoryList->status)) ? ucfirst($subCategoryList->status) : '' }}</td>
                         @if(Auth::user()->role_id == 1)
						 <td>
                            <div class="d-flex">
                              <a href="{{ route('subcategory.edit',$subCategoryList->id) }}" class="btn btn-primary tableActionBtn editBtn" title="Edit Sub Category1"><i class="right fas fa-edit"></i></a>
                              <form action="{{ route('subcategory.destroy', $subCategoryList->id) }}" id="deleteForm" method="POST">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-danger tableActionBtn deleteBtn" title="Delete Sub Category1"><i class="right fas fa-trash"></i></a>
                              </form>
                            </div>
                          </td>
						  @endif
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('custom_js')
  <!-- DataTables -->
  <script src="{{ asset('admin_theme/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin_theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('admin_theme/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('admin_theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script type="text/javascript">
    $(function () {
      $("#example1").DataTable({
        "paging": true,
        "searching": true,
        "ordering": true,
        "info": true,
        "autoWidth": true,
        "responsive": true,
      });
    });

    // Display sweet alert while deleting
    $(".deleteBtn").click(function(){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'error',
        html: "You want to delete this sub category?",
        allowOutsideClick: false,
        showCancelButton: true,
        confirmButtonText: 'Delete',
        cancelButtonText: 'Cancel',
      })
      .then((result) => {
        if (result.isConfirmed) {
          $(this).closest("form").submit();
        }
      })
    });
  </script>
@endsection