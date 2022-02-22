<?php 
  include("../includes/db.php");

  if (isset($_COOKIE['userLoggedin']) && isset($_SESSION['email'])) {?>
    <script>
      window.location = '../home'
    </script>
  <?php 
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Osabox Loan and Personel - Project Management System</title>
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
  <link rel="icon" type="text/css" href="../images/icon2.png">
  <style type="text/css">
    #showpass_text {
      cursor: pointer;
    }
  </style>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../" class="h4"><b><img src="../images/logo.png" class="img-fluid" alt="logo" width="140"></b></a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form  method="post" id="loginForm">
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
          <input type="hidden" name="login" id="login" value="login">
          <div class="input-group-append">
            <div class="input-group-text" id="showpass_text"  onclick="passReveal()">
              <span class="fas fa-eye"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember" name="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block" id="loginAdmin">Sign In</button>
          </div>
        </div>
      </form>

      <div class="social-auth-links text-center mt-2 mb-3">
        
      </div>

      <p class="mb-1">
        <a href="forgot-password">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="../register" class="text-center">Register a new membership</a>
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
    var sign_in = document.getElementById('loginAdmin');
    var LoginFormNow = document.getElementById('loginForm');
    var email = document.getElementById('email');
    var password = document.getElementById('password');
    
    var url = '../processing/loginAdmin';
    var xhr = new XMLHttpRequest();
    
    LoginFormNow.addEventListener('submit', (event) => {
      event.preventDefault();
      if(email.value == ""){
        alert("email is required");
        email.focus();
        return false;
      }
      if(password.value == ""){
        alert("password is required");
        password.focus();
        return false;
      }
      
      var data = new FormData(LoginFormNow);
      xhr.open('POST', url, true);
      xhr.onreadystatechange = function(){
        if(xhr.readyState == 4 && xhr.status == 200) {
          r = xhr.responseText;
          if(r === 'done'){
            loginsuccessNow("Redirecting You in 2 Seconds");
            setTimeout(function(){
              window.location = 'home';
            }, 2000);
          
          }else if (r === 'incorrect_password') {
            errorNow('Invalid login in credentials');
            sign_in.innerHTML = 'Sign In';
            // $('#LoginFormNow')[0].reset();
            return;
          }else if(r === 'activate'){
                      
          }else{
            errorNow(r);
            setTimeout(function(){
              window.location = 'login';
            }, 3000);
          }
          sign_in.innerHTML = 'Sign In';
        }else{

        }
      }
      sign_in.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
      xhr.send(data);
    })

    function loginsuccessNow(msg){
          toastr.warning(msg);
          toastr.options.progressBar = false;
          toastr.options.positionClass = "toast-top-right";
      }
    var showpass = document.getElementById('showpass_text');
    var password = document.getElementById('password');
    function passReveal(){
      var password = document.getElementById('password');
        if(password.type == 'password') {
            password.type = 'text';
            showpass.innerHTML = '<i class="fas fa-eye-slash"></i>';
        }else {
            password.type = 'password';
            showpass.innerHTML = '<i class="fas fa-eye"></i>';
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
  </script>

</body>
</html>
