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
                <h3 class="card-title">Add Sub Category2</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  <label class="required">Select Category</label>
                  <select class="form-control" name="category" id="category" required>
                    <option value="">Please Select Category</option>
                    @if(isset($categoryData) && !empty($categoryData))
                      @foreach($categoryData as $data)
                        <option value="{{ $data->id }}">{{ ucwords($data->name) }}</option>
                      @endforeach
                    @endif
                  </select>
                </div>

                <div class="form-group">
                  <label class="required">Select Sub Category</label>
                  <select class="form-control" name="sub_category" id="sub_category" required></select>
                </div>

                <div class="form-group">
                  <label class="required">Sub Category2 Name</label>
                  <input type="text" name="sub_category2_name" id="sub_category2_name" class="form-control" placeholder="Sub Category2 Name" required>
                </div>
              </div>
              <div class="card-footer">
                <input type="button" class="btn btn-primary btn_action submit_button" value="Submit">
                <a href="{{ route('subcategory2.index') }}" class="btn btn-secondary btn_action">Cancel</a>
                <a href="javascript:;" class="btn btn-primary loading" style="display:none;">Adding....</a>
              </div>
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

        $.ajax({
          type: "POST",
          url: "{{ route('subcategory2.store') }}",
          dataType: "json",
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          data : {
                  'category': category,
                  'sub_category': sub_category,
                  'sub_category2_name': sub_category2_name,
                },
          success: function(result){
            if(result.success){
              toastr.success(result.message);
              setTimeout(function(){window.location.href = window.location.origin+'/seller/subcategory2'}, 1000);
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