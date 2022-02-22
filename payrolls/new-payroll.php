<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php"); 
  	 
  	if (isset($_GET['staff-id']) AND isset($_GET['parent_id'])) {
    	$parent_id = preg_replace("#[^0-9]#", "", $_GET['parent_id']);
    	$staff_id = preg_replace("#[^0-9]#", "", $_GET['staff-id']);
    	$pay_scale = $the_currency = $salary_amount = $grosspay = $total_deductions = $net_pay = $payment_method = $pay_date = "";
    	if (isset($_GET['payroll_id'])) {
    		$PAYROLL_ID = $_GET['payroll_id'];
    		$query = $connect->prepare("SELECT * FROM payroll WHERE id = ? AND staff_id = ? AND parent_id = ? ");
    		$query->execute(array($PAYROLL_ID, $staff_id, $parent_id));
    		$row = $query->fetch();
    		$pay_scale = $row['pay_scale'];
    		$the_currency = $row['the_currency'];
    		$payroll_salary_amount = $row['salary_amount'];
    		$grosspay = $row['grosspay'];
    		$total_deductions = $row['total_deductions'];
    		$net_pay = $row['net_pay'];
    		$payment_method = $row['payment_method'];
    		$pay_date = $row['pay_date'];

    	}
    }

?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> Edit payroll</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">

</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<?php include ("dash_data.php"); ?>
			<section class="content">
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? AND id = ?  ");
			        $sql->execute(array($_SESSION['parent_id'], $staff_id));
			        $row = $sql->fetch();
			        if ($row) {
			        	extract($row);
			        	$position = $position;
			        }
			        
      			?>
      			
      			<!-- If payrol is set -->
      			<?php 
      				if (isset($_GET['payroll_id'])) {?>
      					<div class="container-fluid">
		      				<div class="row">
		      					<div class="col-md-12">
		      						<div class="card card-info">
		      							<div class="card-header">
		      								<h3 class="card-title"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> - <?php echo $position ?></h3>
		      								<div class="card-tools">
		      									<a href="" class="info"><i class="bi bi-info-circle"></i> Info</a>
		      								</div>
		      							</div>
		      							<form method="post" id="salaryForm" enctype="multipart/form-data">
			      							<div class="card-body">
			      								<?php 
			      									$man_number = $bank_name = $account_number = $PAYROLL_ID = "";
			      									$query = $connect->prepare("SELECT * FROM staff_members_addons WHERE staff_id = ? AND parent_id = ?");
			      									$query->execute(array($staff_id, $parent_id));
			      									if($query->rowCount() > 0){
			      										$roq = $query->fetch();
			      										$man_number = $roq['man_number'];
			      										$bank_name = $roq['bank_name'];
			      										$account_number = $roq['account_number'];
			      									}else{

			      									}
			      									
			      									$PAYROLL_ID  = $_GET['payroll_id'];
			      								?>
			  									<div class="row">
			  										<div class="form-group col-md-3">
				  										<label> MAN No / Work ID</label>
				  										
													    <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id?>" class="form-control" readonly>
													    <input type="text" name="man_number" id="man_number" class="form-control" placeholder="Staff ID" required="" value="<?php echo $man_number?>" readonly>
													    <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Add Man Number</a></em>
													    <input type="hidden" name="PAYROLL_ID" id="PAYROLL_ID" value="<?php echo $PAYROLL_ID?>">
				  									</div>
			  										<div class="form-group col-md-3">
			      										<label>Payment Type</label>
			      										<select class="form-control" name="payment_type" id="payment_type" required="">
			      											<option value="">Select</option>
			      											<option value="monthly" selected>Monthly</option>
			      										</select>
			      									</div>
			  										<div class="form-group col-md-3">
			  											<label>PayDay</label>
			  											<input type="text" name="pay_date" id="pay_date" class="form-control" autocomplete="off" placeholder="Enter Date" required value="<?php echo $pay_date?>">
			  										</div>
			  									
				  									<div class="form-group col-md-3">
				  										<label>Select Basic Pay</label>
				  										<select class="form-control" name="pay_scale" id="pay_scale" style="width: 100%;">
				  											<option value="" data-amount="00.00">Select</option>
				  											<?php
				  												$query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
														        $query->execute(array($_SESSION['parent_id']));
														        $salary_amount = "";
				  												foreach ($query->fetchAll() as $row) {
				  													extract($row);
				  													if ($pay_scale == $p_id ) {
				  														$op = '<option value="'.$pay_scale.'" data-amount="'.$payroll_salary_amount.'" selected>'.$salary_scale_name.' (<small> '.$currency.'</small>  '.$payroll_salary_amount .' )</option>';
				  													}else{
				  														$op = '<option value="'.$p_id.'" data-amount="'.$amount.'">'.$salary_scale_name .' (<small>'.$currency.'</small> '.$amount .' )</option>';
				  													}
				  													echo $op;
				  											?>
														    <?php
														        }
				  											?>
													    </select>
													    <a href="payroll-set-up" target="_blank"> Add Basic Pay</a>
													    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>"> <!-- branchID -->
				  									</div>
												</div>
												<div class="row">
													<div class="col-md-12">
														<h4 class="text-primary mb-4">Payment Distribution</h4>
													</div>
													<div class="col-md-3 mb-3">
														<label>Payment Method</label>
														<input class="form-control" name="payment_method" id="payment_method" required value="<?php echo $payment_method?>">
														<em>Cash</em>,
														<em>Wire Transfer</em>,
														<em>Bank Deposit</em>
													</div>
													<div class="col-md-3 mb-3">
														<label>Bank Name</label>
														<input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $bank_name?>" readonly>
														 <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Add Bank Name</a></em>
													</div>
													<div class="col-md-3 mb-3">
														<label>Account Number</label>
														<input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo $account_number?>" readonly>
														 <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Account Man Number</a></em>
													</div>
													<div class="form-group col-md-3">
												    	<label>Selected Basic Pay</label>
												    	<div class="input-group">
															<span class="input-group-text" id=""><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
												    		<input type="text" name="salary_amount" id="salary_amount" class="form-control" value="<?php echo $payroll_salary_amount?>" readonly>
												    	</div>
												    	<input type="hidden" name="the_currency" id="the_currency" class="form-control" value="<?php echo getCurrency($connect, $_SESSION['parent_id'])?>">
												    </div>
												</div>
			  									
			  									<div class="row mt-5">
			      									<div class="col-md-6">
			      										<div class="card-header card-success">
			      											<h4 class="card-title">Allowances</h4>
			      											<div class="card-tools">
											                  	<a href="" class="btn btn-success btn-sm addAllowance">
											                    	Add Allowance <i class="bi bi-plus"></i>
											                  	</a>
											                </div>
			      										</div>
			      										<div class="card-body">
			      											<div id="getAllowanceType"></div>
			      										</div>
				      								</div>
			      									<div class="col-md-6">
			      										<div class="card-header card-warning">
			      											<h4 class="card-title">Deductions</h4>
			      											<div class="card-tools">
											                  	<a href="" class="btn btn-warning btn-sm addDeduction">
											                    	Add Deduction <i class="bi bi-plus"></i>
											                  	</a>
											                </div>
			      										</div>
			      										<div class="card-body">
			      											<div class="getDeductionType"></div>
			      										</div>
				      								</div>
				      							</div>
			      							</div>
			      							<div class="card-body">
			      								<div class="getTotalCalculation"></div>
			      							</div>
			      						</form>
		      						</div>
		      					</div>
		      				</div>
		      			</div>
      			<?php
      				}else{?>
					<div class="container-fluid">
	      				<div class="row">
	      					<div class="col-md-12">
	      						<div class="card card-info">
	      							<div class="card-header">
	      								<h3 class="card-title"><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?> - <?php echo $position ?></h3>
	      								<div class="card-tools">
	      									<a href="" class="info"><i class="bi bi-info-circle"></i> Info</a>
	      								</div>
	      							</div>
	      							<form method="post" id="salaryForm" enctype="multipart/form-data">
		      							<div class="card-body">
		      								<?php 
		      									$man_number = $bank_name = $account_number = $PAYROLL_ID = "";
		      									$query = $connect->prepare("SELECT * FROM staff_members_addons WHERE staff_id = ? AND parent_id = ?");
		      									$query->execute(array($staff_id, $parent_id));
		      									if($query->rowCount() > 0){
		      										$roq = $query->fetch();
		      										$man_number = $roq['man_number'];
		      										$bank_name = $roq['bank_name'];
		      										$account_number = $roq['account_number'];
		      									}else{

		      									}
		      									// $check = $connect->prepare("SELECT * FROM `payroll` WHERE staff_id = ? AND parent_id = ?");
		      									// $check->execute(array($staff_id, $parent_id));
		      									// if($check->rowCount() > 0){
		      									// 	$row = $check->fetch();
		      									// 	$PAYROLL_ID = $row['id'];
		      									// }else{
		      									// 	$PAYROLL_ID = "";
		      									// }
		      								?>
		  									<div class="row">
		  										<div class="form-group col-md-3">
			  										<label> MAN No / Work ID</label>
			  										
												    <input type="hidden" name="staff_id" id="staff_id" value="<?php echo $staff_id?>" class="form-control" readonly>
												    <input type="text" name="man_number" id="man_number" class="form-control" placeholder="Staff ID" required="" value="<?php echo $man_number?>" readonly>
												    <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Add Man Number</a></em>
												    <input type="hidden" name="PAYROLL_ID" id="PAYROLL_ID" value="">
			  									</div>
		  										<div class="form-group col-md-3">
		      										<label>Payment Type</label>
		      										<select class="form-control" name="payment_type" id="payment_type" required="">
		      											<option value="">Select</option>
		      											<option value="monthly">Monthly</option>
		      										</select>
		      									</div>
		  										<div class="form-group col-md-3">
		  											<label>PayDay</label>
		  											<input type="text" name="pay_date" id="pay_date" class="form-control" autocomplete="off" placeholder="Enter Date" required value="">
		  										</div>
		  									
			  									<div class="form-group col-md-3">
			  										<label>Select Basic Pay</label>
			  										<select class="form-control" name="pay_scale" id="pay_scale" style="width: 100%;">
			  											<option value="" data-amount="00.00">Select</option>
			  											<?php
			  												$query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
													        $query->execute(array($_SESSION['parent_id']));
													        $salary_amount = "";
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
												    <a href="payroll-set-up" target="_blank"> Add Basic Pay</a>
												    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>"> <!-- branchID -->
			  									</div>
											</div>
											<div class="row">
												<div class="col-md-12">
													<h4 class="text-primary mb-4">Payment Distribution</h4>
												</div>
												<div class="col-md-3 mb-3">
													<label>Payment Method</label>
													<input class="form-control" name="payment_method" id="payment_method" required>
													<em>Cash</em>,
													<em>Wire Transfer</em>,
													<em>Bank Deposit</em>
												</div>
												<div class="col-md-3 mb-3">
													<label>Bank Name</label>
													<input type="text" name="bank_name" id="bank_name" class="form-control" value="<?php echo $bank_name?>" readonly>
													 <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Add Bank Name</a></em>
												</div>
												<div class="col-md-3 mb-3">
													<label>Account Number</label>
													<input type="text" name="account_number" id="account_number" class="form-control" value="<?php echo $account_number?>" readonly>
													 <em><a href="members/staff-members?accountDetails=<?php echo $staff_id?>" target="_blank" class="accountDetailsCookie" id="<?php echo $staff_id?>">Click to Account Man Number</a></em>
												</div>
												<div class="form-group col-md-3">
											    	<label>Selected Basic Pay</label>
											    	<div class="input-group">
														<span class="input-group-text" id=""><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
											    		<input type="text" name="salary_amount" id="salary_amount" class="form-control" value="<?php echo $salary_amount?>" readonly>
											    	</div>
											    	<input type="hidden" name="the_currency" id="the_currency" class="form-control" value="<?php echo getCurrency($connect, $_SESSION['parent_id'])?>">
											    </div>
											</div>
		  									
		  									<div class="row mt-5">
		      									<div class="col-md-6">
		      										<div class="card-header card-success">
		      											<h4 class="card-title">Allowances</h4>
		      											<div class="card-tools">
										                  	<a href="" class="btn btn-success btn-sm addAllowance">
										                    	Add Allowance <i class="bi bi-plus"></i>
										                  	</a>
										                </div>
		      										</div>
		      										<div class="card-body">
		      											<div id="getAllowanceType"></div>
		      										</div>
			      								</div>
		      									<div class="col-md-6">
		      										<div class="card-header card-warning">
		      											<h4 class="card-title">Deductions</h4>
		      											<div class="card-tools">
										                  	<a href="" class="btn btn-warning btn-sm addDeduction">
										                    	Add Deduction <i class="bi bi-plus"></i>
										                  	</a>
										                </div>
		      										</div>
		      										<div class="card-body">
		      											<div class="getDeductionType"></div>
		      										</div>
			      								</div>
			      							</div>
		      							</div>
		      							<div class="card-body">
		      								<div class="getTotalCalculation"></div>
		      							</div>
		      						</form>
	      						</div>
	      					</div>
	      				</div>
	      			</div>
      			<?php			
      				}
      			?>
      			<!-- Modal -->
      			<div class="modal fade" id="modal-warning">
			        <div class="modal-dialog">
			          	<div class="modal-content bg-warning">
			          		<form method="post" id="allowancesDeducForm" enctype="multipart/form-data">
					            <div class="modal-header">
					              	<h4 class="modal-title">Add <span id="modalname"></h4>
					              	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                	<span aria-hidden="true">&times;</span>
					              	</button>
					            </div>
				            	<div class="modal-body">  									
  									<div class="card-body">
										<div class="form-group">
											<label><span id="labelname"></span> Name</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-wallet"></i></span>
												<input type="text" name="name" id="name" class="form-control" required>
											</div>
										</div>

										<div class="form-group">
											<label> Amount</label>
											<div class="input-group">
												<span class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
												<input type="number" name="amount" id="amount" class="form-control" step="any" required >
											</div>
										</div>
										<input type="hidden" class="form-control" name="salary_addon" id="salary_addon">
										<em>You are setting up <span id="labelname_span"></span> that will appear on the pay of your staff.</em>
										<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
										<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
										<input type="hidden" name="staff_id" id="staff_id" value="<?php echo $_GET['staff-id']?>">
									</div>
			            		</div>
					            <div class="modal-footer justify-content-between">
					              	<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					              	<button type="submit" class="btn btn-outline-dark" id="allBtn">Save changes</button>
					            </div>
					        </form>
			          	</div>
			        </div>
			    </div>
			    <!-- End of Modal -->
      		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <?php include("footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		//========== GET CURRENCY

		$(function(){
			
			$("#pay_date").datepicker({
				format:'yyyy-mm-dd',
				startDate: '-1d',
				todayHighlight:true,
				zIndexOffset: 99999,
				autoclose:true
			});

			$(".info").click(function(e){
				e.preventDefault();
				successNow("If its your first time adding the staff member, you need to set up their <br> <ul><li>Man Number</li><li>Payment Method</li><li>Bank Name</li><li>Account Number</li></ul> ");
			})

			// =================== SUBMITE THE data =================================
			$(".addAllowance").click(function(e){
	    		e.preventDefault();
	    		var pay_scale = document.getElementById('pay_scale');
				if (pay_scale.value === "") {
					errorNow("Select staff's pay scale");
					pay_scale.focus();
					return false;
				}
	    		$("#modal-warning").modal("show");
	    		// $(".bg-warning").toggleClass("bg-success");
	    		document.getElementById('salary_addon').value = 'Allowance';
	    		document.getElementById('modalname').innerHTML = 'Allowance';
	    		document.getElementById('labelname').innerHTML = 'Allowance';
	    		document.getElementById('labelname_span').innerHTML = 'allowances';

	    	})

	    	$(".addDeduction").click(function(e){
	    		e.preventDefault();
	    		var pay_scale = document.getElementById('pay_scale');
				if (pay_scale.value === "") {
					errorNow("Select staff's pay scale");
					pay_scale.focus();
					return false;
				}
	    		$("#modal-warning").modal("show");
	    		document.getElementById('salary_addon').value = 'Deduction';
	    		document.getElementById('modalname').innerHTML = 'Deduction';
	    		document.getElementById('labelname').innerHTML = 'Deduction';
	    		document.getElementById('labelname_span').innerHTML = 'deductions';
	    	})

			$("#allowancesDeducForm").submit(function(e){
				e.preventDefault();
				var allowancesDeducForm = document.getElementById('allowancesDeducForm');
				var pay_scale = document.getElementById('pay_scale');
				if (pay_scale.value === "") {
					errorNow("Select staff's pay scale");
					pay_scale.focus();
					return false;
				}

				var data = new FormData(allowancesDeducForm);
				var url = 'submit-allowance-deduction';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#allBtn").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						successNow(data);
						$("#allBtn").html('Save Changes');
						$("#allowancesDeducForm")[0].reset();
						calCulateTotal();
						fetchAllowances();
						fetchDeductions();

					}
				})
			});

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
	    	var net_pay = document.getElementById('net_pay');
	    	var pay = $(this).find(':selected').data('amount');
	    	if (pay !== "00.00") {
	    		salary_amount.value = pay;
	    		var cname = 'AllAmount';
	    		var cvalue = pay;
	    		totalAmount(cname, cvalue);
		    	var salaryForm = document.getElementById('salaryForm');
				var data = new FormData(salaryForm);
				var url = 'calculations';
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
						$(".getTotalCalculation").html(data);
						$("#Calculate").html("Calculate");
					}
				})
			}
	    })

	   

	    function totalAmount(cname, cvalue) {
	        event.preventDefault();
	        const d = new Date();
	        d.setTime(d.getTime() + (30*24*60*60*1000));
	        let expires = "expires="+ d.toUTCString();
	        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
	   	}



		$(document).on("click", ".remove_allowance_and_amount", function(e){
			e.preventDefault();
			var allowance_id = $(this).attr("href");
			var branch_id = '<?php echo $BRANCHID?>';
	    	var staff_id  = '<?php echo $_GET['staff-id']?>';

			if(confirm("Confirm you wish to remove the allowance")){
				$.ajax({
					url:"editPayroll",
					method:"post",
					data:{allowance_id:allowance_id, branch_id:branch_id, staff_id:staff_id},
					success:function(data){
						successNow(data);
						fetchAllowances();
						calCulateTotal();
					}
				})
			}else{
				return false;
			}
		})
		// REMOVE DEDCUTION
		$(document).on("click", ".remove_deduction_and_amount", function(e){
			e.preventDefault();
			var remove_deduction_and_amount_id = $(this).attr("href");
			
			var branch_id = '<?php echo $BRANCHID?>';
	    	var staff_id  = '<?php echo $_GET['staff-id']?>';
			if(confirm("Confirm you wish to remove the Deduction")){
				$.ajax({
					url:"editPayroll",
					method:"post",
					data:{
						remove_deduction_and_amount_id:remove_deduction_and_amount_id,
						branch_id:branch_id,
						staff_id:staff_id,
					},
					success:function(data){
						successNow(data);
						fetchDeductions();
						calCulateTotal();
					}
				})
			}else{
				return false;
			}
		})


	    function calC(amount){
			// successNow(amount);
			var salaryForm = document.getElementById('salaryForm');
			var data = new FormData(salaryForm);
			var url = 'calculations';
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
					$(".getTotalCalculation").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}

		function calCDeduction(amount){
			var salaryForm = document.getElementById('salaryForm');
			var data = new FormData(salaryForm);
			var url = 'calculations';
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
					$(".getTotalCalculation").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}
		function calCulateTotal(){
			var parent_id = "<?php echo $_GET['parent_id']?>";
			var staff_id = "<?php echo $_GET['staff-id']?>";
			var branch_id = "<?php echo $BRANCHID?>";
			var salary_addon = document.getElementById('salary_addon').value;
			var url = 'calculations';
			$.ajax({
				url:url+'?<?php echo time()?>',
				method:"post",
				data:{
					parent_id:parent_id,
					staff_id:staff_id,
					branch_id:branch_id,
					salary_addon:salary_addon
				},
				beforeSend:function(){
					$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
				},
				success:function(data){
					$(".getTotalCalculation").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}
		calCulateTotal();
		function fetchAllowances(){
	    	var fetchAllowances = 'fetchAllowances';
	    	var branch_id = '<?php echo $BRANCHID?>';
	    	var staff_id  = '<?php echo $_GET['staff-id']?>';
	    	$.ajax({
				url:"fetchAllowances",
				method:"post",
				data:{fetchAllowances:fetchAllowances, branch_id:branch_id, staff_id:staff_id},
				success:function(data){
					$("#getAllowanceType").html(data);
				}
			})
	    }
	    fetchAllowances();

	    function fetchDeductions(){
	    	var fetchDeductions = 'fetchDeductions';
	    	var branch_id = '<?php echo $BRANCHID?>';
	    	var staff_id  = '<?php echo $_GET['staff-id']?>';
	    	$.ajax({
				url:"fetchDeductions",
				method:"post",
				data:{fetchDeductions:fetchDeductions, branch_id:branch_id, staff_id:staff_id},
				success:function(data){
					$(".getDeductionType").html(data);
				}
			})
	    }
	    fetchDeductions();


	    //========== SUBMIT ============

	    $(document).ready(function(){
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
				var url = 'payroll-submit';
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
								window.location = 'view_payroll?allowed_user_id=<?php echo $_SESSION['parent_id']?>';
							}, 2000);
						}else if(data === 'Updated'){
							successNow("Payroll Updated");
							setTimeout(function(){
								window.location = 'staff-payroll?payroll_id=<?php echo $_GET['staff-id']?>&parent_id=<?php echo $_GET['parent_id']?>&staff_id=<?php echo $_GET['staff-id']?>';
							}, 2000);
							
						}else{
							errorNow(data);
						}
					}
				})
			})
	    })

	</script>

</body>
</html>