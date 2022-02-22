<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");
  	if (isset($_GET['payroll-id'])) {
  	 
	  	$payroll_id = $_GET['payroll-id'];
	    $staff_id = $_GET['staff-id'];
	    $parent_id = $_SESSION['parent_id'];
	}
 
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo getStaffMemberNames($connect, $staff_id, $parent_id) ?> Payslip</title>
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
      				if (isset($_GET['payroll-id'])) {
  	 
					  	$payroll_id = $_GET['payroll-id'];
					    $staff_id = $_GET['staff-id'];
					    $parent_id = $_SESSION['parent_id'];
		
				  		$query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND parent_id = ? AND staff_id = ? ");
					    $query->execute(array($payroll_id, $parent_id, $staff_id));
					    $row = $query->fetch();
					    $pay_date = $row['pay_date'];
					    $man_number = $row['man_number'];
					    $payment_method = $row['payment_method'];
					    $account_number = $row['account_number'];
					    $net_pay = $row['net_pay'];
					    $the_currency = $row['the_currency'];
					    $salary_amount = $row['salary_amount'];
					    $grosspay = $row['grosspay'];
					    $total_deductions = $row['total_deductions'];
					    $period = 1;
      			?>
      			<div class="container mt-5 mb-5">
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
				  				<p class="fs-5">Payslip for the month of: <b><?php echo date("F, Y", strtotime($pay_date))?></b></p>
				  				<p class="text-primary"><strong>Staff Details:</strong></p>
				  				<div class="main_box">
					  				<div class="col-md-8 boxes1">
						  				<table class="table table-borderless">
						  					<tr>
						  						<th>Name</th>
						  						<th>: <?php echo getStaffMemberNames($connect, $staff_id, $parent_id) ?></th>
						  					</tr>
						  					<tr>
						  						<th>Designation</th>
						  						<th>: <?php echo getStaffMemberRole($connect, $staff_id, $parent_id)?></th>
						  					</tr>
						  					<tr>
						  						<th>Man Number</th>
						  						<th>: <?php echo $man_number; ?></th>
						  					</tr>
						  				</table>
						  			</div>
						  			<div class="col-md-4 boxes2">
						  				<p><strong>NET PAY: <?php echo $the_currency ?> <?php echo $net_pay ?></strong></p>
						  				<p>Account No: ******* <?php echo substr($account_number, 0, 3) ?></p>
						  			</div>
						  		</div>
				  			</div>
				  			<div class="col-md-12">
				  				<table id="earningdetails">
				  					<thead>
				  						<tr>
				  							<th style="widows: 65%;">EARNINGS</th>
				  							<th style="width: 35%; text-align: right">AMOUNT</th>
				  						</tr>
				  					</thead>
				  					<tbody>
				  						<tr>
				  							<td><strong>Basic Pay</strong></td>
				  							<td style="text-align:right"><?php echo $the_currency ?> <?php echo $salary_amount ?></td>
				  							
				  						</tr>
				  						<?php
				                    		$output = ''; 
				                    		$sql = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
				                    		$sql->execute(array($payroll_id, $staff_id,  $parent_id));
				                    		$result = $sql->fetchAll();
				                    		foreach ($result as $roq) {?>
				                    			<tr>
						  							<td><?php echo $roq['allowance_name'] ?></td>
						  							<td style="text-align:right"><?php echo $the_currency ?> <?php echo $roq['allowance_amount'] ?></td>
						  						</tr>

				                    	<?php
				                    		}
				                    	
				                    	?>
				  						
				  						
				  						<tr>
				  							<th>Gross Earning</th>
				  							<th style="text-align:right"><?php echo $the_currency ?> <?php echo $grosspay ?></th>
				  						</tr>
				  					</tbody>
				  				</table>
				  				<table class="deductiondetails">
				  					<thead style="border-bottom: 2px dashed mediumblue; padding-bottom: 2px; color: tomato;">
				  						<tr>
				  							<th style="widows: 65%;">DEDUCTIONS</th>
				  							<th style="width: 35%; text-align: right">AMOUNT</th>
				  						</tr>
				  					</thead>
				  					<tbody style="border-bottom: 2px solid tomato">
				  						<?php
				  							$sql_deduc = $connect->prepare("SELECT * FROM payroll_deductions WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
				                    		$sql_deduc->execute(array($payroll_id, $staff_id, $parent_id));
				                    		$result = $sql_deduc->fetchAll();
				                    		foreach ($result as $rows) { 
				  						?>
				  							<tr>
					  							<td><?php echo $rows['deduction_name'] ?></td>
					  							<td style="text-align:right"><?php echo $the_currency ?> <?php echo $rows['deduction_amount'] ?></td>
					  						</tr>
				  						<?php
				  							}
				  						?>
				  						
				  						<tr>
				  							<th>Total Deductions</th>
				  							<th><?php echo $the_currency ?> <?php echo $total_deductions ?></th>
				  						</tr>
				  					</tbody>
				  					<tfoot>
				  						<tr style="background-color: #ddd;">
				  							<th>NET PAY</th>
				  							<th style="text-align: right;"><?php echo $the_currency ?> <?php echo $net_pay ?></th>
				  						</tr>
				  					</tfoot>
				  				</table>

				  			</div>
				  		</div>
				  	</div> 
				</div>
				<?php }?>		
      		</section>
      	</div>
    </div>
	<script>
		window.addEventListener("load", window.print());
	</script>
</body>
</html>