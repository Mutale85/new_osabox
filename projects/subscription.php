<?php 
  require ("includes/db.php");
  require ("includes/tip.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php include("links.php") ?>
  	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  	<style>
  		.card-title {
  			text-align: center;
  		}
  	</style>
  	<?php
    	$message = "";
	    $query = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ") ;
	    $parent_id = $_SESSION['parent_id'];
	    $query->execute(array($parent_id));
	    $row = $query->fetch();
	    $days = "";
	    if($row){
	        $plan 		= $row['plan'];
	        $start_date = strtotime($row['start_date']);
	        $end_date 	= strtotime($row['end_date']);
	        $today 		= strtotime("now");
	        $end_date 	= strtotime($row['end_date']);
	        $daysGone 	= $end_date - $today;
	        $days 		= floor($daysGone/(60*60*24));
	        if ($today > $end_date) {
	            // $message = "Subscription Ended ".$days_remaining." <br>";
	            // setcookie(goodUrl($website_link)."_ExpiredSubscription", $days);
	            $message = "Subscription Ended ". $days. " Days Ago";
	        }else{
	            $message = $days;
	        }
	        $currency 		= $row['currency'];
	        $price 			= $row['price']; 
	        $username 		= $row['firstname'];
	        $phonenumber 	= $row['phonenumber']; 
	    }

    $query = $connect->prepare("SELECT * FROM `subscriptions` WHERE parent_id = ? ORDER BY id DESC ");
    $parent_id = $_SESSION['parent_id'];
    $query->execute(array($_SESSION['parent_id']));
    $row = $query->fetch();
    
    if($row){
        $plan 		= $row['plan'];
        $start_date = strtotime($row['start_date']);
        $end_date 	= strtotime($row['end_date']);
        $today 		= strtotime("now");
        $end_date 	= strtotime($row['end_date']);
        $daysGone 	= $end_date - $today;
        $days 		= floor($daysGone/(60*60*24));
        if ($today > $end_date) {
            $message = "Subscription Ended ".$days_remaining." Days Ago <br>";
        }else{
            $message = $days;
        }
        $currency = $row['currency'];
        $price = $row['price'];     
    }       
?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
      <symbol id="check" viewBox="0 0 16 16">
        <title>Check</title>
        <path d="M13.854 3.646a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708 0l-3.5-3.5a.5.5 0 1 1 .708-.708L6.5 10.293l6.646-6.647a.5.5 0 0 1 .708 0z"/>
      </symbol>
    </svg>
	<div class="wrapper">
  		<?php include ("nav_side.php"); ?>
  		<div class="content-wrapper">
	  		<?php include ("dash_data.php"); ?>
		    <section class="content">
		    	<div class="container-fluid">
		    		<div class="row">
                        <div class="col-md-12">
                            <div class="card card-warning mb-4">
                                <div class="card-header">
                                    <h2 class="card-title">Current User Plan</h2>
                                </div>
                                <div class="card-body">
                                    <p><?php echo $plan ?> Plan</p>
                                    <p><?php echo $currency ?> <?php echo $price?> Paid </p>
                                    <p><?php echo $message?></p>
                                </div>
                            </div>
                        </div>
                    </div>

					<main>
					    <div class="row row-cols-1 row-cols-md-3 mb-3 text-center">
					      <div class="col">
					        <div class="card mb-4 rounded-3 shadow-sm">
					          <div class="card-header py-3">
					            <h4 class="my-0 fw-normal">Basic</h4>
					          </div>
					          <div class="card-body">
					            <h4 class="card-title pricing-card-title">$5/mo/User<small class="text-muted"></small></h4>
					            <ul class="list-unstyled mt-3 mb-4">
					              	<li>5 Projects</li>
					              	<li>5 Payslips</li>
					              	<li>10 Monthly SMS</li>
					              	<li>2 Branch</li>
					              	<li>5 Team Members</li>
					              	<li>Email support</li>
					            </ul>
					            <form method="post">
                                    <input type="hidden" name="username" id="username_basic" value="<?php echo $username?>">
                                    <input type="hidden" name="phonenumber" id="phonenumber_basic" value="<?php echo $phonenumber ?>">
                                    <input type="hidden" name="email" id="email_basic" value="<?php echo $_SESSION['email'] ?>">
                                    <input type="hidden" name="plan" id="plan_basic" value="Basic">
                                    <input type="hidden" name="price" id="price_basic" value="5.00">
                                    <input type="hidden" name="allowed_branches" id="allowed_branches_basic" value="2">
                                    <button type="button" class="w-100 btn btn-info" onclick="basicPayment()">$5.00 Upgrade </button>
                                </form>
					          </div>
					        </div>
					      </div>
					      <div class="col">
					        <div class="card mb-4 rounded-3 shadow-sm">
					          <div class="card-header py-3">
					            <h4 class="my-0 fw-normal">Standard</h4>
					          </div>
					          <div class="card-body">
					            <h4 class="card-title pricing-card-title">$10<small class="text-muted">/mo/User</small><small class="text-muted"></small></h4>
					            <ul class="list-unstyled mt-3 mb-4">
					              	<li>Unlimited Projects</li>
					                <li>20 Payslips</li>
					                <li>50 Monthly SMS</li>
					              	<li>5 Branches</li>
					              	<li>05 Team Members</li>
					              	<li>Priority email support</li>
					            </ul>
					            <form method="post">
                                    <input type="hidden" name="username" id="username_standard" value="<?php echo $username?>">
                                    <input type="hidden" name="phonenumber" id="phonenumber_standard" value="<?php echo $phonenumber ?>">
                                    <input type="hidden" name="email" id="email_standard" value="<?php echo $_SESSION['email'] ?>">
                                    <input type="hidden" name="plan" id="plan_standard" value="Standard">
                                    <input type="hidden" name="price" id="price_standard" value="10.00">
                                    <input type="hidden" name="allowed_branches" id="allowed_branches_standard" value="5">
                                    <button type="button" class="w-100 btn btn-warning" onclick="standardPayment()">$10.00 Upgrade</button>
                                </form>
					          </div>
					        </div>
					      </div>
					      <div class="col">
					        <div class="card mb-4 rounded-3 shadow-sm border-primary">
					          <div class="card-header py-3 text-white bg-primary border-primary">
					            <h4 class="my-0 fw-normal">Platinum</h4>
					          </div>
					          <div class="card-body">
					            <h4 class="card-title pricing-card-title">$29.99<small class="text-muted">/mo</small></h4>
					            <ul class="list-unstyled mt-3 mb-4">
					              <li>Unlimited Projects</li>
					              <li>Unlimited Payslips</li>
					              <li>200 Monthly SMS</li>
					              <li>Unlimited Branches</li>
					              <li>Unlimited Team Members</li>
					              <li>Priorty email support</li>
					            </ul>
					            <form method="post">
                                    <input type="hidden" name="username" id="username_platinum" value="<?php echo $username?>">
                                    <input type="hidden" name="phonenumber" id="phonenumber_platinum" value="<?php echo $phonenumber ?>">
                                    <input type="hidden" name="email" id="email_platinum" value="<?php echo $_SESSION['email'] ?>">
                                    <input type="hidden" name="plan" id="plan_platinum" value="Platinum">
                                    <input type="hidden" name="price" id="price_platinum" value="29.99">
                                    <input type="hidden" name="allowed_branches" id="allowed_branches_platinum" value="Unlimited">
                                    <button type="button" class="w-100 btn btn-primary" onclick="platinumPayment()">$29.99 Upgrade</button>
                                </form>
					          </div>
					        </div>
					      </div>
					    </div>

					    <h2 class="display-6 text-center mb-4">Compare plans</h2>

					    <div class="card-body">
                            <div class="table-responsive mb-5">
                              	<table class="table table-borderless table-md">
							        <thead>
							          <tr>
							            <th style="width: 34%;"></th>
							            <th style="width: 22%;">Free</th>
							            <th style="width: 22%;">Standard</th>
							            <th style="width: 22%;">Platinum</th>
							          </tr>
							        </thead>
							        <tbody>
							          <tr>
							            <th scope="row" class="text-start">Project Mangement Tool</th>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							          </tr>
							          <tr>
							            <th scope="row" class="text-start">Payroll Generating System</th>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							          </tr>
							        </tbody>
							        <tbody>
							          <tr>
							            <th scope="row" class="text-start">Branches</th>
							            <td>1</td>
							            <td>5</td>
							            <td>Unlimited</td>
							          </tr>
							          <tr>
							            <th scope="row" class="text-start">SMS Clients</th>
							            <td>5 SMS</td>
							            <td>50 SMS (Accumulative)</td>
							            <td>200 SMS (Accumulative)</td>
							          </tr>
							          <tr>
							            <th scope="row" class="text-start">Staff Members</th>
							            <td>5</td>
							            <td>5</td>
							            <td>Unlimited</td>
							          </tr>
							          <tr>
							            <th scope="row" class="text-start">No Set Up Fee</th>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							            <td><svg class="bi" width="24" height="24"><use xlink:href="#check"/></svg></td>
							          </tr>
							        </tbody>
					      		</table>
					    	</div>
					  	</main>
					  </div>
		    	</div>
		    </section>
  		</div>
  		<aside class="control-sidebar control-sidebar-dark"></aside>
  		<?php include("footer_links.php")?>
  	</div>
  	<script src="https://checkout.flutterwave.com/v3.js"></script>
    <script>
    	function basicPayment() {
		  	var plan = document.getElementById('plan').value;
			var price = document.getElementById('price').value;
			var allowed_sites = document.getElementById('allowed_sites').value;
			var service = document.getElementById('service').value;
			var username = document.getElementById('username');
			var phone = document.getElementById('phone');
			var phonenumber = document.getElementById('phonenumber');
			var email = document.getElementById('email');
			var password = document.getElementById('password');


		  	
		    FlutterwaveCheckout({
				public_key: "FLWPUBK_TEST-e5fa271a124685e29bf24120770dcdbc-X",
				tx_ref: email+phonenumber,
				amount: price,
				currency: "USD",
				country: "",
				payment_options: " ",
				redirect_url: // specified redirect URL
				'http://localhost/weblister.co/k/payment-for-monthly-subscription?plan='+plan+'&price='+price+'&allowed_sites='+allowed_sites+'&service='+service+'&username='+username+'&email='+email,
					meta: {
					consumer_id: 23,
					consumer_mac: "92a3-912ba-1192a",
				},
				customer: {
					email: email,
					phone_number: phonenumber,
					name: username,
				},
				callback: function (data) {
					console.log(data);
				},
				onclose: function() {
					// close modal
				},
				customizations: {
					title: "Weblister "+ plan +" Subscription",
					description: plan + " Payment",
					logo: "https://weblister.co/images/icon_new.png",
				},
			});
		}

		function standardPayment() {
		  	var plan = document.getElementById('plan_standard').value;
		  	var price = document.getElementById('price_standard').value;
		  	var allowed_sites = document.getElementById('allowed_sites_standard').value;
		  	var service = document.getElementById('service_standard').value;
		  	var username = document.getElementById('username_standard').value;
		  	var email = document.getElementById('email_standard').value;
		  	var phonenumber = document.getElementById('phonenumber_standard').value;

		  	
		    FlutterwaveCheckout({
				public_key: "FLWPUBK_TEST-e5fa271a124685e29bf24120770dcdbc-X",
				tx_ref: email+phonenumber,
				amount: price,
				currency: "USD",
				country: "",
				payment_options: " ",
				redirect_url: // specified redirect URL
				'http://localhost/weblister.co/k/payment-for-monthly-subscription?plan='+plan+'&price='+price+'&allowed_sites='+allowed_sites+'&service='+service+'&username='+username+'&email='+email,
					meta: {
					consumer_id: 23,
					consumer_mac: "92a3-912ba-1192a",
				},
				customer: {
					email: email,
					phone_number: phonenumber,
					name: username,
				},
				callback: function (data) {
					console.log(data);
				},
				onclose: function() {
					// close modal
				},
				customizations: {
					title: "Weblister "+ plan +" Subscription",
					description: plan + " Payment",
					logo: "https://weblister.co/images/icon_new.png",
				},
			});
		}

		function platinumPayment() {
		  	var plan = document.getElementById('plan_platinum').value;
		  	var price = document.getElementById('price_platinum').value;
		  	var allowed_sites = document.getElementById('allowed_sites_platinum').value;
		  	var service = document.getElementById('service_platinum').value;
		  	var username = document.getElementById('username_platinum').value;
		  	var email = document.getElementById('email_platinum').value;
		  	var phonenumber = document.getElementById('phonenumber_platinum').value;
		  	var rand = Math.random();

		    FlutterwaveCheckout({
				public_key: "FLWPUBK_TEST-e5fa271a124685e29bf24120770dcdbc-X",
				tx_ref: email+phonenumber,
				amount: price,
				currency: "USD",
				country: "",
				payment_options: " ",
				redirect_url: // specified redirect URL
				'http://localhost/weblister.co/k/payment-for-monthly-subscription?plan='+plan+'&price='+price+'&allowed_sites='+allowed_sites+'&service='+service+'&username='+username+'&email='+email,
					meta: {
					consumer_id: rand,
					consumer_mac: "92a3-912ba-1192a",
				},
				customer: {
					email: email,
					phone_number: phonenumber,
					name: username,
				},
				callback: function (data) {
					console.log(data);
				},
				onclose: function() {
					// close modal
				},
				customizations: {
					title: "Weblister "+ plan +" Subscription",
					description: plan + " Payment",
					logo: "https://weblister.co/images/icon_new.png",
				},
			});
		}
	</script>
</body>
</html>