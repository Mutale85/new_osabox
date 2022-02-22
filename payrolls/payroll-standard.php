<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payslip Standard</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.debug.js" ></script>
	<style>
		.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
		    border-color: #ff80ac;
		    height: 40px !important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
		    width: 100%;
		    margin-left: .375rem;
		    height: 40px;
		}
		.select2-container--default .select2-selection--single {
		    background-color: #f8f9fa;
		    border: 1px solid #aaa;
		    border-radius: 4px;
		    height: 40px;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__rendered {
		    box-sizing: border-box;
		    list-style: none;
		    margin: 0;
		    padding: .4em;
		    width: 100%;
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
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">

  						</div>
      				</div>
      			</div>
      		</section>
      		<section>
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));
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
      			?>
      			<div class="container">
      				<div class="row">
      					<div class="col-md-1"></div>
      					<div class="col-md-10">
			      			<div class="card shadow">
			      				<div class="card-header">
			      					<h4 class="card-title">Standard Payslip Template</h4>
			      				</div>
			      				<div class="card-body">
			      					<div class="container mt-5 mb-5">
									    <div class="row">
									        <div class="col-md-12"  id="element-to-print">
									            <div class="text-center lh-1 mb-2">
									                <h6 class="fw-bold">Payslip</h6> <span class="fw-normal">Payment slip for the month of <strong><?php echo date("F, Y", strtotime($pay_date))?></strong></span>
									            </div>
									            <div class="d-flex justify-content-end"> <span>Working Branch: <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?></span> </div>
									            <div class="row">
									                <div class="col-md-10">
									                    <div class="row">
									                        <div class="col-md-6">
									                            <div> <span class="fw-bolder">Man No:</span> <strong class="ms-3"><?php echo $man_number; ?></strong> </div>
									                        </div>
									                        <div class="col-md-6">
									                            <div> <span class="fw-bolder">Staff Name: </span> <strong class="ms-3"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id) ?></strong> </div>
									                        </div>
									                    </div>
									                    
									                    <div class="row">
									                        <div class="col-md-6">
									                            
									                        </div>
									                        <div class="col-md-6">
									                            <div> <span class="fw-bolder">Mode of Pay: </span> <strong class="ms-3"><?php echo $payment_method ?></strong> </div>
									                        </div>
									                    </div>
									                    <div class="row">
									                        <div class="col-md-6">
									                            <div> <span class="fw-bolder">Designation</span> <strong class="ms-3"><?php echo getStaffMemberRole($connect, $staff_id, $parent_id)?></strong> </div>
									                        </div>
									                        <div class="col-md-6">
									                            <div> <span class="fw-bolder">Ac No.</span> <strong class="ms-3">******* <?php echo substr($account_number, 0, 3) ?> </strong> </div>
									                        </div>
									                    </div>
									                </div>
									                <table class="mt-4 table table-bordered" style="width: 100%;">
									                    <thead class="bg-dark text-white">
									                        <tr>
									                            <th scope="col">Earnings</th>
									                            <th scope="col">Amount</th>
									                            <th scope="col">Deductions</th>
									                            <th scope="col">Amount</th>
									                        </tr>
									                    </thead>
									                    <tbody>
									                    	<?php
									                    		$output = ''; 
									                    		$sql = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
									                    		$sql->execute(array($payroll_id, $parent_id, $staff_id));
									                    		$result = $sql->fetchAll();
									                    		foreach ($result as $row) {
									                    			$output .= '
									                    				<th scope="row">'.$row['allowance_name'].'</th>
									                            		<td>'.$row['allowance_amount'].'</td>
									                    			'; 
									                    		}

									                    		$sql_deduc = $connect->prepare("SELECT * FROM payroll_deductions WHERE payroll_id = ? AND employee_id = ? and parent_id = ?");
									                    		$sql_deduc->execute(array($payroll_id, $parent_id, $staff_id));
									                    		$result = $sql_deduc->fetchAll();
									                    		foreach ($result as $row) {
									                    			$output .= '
									                    				<th scope="row">'.$row['deduction_name'].'</th>
									                            		<td>'.$row['deduction_amount'].'</td>
									                    			'; 
									                    		}
									                    		$query = $connect->prepare("SELECT payroll_deductions.*, payroll_allowances.* FROM `payroll_deductions` JOIN payroll_allowances ON payroll_deductions.payroll_id = payroll_allowances.payroll_id WHERE payroll_deductions.employee_id = ? AND payroll_allowances.parent_id = ?");
									                    		$query->execute(array($staff_id, $parent_id));
									                    		foreach ($query->fetchAll() as $row) {?>
									                    			
									                    	<?php
									                    		}
									                    	?>
									                       

									                        <tr>
									                            <th scope="row">DA</th>
									                            <td>550.00</td>
									                            <td>ESI</td>
									                            <td>142.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">HRA</th>
									                            <td>1650.00 </td>
									                            <td>TDS</td>
									                            <td>0.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">WA</th>
									                            <td>120.00 </td>
									                            <td>LOP</td>
									                            <td>0.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">CA</th>
									                            <td>0.00 </td>
									                            <td>PT</td>
									                            <td>0.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">CCA</th>
									                            <td>0.00 </td>
									                            <td>SPL. Deduction</td>
									                            <td>500.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">MA</th>
									                            <td>3000.00</td>
									                            <td>EWF</td>
									                            <td>0.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Sales Incentive</th>
									                            <td>0.00</td>
									                            <td>CD</td>
									                            <td>0.00</td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Leave Encashment</th>
									                            <td>0.00</td>
									                            <td colspan="2"></td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Holiday Wages</th>
									                            <td>500.00</td>
									                            <td colspan="2"></td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Special Allowance</th>
									                            <td>100.00</td>
									                            <td colspan="2"></td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Bonus</th>
									                            <td>1400.00</td>
									                            <td colspan="2"></td>
									                        </tr>
									                        <tr>
									                            <th scope="row">Individual Incentive</th>
									                            <td>2400.00</td>
									                            <td colspan="2"></td>
									                        </tr>
									                        <tr class="border-top">
									                            <th scope="row">Total Earning</th>
									                            <td>25970.00</td>
									                            <td>Total Deductions</td>
									                            <td>2442.00</td>
									                        </tr>
									                    </tbody>
									                </table>
									            </div>
									            <div class="row">
									                <div class="col-md-4"> <br> <span class="fw-bold">Net Pay : 24528.00</span> </div>
									                <div class="border col-md-8">
									                    <div class="d-flex flex-column"> <span>In Words</span> <span>Twenty Five thousand nine hundred seventy only</span> </div>
									                </div>
									            </div>
									            <div class="d-flex justify-content-end">
									                <div class="d-flex flex-column mt-2"> <span class="fw-bolder">For Kalyan Jewellers</span> <span class="mt-4">Authorised Signatory</span> </div>
									                
									            </div>
									            <div class="row mt-5">
									            	<div>
									                	<a href="temp_one" target="_blank" class="btn btn-primary">Print</a>
									                </div>
									            </div>
									        </div>
									    </div>
									</div>
			      				</div>
			      			</div>
			      		</div>
			      		<div class="col-md-1"></div>
			      	</div>
			    </div>
      		</section>
      		<aside class="control-sidebar control-sidebar-dark"></aside>
      	</div>
      	
    </div>
    <?php include("footer_links.php")?>
</body>
</html>