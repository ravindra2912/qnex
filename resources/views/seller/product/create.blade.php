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
  </style>

  <!-- Summernote css/js -->
  <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
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
        
            <form action="{{ route('product.store') }}" id="addform" class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Add Product</h3>
              </div>
				<div class="card-body row">
					<div class="form-group col-md-4 col-sm-6">
					  <label class="required">Product Name</label>
					  <input type="text" name="product_name" id="product_name" class="form-control" placeholder="Product Name" >
					</div>
					
					<div class="form-group col-md-4 col-sm-6">
					  <label class="required">Brand</label>
					  <input type="text" name="brand" id="brand" class="form-control" placeholder="Brand" >
					</div>

					<div class="form-group col-md-4 col-sm-6">
					  <label class="required">Price</label>
					  <input type="text" name="price" id="price" class="form-control" onkeypress="return isNumberKey(event,this)" placeholder="Price" >
					</div>
					
					<div class="form-group col-md-4 col-sm-6">
						<label class="required">Manage Product variants</label>
						<select class="form-control" name="is_variants" id="is_variants">
							<option value="0" >No</option>
							<option value="1" >yes</option>
							
						</select>
					</div>
					
					<div class="form-group col-md-4 col-sm-6 div-quantity" >
						<label class="required">Quantity</label>
						<input type="text" name="quantity" id="quantity" class="form-control" onkeypress="return isNumberKey(event,this)" placeholder="Quantity" >
					</div>
					
					<div class="form-group col-md-4 col-sm-6">
						<label class="required">Select Category</label>
						<select class="form-control" name="category" id="category" >
							<option value="">Please Select Category</option>
							@if(isset($categoryData) && !empty($categoryData))
							  @foreach($categoryData as $data)
								<option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
							  @endforeach
							@endif
						</select>
					</div>

                <div class="form-group col-md-4 col-sm-6">
					<label >Select Sub Category</label>
					<select class="form-control" name="sub_category" id="sub_category" >
						<option value="">Please Select Sub Category</option>
					</select>
                </div>

                <div class="form-group col-md-4 col-sm-6">
					<label>Select Sub Category2</label>
					<select class="form-control" name="sub_category2" id="sub_category2" >
						<option value="">Please Select Sub Category2</option>
					</select>
                </div>

                

                <div class="form-group col-md-12 col-sm-12">
					<label class="required">Short Description</label>
					<textarea class="form-control" name="short_description" placeholder="Short Description"></textarea>
                </div>
				
				<div class="form-group col-md-12 col-sm-12">
					<label class="required">Description</label>
					<textarea class="form-control" name="description" id="description" placeholder="Description"></textarea>
                </div>
				
				<div class="form-group col-md-12 col-sm-12">
					<label class="required">Additional Information</label>
					<textarea class="form-control" name="additional_information"  id="additional_information" placeholder="Additional Information"></textarea>
                </div>
				
                <div class="custom-control custom-checkbox col-md-3 col-sm-12">
					<input type="checkbox" class="custom-control-input is_replacement" name="is_replacement" id="is_replacement" >
					<label for="is_replacement" class="custom-control-label">Is Replacement Applicable?</label>
                </div>
				
				<div class="form-group col-md-3 col-sm-6 show_replacement" style="display:none;">
					<label class="required">Replacement Days</label>
					<input type="text" class="form-control txt_taxes" name="replacement_days" id="replacement_days" Placeholder="Enter Replacement Days" onkeypress="return isNumberKey(event,this)">
				</div>
				
				
				
				<div class="custom-control custom-checkbox col-md-12 col-sm-12">
                  <input type="checkbox" class="custom-control-input is_tax_applicable" name="is_tax_applicable" id="customCheckbox2">
                  <label for="customCheckbox2" class="custom-control-label">Is Tax Applicable?</label>
                </div>

                <div class="show_taxes mt-2" style="display:none;">
                  <div class="row mt-3">
                    <div class="col-md-1 mt-2">
                      <label>IGST (%)</label>
                    </div>
                    <div class="col-md-3 mt-2">
                      <input type="text" class="form-control txt_taxes" name="igst" id="igst" onkeypress="return isNumberKey(event,this)">
                    </div>

                    <div class="col-md-1 mt-2">
                      <label>CGST (%)</label>
                    </div>
                    <div class="col-md-3 mt-2">
                      <input type="text" class="form-control txt_taxes" name="cgst" id="cgst" onkeypress="return isNumberKey(event,this)">
                    </div>

                    <div class="col-md-1 mt-2">
                      <label>SGST (%)</label>
                    </div>
                    <div class="col-md-3 mt-2">
                      <input type="text" class="form-control txt_taxes" name="sgst" id="sgst" onkeypress="return isNumberKey(event,this)">
                    </div>
                  </div>
                </div>


				<div class="form-group col-md-12 col-sm-12 mt-4 text-center">
					<h3>---- SEO ----</h3>
                </div>
				
				<div class="form-group col-md-6 col-sm-6">
					<label class="required">SEO Description</label>
					<textarea class="form-control" name="SEO_description" placeholder="SEO Description"></textarea>
                </div>
				
				<div class="form-group col-md-6 col-sm-6">
					<label class="required">SEO Tags (,)</label>
					<textarea class="form-control" name="SEO_tags" placeholder="SEO Tags"></textarea>
                </div>

              </div>
              <div class="card-footer">
                <input type="submit" class="btn btn-primary btn_action submit_button" value="Submit">
                <a href="{{ route('product.index') }}" class="btn btn-secondary btn_action">Cancel</a>
                <a href="javascript:;" class="btn btn-primary loading" style="display:none;">Adding....</a>
              </div>
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

    $("document").ready(function(){

      $("#description").summernote({
        height: 200
      });
	  $("#additional_information").summernote({
        height: 200
      });
	  
		$("#is_variants").change(function(){
			if(this.value == 0){
				$('.div-quantity').show();
			}else{
				$('.div-quantity').hide();
			}
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
      
	  
		$("#addform").on('submit',(function(e) {
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
        var quantity = $("body").find("#quantity").val();
        var description = $("body").find("#description").val();
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
          url: "{{ route('product.store') }}",
          dataType: "json",
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          data : {
                  'category': category,
                  'sub_category': sub_category,
                  'sub_category2': sub_category2,
                  'product_name': product_name,
                  'price': price,
                  'quantity': quantity,
                  'description': description,
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
          },
		  error: function (e) {
				console.log(e);
			}
        });
      }); */
    });
  </script>
@endsection