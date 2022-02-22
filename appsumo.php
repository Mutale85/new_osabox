<!DOCTYPE html>
<html>
<?php
	include("supports/header.php");
	
	$plan = 'Appsumo';
	$price = '69.99';
	$allowed_branches = '30';
	$button = '<button id="submitBtn" type="submit" class="btn btn-outline-primary w-100 mt-4 mb-4">Redeem Code</button>';

?>
<title> Uptime Monitoring and Traffic Analytics - Sign Up  </title>
<style>
	.url-error {
		color:red;
	}
	.select-style {
	    width: 70px;
	    padding: 0;
	    margin: 0;
	    display: inline-block;
	    vertical-align: middle;
	    background: url("http://grumbletum.com/places/arrowdown.gif") no-repeat 100% 30%;
	}
	.select-style select {
	    width: 100%;
	    padding: 0;
	    margin: 0;
	    background-color: transparent;
	    background-image: none;
	    border: none;
	    box-shadow: none;
	    -webkit-appearance: none;
	       -moz-appearance: none; // FF have a bug
	            appearance: none;
	}
	.iti { width: 100%; }
	.intl-tel-input {
	  background-color: black;
	}
	.intl-tel-input .selected-flag {
	  	z-index: 4;
	  	background-color: black;
	}
	.iti__selected-dial-code {
		color: red;
	}
	.intl-tel-input .country-list {
	  	z-index: 5;
	  	background-color: black;
	}
	.input-group .intl-tel-input .form-control {
		border-top-left-radius: 4px;
		border-top-right-radius: 0;
		border-bottom-left-radius: 4px;
		border-bottom-right-radius: 0;
	}
	#showpass_text {
		cursor: pointer;
	}
</style>

<body>
	<?php include ("supports/nav.php"); ?>
	
	<div class="container mt-5 mb-5">
		<div class="row">
			<div class="col-md-6 mt-5 mb-4">
		   		<form method="post" class="ClientRegisterForm p-2" id="ClientRegisterForm" autocomplete="off">
		   			<h1 class="text-center text-primary mb-5">Sign Up in 30 Seconds </h1>
		   			<img src="https://weblister.co/images/as-appsumo-logo-blk.png" class="img-fluid appsumocode mb-5" style="width: 20%;">
		       		
		       		<div class="row">
		       			<div class="col-md-6">
		       				<div class="form-group  mb-3">
		       					<label class="mb-2">Plan</label>
	       						<input type="text" name="plan" id="plan" class="form-control"  value="<?php echo $plan?>" readonly>
	       					</div>
	       				</div>
	       				<div class="col-md-6">
		       				<div class="form-group  mb-3">
		       					<label class="mb-2">Amount Due</label>
		       					<div class="input-group">
		       						<span class="input-group-text">$</span>
				   					<input type="text" name="price" class="form-control"  id="price" value="<?php echo $price?>" readonly>
				   				</div>
			   					<input type="hidden" name="allowed_branches" id="allowed_branches" value="<?php echo $allowed_branches?>">
			   				</div>
		   				</div>
						<div class="col-md-6">
				       		<div class="form-group mb-3">
				       			<label class="mb-2" for="username">Firstname</label>
								<input type="text" name="firstname" id="firstname" class="form-control" required placeholder="John">
				       		</div>
				       	</div>
				       	<div class="col-md-6">
				       		<div class="form-group mb-3">
				       			<label class="mb-2" for="username">Lastname</label>
								<input type="text" name="lastname" id="lastname" class="form-control" required placeholder="Doe">
				       		</div>
				       	</div>
				       	<div class="col-md-6">
				   			<div class="form-group mb-3">
				   				<label class="mb-2" for="phonenumber">Phone </label>
				   				<input type="tel" id="phone" name="phone" class="form-control" onkeyup="complePhone(this.value)">
								<input type="hidden" name="phonenumber" id="phonenumber" class="form-control" required  placeholder="e.g +123487739">
								<p id="result"></p>
				       		</div>
				       	</div>
				       	<div class="col-md-6">
				       		<div class="form-group mb-3">
				       			<label class="mb-2" for="email">Email</label>
				   				<input type="email" name="email" id="email" class="form-control" required placeholder="Email" autocomplete="off">
				   				<input type="hidden" name="currency" id="currency" value="USD">
				       		</div>
				       	</div>
				       	<div class="col-md-6">
				       		<div class="form-group mb-3">
				       			<label class="mb-2" for="password"> AppSumo Code </label>
				       			<div class="input-group">
				       				<input type="text" name="appsumocode" id="appsumocode" class="form-control" required  autocomplete="off">
				       				<span class="input-group-text" id="showpass_text"><i class="bi bi-key"></i></span>
				       			</div>
				       		</div>
				       		<div class="error-msg ext-danger"></div>
				       	</div>
				       	<div class="col-md-6">
				       		<div class="form-group mb-3">
				       			<label class="mb-2" for="password"> Password </label>
				       			<div class="input-group">
				       				<input type="password" name="password" id="password" class="form-control" required  autocomplete="off">
				       				<span class="input-group-text" id="showpass_text" onclick="passReveal()"><i class="bi bi-eye"></i></span>
				       			</div>
				       		</div>
				       	</div>
				       	<div class="col-md-12">
				       		<?php echo $button?>
				       	</div>
				    </div>
				    <div class="d-flex justify-content-between ">
						<p><a href="login" title="login" class="text-primary mt-4 mb-4">Have an Account? Sign In</a></p>
					</div>
				</form>
		   				
			</div>
			<div class="col-md-6 mt-5 mb-5 p-5">
				<h4 class="text-center">Welcome From</h4>
				<img src="https://weblister.co/images/as-appsumo-logo-blk.png" class="img-fluid appsumocode mb-5" style="width: 100%;">
			</div>
		</div>
	</div>

<?php include ("supports/footer.php");?>

<script>
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

$(document).ready(function(){
	$("#ClientRegisterForm").submit(function(e){
		e.preventDefault();
		var username = document.getElementById('firstname').value;
		var email = document.getElementById('email').value;
		var url = 'includes/submitAppsumoUser';
		$.ajax({
			url:url,
			method:"POST",
			data:$(this).serialize(),
			beforeSend:function(){
				$("#submitBtn").html("Please Wait...");
			},
			success:function(data){
				
				$(".error-msg").html(data);
				$("#submitBtn").html("Submit");
				// setTimeout(function(){
				// 	location.reload();
				// }, 2000);
				
			}
		})
	})
})


 // Telephone number with country code
    var input = document.querySelector("#phone");
      var iti = intlTelInput(input, {
        autoHideDialCode: true,
          autoPlaceholder: true,
          separateDialCode: true,
          nationalMode: true,
        allowDropdown: true,
        autoPlaceholder: "polite",
        dropdownContainer: document.body,
          geoIpLookup: function(callback) {
            $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
              var countryCode = (resp && resp.country) ? resp.country : "";
              callback(countryCode);
            });
          },
          nationalMode: false,
          placeholderNumberType: "MOBILE",
          preferredCountries: ['zm'],
          separateDialCode: true,
        utilsScript: "intl.17/build/js/utils.js",
    });

    function complePhone(phone){
      // var num = iti.getNumber(),
      var number = iti.getNumber(intlTelInputUtils.numberFormat.E164);
      var isValid = iti.isValidNumber();
      result = document.querySelector("#result");
      phonenumber = document.getElementById("phonenumber");
      if (phone == "") {
        result.textContent = "Add Your Number";
        return false;
      }
        if (isValid === true) {
          result.textContent = "Number: " + number + ", is valid";
          phonenumber.value = number;
        }else if(isValid === false){
          result.textContent = "Number: " + number + ", is invalid";
          phonenumber.value = number;
        }
    }
</script>
</body>
</html>
