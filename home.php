<?php
	include('includes/db.php');
	if (!isset($_COOKIE['userLoggedin']) && !isset($_SESSION['email'])) {
	    echo '<script>
				window.location = "./";
			</script>';
	}else if (isset($_COOKIE['ManagementApp'])){
		if($_COOKIE['ManagementApp'] == 'payrolls') {
      		echo "<script>
            		window.location = 'payrolls';
          		</script>";
	    }elseif ($_COOKIE['ManagementApp'] == 'projects') {
	      	echo "<script>
	            	window.location = 'projects';
	          	</script>";
	    }
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Pick Your Tool</title>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="English">
	<meta name="author" content="Mutale Mulenga">

<!-- 	<meta name="google-site-verification" content="HFaBnsPkNovLhjUB-Nncw4Fmyh1mk88yjZQedhoL72Y" /> -->
	<meta name="google-site-verification" content="8MzoexPjnr23uGeehBvoNDgX3XUCPg7VFisi1Y7T5tQ" />

    <meta name="title" content="Website Analytics and Uptime monitoring 1440 a day - Weblister.co">
    <meta name="description" content="Analytics and Uptime monitoring 1440 a day - get notified when your website goes downtime. 24/7 uptime and downtime monitoring with up to the minute email and sms notification">
    <meta name="keywords" content="website uptime monitoring, traffic analytics, website uptime monitoring software, website downtime monitoring, website uptime software">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://osabox.net/">
    <meta property="og:title" content="Website Analytics and Uptime monitoring 1440 a day - Weblister.co">
    <meta property="og:description" content="Analytics and Uptime monitoring 1440 a day - get notified when your website goes downtime. 24/7 uptime and downtime monitoring with up to the minute email and sms notification">
    <meta property="og:image" content="https://osabox.net/bg/newDash.png">
    <meta property="og:keywords" content="website uptime monitoring, traffic analytics, website uptime monitoring software, website downtime monitoring, website uptime software">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="https://osabox.net/">
    <meta property="twitter:title" content="Website Analytics and Uptime monitoring 1440 a day - Weblister.co">
    <meta property="twitter:description" content="Analytics and Uptime monitoring 1440 a day - get notified when your website goes downtime. 24/7 uptime and downtime monitoring with up to the minute email and sms notification">
    <meta property="twitter:image" content="https://osabox.net/bg/newDash.png">
    <meta property="twitter:keywords" content="website uptime monitoring, traffic analytics, website uptime monitoring software, website downtime monitoring, website uptime software">

    <!--Google Index Verification-->
    <meta name="google-site-verification" content="4jbOUVKGHZ1jTvzMM-7zkqw_C3kEaEUeIRG93hKwxAI" />
    <link rel="icon" type="icon" href="dist/images/icon_new.png">
    <link rel="canonical" type="text/css" href="https://osabox.net/">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="bootstrap-icons/font/bootstrap-icons.css">
    <link rel="icon" type="text/css" href="images/icon2.png">
    <link rel="stylesheet" type="text/css" href="css/link.css">
    <!-- <link rel="stylesheet" href="toastr/toastr.min.css"> -->
    <link rel="stylesheet" href="app/intl.17/build/css/intlTelInput.css">
    <link rel="stylesheet" href="app/plugins/toastr/toastr.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="js/jquery-3.6.0.min.js"></script>
    <style type="text/css">
    	.center {
			margin-top: 10em;
			width: 100%;
			padding: 10px;
		}
    </style>
</head>
<body>
	<div class="container-fluid  mt-5">
		<div class="container mt-5 mb-5">
			<h1 class="text-center text-secondary">Welcome: <?php echo $_SESSION['firstname']?></h1>
			<a href="signout" class="text-decoration-none text-danger"><i class="bi bi-door-open"></i> Sign Out</a>
		</div>
		<div class="container mt-5">
			<div class="position-relative center">
				<div class="row">
					<div class="col-md-6">
						<a href="projects" title="projects" class="text-decoration-none text-white manageapp">
							<div class="card bg-info mb-4">
								<div class="card-body text-center">
									Project Management System
								</div>
							</div>
						</a>
					</div>
					<div class="col-md-6">
						<a href="payrolls" title="payrolls" class="text-decoration-none text-warning manageapp">
							<div class="card bg-secondary mb-4">
								<div class="card-body text-center">
									Payroll Management System
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		$(document).on("click", ".manageapp", function(e){
      		e.preventDefault();
      		var cvalue = $(this).attr('href');
      		var cname = "ManagementApp";
      		Management(cname, cvalue);
      		setTimeout(function(){
	        // location.reload();
          		window.location = cvalue;
	      	}, 1500);
      })
      function Management(cname, cvalue) {
        	event.preventDefault();
        	// successToast("Branch Selected");
        	const d = new Date();
        	d.setTime(d.getTime() + (30*24*60*60*1000));
        	let expires = "expires="+ d.toUTCString();
        	document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
      }
	</script>
</body>
</html>