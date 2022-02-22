<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payslip for <?php echo getStaffMemberNames($connect, $_GET['staff-id'], $_GET['parent-id']) ?></title>
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
	</style>	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2  ">
  							<div class="callout callout-info">
				              	<h5><i class="fas fa-info"></i> Note:</h5>
				              This page has been enhanced for printing. Click the print button of the payslip to test.
				            </div>
  						</div>
      				</div>
      			</div>
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $payroll_id = $_GET['payroll-id'];
			        $staff_id = $_GET['staff-id'];
			        $parent_id = $_SESSION['parent_id'];

			        $query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND parent_id = ? AND staff_id = ? ");
			        $query->execute(array($payroll_id, $parent_id, $staff_id));
			        $count_rows = $query->rowCount();
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
			        $bank_name = $row['bank_name'];
      			?>
      			<div class="container mb-5">
		            <div class="invoice p-3 mb-3">
		              <div class="row">
		                <div class="col-12">
		                  <h4>
		                    <i class="fas fa-globe"></i> <?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?>.
		                    <small class="float-right">Date: <?php echo date("d/m/Y", strtotime($pay_date))?></small>
		                  </h4>
		                </div>
		              </div>
		              <div class="row invoice-info">
		                <div class="col-sm-4 invoice-col">
		                  
		                  <address>
		                    <strong><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></strong><br>
		                    <?php echo getOrganisationAddressDetailsForPDF($connect, $_SESSION['parent_id'])?>
		                  </address>
		                </div>
		                <div class="col-sm-4 invoice-col">
		                  
		                  <address>
		                    <strong><?php echo strtoupper(getStaffMemberNames($connect, $staff_id, $parent_id)) ?></strong><br>
		                    <b>Man Number:</b> <?php echo $man_number ?><br>
		                    
		                  </address>
		                </div>
		                <div class="col-sm-4 invoice-col">
		                  <b>Payslip No: <?php echo $count_rows ?></b><br>
		                  <br>
		                  
		                  <b>Bank Name:</b> <?php echo $bank_name ?><br>
		                  <b>Account:</b> ******* <?php echo substr($account_number, 0, 3) ?>
		                </div>
		              </div>
		              <style>
		              	.row_table {
							margin-left:-5px;
							margin-right:-5px;
						}

						.column {
							float: left;
							width: 50%;
							padding: 5px;
						}
						.row_table::after {
							content: "";
							clear: both;
							display: table;
						}
						table.column_tale {
							border-collapse: collapse;
							border-spacing: 0;
							width: 100%;
							border: 1px solid #ddd;
						}

						table.column_tale th, table.column_tale td {
							text-align: left;
							padding: 16px;
						}

						table.column_tale tr:nth-child(even) {
							background-color: #f2f2f2;
						}
		              </style>
		              <div class="row">
		                <div class="col-12 table-responsive mb-5">
		                  
	                    	<div class="row_table">
		                    	<div class="column">
		                    		<table class="column_tale">
		                    			<tr>
					                      	<th>S/N</th>
					                      	<th>Allowances</th>
					                      	<th>Amount</th>
					                    </tr>
				                    	<?php
				                    		$output = ""; 
				                    		$sql = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? and parent_id = ?  ");
											$sql->execute(array($payroll_id, $staff_id,  $parent_id));
											$result = $sql->fetchAll();
											$i = 1;
											foreach ($result as $roq) {
												$output .=' 
													<tr>
														<td>'.$i++.'</td>
														<td>'.$roq['allowance_name'].'</td>
														<td>'.$the_currency.' '.$roq['allowance_amount'].'</td>
													</tr>
													';
											}
											echo $output;
										?>
									</table>
								</div>
								<div class="column">
									<table class="column_tale">
										<tr>
					                      	<th>S/N</th>
					                      	<th>Deduction</th>
					                      	<th>Amount</th>
					                    </tr>
										<?php  
				                    		$sql = $connect->prepare("SELECT * FROM  payroll_deductions WHERE payroll_id = ? AND employee_id = ? and parent_id = ? ");
											$sql->execute(array($payroll_id, $staff_id,  $parent_id));
											$result = $sql->fetchAll();
											foreach ($result as $roq) {
												$output .='
													<tr> 
														<td>'.$i++.'</td>
														<td>'.$roq['deduction_name'].'</td>
														<td>'.$the_currency.' '.$roq['deduction_amount'].'</td>
													</tr>
													';
											}

											echo $output;
				                    	?>
				                    </table>
			                    </div>
	                    	</div>
		                    
		                </div>
		              </div>

		              <div class="row">
		                <!-- accepted payments column -->
		                <div class="col-6">
		                  <p class="lead">Payment Methods:</p>
		                  	<?php echo strtoupper($payment_method) ?>
		                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;"></p>
		                </div>
		                <div class="col-6">
		                  <div class="table-responsive">
		                    <table class="table">
		                      <tr>
		                        <th style="width:50%">GROSS PAY:</th>
		                        <td style="text-align: right;"><?php echo $the_currency ?> <strong><?php echo $grosspay ?></strong></td>
		                      </tr>
		                      <tr>
		                        <th>Total Deductions</th>
		                        <td style="text-align: right;"><?php echo $the_currency ?> <strong><?php echo$total_deductions ?></strong></td>
		                      </tr>
		                      
		                      <tr>
		                        <th>NET PAY:</th>
		                        <td style="text-align: right;"><?php echo $the_currency ?> <strong><?php echo $net_pay ?></strong></td>
		                      </tr>
		                    </table>
		                  </div>
		                </div>
		              </div>
		              <div class="row no-print">
		                <div class="col-12">
		                  <a href="payslip-two-print?payroll-id=<?php echo $payroll_id?>&parent-id=<?php echo $parent_id?>&staff-id=<?php echo $staff_id ?>" rel="noopener" target="_blank" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
		                    <i class="bi bi-printer"></i> PRINT Payslip
		                  </a>

		                  <a href="payslip-two-pdf?payroll-id=<?php echo $payroll_id?>&parent-id=<?php echo $parent_id?>&staff-id=<?php echo $staff_id ?>" rel="noopener" target="_blank" type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
		                    <i class="bi bi-file-pdf"></i> Generate Payslip
		                  </a>
		                </div>
		              </div>
		            </div>
            <!-- /.invoice -->
			    </div>
			    <div class="container mb-5">
			    	<br><br><br>
			    </div>
      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <?php include("footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script></script>
</body>
</html>