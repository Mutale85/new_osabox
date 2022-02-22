<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Kukula Micro-Finance Register Member</title>
	<link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
	<!-- icheck bootstrap -->
	<link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="dist/css/adminlte.min.css">
	<link rel="icon" type="text/css" href="../images/logo.png">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  	<div class="card card-outline card-primary">
    	<div class="card-header text-center">
      		<a href="../" class="h4"><b><img src="../images/logo.png" class="img-fluid" alt="logo" width="140"></b></a>
    	</div>
    	<div class="card-body">
      	<p class="login-box-msg">Register new admin</p>

      <form action="" method="post" id="membershipForm">
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="firstname" id="firstname" placeholder="Firstname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control" name="lastname" id="lastname" placeholder="Lastname" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control" name="email" id="email" placeholder="Email" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="retype_password" id="retype_password" placeholder="Retype password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          	<div class="col-8">
            	<div class="icheck-primary">
              		<input type="checkbox" id="agreeTerms" name="terms" value="agree">
	              	<label for="agreeTerms">
	               		I agree to the <a href="../terms">terms</a>
	              	</label>
            	</div>
          	</div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="submitMember">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <a href="login" class="text-center">I already an admin</a>
    </div>
    <!-- /.form-box -->
  	</div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<script type="text/javascript" src="../js/link.js"></script>
</body>
</html>
