<!DOCTYPE html>
<html>
<head>
	<title>Osabox.net - Your easy to use loan management system</title>
	<?php include("supports/header.php")?>
	<style>
		html {
			scroll-behavior: smooth;
		}
		body {
			font-family: Josefin Sans Regular;
		}
		img.lines {
			position: absolute;
			left: 0%;
			right: -0.83%;
			top: 0%;
			bottom: 88.38%;
			opacity: 1;
			width: 100%;
		}
		.front {
			width: 100%;
			padding: 12em 0 2em;
			color: #1016ef;
			margin: 0 auto;
			/*background-color: #1a417a;*/
			font-family: optima;
		}
		.alphaTitle {
			font-style: normal;
			font-weight: 600;
			font-size: 4em;
			line-height: 1.4em;
			color: #FFFFFF;
			z-index: 20000 !important;
			font-family: 
		}
		.titleSpan {
			color: #FFFF00;
			border-bottom: .001em solid #ffffff;
			border-radius: 0.2em;
		}
		.subTitle {
			color: #ffffff;
			opacity: .8;
			margin: 2em auto;
		}
		.yellow {
			color: #1a417a;
			font-weight: 400;
		}
		.mid_gap {
			margin: 10em auto;
		}
		
		.main_container {
			padding: 3em;
		}
		img.payroll, img.project, img.todolist {
			box-shadow:  10px 0 10px;
			border-radius: 5px;
		}
		img.payslip {
			box-shadow:  10px 0 10px;
			border-radius: 5px;
		}
		@media(max-width: 767px) {
			.main_container {
				padding: 0.5em;
			}
		}
	</style>
</head>
<body>
	<?php include("supports/nav.php")?>
	<div class="container-fluid main_container div-outline bg-warning mt-5 ">
		<div class="container mt-5 mb-5">
			<div class="row">
				<div class="col-md-6 col-sm-12 mt-4">
					<div class="front p-4 bg- mt-5">
						<h1 class="alphaTitles text-center mb-5"><span class="text-white border-bottom border-dark">Uncomplicated</span> Cloud Based Loan Management Tool </h1>
						<p class="text-center h4 mb-2">Add Borrowers, Manage Borrowers</p> 
						<p class="text-center h4 mb-0">Collateral Data</p>
						<div class="text-center mt-5"><a href="register" title="start" class="btn btn-secondary">Register for Free</a></div>
					</div>
				</div>
				<div class="col-md-6 col-sm-12 p-4">
					<div class=" mt-5">
						<img src="images/undraw_Surveillance_re_8tkl.svg" class="img-fluid " alt="undraw_Dashboard_re_3b76 " width="100%">
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid main_container mid_gap bg-white">

		<div class="container">
		<!-- Features -->
			<div class="row mt-5">
				<div class="col-md-6 col-sm-12 mb-5">
					<img src="images/1_.png" alt="undraw_Surveillance_re_8tkl" class="img-fluid shadow" width="100%">
				</div>
				<div class="col-md-6 col-sm-12 mb-5">
					<h3 class="card-title text-center text-primary"><i class="bi bi-speedometer2 fs-1"></i></h3>
					<h3 class="card-title text-center text-primary">Admin Dashboard</h3>				
					<p class="fs-5">Manage all your borrowers in one place, whether they are a group or individuals. You also view repayment plans, loan files, loan collaterals management. You set the kind of loans you wish to offer and the rates and terms of repayments.</p>
					<!-- <p class="fs-5">Send emails with attachment to your clients with easy.</p> -->
				</div>
			</div>
			<div class="mid_gap"></div>
			<div class="row">
				<div class="col-sm-6">
					<h3 class="card-title text-center text-primary"><i class="bi bi-bar-chart-fill"></i></h3>
					<h3 class="card-title text-center text-primary"> Loan Setting </h3>
					<p class="fs-5">Create loans according to the types that you offer, e.g <em>Business Loans, Personal Loans, House Maintenance Loans and so on. </em> Add and view loan files provided by your clients.</p>
					<p class="fs-5">View and compare graphically your loans disbursements with your loan collections. </p>
				</div>
				<div class="col-sm-6">
					<img src="images/undraw_All_the_data_re_hh4w.svg" class="img-fluid" width="100%" alt="undraw_All_the_data_re_hh4w">
				</div>
			</div>
		</div>
	</div>
	<div class="container-fluid main_container bg-light">
		<div class="container mt-5">
			<div class="row mt-5 mb-5">
				<div class="col-md-6 col-sm-12 mb-5">
					<img src="images/project.png" alt="project" class="img-fluid project" width="100%">
				</div>
				<div class="col-md-6 col-sm-12 mb-5">
					<h3 class="card-title text-center text-primary"><i class="bi bi-cast fs-1"></i></h3>
					<h3 class="card-title text-center text-primary">Project Management</h3>
					<p class="fs-5">Is your team or organisation embarking on a new project? Use our project management tool to create, contribute milestones and also update team or staff members and let them contribute and achieve maximum results.</p>
				</div>
			</div>
			<div class="row mb-5 mt-5">
				<div class="col-sm-12 text-center mb-5">
					<a href="register" title="register" class="btn btn-warning btn-lg shadow"> Register Now</a>
				</div>
			</div>
		</div>
	</div>

	<div class="container-fluid main_container">
		<div class="container mt-5">
			<div class="row">
				<div class="col-md-4">
					<div class="card w-100 mb-5">
						<div class="card-header">
							<h2 class="card-title">To-do List</h2>
						</div>
						<div class="card-body">
							
							<p>Let you or your staff members create a to-do list in a quickest way and update cross it once the task is done.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card w-100 mb-5">
						<div class="card-header">
							<h2 class="card-title">SMS System</h2>
						</div>
						<div class="card-body">
							<p>Generate and send SMS to your clients, as well as to your staff members and we deliver them with easy.</p>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="card w-100 mb-5">
						<div class="card-header">
							<h2 class="card-title">Emailing</h2>
						</div>
						<div class="card-body">
							<p>Generate and send Emails to your clients, as well as to your staff members and know which emails have been opened.</p>
							<p>You use your SMTP, then add your logo or company marketing details in your emails.</p>
						</div>
					</div>
				</div>
				<div class="col-md-12 mt-5 mb-5">
					<img src="images/todolist_dark.png" class="img-fluid todolist" alt="todolist">
				</div>
			</div>
			<!-- #f4f6f9 -->
		</div>
	</div>

	<div class="container-fluid bg-warning main_container">
		<div class="container">
			<div class="row">
				<div class="co-md-12">
					<h2>Payroll System</h2>
					<p class="fs-5">Are you thinking of remunerating your staff? Our system has a built in payroll management system that is easier to generate and print for all your staff members.</p>
					<ul>
						<li>Set Up Basic pay</li>
						<li>Add allowances</li>
						<li>Add Deductions</li>
						<li>Auto-calculation of the gross and net pay</li>
						<li>Generate Payslip</li>
					</ul>
				</div>
				<div class="col-md-6 mb-5">
					<img src="images/payroll.png" class="img-fluid payroll" alt="payroll" width="100%">
				</div>
				<div class="col-md-6 mb-5">
					<img src="images/payslip.png" class="img-fluid payslip" alt="payslip" width="100%">
				</div>
			</div>
		</div>
	</div>
	
	<?php include('supports/footer.php') ?>
	<script>
		
		// async function displayMonitors(){
		// 	var xhr = new XMLHttpRequest();
		// 	var url = "parsers/fetchCounts";
		// 	var data = "fetchCounts=fetchCounts";
		// 	xhr.onreadystatechange = function() {
		// 	    if (this.readyState == 4 && this.status == 200) {
		// 	       	document.getElementById("displayCounts").innerHTML = xhr.responseText;
		// 	    }
		// 	};
		// 	xhr.open("POST", url, true);
		// 	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		// 	xhr.send(data);
		// }
		// displayMonitors();

	</script>
</body>
</html>