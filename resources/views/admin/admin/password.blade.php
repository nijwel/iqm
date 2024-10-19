@extends('layouts.app')
@section('content')
	<!-- Page header -->
	<div class="page-header page-header-light">
		<div class="page-header-content header-elements-md-inline">
			<div class="page-title d-flex">
				<h4><i class="icon-arrow-left52 mr-2"></i> <span class="font-weight-semibold">Change Password</h4>
				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>

		<div class="breadcrumb-line breadcrumb-line-light header-elements-md-inline">
			<div class="d-flex">
				<div class="breadcrumb">
					<a href="index.html" class="breadcrumb-item"><i class="icon-home2 mr-2"></i> Home</a>
					<span class="breadcrumb-item active">Change Password</span>
				</div>

				<a href="#" class="header-elements-toggle text-default d-md-none"><i class="icon-more"></i></a>
			</div>
		</div>
	</div>
	<!-- /page header -->
	<div class="container">
		<div class="col-md-12" style="height: 400px;">
			<!-- Profile info -->
			<div class="card">
				<div class="card-header header-elements-inline">
					<h5 class="card-title">Change Password</h5>
					<div class="header-elements">
						<div class="list-icons">
		            		<a class="list-icons-item" data-action="collapse"></a>
		            		<a class="list-icons-item" data-action="reload"></a>
		            		<a class="list-icons-item" data-action="remove"></a>
		            	</div>
		        	</div>
				</div>

				<div class="card-body">
					<form action="{{ route('update.password') }}" method="POST"  id="editForm">
						@csrf
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<label>Old Password <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="password" required="" name="old_password" class="form-control" placeholder="Old Password" id="OldPasswordInputID">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" onclick="oldPass()">
												<i id="oldEyeChangeId" class="icon-eye-blocked"></i>
											</button>
										</span>
										<small class="text-danger error"></small>
									</div>
								</div>
								<div class="col-md-4">
									<label>New Password <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="password" required="" name="new_password" class="form-control" placeholder="New Password" id="NewPasswordInputID">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" onclick="newPass()">
												<i id="newEyeChangeId" class="icon-eye-blocked"></i></button>
										</span>
									</div>
								</div>
								<div class="col-md-4">
									<label>Confirm Password <span class="text-danger">*</span></label>
									<div class="input-group">
										<input type="password" required="" name="confirm_password" class="form-control" placeholder="Confirm Password" id="ConPasswordInputID">
										<span class="input-group-append">
											<button class="btn btn-light" type="button" onclick="conPass()">
												<i id="conEyeChangeId" class="icon-eye-blocked"></i></button>
										</span>
									</div>
								</div>
							</div>
						</div>
		                <div class="text-right">
		                	<button type="submit" class="btn btn-primary"><i class="icon-spinner2 spinner d-none"></i> Save changes</button>
		                </div>
					</form>
				</div>
			</div>
			<!-- /profile info -->
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script>
		$('#editForm').submit(function(e){
		  e.preventDefault();
		  var url = $(this).attr('action');
		  var request =$(this).serialize();
		  $.ajax({
		    url:url,
		    type:'post',
		    async:false,
		    data:request,
		    success:function(data){  
		    	if (data.success) {
		    		 toastr.success(data.success);
		    		 window.location.href = "{{ route('login')}}";
		    	}else{
		    		toastr.error(data.error);
		    		$('#editForm')[0].reset();
		    		$("#editForm").load(location.href+" #editForm>*","");
		    	}
		    }
		  });
		});
	</script>
	<script type="text/javascript">
	//Javascript function definition
	function oldPass() 
	{
		//getting type of the password field element by jQuery
		var x = $('#OldPasswordInputID').prop("type"); 
		if (x === "password") 
		{
			//changing input type text
			$('#OldPasswordInputID').prop("type", "text");
			//removing fa-eye class
			$('#oldEyeChangeId').removeClass('icon-eye-blocked'); 
			//adding fa-eye-slash class
			$('#oldEyeChangeId').addClass('icon-eye'); 
		} 
		else 
		{
			//changing type passord
			$('#OldPasswordInputID').prop("type", "password");
			//removinf fa-eye-slash class
			$('#oldEyeChangeId').removeClass('icon-eye'); 
			//adding fa-eye class
			$('#oldEyeChangeId').addClass('icon-eye-blocked'); 
		}
	}

	function newPass() 
	{
		//getting type of the password field element by jQuery
		var x = $('#NewPasswordInputID').prop("type"); 
		if (x === "password") 
		{
			//changing input type text
			$('#NewPasswordInputID').prop("type", "text");
			//removing fa-eye class
			$('#newEyeChangeId').removeClass('icon-eye-blocked'); 
			//adding fa-eye-slash class
			$('#newEyeChangeId').addClass('icon-eye'); 
		} 
		else 
		{
			//changing type passord
			$('#NewPasswordInputID').prop("type", "password");
			//removinf fa-eye-slash class
			$('#newEyeChangeId').removeClass('icon-eye'); 
			//adding fa-eye class
			$('#newEyeChangeId').addClass('icon-eye-blocked'); 
		}
	}

	function conPass() 
	{
		//getting type of the password field element by jQuery
		var x = $('#ConPasswordInputID').prop("type"); 
		if (x === "password") 
		{
			//changing input type text
			$('#ConPasswordInputID').prop("type", "text");
			//removing fa-eye class
			$('#conEyeChangeId').removeClass('icon-eye-blocked'); 
			//adding fa-eye-slash class
			$('#conEyeChangeId').addClass('icon-eye'); 
		} 
		else 
		{
			//changing type passord
			$('#ConPasswordInputID').prop("type", "password");
			//removinf fa-eye-slash class
			$('#conEyeChangeId').removeClass('icon-eye'); 
			//adding fa-eye class
			$('#conEyeChangeId').addClass('icon-eye-blocked'); 
		}
	}


	// Add form spinner load
	   $(document).ready(function(){
	     $('#editForm').on('submit', function(e){   //when form submit
	          $('.icon-spinner2').removeClass('d-none');   //remove the spinner class   
	     });
	   });
</script>
@endsection