<!DOCTYPE html>
<html lang="en">
<?php include('supports/header.php');
$msg = "";
if (isset($_POST['email'])) {
	$email  		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$password  		= filter_var($_POST['password'], FILTER_SANITIZE_STRING);
	$user_ip 		= getUserIpAddr();
	$query = $connect->prepare("SELECT * FROM members_list WHERE email = ? ");
	$query->execute(array($email));
	$count = $query->rowCount();
	$result = $query->fetchAll();
	if ($count > 0){
		foreach ($result as $row) {
			$active = $row['activate'];
			if ($active == '1') {
			    
		        if (password_verify($password, $row['password'])){
				    $_SESSION['email'] 		= $row['email'];
				    $_SESSION['user_id'] 	= $row['id'];
				    $_SESSION['parent_id'] 	= $row['parent_id'];
				    $_SESSION['admin_role'] = $row['admin_role'];
				    $_SESSION['username'] 	= $row['username'];
				    $_SESSION['password'] 	= $row['password'];
				    $_SESSION['plan']		= $row['plan'];
				    $_SESSION['sites']		= $row['allowed_sites'];
				    $sql = $connect->prepare("UPDATE members_list SET user_ip = ?, last_login = NOW() WHERE email = ? ");
				    $sql->execute(array($user_ip, $row['email']));
				    setcookie("parentID", $row['parent_id'], time()+60*60*24*30, '/');
					$msg =  "Login you in successful - Please Wait as we redirect you";
                	header('location:home');
		        }else{
		            $msg =  "Incorrect Login Details";
				    exit(); 
		        }
			}else{
				$msg =  "Your account is not activated";
				exit();
				//send an email with activation link
			}			
		}
	}else{
		$msg =  "User Not Found";
    	exit();
	}
}else{
	$msg =  "";
}
?>
<title>Osabox - Loan, Payroll, Project and Todo list Management System </title>
<body>
	<?php include('supports/nav.php') ?>
	<section class="intro-section spad">
		<div class="container-md">
			<div class="row">
				<div class="col-sm-12 mb-5 mt-5">
					<h2 class="form-title text-center mb-4">Welcome Back</h2>
                	<div id="result"><?php echo $msg?></div>
				</div>
				<div class="col-md-6">
					<form method="post" id="LoginFormNow" autocomplete="off" action="" class="border p-4 shadow-lg pt-5">
						<div class="form-grou mb-3">
							<label class="mb-3" for="floatingInput">Email address</label>
							<input type="email" name="email" id="email" class="form-control" id="floatingInput" placeholder="name@example.com">
							
							<span id="em_error"></span> 
						</div>
						<div class="form-grou mb-4">
							<label class="mb-3" for="floatingPassword">Password</label>
							<div class="input-group">
								<input type="password" name="password" id="password" class="form-control" id="floatingPassword" placeholder="Password">
								<span class="input-group-text" id="showpass_text" onclick="passReveal()"><i class="bi bi-eye"></i></span>
							</div>
							<span id="pass_msg"></span> 
						</div>
			       		
			          	<button type="submit" name="submit" id="loginBtn" class=" btn btn-primary loginBtn mb-5">Sign In</button>
			          	<div class="d-flex justify-content-between mt-4">
				       		<p><a href="forgotpassword" title="forgotpassword" class="forgotpassword text-danger">Forgot Password?</a></p> 
				       		<p><a href="register" title="registerLink" class="registerLink">New Here ? Sign Up</a></p>
				       </div>
			       	</form>
			       	
				</div>
				<div class="col-md-6">
					<img src="images/undraw_Dashboard_re_3b76.svg" class="img-fluid">
				</div>
				
			</div>
		</div>
	</section>
	<?php include('supports/footer.php') ?>
	<script>
		var sign_in = document.getElementById('loginBtn');
		var LoginFormNow = document.getElementById('LoginFormNow');
		var email = document.getElementById('email');
		var password = document.getElementById('password');
		
		var url = 'processing/loginAdmin';
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
							window.location = 'app/';
						}, 2000);
					
					}else if (r === 'incorrect_password') {
						errorNow('Invalid login in credentials');
						sign_in.innerHTML = 'Sign In';
						// $('#LoginFormNow')[0].reset();
						return;
					}else if(r === 'activate'){
                    	
                    }else{
                    	errorNow(r);
                    }
					sign_in.innerHTML = 'Sign In';
				}else{

				}
			}
			sign_in.innerHTML = 'Processing...';
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
		        showpass.innerHTML = '<i class="bi bi-eye-slash"></i>';
		    }else {
		        password.type = 'password';
		        showpass.innerHTML = '<i class="bi bi-eye"></i>';
		    }
		}
	</script>
</body>
</html>