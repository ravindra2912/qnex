@extends('front.layouts.index')

@section('seo')
	
	@php
			$description = 'Bajarang';
			$keywords = 'Bajarang';
		@endphp

		<title>Bajarang | CheckOut</title>
	    
	
@endsection

@section('custom_css')  
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<style>
		.divider{
			border-bottom: 2px solid #9A9A9A;
		}
		.p-img{
			height: 50px;
			width: auto;
			object-fit: contain;
		}
		
		.address{
			border: 2px solid #9A9A9A;
			border-radius: 10px;
			padding: 8px 10px;
			position:relative;
		}
		
		.address:hover, input[name="selectaddress"]:checked+label .address{
			border: 2px solid var(--primary);
			box-shadow: 0 .1rem 0.5rem var(--primary)!important;
		}
		 
		input[name="selectaddress"]{
			opacity: 0;
			//position: absolute;
			//top: 324px;
		}
		
		
		.coupon-btn{
			border-bottom-left-radius: 0;
			border-top-left-radius: 0;
		}
		
		
		
	</style>

@endsection

@section('content')

	<section id="nevigation-header">
		<h3>CheckOut</h3>
		<p>Home <i class="fa-solid fa-angle-right"></i> Cart <i class="fa-solid fa-angle-right"></i>CheckOut</p>
	</section>
  
	<section id="about" class="mt-5 mb-5 pb-5">
		<div class="container">
			
            <div class="row">
				<div class="col-sm-7">
					<div class="row">
						<div class="col-lg-12 col-sm-12">
							<div class="d-flex justify-content-between align-items-center mb-3">
								<h5 class="mt-2 font-weight-bold">Shipping Address</h5>
								<!-- button type="button" class="btn btn-primary btn-sm" style="height: max-content;" title="Add New Address" data-toggle="modal" data-target="#addaddressmodal"><i class="fa-solid fa-plus"></i></button -->
							</div>
							<div class="row" id="addresses">
								@foreach($Address as $val)
									<input type="radio" name="selectaddress"  value="{{ $val->id }}" id="{{ $val->id }}" onchange="$('#orderaddress').val(this.value); get_summary();" />
									<label class="col-lg-12 col-sm-12 col-12" for="{{ $val->id }}">
										<div class="address" >
											<button class="btn btn-primary deleteBtn" data-id="{{ $val->id }}" data-action="{{ route('address.remove_address') }}" title="Delete Address" style="position: absolute; right: 10px;"><i class="fas fa-trash-alt"></i></button>
											<div class="row">
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> Name </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ $val->name }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> Email </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ (isset($val->user_data)&& !empty($val->user_data))? $val->user_data->email : '' }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> Address </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ $val->address }}, {{ $val->address2 }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> City </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ $val->city }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> State </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ $val->state }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> Phone </div>
												<div class="col-lg-10 col-sm-10 col-9"> +91 {{ $val->contact }} </div>
												
												<div class="col-lg-2 col-sm-2 col-3 font-weight-bold"> ZipCode </div>
												<div class="col-lg-10 col-sm-10 col-9"> {{ $val->zipcode }} </div>
											</div>
											
										</div>
									</label>
								@endforeach
								
								<div class="form-check col-lg-12 col-sm-12 col-12 ml-3">
									<input type="checkbox" class="form-check-input" id="ship_change" {{ (isset($Address) && count($Address) == 0 )? 'checked':'' }}>
									<label class="form-check-label"  for="ship_change">Ship to a different address?</label>
								</div>
								
							</div>
							
							<!-- new address Form-->
							<form action="{{ route('address.add_update') }}" id="addAddress" style="{{ (isset($Address) && count($Address) > 0)? 'display:none;':'' }}" class="row">{{ csrf_field() }}
						
								<div class="form-group col-lg-12 col-md-12 col-12 mt-4">
									<h5 class="mt-2 font-weight-bold">Your Billing Address</h5>
								</div>
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="name" class="form-control" placeholder="Your Name *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="number" name="contact" class="form-control" placeholder="Your Contact Number *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="Address" class="form-control" placeholder="Your address *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="address2" class="form-control" placeholder="Your address 2 *"> 
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="country" class="form-control" placeholder="Your Country *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="state" class="form-control" placeholder="Your State *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="city" class="form-control" placeholder="Your City *">
								</div>
								
								<div class="form-group col-lg-12 col-md-12 col-12">
									<input type="text" name="zipcode" class="form-control" placeholder="Your ZipCode *">
								</div>
								
								<div class="form-check col-lg-12 col-md-12 col-12 text-right">
									<button type="submit" class="btn btn-primary btn-round mt-3 ml-2 pr-4 pl-4 submit_button">Add</button>
									<button type="button" class="btn btn-primary btn-round mt-3 ml-2 pr-4 pl-4 submit_button loading" style="display:none;">Loading ...</button>
								</div>
							</form>
						</div>
						
					</div>
				</div>
				<div class="col-sm-5">
					<form id="placeorder" action="{{ route('order.place_order') }}">
						<input type="hidden" name="address" id="orderaddress" />
							
							<div class="checkout pt-0" id="summary">
								
							</div>
						
					</form>
				</div>
            </div>
        
		</div>
	</section>
	
	<!--div class="modal fade" id="addaddressmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-md" role="document">
			<div class="modal-content">
				
				<div class="modal-body">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<p class="h4 mb-3 font-weight-bold">Add New Address</p>
					<form action="{{ route('address.add_update') }}" id="addAddress" class="row">{{ csrf_field() }}
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="name" class="form-control" placeholder="Your Name *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="number" name="contact" class="form-control" placeholder="Your Contact Number *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="Address" class="form-control" placeholder="Your address *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="address2" class="form-control" placeholder="Your address 2 *"> 
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="country" class="form-control" placeholder="Your Country *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="state" class="form-control" placeholder="Your State *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="city" class="form-control" placeholder="Your City *">
						</div>
						
						<div class="form-group col-lg-12 col-md-12 col-12">
							<input type="text" name="zipcode" class="form-control" placeholder="Your ZipCode *">
						</div>
						
						
						
						<div class="form-check col-lg-12 col-md-12 col-12 text-right">
							<button type="submit" class="btn btn-primary btn-round mt-3 ml-2 pr-4 pl-4 submit_button">Add</button>
							<button type="button" class="btn btn-primary btn-round mt-3 ml-2 pr-4 pl-4 submit_button loading" style="display:none;">Loading ...</button>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div>
		</div>
	</div -->
	
@endsection

@section('custom_js')  
<script>	
	
	$("document").ready(function(){
		
		$('#ship_change').on('change', function(){
			if(this.checked){
				$('#addAddress').show();
			}else{
				$('#addAddress').hide();
			}
			
		})
		
		$("#addAddress").on('submit',(function(e) {
		  e.preventDefault();
			var form = this;
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
					$('.submit_button').hide();
					$('.loading').show();
				},
				success: function(result){
					//console.log(data);
					
					if(result.success){
					  toastr.success(result.message);
					  location.reload();
					}
					else{
						if(result.auth == false){
							location.reload();
						}else{
							toastr.error(result.message);
						}
					}
					$('.submit_button').show();
					$('.loading').hide();
				},
				error: function(e){ 
					console.log(e);
					var e = eval("(" + e.responseText + ")");
					if(e.message == "CSRF token mismatch."){ 
						toastr.error('Your session has expired');
						location.reload(); 
						setTimeout(function() { location.reload(); }, 3000);
					}else{
						toastr.error('Something Wrong');
					}

					$('.submit_button').show();
					$('.loading').hide();
				}           
			});
		}));
		
		$("#placeorder").on('submit',(function(e) {
		  e.preventDefault();
			var form = this;
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
					$('.submit_button').hide();
					$('.loading').show();
				},
				success: function(result){
					//console.log(result);
					
					if(result.success){
					  toastr.success(result.message);
					  window.location.href = result.redirect;
					  //location.reload();
					}
					else{
						if(result.auth == false){
							location.reload();
						}else{
							toastr.error(result.message);
						}
					}
					$('.submit_button').show();
					$('.loading').hide();
				},
				error: function(e){ 
					console.log(e);
					var e = eval("(" + e.responseText + ")");
					if(e.message == "CSRF token mismatch."){ 
						toastr.error('Your session has expired');
						location.reload(); 
						setTimeout(function() { location.reload(); }, 3000);
					}else{
						toastr.error('Something Wrong');
					}

					$('.submit_button').show();
					$('.loading').hide();
				}           
			});
		}));
		
		$(".deleteBtn").click(function(){
			var address_id = $(this).data('id');
			var action = $(this).data('action');
		  Swal.fire({
			title: 'Are you sure?',
			icon: 'error',
			html: "You want to delete this Address?",
			allowOutsideClick: false,
			showCancelButton: true,
			confirmButtonText: 'Delete',
			cancelButtonText: 'Cancel',
		  })
		  .then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					url: action,
					type: "POST",
					data:  {
						'address_id':address_id,
					},
					dataType: "json",
					headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
					beforeSend : function(){ 
					},
					success: function(result){
						//console.log(data);
						
						if(result.success){
						  toastr.success(result.message);
						  setTimeout(function() { location.reload(); }, 2000);
						}
						else{
							if(!result.auth){
								location.reload();
							}else{
								toastr.error(result.message);
							}
							
						}
						$('.submit_button').show();
						$('.loading').hide();
					},
					error: function(e){ 
						console.log(e);
						var e = eval("(" + e.responseText + ")");
						if(e.message == "CSRF token mismatch."){ 
							toastr.error('Your session has expired');
							setTimeout(function() { location.reload(); }, 2000);
						}else{
							toastr.error('Something Wrong');
						}
					}           
				});
			}
		  })
		});
	});
	
	function get_summary(){
		$.ajax({
			url: "{{ route('ckeckout.render_summary') }}",
			type: "POST",
			data:  {
				"address":($('input[name="address"]').val() != 'undefined')?$('input[name="address"]').val():'',
				"coupan_code":($('#coupan_code').val() != 'undefined' )? $('#coupan_code').val() :'',
			},
			dataType: "json",
			headers: { 'X-CSRF-TOKEN': "{{ csrf_token() }}" },
			beforeSend : function(){ 
				
			},
			success: function(result){
				//console.log(data);
				
				if(result.success){
					$('#summary').html(result.data);
				}else{
					toastr.error(result.message);
				}
			},
			error: function(e){ 
				console.log(e);
				var e = eval("(" + e.responseText + ")");
				if(e.message == "CSRF token mismatch."){ 
					toastr.error('Your session has expired');
					location.reload(); 
					setTimeout(function() { location.reload(); }, 3000);
				}else{
					toastr.error('Something Wrong');
				}
			}           
		});
	}
	get_summary();
</script>	

@endsection

