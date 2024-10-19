@extends('layouts.app')
@section('content')
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">My Profile</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<a href="#" class="breadcrumb-item">My Profile</a>
					<span class="breadcrumb-item active">{{ Auth::user()->user_name }} profile</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->
	
	<div class="content">
		<div class="row" >
			<div class="col-md-4">
				<!-- Navigation -->
				<div class="card" id="info">
					<div class="card-body bg-indigo-400 text-center card-img-top" style="background-image: url(public/backend/global_assets/images/backgrounds/panel_bg.png); background-size: contain;">
						<div class="card-img-actions d-inline-block mb-3">
							<img class="img-fluid rounded-circle" src="{{ asset(Auth::user()->image) }}" width="170" height="170" alt="">
						</div>

			    		<h6 class="font-weight-semibold mb-0" id="user_name_show">{{ Auth::user()->user_name }}</h6>
			    		<span class="d-block opacity-75">{{ Auth::user()->designation }}</span>
			    	</div>

					<div class="card-body p-0">
						<ul class="nav nav-sidebar mb-2">
							<li class="nav-item-header"><h5>User Details</h5></li>
							<li class="nav-item">
								<a href="#" class="nav-link active" data-toggle="tab">
									<i class="icon-user"></i>
									 Full Name
									 <span id="full_name_show" class="font-size-sm font-weight-normal ml-auto full_name">{{ Auth::user()->full_name }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#schedule" class="nav-link" data-toggle="tab">
									<i class="icon-calendar3"></i>
									Join
									<span class="font-size-sm font-weight-normal ml-auto">{{ Auth::user()->created_at->format('d M, Y') }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#inbox" class="nav-link" data-toggle="tab">
									<i class="icon-mobile"></i>
									Contact No.
									<span class="font-size-sm font-weight-normal ml-auto" id="mobile_show">{{ Auth::user()->mobile }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#orders" class="nav-link" data-toggle="tab">
									<i class="icon-envelop2"></i>
									Email
									<span class="font-size-sm font-weight-normal ml-auto">{{ Auth::user()->email }}</span>
								</a>
							</li>
							<li class="nav-item">
								<a href="#orders" class="nav-link" data-toggle="tab">
									<i class="icon-map"></i>
									Address
									<span class="font-size-sm font-weight-normal ml-auto"> <span id="address_show">{{ Auth::user()->address }}</span> <span id="state_show" >{{ Auth::user()->state }}</span> <span id="city_show">{{ Auth::user()->city }}</span>-<span id="zip_show">{{ Auth::user()->zip }}</span> <span id="country_show">{{ Auth::user()->country }}</span></span>
								</a>
							</li>
							<li class="nav-item-divider"></li>
							<li class="nav-item">
								<a href="{{ route('logout') }}" class="nav-link" data-toggle="tab" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
									<i class="icon-switch2"></i>
									Logout
								</a>
							</li>
						</ul>
					</div>
				</div>
				<!-- /navigation -->
			</div>
			<div class="col-md-8">
				<!-- Profile info -->
				<div class="card">
					<div class="card-header header-elements-inline">
						<h5 class="card-title">Profile information</h5>
						<div class="header-elements">
							<div class="list-icons">
			            		<a class="list-icons-item" data-action="collapse"></a>
			            		<a class="list-icons-item" data-action="reload"></a>
			            		<a class="list-icons-item" data-action="remove"></a>
			            	</div>
			        	</div>
					</div>

					<div class="card-body">
						<form action="{{ route('update.user.info',Auth::user()->id) }}" method="POST" enctype="multipart/form-data" id="editForm">
							@csrf
							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>Username</label>
										<input type="text" readonly="" name="user_name" value="{{ Auth::user()->user_name }}" class="form-control" id="user_name">
									</div>
									<div class="col-md-6">
										<label>Full name</label>
										<input type="text" name="full_name" value="{{ Auth::user()->full_name }}" class="form-control" id="full_name">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>Address line 1</label>
										<input type="text" name="address" value="{{ Auth::user()->address }}" class="form-control" id="address">
									</div>
									<div class="col-md-6">
										<label>Address line 2</label>
										<input type="text" name="address_two" value="{{ Auth::user()->address_two }}" class="form-control" id="address_two">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<label>City</label>
										<input type="text" name="city" value="{{ Auth::user()->city }}" class="form-control" id="city">
									</div>
									<div class="col-md-4">
										<label>State/Province</label>
										<input type="text" name="state" value="{{ Auth::user()->state }}" class="form-control" id="state">
									</div>
									<div class="col-md-4">
										<label>ZIP code</label>
										<input type="text" name="zip" value="{{ Auth::user()->zip }}" class="form-control" id="zip">
									</div>
								</div>
							</div>

							<div class="form-group">
								<div class="row">
									<div class="col-md-6">
										<label>Email</label>
										<input type="text" name="email" readonly="readonly" value="{{ Auth::user()->email }}" class="form-control">
									</div>
									<div class="col-md-6">
										<label>Country</label>
										<input type="text" id="country" name="country" value="{{ Auth::user()->country }}" class="form-control">
									</div>
								</div>
							</div>

			                <div class="form-group">
			                	<div class="row">
			                		<div class="col-md-6">
										<label>Phone #</label>
										<input type="number" name="mobile" value="{{ Auth::user()->mobile }}" class="form-control" id="mobile">
										<span class="form-text text-muted">+99-99-9999-9999</span>
			                		</div>

									<div class="col-md-6">
										<label>Upload profile image</label>
			                            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.gif" class="form-input">
			                            <span class="form-text text-muted">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
									</div>
			                	</div>
			                </div>

			                <div class="text-right">
			                	<button type="submit" class="btn btn-primary">Save changes</button>
			                </div>
						</form>
					</div>
				</div>
				<!-- /profile info -->
			</div>
		</div>
	</div>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> --}}
	<script type="text/javascript">
	      $('#editForm').on('submit', function(e) {
	          e.preventDefault();
	          $('.loading').removeClass('d-none');
	          var url = $(this).attr('action');
	          var request = $(this).serialize();
	          $.ajax({
	              url: url,
	              type: 'post',
	              data: new FormData(this),
	              contentType: false,
	              cache: false,
	              processData: false,
	          success:function(data){  
	            toastr.success(data);
	            $('#image').val('');
	            $("#info").load(location.href+" #info>*",""); 
	          }
	        });
	      });

	      $('#full_name').keyup(function(){
	      	$('#full_name_show').text($(this).val());
	      });

	      $('#user_name').keyup(function(){
	      	$('#user_name_show').text($(this).val());
	      });

	      $('#address').keyup(function(){
	      	$('#address_show').text($(this).val());
	      });

	      $('#mobile').keyup(function(){
	      	$('#mobile_show').text($(this).val());
	      });

	      $('#city').keyup(function(){
	      	$('#city_show').text($(this).val());
	      });

	      $('#zip').keyup(function(){
	      	$('#zip_show').text($(this).val());
	      });

	      $('#state').keyup(function(){
	      	$('#state_show').text($(this).val());
	      });

	      $('#country').keyup(function(){
	      	$('#country_show').text($(this).val());
	      });
	    </script>
	

@endsection