<?php 
      require ("../../includes/db.php");
      require ("../../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Payroll</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">


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
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h4> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> BRANCH </h4>
  						</div>
      				</div>
      			</div>
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM payroll_allowances WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));
			        if (isset($_GET['allowed_user_id'])) {
			        	$parent_id = preg_replace("#[^0-9]#", "", $_GET['allowed_user_id']);
      			?>
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-info">
      							<div class="card-header">
      								<h3 class="card-title">Pay Roll</h3>
      							</div>
      							<div class="card-body">
      								<div class="table table-responsive">
      									<table class="cell-table table-sm" id="payrollTable" style="width: 100%">
      										<thead>
      											<tr>
      												<th>Staff</th>
      												<th>Pay Day</th>
      												<th>Gross Pay</th>
      												<th>Deductions</th>
      												<th>Net Pay</th>
      												<th>View</th>
      												<th>PDF Payslip</th>
      											</tr>
      										</thead>
      										<tbody>
      											<?php
      												$query = $connect->prepare("SELECT * FROM payroll WHERE parent_id = ? ");
      												$query->execute(array($parent_id));
      												foreach ($query as $row) {
      													extract($row);
      											?>
      											<tr class="text-dark">
      												<td><?php echo getStaffMemberNames($connect, $employee_id, $parent_id)?></td>
      												<td><?php echo $pay_date ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($grosspay, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($total_deductions, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($net_pay, 2) ?></td>
      												
      												<td>
      													<a href="payroll/staff_payroll?payroll_id=<?php echo $id;?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>" target="_blank"><small>View Payroll</small> </a>
      												</td>
                                                                              <td><a href="payroll/staffpayrollprint?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>"><small>Print Payslip <i class="bi bi-printer"></i></small> </a></td>
      											</tr>
      											<?php
      												}
      											?>
      										</tbody>
      									</table>
      								</div>
      							</div>
      						</div>
      					</div>
      				</div>
      			</div>
      			<?php }else{?>
      				<div class="container-fluid">
      					<div class="row">
      						<div class="col-md-12">
      							<div class="card card-primary">
      								<div class="card-header">
      									<h4 class="card-title">Pay Roll</h4>
      								</div>
      								<div class="card-body">
      									<div class="table table-responsive">
      									<table class="cell-table table-sm" id="payrollTable" style="width: 100%">
      										<thead>
      											<tr>
      												<th>Staff</th>
      												<th>Pay Day</th>
      												<th>Gross Pay</th>
      												<th>Deductions</th>
      												<th>Net Pay</th>
      												<th>Payslip</th>
      												<th>View</th>
      											</tr>
      										</thead>
      										<tbody class="text-dark">
      											<?php
      												$query = $connect->prepare("SELECT * FROM payroll WHERE parent_id = ? ");
      												$query->execute(array($_SESSION['parent_id']));
      												foreach ($query as $row) {
      													extract($row);
      											?>
      											<tr>
      												<td><?php echo getStaffMemberNames($connect, $employee_id, $parent_id)?></td>
      												<td><?php echo $pay_date ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($grosspay, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($total_deductions, 2) ?></td>
      												<td><small><?php echo $the_currency?></small> <?php echo number_format($net_pay, 2) ?></td>
      												<td><a href="payroll/staffpayrollprint?payroll_id=<?php echo $id?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>" target="_blank"><small>Print Payslip <i class="bi bi-printer"></i></small> </a></td>
      												<td>
      													<a href="payroll/staff_payroll?payroll_id=<?php echo $id;?>&parent_id=<?php echo $parent_id?>&staff_id=<?php echo $employee_id?>"><small>View Payroll</small> </a>
      												</td>
      											</tr>
      											<?php
      												}
      											?>
      										</tbody>
      									</table>
      								</div>
      								</div>
      							</div>
      						</div>
      					</div>
      				</div>

      			<?php }?>
      			
      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>


    </div>
    <?php include("../footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>
		//========== GET CURRENCY
		// document.addEventListener('DOMContentLoaded', function () {
		//  	var currency_span = document.getElementById('currency_span');
		//  	var the_currency = document.getElementById('the_currency');
		//  	if (localStorage['currency']) { 
		//      	currency_span.innerHTML = localStorage['currency'];
		//      	the_currency.value = localStorage['currency'];
		//  	}
		// });

		
		// ================================= DISPLAYS ======================================
		$("#payrollTable").DataTable();
		function successNow(msg){
			toastr.success(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	      	toastr.options.showDuration = 1000;
	    }

		function errorNow(msg){
			toastr.error(msg);
	      	toastr.options.progressBar = true;
	      	toastr.options.positionClass = "toast-top-center";
	      	toastr.options.showDuration = 1000;
	    } 
	</script>

</body>
</html>