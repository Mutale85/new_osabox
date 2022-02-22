<?php
	include("../includes/db.php");

	  if (isset($_COOKIE['userLoggedin']) && isset($_SESSION['email'])) {?>
	    <script>
	      window.location = './'
	    </script>
	  <?php 
	  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Osabox - Forgot Password</title>

	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="icon" type="text/css" href="../images/icon2.png">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      	<a href="../" class="h4"><b><img src="../images/logo.png" class="img-fluid" alt="logo" width="140"></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>
      	<form method="post" id="recoverForm">
	        <div class="input-group mb-3">
	          <input type="email" name="email" id="email" class="form-control" placeholder="Email">
	          <div class="input-group-append">
	            <div class="input-group-text">
	              <span class="fas fa-envelope"></span>
	            </div>
	          </div>
        	</div>
        	<div class="row">
          		<div class="col-12">
            		<button type="submit" class="btn btn-primary btn-block" id="btn">Request new password</button>
          		</div>
        	</div>
      	</form>
      	<p class="mt-3 mb-1">
        	<a href="login">Login</a>
      	</p>
    </div>
  </div>
</div>

<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script src="plugins/toastr/toastr.min.js"></script>
<script>
    var btn = document.getElementById('btn');
    var recoverForm = document.getElementById('recoverForm');
    var email = document.getElementById('email');    
    var url = '../processing/recover-password';
    var xhr = new XMLHttpRequest();
    
    recoverForm.addEventListener('submit', (event) => {
      event.preventDefault();
      if(email.value == ""){
        alert("email is required");
        email.focus();
        return false;
      }
      
      
      var data = new FormData(recoverForm);
      xhr.open('POST', url, true);
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200) {
          r = xhr.responseText;
          if(r === 'done'){
            loginsuccessNow("Redirecting You in 2 Seconds");
            setTimeout(function(){
              window.location = 'login';
            }, 1500); 
          }else{
            errorNow(r);
            setTimeout(function(){
              window.location = 'login';
            }, 1500);
          }
          btn.innerHTML = 'Request new password';
        }else{

        }
      }
      btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
      xhr.send(data);
    })

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
  </script>


</body>
</html>