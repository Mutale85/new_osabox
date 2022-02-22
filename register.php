<!DOCTYPE html>
<html>
<?php
	include("supports/header.php");
	if (isset($_GET['register'])) {
		if ($_GET['register'] == '1') {
			$plan = 'Trial';
			$price = '0.00';
			$allowed_branches = '1';
			$button = '<button id="submitBtn" type="submit" class="button-17 mt-4 mb-4">Sign Up</button>';
		}
		if ($_GET['register'] == '2') {
			$plan = 'Standard';
			$price = '25.00';
			$allowed_branches = '1';
			$button = '<button id="submitBtn" type="submit" class="button-17 mt-4 mb-4">Sign Up</button>';
		}
		if ($_GET['register'] == '3') {
			$plan = 'Platinum';
			$price = '69.99';
			$allowed_branches = '1';
			$button = '<button id="submitBtn" type="submit" class="button-17 mt-4 mb-4">Sign Up</button>';
		}

	}else{
		$plan = 'Trial';
		$price = '0.00';
		$allowed_branches = '1';
		$service = 'WM';
		$button = '<button id="submitBtn" type="submit" class="button-17 mt-4 mb-4">Sign Up</button>';
	}
?>
<title> Osabox.co - Create your account </title>
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
	<div class="first_section">
		<div class="container mt-5 mb-5">
			<div class="row">
				<div class="col-md-6 mt-5 mb-4">
			   		<form method="post" class="ClientRegisterForm p-2" id="ClientRegisterForm" autocomplete="off">
			       		<h1 class="text-center text-primary mb-5">Sign Up in 10 Seconds </h1>
			       		<div class="row mt-5">
			       			<div class="col-md-6">
		       				</div>
		       				<div class="col-md-6">
			   				</div>
							<div class="col-md-6">
								<input type="hidden" name="plan" id="plan" class="form-control"  value="<?php echo $plan?>" readonly>
								<input type="hidden" name="price" class="form-control"  id="price" value="<?php echo $price?>" readonly>
								<input type="hidden" name="allowed_branches" id="allowed_branches" value="<?php echo $allowed_branches?>">
					       		
					       		
								<input type="hidden" name="firstname" id="firstname" class="form-control" required placeholder="John">
					       		
								<input type="hidden" name="lastname" id="lastname" class="form-control" required placeholder="Doe">
				       		
				   				<input type="hidden" id="phone" name="phone" class="form-control" onkeyup="complePhone(this.value)">
								<input type="hidden" name="phonenumber" id="phonenumber" class="form-control" required  placeholder="e.g +123487739">
					       		<div class="form-group mb-3">
					       			<label class="mb-2" for="email">Email</label>
					   				<input type="email" name="email" id="email" class="form-control" required placeholder="Email" autocomplete="off">
					   				<input type="hidden" name="currency" id="currency" value="USD">
					       		</div>
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
							<p><a href="app/login" title="login" class="text-primary mt-4 mb-4">Have an Account? Sign In</a></p>
						</div>
					</form>
			   		<div class="error-msg" class="text-danger"></div>		
				</div>
				<div class="col-md-6 mt-5 mb-5 p-5">
					<h4 class="text-center">Start Your 30 Days Trial</h4>
					<img src="images/build.svg" class="img-responsive img-fluid mt-5 mb-5" alt="build.svg" width="100%">
				</div>
			</div>
		</div>
	</div>

<?php include ("supports/footer.php");?>
<script src="https://checkout.flutterwave.com/v3.js"></script>
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
		var url = 'processing/submitUser';
		$.ajax({
			url:url,
			method:"POST",
			data:$(this).serialize(),
			beforeSend:function(){
				$("#submitBtn").html("Please Wait...");
			},
			success:function(data){
				
				successNow(data);
				$("#submitBtn").html("Submit");
				// setTimeout(function(){
				// 	location.reload();
				// }, 2000);
				
			}
		})
	})
})


  
function makePayment() {
  	var plan = document.getElementById('plan').value;
  	var price = document.getElementById('price').value;
  	var allowed_sites = document.getElementById('allowed_sites').value;
  	var service = document.getElementById('service').value;
  	var username = document.getElementById('username');
  	var phone = document.getElementById('phone');
  	var phonenumber = document.getElementById('phonenumber');
  	var email = document.getElementById('email');
  	var password = document.getElementById('password');

  	if (username.value === '') {
  		errorNow("Please enter your names");
  		username.focus();
  		return false;
  	}

  	if (phone.value === '') {
  		errorNow("Please enter your Phone Number");
  		phone.focus();
  		return false;
  	}

  	if (email.value === '') {
  		errorNow("Please enter your valid email");
  		email.focus();
  		return false;
  	}

  	if (password.value === '') {
  		errorNow("Please create password");
  		password.focus();
  		return false;
  	}

    FlutterwaveCheckout({
		public_key: "FLWPUBK_TEST-e5fa271a124685e29bf24120770dcdbc-X",
		tx_ref: email.value+phonenumber.value,
		amount: price,
		currency: "USD",
		country: "",
		payment_options: " ",
		redirect_url: // specified redirect URL
		'http://localhost/osabox.co/successandRegisterClient?plan='+plan+'&price='+price+'&allowed_sites='+allowed_sites+'&service='+service+'&username='+username.value+'&phonenumber='+phonenumber.value+'&email='+email.value+'&password='+password.value,
			meta: {
			consumer_id: email.value+phonenumber.value,
			consumer_mac: "92a3-912ba-1192a",
		},
		customer: {
			email: email.value,
			phone_number: phonenumber.value,
			name: username.value,
		},
		callback: function (data) {
			console.log(data);
		},
		onclose: function() {
			// close modal
		},
		customizations: {
			title: "osabox "+ plan +" Subscription",
			description: plan + " Payment",
			logo: "https://osabox.co/images/icon_new.png",
			},
	});
}


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
        utilsScript: "app/intl.17/build/js/utils.js",
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
