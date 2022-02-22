<!DOCTYPE html>
<html>
<head>
	<title>Reset Password</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="icon" type="text/css" href="../images/icon2.png">
	<style type="text/css">
		#showpass_text, #showpass_text2 {
			cursor: pointer;
		}
		#message {
			display:none;
			background: #f1f1f1;
			color: #000;
			position: relative;
			padding: 6px;
			margin-top: 10px;
		}

		#message p {
			padding: 10px 35px;
			font-size: 14px;
		}

			/* Add a green text color and a checkmark when the requirements are right */
		.valid {
			color: green;
		}

		.valid:before {
			position: relative;
			left: -35px;
			content: "";
		}

			/* Add a red text color and an "x" when the requirements are wrong */
		.invalid {
			color: red;
		}

		.invalid:before {
			position: relative;
			left: -35px;
			content: "✖";
		}
		/*end of password */
  	</style>
  	<?php 
  		$token = $email = "";
  		if(isset($_GET['token']) && isset($_GET['email'])){
	  		$token = $_GET['token'];
	  		$email = $_GET['email'];
	  	}
  	?>
</head>
<body class="hold-transition login-page">
	<div class="login-box">
  		<div class="card card-outline card-primary">
    		<div class="card-header text-center">
      			<a href="../" class="h4"><b><img src="../images/logo.png" class="img-fluid" alt="logo" width="140"></b></a>
    		</div>
    		<div class="card-body">
      			<p class="login-box-msg">Recover your Password</p>

      			<form  method="post" id="passwordForm">
			        <div class="input-group mb-3">
			          	<input type="password" class="form-control" name="new_password" id="new_password" required autocomplete="off" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
			          	<div class="input-group-append">
				            <div class="input-group-text" id="showpass_text"  onclick="passReveal()">
				              	<span class="fas fa-eye"></span>
				            </div>
			          	</div>
			        </div>
			        <div class="input-group mb-3">
			        	<input type="hidden" name="token" id="token" value="<?php echo $token?>">
						<input type="hidden" name="email" id="email" value="<?php echo $email?>">
			          	<input type="password" class="form-control" name="new_password_2" id="new_password_2" onkeyup="comparePass(this.value)" placeholder="Password" required autocomplete="off"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
			          	<div class="input-group-append">
			            	<div class="input-group-text" id="showpass_text2"  onclick="passReveal2()">
			              		<span class="fas fa-eye"></span>
			            	</div>
			          	</div>
			        </div>
		        	<div class="row">
		          		<div class="col-12">
		            		<button type="submit" class="btn btn-primary" id="submitBtn">Reset Password</button>
		          		</div>
		        	</div>
      			</form>
      			<div id="message" class="mt-4">
					<p>Password must contain the following:</p>
					<p id="letter" class="invalid">A <b>lowercase</b> letter</p>
					<p id="capital" class="invalid">A <b>capital (uppercase)</b> letter</p>
					<p id="number" class="invalid">A <b>number</b></p>
					<p id="length" class="invalid">Minimum <b>8 characters</b></p>
				</div>

		      	<div class="social-auth-links text-center mt-2 mb-3">
		        
		      	</div>

		      	<p class="mb-1">
		        	<a href="https://login.osabox.co">I Know my password</a>
		      	</p>
     
    		</div>
    <!-- /.card-body -->
  		</div>
  <!-- /.card -->
	</div>
<!-- /.login-box -->

<!-- jQuery -->
	<script src="plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap 4 -->
	<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- AdminLTE App -->
	<script src="dist/js/adminlte.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		var myInput = document.getElementById("new_password");
		var letter = document.getElementById("letter");
		var capital = document.getElementById("capital");
		var number = document.getElementById("number");
		var length = document.getElementById("length");

		// When the user clicks on the password field, show the message box
		myInput.onfocus = function() {
		  document.getElementById("message").style.display = "block";
		}

		// When the user clicks outside of the password field, hide the message box
		myInput.onblur = function() {
		  document.getElementById("message").style.display = "none";
		}

		// When the user starts to type something inside the password field
		myInput.onkeyup = function() {
		  // Validate lowercase letters
		  var lowerCaseLetters = /[a-z]/g;
		  if(myInput.value.match(lowerCaseLetters)) {  
		    letter.classList.remove("invalid");
		    letter.classList.add("valid");
		  } else {
		    letter.classList.remove("valid");
		    letter.classList.add("invalid");
		  }
		  
		  // Validate capital letters
		  var upperCaseLetters = /[A-Z]/g;
		  if(myInput.value.match(upperCaseLetters)) {  
		    capital.classList.remove("invalid");
		    capital.classList.add("valid");
		  } else {
		    capital.classList.remove("valid");
		    capital.classList.add("invalid");
		  }

		  // Validate numbers
		  var numbers = /[0-9]/g;
		  if(myInput.value.match(numbers)) {  
		    number.classList.remove("invalid");
		    number.classList.add("valid");
		  } else {
		    number.classList.remove("valid");
		    number.classList.add("invalid");
		  }
		  
		  // Validate length
		  if(myInput.value.length >= 8) {
		    length.classList.remove("invalid");
		    length.classList.add("valid");

		  } else {
		    length.classList.remove("valid");
		    length.classList.add("invalid");
		  }
		}

	    

	    function loginsuccessNow(msg){
	          toastr.warning(msg);
	          toastr.options.progressBar = false;
	          toastr.options.positionClass = "toast-top-right";
	    }
	    var showpass = document.getElementById('showpass_text');
	    var showpass2 = document.getElementById('showpass_text2');

	    function passReveal(){
	      var password = document.getElementById('new_password');
	      	        if(password.type == 'password') {
	            password.type = 'text';
	            showpass.innerHTML = '<i class="fas fa-eye-slash"></i>';
	        }else {
	            password.type = 'password';
	            showpass.innerHTML = '<i class="fas fa-eye"></i>';
	        }
	    }
	    function passReveal2(){
	    var password_2 = document.getElementById('new_password_2');

	        if(password_2.type == 'password') {
	            password_2.type = 'text';
	            showpass2.innerHTML = '<i class="fas fa-eye-slash"></i>';
	        }else {
	            password_2.type = 'password';
	            showpass2.innerHTML = '<i class="fas fa-eye"></i>';
	        }
	    }

	    // ========= ALERTS ============
	    function successNow(msg){
	      	toastr.success(msg);
	          toastr.options.progressBar = true;
	          toastr.options.positionClass = "toast-top-center";
	          toastr.options.showDuration = 1000;
	      }

	    function errorNow(msg){
	    	toastr.error(msg);
	        toastr.options.progressBar = true;
	        toastr.options.positionClass = "toast-top-center";
	        toastr.options.showDuration = 1000;
	    }

	    function comparePass(repeat_password){
			var new_password = document.getElementById('new_password').value;
			if (repeat_password != new_password) {
				document.getElementById("message").style.display = "block";
				$('#message').html("Passwords not matching").addClass("text-danger");
			}else if(repeat_password == new_password){
				document.getElementById("message").style.display = "none";
				$('#message').html("");
			}
		}

		$("#passwordForm").submit(function(event){
			event.preventDefault();
			$.ajax({
				url:"includes/newpasswordSubmit",
				method:"post",
				data:$(this).serialize(),
				beforeSend:function(){
				    $("#submitBtn").html('Please wait...');
				},
				
				success:function(data){
				    successNow(data);
				    setTimeout(function(){
				    	window.location = "https://login.osabox.co";
				    }, 1500);
				    
				}
			})
		})
  	</script>
</body>
</html>