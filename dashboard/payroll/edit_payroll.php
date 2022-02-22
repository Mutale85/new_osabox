<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php"); 
  	 
  	if (isset($_GET['payroll_id']) AND isset($_GET['parent_id'])) {
    	$payroll_id = preg_replace("#[^0-9]#", "", $_GET['payroll_id']);
    	$parent_id = preg_replace("#[^0-9]#", "", $_GET['parent_id']);
    	$staff_id = preg_replace("#[^0-9]#", "", $_GET['staff_id']);
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> Edit payroll</title>
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
			<section class="content bg-light mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h1 class="h3"> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> BRANCH </h1>
  						</div>
      				</div>
      			</div>
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));

			        $editQuery = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND employee_id = ? AND parent_id = ? ");
					$editQuery->execute(array($payroll_id, $staff_id, $parent_id));
					$rows = $editQuery->fetch();
					if ($rows) {
						if ($rows['payment_type'] == "weekly") {
							$options = '
								<option value="">Select</option>
								<option value="weekly" selected>Weekly</option>
								<option value="monthly">Monthly</option>
							';
						}elseif ($rows['payment_type'] == 'monthly') {
							$options = '
								<option value="">Select</option>
								<option value="weekly">Weekly</option>
								<option value="monthly" selected>Monthly</option>
							';
						}

						$pay_scale = $rows['pay_scale'];
						$salary_amount = $rows['salary_amount'];
						$the_currency = $rows['the_currency'];
					}
      			?>
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-info">
      							<div class="card-header">
      								<h3 class="card-title"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> BASIC PAY SCALE</h3>
      							</div>
      							<form method="post" id="salaryForm" enctype="multipart/form-data">
	      							<div class="card-body">
	  									<div class="d-flex justify-content-between">
	  										<div class="form-group col-md-6">
	      										<label>Payment Type</label>
	      										<select class="form-control" name="payment_type" id="payment_type" required="">
	      											<?php echo $options?>
	      										</select>
	      									</div>
	  										
	  										<div class="form-group col-md-6">
	  											<label>PayDay</label>
	  											<input type="text" name="pay_date" id="pay_date" class="form-control" autocomplete="off" placeholder="Enter Date" required value="<?php echo $rows['pay_date']?>">
	  										</div>
	  									</div>
	  									<div class="form-group">
	  										<label>Selected Employee</label>
	  										<select class="select2" name="employee" id="employee" style="width: 100%;">
	  											
											 <option value="<?php echo $staff_id?>" selected><?php echo getStaffMemberNames($connect, $staff_id, $parent_id) ?></option>
											    
										    </select>
	  									</div>
	  									<div class="form-group">
	  										<label>Select Basic Pay</label>
	  										<select class="select2" name="pay_scale" id="pay_scale" style="width: 100%;">
	  											<option value=""></option>
	  											<?php
	  												foreach ($query->fetchAll() as $row) {
	  													extract($row);
	  													if ($pay_scale == $p_id ) {
	  														$op = '<option value="'.$pay_scale.'" data-amount="'.$salary_amount.'" selected>'.$salary_scale_name.' (<small> '.$currency.'</small>  '.$salary_amount .' )</option>';
	  													}else{
	  														$op = '<option value="'.$p_id.'" data-amount="'.$amount.'">'.$salary_scale_name .' (<small>'.$currency.'</small> '.$amount .' )</option>';
	  													}
	  													echo $op;
	  											?>
											    <?php
											        }
	  											?>
										    </select>
										    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>"> <!-- branchID -->
	  									</div>
	  									<div class="form-group">
									    	<label>Selected Pay</label>
									    	<div class="input-group">
												<span class="input-group-text" id="currency_span"></span>
									    		<input type="text" name="salary_amount" id="salary_amount" class="form-control" value="<?php echo $salary_amount?>" readonly>
									    	</div>
									    	<input type="hidden" name="the_currency" id="the_currency" class="form-control" value="<?php echo $the_currency?>">
									    	<input type="hidden" name="payrollID" id="payrollID" class="form-control" value="<?php echo $payroll_id?>">
									    </div>
	  									<div class="col-md-12">
	  										<div class="border-bottom border-warning mb-4"></div>
	  										
	  										<?php
	  											$output = "";
	  											$sql = $connect->prepare("SELECT * FROM salary_allowances WHERE parent_id = ?");
	  											$sql->execute(array($_SESSION['parent_id']));
	  											
	  										?>

	  										<?php
	  											$output = "";
	  											$query = $connect->prepare("SELECT * FROM salary_deductions WHERE parent_id = ?");
	  											$query->execute(array($_SESSION['parent_id']));
	  											
	  										?>
	  									</div>
	  									<div class="row">
	      									<div class="col-md-6">
	      										<div class="card-header card-success">
	      											<h4 class="card-title">Allowances</h4>
	      										</div>
	      										<div class="card-body">
	      											<?php 
	      												if ($sql->rowCount() > 0) {
		      												foreach ($sql->fetchAll() as $row) {
			      												$find = $connect->prepare("SELECT * FROM payroll_allowances WHERE payroll_id = ? AND parent_id = ? AND allowance_id = ? ");
			      												$find->execute(array($payroll_id, $parent_id, $row['id']));
			      												$r = $find->fetch();
		      													if ($r) {
		      													
		      												
		      											?>

		      													<div class="form-group">
																	<label><?php echo $row['name']?></label>
																	<div class="input-group">
																		<span class="input-group-text" id="currency_<?php echo $row['id']?>"></span>
																			<input type="number" step="any" name="allowance_amount[]" id="allowance_amount" class="form-control" placeholder="" min="0" max="1000000" value="<?php echo $r['allowance_amount'] ?>">
																		</div>
																		<input type="hidden" step="any" name="allowance_id[]" id="allowance_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">
																		
																	</div>
																	<script>
																		document.addEventListener('DOMContentLoaded', function () {
																	 	var currency_ = document.getElementById('currency_<?php echo $row['id']?>');
																	 	var currency = document.getElementById('currency');
																	 	if (localStorage['currency']) { 
																	     	currency_.innerHTML = localStorage['currency'];
																	 	}
																	});

																	</script>		
		      										<?php	
		      													}
		      												}
		      											}else{
		      												$output .= '<a href="payroll_settings">Payroll Settings</a>';
		      											}
	      											?>

	      										</div>
		      								</div>
	      									<div class="col-md-6">
	      										<div class="card-header card-warning">
	      											<h4 class="card-title">Deductions</h4>
	      										</div>
	      										<div class="card-body">

	      											<?php 
	      												if ($query->rowCount() > 0) {
		      												foreach ($query->fetchAll() as $row) {
		      													$dfind = $connect->prepare("SELECT * FROM payroll_deductions WHERE payroll_id = ? AND parent_id = ? AND deduction_id = ? ");
			      												$dfind->execute(array($payroll_id, $parent_id, $row['id']));
			      												$dr = $dfind->fetch();
		      													if ($dr) {
		      										?>			
		      													<div class="form-group">
																		<label><?php echo $row['name']?></label>
																		<div class="input-group">
																		<span class="input-group-text" id="currency__<?php echo $row['id']?>"></span>
																			<input type="number" step="any" name="deduction_amount[]" id="deduction_amount" class="form-control" placeholder="" min="0" max="1000000" value="<?php echo $dr['deduction_amount'] ?>">
																		</div>
																		<input type="hidden" step="any" name="deduction_id[]" id="deduction_id" class="form-control" placeholder="" value="<?php echo $row['id']?>">
																		
																	</div>
																	<script>
																		document.addEventListener('DOMContentLoaded', function () {
																	 	var currency__ = document.getElementById('currency__<?php echo $row['id']?>');
																	 	var currency = document.getElementById('currency');
																	 	if (localStorage['currency']) { 
																	     	currency__.innerHTML = localStorage['currency'];
																	 	}
																	});
																	</script>
		      																
		      										<?php	
		      													}
		      												}
		      											}else{
		      												$output .= '<a href="payroll_settings">Payroll Settings</a>';
		      											}
	      											?>
	      										</div>
		      								</div>
		      							</div>
	      							</div>
	      							<div class="card-footer">	      								
										<button class="btn btn-outline-secondary Calculate" id="Calculate" type="button">Calculate</button>
	      							</div>
	      							<div class="card-body">
	      								
	      								<div id="calculations"></div>
	      								
	      							</div>
	      						</form>
      						</div>
      					</div>
      				</div>
      			</div>
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
		document.addEventListener('DOMContentLoaded', function () {
		 	var currency_span = document.getElementById('currency_span');
		 	var the_currency = document.getElementById('the_currency');
		 	if (localStorage['currency']) { 
		     	currency_span.innerHTML = localStorage['currency'];
		     	the_currency.value = localStorage['currency'];
		 	}
		});

		$(function() {
		    $('.select').multipleSelect({
		      	filter: true,
		      	customFilter: function (label, text, originalLabel, originalText) {
		        if ($('input').prop('checked')) {
		          	return originalLabel.indexOf(originalText) === 0
		        }
		        	return label.indexOf(text) === 0
		      	}
		    })
		})

		$(function(){
			// $("#salaryATable").DataTable();
			// $("#salaryDTable").DataTable();
			// $("#basicPayTable").DataTable();
			$("#pay_date").datepicker({
				format:'yyyy-mm-dd',
				startDate: '-1d',
				todayHighlight:true,
				zIndexOffset: 99999,
				autoclose:true
			});


			$("#Calculate").click(function(e){
				e.preventDefault();
				// alert("Hello");
				var salaryForm = document.getElementById('salaryForm');
				var data = new FormData(salaryForm);
				var url = 'payroll/calculations';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						$("#calculations").html(data);
						$("#Calculate").html("Calculate");
					}
				})
			})


			// =================== SUBMITE THE data =================================

			$("#salaryForm").submit(function(e){
				e.preventDefault();
				var salaryForm = document.getElementById('salaryForm');
				var pay_date = document.getElementById('pay_date');
				if (pay_date.value === "") {
					alert("Pay Date is requird");
					pay_date.focus();
					return false;
				}
				var data = new FormData(salaryForm);
				var url = 'payroll/submitPayroll';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#submitPay").html("<i class='fa fa-spinner fa-spin'></i>");
						$("#calculations").attr("disabled", "disabled");
					},
					success:function(data){

						if (data === 'done') {
							successNow("Payroll Submitted");
							setTimeout(function(){
								window.location = 'payroll/view_payroll?allowed_user_id=<?php echo $_SESSION['parent_id']?>';
							}, 2000);
						}else if(data === 'Updated'){
							successNow("Payroll Updated");
							setTimeout(function(){
								window.location = 'payroll/staff_payroll?payroll_id=<?php echo $_GET['payroll_id']?>&parent_id=<?php echo $_GET['parent_id']?>&staff_id=<?php echo $_GET['staff_id']?>';
							}, 2000);
							
						}else{
							errorNow(data);
						}
					}
				})
			})

		})	

		
		// ================================= DISPLAYS ======================================
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

	    $(document).on("change", "#pay_scale", function(){
	    	var salary_amount = document.getElementById('salary_amount');
	    	var grosspay = document.getElementById('grosspay');
	    	var pay = $(this).find(':selected').data('amount');
	    	salary_amount.value = pay;
	    	// grosspay.value = pay;
	    })
 
	</script>

</body>
</html>