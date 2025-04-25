@extends('seller.layouts.index')

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
        <div class="row">
          <div class="col-md-3 col-sm-1"></div>
          <div class="col-md-6 col-sm-10">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Edit Sub Category2</h3>
              </div>
              @if(isset($subCategory2Data) && !empty($subCategory2Data))
                <input type="hidden" id="form_url" value="{{ route('subcategory2.update',$subCategory2Data->id) }}">
                <div class="card-body">
                  <div class="form-group">
                    <label class="required">Select Category</label>
                    <select class="form-control select2" name="category" id="category" required>
                      @if(isset($categoryData) && !empty($categoryData))
                        @foreach($categoryData as $data)
                          <option value="{{ $data->id }}" {{ ($data->id == $subCategoryData->parent_id) ? "selected" : '' }} >{{ ucwords($data->name) }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="required">Select Sub Category</label>
                    <select class="form-control select2" name="sub_category" id="sub_category" required>
                      @if(isset($subParentData) && !empty($subParentData))
                        @foreach($subParentData as $d)
                          <option value="{{ $d->id }}" {{ ($d->id == $subCategory2Data->parent_id) ? "selected" : '' }} >{{ ucwords($d->name) }}</option>
                        @endforeach
                      @endif
                    </select>
                  </div>

                  <div class="form-group">
                    <label class="required">Sub Category2 Name</label>
                    <input type="text" name="sub_category2_name" id="sub_category2_name" class="form-control" placeholder="Sub Category2 Name" value="{{ (isset($subCategory2Data->name) && !empty($subCategory2Data->name)) ? $subCategory2Data->name : '' }}" required>
                  </div>

                  <div class="form-group">
                    <label class="required">Status</label>
                    <select name="status" id="status" class="form-control" required>
                      <option value='Active' {{ (isset($subCategory2Data->status) && $subCategory2Data->status == "Active") ? 'selected' : '' }}>Active</option>
                      <option value='Inactive' {{ (isset($subCategory2Data->status) && $subCategory2Data->status == "Inactive") ? 'selected' : '' }}>Inactive</option>
                    </select>
                  </div>
				  
					<div class="form-group text-center">
						<h3>---- SEO ----</h3>
					</div>
					
					<div class="form-group 6">
						<label class="">SEO Description</label>
						<textarea class="form-control" name="SEO_description" id="SEO_description" placeholder="SEO Description">{{ $subCategory2Data->SEO_description }}</textarea>
					</div>
					
					<div class="form-group ">
						<label class="">SEO Tags (,)</label>
						<textarea class="form-control" name="SEO_tags" id="SEO_tags" placeholder="SEO Tags">{{ $subCategory2Data->SEO_tags }}</textarea>
					</div>
				  
                </div>
                <div class="card-footer">
                  <input type="button" class="btn btn-primary btn_action submit_button" value="Submit">
                  <a href="{{ route('subcategory2.index') }}" class="btn btn-secondary btn_action">Cancel</a>
                  <a href="javascript:;" class="btn btn-primary loading" style="display:none;">Editing....</a>
                </div>
              @else
                <div class="card-body">
                  <p class="text-danger">No Data Found</p>
                </div>
              @endif
            </div>
          </div>
          <div class="col-md-3 col-sm-1"></div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('custom_js')
  <script type="text/javascript">
    $("document").ready(function(){
      $("#category").change(function(){

        $("body").find("#sub_category").find('option').remove();

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

      $(".submit_button").click(function(){

        $("body").find(".btn_action").hide();
        $("body").find(".loading").show();

        var category = $("body").find("#category").val();
        var sub_category = $("body").find("#sub_category").val();
        var sub_category2_name = $("body").find("#sub_category2_name").val();
        var status = $("body").find("#status").val();
        var SEO_description = $("body").find("#SEO_description").val();
        var SEO_tags = $("body").find("#SEO_tags").val();

        $.ajax({
          type: "POST",
          url: $("body").find("#form_url").val(),
          dataType: "json",
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          data : {
                  'category': category,
                  'sub_category': sub_category,
                  'sub_category2_name': sub_category2_name,
                  'status': status,
                  'SEO_description': SEO_description,
                  'SEO_tags': SEO_tags,
                  '_method': "PATCH",
                },
          success: function(result){
            if(result.success){
              toastr.success(result.message);
              setTimeout(function(){window.location.href = window.location.origin+'/seller/subcategory2'}, 2000);
            }
            else{
              toastr.error(result.message);
              $("body").find(".btn_action").show();
              $("body").find(".loading").hide();
            }
          }
        });
      });
    });
  </script>
@endsection