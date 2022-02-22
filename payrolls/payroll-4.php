<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Template Three Payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<style type="text/css">
		.main_box {
			display: flex;
		}
		#earningdetails, .deductiondetails {
			width: 100%;
			border-collapse: collapse;
		}
		#earningdetails td, #earningdetails th, .deductiondetails td, .deductiondetails th {
			padding: 0.5em; 
		}
		#earningdetails thead {
			padding-top: 1em;
			border-bottom: 2px dashed mediumblue;
			color: mediumblue;
			border-top: 2px solid mediumblue;
		}
		
		#earningdetails tbody {
			border-bottom: 2px solid mediumblue;
		}

		@media print {

		  html, body {
		    height:100%; 
		    margin: 0 !important; 
		    padding: 0 !important;
		    overflow: hidden;
		  }

		}
	</style>	
</head>
<body>
	<div class="wrapper">
		<div class="content-wrappers">
			<section class="content mt-4">
      			
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));
      			?>
      			<div class="container">
      				<div class="row">
      					
			  		<div class="row border border-primary p-4">
			  			<div class="col-md-12 d-flex justify-content-between border-bottom border-secondary">
			  				<div class="address">
			  					<?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> 
			  					<?php echo getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id'])?>
			  				</div>
			  				<div class="logo">
			  					<img src="<?php echo getOrganisationLogoDetailsForPDF($connect, $_SESSION['parent_id'])?>" class="img-fluid" alt="logo" style="width: 40px; height: 40px; border-radius: 50%;">
			  				</div>
			  			</div>
			  			<div class="col-md-12 mt-4">
			  				<p class="fs-5">Payslip for the month of: <b>October, 2021</b></p>
			  				<p class="text-primary"><strong>Staff Details:</strong></p>
			  				<div class="main_box">
				  				<div class="col-md-8 boxes1">
					  				<table class="table table-borderless">
					  					<tr>
					  						<td>Name</td>
					  						<td>: Mutale Mulenga</td>
					  					</tr>
					  					<tr>
					  						<td>Designation</td>
					  						<td>: Software Engineer</td>
					  					</tr>
					  					<tr>
					  						<td>Employee Number</td>
					  						<td>: 0009800</td>
					  					</tr>
					  				</table>
					  			</div>
					  			<div class="col-md-4 boxes2">
					  				<h4>NET PAY</h4>
					  				<h4>ZMW 46,700</h4>

					  				<p>Account: XXXX -782</p>
					  			</div>
					  		</div>
			  			</div>
			  			<div class="col-md-12">
			  				<table id="earningdetails">
			  					<thead>
			  						<tr>
			  							<th style="widows: 50%;">EARNINGS</th>
			  							<th style="width: 25%;">AMOUNT</th>
			  							<th style="text-align: right; width: 25%;">YTD</th>
			  						</tr>
			  					</thead>
			  					<tbody>
			  						<tr>
			  							<td>Basic Pay</td>
			  							<td>ZMW 5780.00</td>
			  							<td style="text-align: right;">ZMW 5780.0 X 3 </td>
			  						</tr>

			  						<tr>
			  							<td>Electricity</td>
			  							<td>ZMW 450.00</td>
			  							<td style="text-align: right;">ZMW 450.0 X 3 </td>
			  						</tr>
			  						<tr>
			  							<td>Water</td>
			  							<td>ZMW 125.00</td>
			  							<td style="text-align: right;">ZMW 125.0 X 3 </td>
			  						</tr>
			  						<tr>
			  							<th>Gross Earning</th>
			  							<th>ZMW 125.00</th>
			  							<td></td>
			  						</tr>
			  					</tbody>
			  				</table>
			  				<table class="deductiondetails">
			  					<thead style="border-bottom: 2px dashed mediumblue; padding-bottom: 2px; color: tomato;">
			  						<tr>
			  							<th style="widows: 50%;">DEDUCTIONS</th>
			  							<th style="width: 25%;">AMOUNT</th>
			  							<th style="text-align: right; width: 25%;">YTD</th>
			  						</tr>
			  					</thead>
			  					<tbody style="border-bottom: 2px solid tomato">
			  						<tr>
			  							<td>Pay as you earn</td>
			  							<td>ZMW 467.00</td>
			  							<td style="text-align: right;">ZMW 467.00 X 3 </td>
			  						</tr>
			  						<tr>
			  							<td>Stanchart loan</td>
			  							<td>ZMW 600.00</td>
			  							<td style="text-align: right;">ZMW 600.00 X 3 </td>
			  						</tr>
			  						<tr>
			  							<td>Personal levy</td>
			  							<td>ZMW 125.00</td>
			  							<td style="text-align: right;">ZMW 125.00 X 3 </td>
			  						</tr>
			  						<tr>
			  							<th>Total Deductions</th>
			  							<th>ZMW 1567.00</th>
			  							<td></td>
			  						</tr>
			  					</tbody>
			  					<tfoot>
			  						<tr style="color:#fff; background-color: #1e1e1e;">
			  							<th>NET PAY</th>
			  							<th></th>
			  							<th style="text-align: right;">ZMW 5670.00</th>
			  						</tr>
			  					</tfoot>
			  				</table>

			  			</div>
			  		</div>			
			    </div>
      		</section>
      	</div>
    </div>
	<script>
		window.addEventListener("load", window.print());
	</script>
</body>
</html>