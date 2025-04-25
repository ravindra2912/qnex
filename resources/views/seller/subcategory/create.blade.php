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
                <h3 class="card-title">Add Sub Category1</h3>
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
                  <label class="required">Sub Category Name</label>
                  <input type="text" name="sub_category_name" id="sub_category_name" class="form-control" placeholder="Sub Category Name" required>
                </div>
              </div>
              <div class="card-footer">
                <input type="button" class="btn btn-primary btn_action submit_button" value="Submit">
                <a href="{{ route('subcategory.index') }}" class="btn btn-secondary btn_action">Cancel</a>
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
      $(".submit_button").click(function(){

        $("body").find(".btn_action").hide();
        $("body").find(".loading").show();

        var category = $("body").find("#category").val();
        var sub_category_name = $("body").find("#sub_category_name").val();

        $.ajax({
          type: "POST",
          url: "{{ route('subcategory.store') }}",
          dataType: "json",
          headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
          data : {
                  'category': category,
                  'sub_category_name': sub_category_name,
                },
          success: function(result){
            if(result.success){
              toastr.success(result.message);
              setTimeout(function(){window.location.href = window.location.origin+'/seller/subcategory'}, 1000);
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