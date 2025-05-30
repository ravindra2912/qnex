@extends('seller.layouts.index')

@section('custom_css')
    <style>
        .right-wrapper{
            background: #fff !important;
            background-color: #fff !important;
        }
        .note-editing-area {
            background: whitesmoke;
        }
		
		.product-images img{
			height: 200px;
			width: 100%;
			object-fit: contain;
			padding: 7px 5px;
		}
		.product-images{
			border: 1px solid lightblue;
			border-radius: 13px;
		}
		
		.add-images{
			height: 200px;
			display: flex;
			justify-content: center;
			align-items: center;
			flex-direction: column;
		}
		.add-images i{
			font-size: 70px;
			color: lightblue;
		}
		
		.add-images p{
			font-size: 23px;
			color: lightblue;
		}
		.action{
			position: absolute;
			width:100%;
			opacity: 0;
			height: 100%;
		}
		
		.action:hover{
			opacity: 1;
		}
		
		.action i, .action a{
			background: white;
			border-radius: 14px;
			padding: 5px;
			border: 1px solid;
		}
    </style>

    <!-- Summernote css/js -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
	
	 <!-- Sweet Alert -->
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                    </div>
                </div>
            </div>
        </section>
		
		<section class="content">
            <div class="container-fluid">
				@if($productData->is_variants == 1)
				<div class=" text-right mb-2">
					<a href="{{ route('products_variants',$productData->id) }}" title="Variants" class="btn btn-primary "><i class="right fas fa-sitemap"></i></a>
				</div>	
				@endif
				<div class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Images</h3>
					</div>
						<form method="POST" id="image_form" action="{{ url('/seller/product/upload_images/'.$productData->id) }}" enctype="multipart/form-data" >{{ csrf_field() }}
							<input type="file" name="images[]" max="{{ 5 - count($ProductImages) }}" accept=".png, .jpg, .jpeg" id="images" class="form-control" multiple style="opacity: 0;">
						</form>
						<span class="text-danger">@error('images') {{$message}} @enderror</span>
						<div class="card-body row">
							@foreach($ProductImages as $ims)
							<div class="form-group col-md-2 col-sm-3 ">
								<div class="product-images">
									<div class="action pr-4 pt-2 text-right" >
										<i class="fas fa-trash-alt pr-2 pl-2 text-danger" onclick="deleteimage({{ $ims->id }})"></i>
										<a href="{{ getImage($ims->image) }}" target="_blank" class="fas fa-eye text-primary"></a>
									</div>
									<img src="{{ getImage($ims->image) }}" class="">
								</div>
							</div>
							@endforeach
							
							@if(count($ProductImages) < 5)
							<div class="form-group col-md-2 col-sm-3 "  onclick="$('#images').click()">
								<div class="product-images add-images">
									<i class="fas fa-image"></i>
									<p>Add Image</p>
								</div>
							</div>
							@endif
							
						</div>
					
				</div>
                    
            </div>
        </section>
            
			
        <section class="content">
            <div class="container-fluid">
				<form action="{{ route('product.update',$productData->id) }}" id="updateform" class="card card-primary">
					<div class="card-header">
						<h3 class="card-title">Edit Product</h3>
					</div>
					@if(isset($productData) && !empty($productData))
						<input type="hidden" name="_method" value="PATCH">
						<div class="card-body row">
						
							<div class="form-group col-md-4 col-sm-6">
								<label class="required">Product Name</label>
								<input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" value="{{ isset($productData->name) && !empty($productData->name) ? $productData->name : '' }}" >
							</div>
							
							<div class="form-group col-md-4 col-sm-6">
							  <label class="required">Brand</label>
							  <input type="text" name="brand" id="brand" class="form-control" value="{{ $productData->brand}}" placeholder="Brand" >
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label class="required">Price</label>
								<input type="text" name="price" id="price" class="form-control" value="{{ isset($productData->price) && !empty($productData->price) ? $productData->price : 0 }}" onkeypress="return isNumberKey(event,this)" placeholder="Price" >
							</div>
						
							<div class="form-group col-md-4 col-sm-6">
								<label class="required">Manage Product variants</label>
								<select class="form-control" name="is_variants" id="is_variants" >
									<option value="1" {{ ($productData->is_variants == 1)? "selected" : '' }} >yes</option>
									<option value="0" {{ ($productData->is_variants == 0)? "selected" : '' }} >No</option>
								</select>
							</div>
							
							<div class="form-group col-md-4 col-sm-6 div-quantity" style="{{ ($productData->is_variants == 1)? "display:none;" : '' }}">
								<label class="required">Quantity</label>
								<input type="text" name="quantity" id="quantity" class="form-control" value="{{ $productData->quantity }}" onkeypress="return isNumberKey(event,this)" placeholder="Quantity" >
							</div>
							
							<div class="form-group col-md-4 col-sm-6">
								<label class="required">Select Category</label>
								<select class="form-control" name="category" id="category" >
									<option value="">Please Select Category</option>
									@if(isset($categoryData) && !empty($categoryData))
										@foreach($categoryData as $data)
											<option value="{{ $data->id }}" {{ ($data->id == $productData->category_id) ? "selected" : '' }} >{{ ucwords($data->name) }}</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label >Select Sub Category</label>
								<select class="form-control" name="sub_category" id="sub_category" >
									<option value="">Please Select Sub Category</option>
									@if(isset($subCategoryData) && !empty($subCategoryData))
										@foreach($subCategoryData as $da)
											<option value="{{ $da->id }}" {{ ($da->id == $productData->sub_category_id) ? "selected" : '' }} >{{ ucwords($da->name) }}</option>
										@endforeach
									@endif
								</select>
							</div>

							<div class="form-group col-md-4 col-sm-6">
								<label >Select Sub Category2</label>
								<select class="form-control" name="sub_category2" id="sub_category2" >
									<option value="">Please Select Sub Category</option>
									@if(isset($subCategory2Data) && !empty($subCategory2Data))
										@foreach($subCategory2Data as $d)
											<option value="{{ $d->id }}" {{ ($d->id == $productData->sub_category2_id) ? "selected" : '' }} >{{ ucwords($d->name) }}</option>
										@endforeach
									@endif
								</select>
							</div>
							
							<div class="form-group col-md-4 col-sm-6">
								<label class="required">Status</label>
								<select name="status" id="status" class="form-control" required>
									<option value='Active' {{ (isset($productData->status) && $productData->status == "Active") ? 'selected' : '' }}>Active</option>
									<option value='Inactive' {{ (isset($productData->status) && $productData->status == "Inactive") ? 'selected' : '' }}>Inactive</option>
								</select>
							</div>
							
							<div class="form-group col-md-12 col-sm-12">
								<label class="required">Short Description</label>
								<textarea class="form-control" name="short_description" placeholder="Short Description">{{ $productData->short_description }}</textarea>
							</div>
							
							<div class="form-group col-md-12 col-sm-12">
								<label class="required">Description</label>
								<textarea class="form-control" name="description" id="description">{{ isset($productData->description) && !empty($productData->description) ? $productData->description : '' }}</textarea>
							</div>
							
							<div class="form-group col-md-12 col-sm-12">
								<label class="required">Additional Information</label>
								<textarea class="form-control" name="additional_information"  id="additional_information" placeholder="Additional Information">{{ $productData->additional_information }}</textarea>
							</div>
							
							<div class="custom-control custom-checkbox col-md-12 col-sm-12">
								<input type="checkbox" class="custom-control-input is_featured" name="is_featured" id="is_featured"  {{ (isset($productData->is_featured) && $productData->is_featured == '1') ? 'checked' : '' }}>
								<label for="is_featured" class="custom-control-label">Is Featured</label>
							</div>
							
							<div class="form-group col-md-6 col-sm-6 mt-3 show_featured" style="{{ $productData->is_featured != '1' ? 'display:none;' : '' }}">
								<label class="required">Featured End Date</label>
								<input type="date" class="form-control" name="featured_date" id="featured_date" value="{{ date_format(date_create($productData->featured_date), 'Y-m-d')  }}" Placeholder="Featured Date" >
							</div>
							
							<div class="custom-control custom-checkbox col-md-12 col-sm-12">
								<input type="checkbox" class="custom-control-input is_replacement" name="is_replacement" id="is_replacement"  {{ (isset($productData->is_replacement) && $productData->is_replacement == '1') ? 'checked' : '' }}>
								<label for="is_replacement" class="custom-control-label">Is Replacement Applicable?</label>
							</div>
							
							<div class="form-group col-md-6 col-sm-12 mt-3 show_replacement" style="{{ $productData->is_replacement != '1' ? 'display:none;' : '' }}">
								<label class="required">Replacement Days</label>
								<input type="text" class="form-control" name="replacement_days" id="replacement_days" value="{{ isset($productData->replacement_days) && !empty($productData->replacement_days) ? $productData->replacement_days : '' }}" Placeholder="Enter Replacement Days" onkeypress="return isNumberKey(event,this)">
							</div>
							
							<div class="custom-control custom-checkbox col-md-12 col-sm-12">
							  <input type="checkbox" class="custom-control-input is_tax_applicable" name="is_tax_applicable" id="customCheckbox2" {{ (isset($productData->is_tax_applicable) && $productData->is_tax_applicable == '1') ? 'checked' : '' }}>
							  <label for="customCheckbox2" class="custom-control-label">Is Tax Applicable?</label>
							</div>

							<div class="show_taxes mt-2" style="{{ $productData->is_tax_applicable != '1' ? 'display:none;' : '' }}">
							  <div class="row mt-3">
								<div class="col-md-1 mt-2">
								  <label>IGST (%)</label>
								</div>
								<div class="col-md-3 mt-2">
								  <input type="text" class="form-control txt_taxes" name="igst" id="igst" onkeypress="return isNumberKey(event,this)" value="{{ isset($productData->igst) && !empty($productData->igst) ? $productData->igst : '' }}">
								</div>

								<div class="col-md-1 mt-2">
								  <label>CGST (%)</label>
								</div>
								<div class="col-md-3 mt-2">
								  <input type="text" class="form-control txt_taxes" name="cgst" id="cgst" onkeypress="return isNumberKey(event,this)" value="{{ isset($productData->cgst) && !empty($productData->cgst) ? $productData->cgst : '' }}">
								</div>

								<div class="col-md-1 mt-2">
								  <label>SGST (%)</label>
								</div>
								<div class="col-md-3 mt-2">
								  <input type="text" class="form-control txt_taxes" name="sgst" id="sgst" onkeypress="return isNumberKey(event,this)" value="{{ isset($productData->sgst) && !empty($productData->sgst) ? $productData->sgst : '' }}">
								</div>
							  </div>
							</div>
							
							<div class="form-group col-md-12 col-sm-12 mt-4 text-center">
								<h3>---- SEO ----</h3>
							</div>
							
							<div class="form-group col-md-6 col-sm-6">
								<label class="required">SEO Description</label>
								<textarea class="form-control" name="SEO_description" placeholder="SEO Description">{{ $productData->SEO_description }}</textarea>
							</div>
							
							<div class="form-group col-md-6 col-sm-6">
								<label class="required">SEO Tags (,)</label>
								<textarea class="form-control" name="SEO_tags" placeholder="SEO Tags">{{ $productData->SEO_tags }}</textarea>
							</div>
							
						</div>
						<div class="card-footer">
							<input type="submit" class="btn btn-primary btn_action submit_button" value="Submit">
							<a href="{{ route('product.index') }}" class="btn btn-secondary btn_action">Cancel</a>
							<a href="javascript:;" class="btn btn-primary loading" style="display:none;">Edit....</a>
						</div>
					@else
						<div class="card-body">
							<p class="text-danger">No Data Found</p>
						</div>
					@endif
				</form>
                    
            </div>
        </section>
		
		
    </div>
@endsection

@section('custom_js')
    
    <script type="text/javascript">

        function isNumberKey(evt, element) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57) && !(charCode == 46 || charCode == 8))
                return false;
            else {
                var len = $(element).val().length;
                var index = $(element).val().indexOf('.');
                if (index > 0 && charCode == 46) {
                    return false;
                }
                if (index > 0) {
                    var CharAfterdot = (len + 1) - index;
                    if (CharAfterdot > 3) {
                        return false;
                    }
                }
            }
            return true;
        }
		
		$("body").find(".is_tax_applicable").click(function(){

		  if ($(this).prop("checked")) {
			$("body").find(".show_taxes").show();
		  }
		  else {
			$("body").find(".show_taxes").hide();
		  }
		});
		
		$("body").find(".is_replacement").click(function(){
      
		  if ($(this).prop("checked")) {
			$("body").find(".show_replacement").show();
		  }
		  else {
			$("body").find(".show_replacement").hide();
		  }
		});
		
		$("body").find(".is_featured").click(function(){
      
		  if ($(this).prop("checked")) {
			$("body").find(".show_featured").show();
		  }
		  else {
			$("body").find(".show_featured").hide();
		  }
		});
		
		 $("#is_variants").change(function(){

                if(this.value == 0){
					$('.div-quantity').show();
				}else{
					$('.div-quantity').hide();
				}
            });


        $("document").ready(function(){
            $("#description").summernote({
                height: 200
            });
			
			$("#additional_information").summernote({
                height: 200
            });

            $("#category").change(function(){

                $("body").find("#sub_category").find('option').remove();
                $("body").find("#sub_category2").find('option').remove();

                var category = $(this).val();
                var url = "{{ route('sub_category_name', ":category") }}";
                url = url.replace(':category', category);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    success: function(result){
                        if(result.success){
                            var html = "";
                            if(result.data.length > 0){
                                html +="<option value=''>Please Select Sub Category</option>";
                                for(var i = 0; i < result.data.length; i++){
                                    html +="<option value='"+result.data[i].id+"'>"+result.data[i].name+"</option>";
                                }
                            }

                            if(html != ""){
                                $("#sub_category").append(html);
                            }
                        }
                        else{
                            toastr.error(result.message);
                        }
                    }
                });
            });

            $("#sub_category").change(function(){

                $("body").find("#sub_category2").find('option').remove();

                var category = $(this).val();
                var url = "{{ route('sub_category_name', ":category") }}";
                url = url.replace(':category', category);

                $.ajax({
                    type: "GET",
                    url: url,
                    dataType: "json",
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    success: function(result){
                        if(result.success){
                                var html = "";
                                if(result.data.length > 0){
                                    html +="<option value=''>Please Select Sub Category2</option>";
                                    for(var i = 0; i < result.data.length; i++){
                                        html +="<option value='"+result.data[i].id+"'>"+result.data[i].name+"</option>";
                                    }
                                }

                            if(html != ""){
                                $("#sub_category2").append(html);
                            }
                        }
                        else{
                            toastr.error(result.message);
                        }
                    }
                });
            });

			$("#updateform").on('submit',(function(e) {
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
						  setTimeout(function(){window.location.href = result.redirect}, 1000);
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

            /* $(".submit_button").click(function(){

                $("body").find(".btn_action").hide();
                $("body").find(".loading").show();

                var category = $("body").find("#category").val();
                var sub_category = $("body").find("#sub_category").val();
                var sub_category2 = $("body").find("#sub_category2").val();
                var product_name = $("body").find("#product_name").val();
                var price = $("body").find("#price").val();
                var is_variants = $("body").find("#is_variants").val();
                var quantity = $("body").find("#quantity").val();
                var description = $("body").find("#description").val();
                var status = $("body").find("#status").val();
				var is_replacement = $("body").find(".is_replacement").prop("checked");
				var replacement_days = $("body").find("#replacement_days").val();
				var is_tax_applicable = $("body").find(".is_tax_applicable").prop("checked");
				var igst = $("body").find("#igst").val();
				var cgst = $("body").find("#cgst").val();
				var sgst = $("body").find("#sgst").val();

                if(description === "<p><br></p>"){
                    description = "";
                }

                $.ajax({
                    type: "POST",
                    url: $("body").find("#form_url").val(),
                    dataType: "json",
                    headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
                    data : {
                        '_method': "PATCH",
                        'category': category,
                        'sub_category': sub_category,
                        'sub_category2': sub_category2,
                        'product_name': product_name,
                        'price': price,
                        'is_variants': is_variants,
                        'quantity': quantity,
                        'description': description,
                        'status': status,
						'is_replacement': is_replacement,
						'replacement_days': replacement_days,
						'is_tax_applicable': is_tax_applicable,
						'igst': igst,
						'cgst': cgst,
						'sgst': sgst,
                    },
                    success: function(result){
                        if(result.success){
                            toastr.success(result.message);
                            setTimeout(function(){window.location.href = window.location.origin+'/seller/product'}, 1000);
                        }
                        else{
                            toastr.error(result.message);
                            $("body").find(".btn_action").show();
                            $("body").find(".loading").hide();
                        }
                    }
                });
            }); */
			
			$("input[id='images']").change(function(){
				var fileUpload = $("input[id='images']");
				var limit = fileUpload.get(0).max;
				if (parseInt(fileUpload.get(0).files.length)>limit){
					 toastr.error("You can only upload a maximum of 5 Images");
				}else{
					$('#image_form').submit()
				}
			}); 
			
			 
        });
		
		function deleteimage(id){
				  Swal.fire({
					title: 'Are you sure?',
					icon: 'error',
					html: "If you will delete this Image?",
					allowOutsideClick: false,
					showCancelButton: true,
					confirmButtonText: 'Delete',
					cancelButtonText: 'Cancel',
				  })
				  .then((result) => {
					if (result.isConfirmed) {
						$.ajax({
							type: "POST",
							url: "{{ url('/seller/product/deleteimage') }}",
							dataType: "json",
							headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
							data : {
								'id': id,
							
							},
							success: function(result){
								if(result.success){
									toastr.success(result.message);
									setTimeout(function(){ location.reload(); }, 1000);
								}
								else{
									toastr.error(result.message);
								}
							}
						});
					}
				  })
				}
    </script>
@endsection