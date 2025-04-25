@extends('seller.layouts.index')

@section('custom_css')

  <!-- Sweet Alert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <style>
	.m-hide {
		display: table;
	}
  </style>
@endsection

@section('content')
  <div class="content-wrapper">
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Product List</h1>
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
                  <a href="{{ route('product.create') }}" title="Add New Product" class="btn btn-success btn-sm float-right">+ Add new product</a>
                  <button href="{{ route('product.create') }}" title="Import Product" class="btn btn-success btn-sm float-right mr-2" data-toggle="modal" data-target="#modal-import">Import</button>
                </div>
              <div class="card-body">
			  
				<form action="{{ route('product.index') }}" method="get" enctype="multipart/form-data"> 
					<div class="row filter-div">
						<div class="col-sm-1">
						</div>
						<div class="col-sm-2">
							<div class="form-group">
							<label>From Date</label>
								<input type="date" name="start_date" value="{{$request['start_date']}}" class="form-control"  >
							</div>
						</div>												
						
						<div class="col-sm-2">
							<div class="form-group">
							<label>To Date</label>
								<input type="date" name="end_date" value="{{$request['end_date']}}" class="form-control"  >
							</div>
						</div>		

						<div class="col-sm-2">            
							<div class="form-group">       
								<label for="category">Status</label>     
								<select class="form-control" name="status" id="status">	
									<option value="">All </option>	
									<option value="Active" @if($request['status'] == 'Active') selected @endif>Active </option>	
									<option value="Inactive" @if($request['status'] == 'Inactive') selected @endif>Inactive </option>	
													
								</select>   
                   			</div>   
						</div>	
						
						<div class="col-sm-3">
							<div class="form-group">
							<label for="bundle_name">Search</label>
								<input type="search" name="search" value="{{$request['search']}}" class="form-control" placeholder="Search" >
							</div>
						</div>	
						<div class="col-sm-2">		
							<div class="form-group">
								<label for="bundle_name" style="margin-top: 35px;">&nbsp;</label>
								<button class="btn btn-primary" name="action" value="submit" title="Search" type="submit" >Search</button>				
								<button class="btn btn-primary" name="action" value="export" title="Product Report" type="submit" >Export</button>				
							</div>						
						</div>						
					</div>					
				</form>
              </div>
            </div>
          </div>
		  
		  <div class="col-12">
            <div class="card table-card">
              <div class="card-body">
				@if(isset($productLists) && !empty($productLists) && count($productLists) > 0)
                <table id="example1" class="table table-striped w-100 m-hide">
                  <thead>
                    <tr>
                      <th>Sr. No</th>
					  <th>Product Name</th>
                      <th>Category Name</th>
                      <th>Sub Category Name</th>
                      <th>Sub Category2 Name</th>
                      
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $i=1; @endphp
                    @if(isset($productLists) && !empty($productLists))
                      @foreach($productLists as $productList)
                        <tr>
                          <td>{{ $i++ }}</td>
						  <td>{{ (isset($productList->name) && !empty($productList->name)) ? ucfirst($productList->name) : '' }}</td>
                          <td>{{ (isset($productList->category_data) && !empty($productList->category_data) && isset($productList->category_data->name)) ? ucfirst($productList->category_data->name) : '' }}</td>
                          <td>{{ (isset($productList->sub_category_data) && !empty($productList->sub_category_data) && isset($productList->sub_category_data->name)) ? ucfirst($productList->sub_category_data->name) : '' }}</td>
                          <td>{{ (isset($productList->sub_category2_data) && !empty($productList->sub_category2_data) && isset($productList->sub_category2_data->name)) ? ucfirst($productList->sub_category2_data->name) : '' }}</td>
                          <td>{{ (isset($productList->status) && !empty($productList->status)) ? ucfirst($productList->status) : '' }}</td>
                          <td>
                            <div class="d-flex justify-content-center">
								<a href="{{ route('product.edit',$productList->id) }}" class="btn btn-primary tableActionBtn editBtn" title="Edit Product"><i class="right fas fa-edit"></i></a>
								<a href="{{ route('product.product_review',$productList->id) }}" class="btn btn-primary tableActionBtn ml-1" title="Product Reviews"><i class="right fas fa-star"></i></a>
								@if($productList->is_variants == 1)
									<a href="{{ route('products_variants',$productList->id) }}" class="btn btn-warning tableActionBtn editBtn ml-1" title="Product variants"><i class="right fas fa-sitemap"></i></a>
								@endif
								<form action="{{ route('product.destroy', $productList->id) }}" id="deleteForm" method="POST">
									@csrf
									@method('DELETE')
									<a class="btn btn-danger tableActionBtn deleteBtn" title="Delete Product"><i class="right fas fa-trash"></i></a>
								</form>
                            </div>
                          </td>
                        </tr>
                      @endforeach
                    @endif
                  </tbody>
                </table>
				
				<style>
					.pimg{
						height: 140px;
						width: 120px;
						object-fit: contain;
					}
					.p-name {
						font-size: 15px;
						color: #000;
						text-transform: none;
						width: auto;
						display: -webkit-box;
						-webkit-line-clamp: 2;
						-webkit-box-orient: vertical;
						overflow: hidden;
						text-overflow: ellipsis;
						height: 40px;
					}
					.dropdown-toggle::after {
						display: none;
						margin-left: .255em;
						vertical-align: .255em;
						content: "";
						border-top: .3em solid;
						border-right: .3em solid transparent;
						border-bottom: 0;
						border-left: .3em solid transparent;
					}
					.dropdown-menu.show{
						transform: translate3d(-120px, 31px, 0px ) !important;
					}
					.p-list .card{
						padding: 1.0rem !important ;
					}
				</style>
				<div class="m-show p-list">
					<div class="row px-2 py-2">
						@if(isset($productLists) && !empty($productLists))
							@foreach($productLists as $productList)
								<div class="col-6 ">
									<div class="card" >
										<div class="card-header py-1">
											<p class="mb-0 float-left">{{ (isset($productList->status) && !empty($productList->status)) ? ucfirst($productList->status) : '' }}</p>
											<div class="btn-group float-right">
												<button type="button" class="btn  btn-sm dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
												  <i class="fas fa-ellipsis-v"></i></button>
												<div class="dropdown-menu float-right" role="menu" style="">
													<a href="{{ route('product.edit',$productList->id) }}" class="dropdown-item">Edit</a>
													<a href="{{ route('product.product_review',$productList->id) }}" class="dropdown-item">Reviews</a>
													@if($productList->is_variants == 1)
														<a href="{{ route('products_variants',$productList->id) }}" class="dropdown-item">variants</a>
													@endif
													<div class="dropdown-divider"></div>
													<form action="{{ route('product.destroy', $productList->id) }}" id="deleteForm" method="POST">
														@csrf
														@method('DELETE')
														<div class="dropdown-item text-danger deleteBtn">Delete</div>
													</form>
												  
												</div>
											</div>
										</div>
										<div class="card-body">
											<img class="pimg" src="{{ (isset($productList->images_data[0]->small_image) )? getImage($productList->images_data[0]->small_image) : getImage('') }}" />
											<p class="p-name mb-1 ">{{ (isset($productList->name) && !empty($productList->name)) ? ucfirst($productList->name) : '' }}</p>
											<p class="mb-0 font-weight-bold">₹{{ (isset($productList->price) && !empty($productList->price)) ? ucfirst($productList->price) : '' }}</p>
										</div>
									</div>
								</div>
							@endforeach
						@endif
					</div>
				</div>
				
				<div class="d-flax align-self-end" >
					{{ $productLists->appends(request()->except('page'))->links() }}
				</div>
				
				@else
					<div class="my-3">
						<h4 class="font-weight-bold text-center">No Data Found!</h4>
					</div>
				@endif
				
              </div>
			   
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  
  
	<div class="modal fade" id="modal-import">
		<div class="modal-dialog">
			<form action="{{ route('product.import') }}" id="importform" method="post" enctype="multipart/form-data" class="modal-content">@csrf
				<div class="modal-header">
					<h4 class="modal-title">Import Product</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<label>File</label>
					<input type="file" name="file" class="form-control" />
				</div>
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<a href="{{ asset('uploads/bulk upload demo.xlsx') }}" download class="btn btn-info">Download Demo</a>
					<button type="submit" class="btn btn-primary btn_action">Submit</button>
					<button type="button" class="btn btn-primary loading" style="display:none;">Loading ...</button>
				</div>
			</form>
		</div>
	</div>
@endsection

@section('custom_js')
  <!-- DataTables -->

  <script type="text/javascript">
   

    // Display sweet alert while deleting
    $(".deleteBtn").click(function(){
      Swal.fire({
        title: 'Are you sure?',
        icon: 'error',
        html: "You want to delete this product?",
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
	
	$("#importform").on('submit',(function(e) {
		e.preventDefault();
		 
		  $.ajax({
			url: this.action,
			type: "POST",
			data:  new FormData(this),
			dataType: "json",
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
			contentType: false,
			cache: false,
			processData:false,
			beforeSend : function(){ 
				$('.btn_action').hide();
				$('.loading').show();
			},
			success: function(result){
				//console.log(data);
				
				if(result.success){
				  toastr.success(result.message);
				  setTimeout(function(){ location.reload(); }, 1000);
				}
				else{
					toastr.error(result.message);
					$('.btn_action').show();
					$('.loading').hide();
				}
			},
			error: function(e){ 
				toastr.error('Somthing Wrong');
				console.log(e);
				$('.btn_action').show();
				$('.loading').hide();
			}           
		});
	 }));
  </script>
@endsection