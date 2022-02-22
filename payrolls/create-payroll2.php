<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create Payroll</title>
	<?php include("links.php") ?>
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
		<?php include ("nav_side.php"); ?>
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

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));


      			?>
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-info">
      							<div class="card-header">
      								<h3 class="card-title">BASIC PAY SCALE</h3>
      							</div>
      							<form method="post" id="salaryForm" enctype="multipart/form-data">
	      							<div class="card-body">
	  									<div class="row">
	  										<div class="form-group col-md-4">
		  										<label>Select Employee</label>
		  										<select class="select2" name="employee" id="employee"  style="width: 100%;" onchange="getStaffId(this.value)">
		  											<option value="">Select Staff</option>
		  											<?php
		  												foreach ($sql->fetchAll() as $row) {
		  													extract($row);
		  											?>
												         <option value="<?php echo $id?>"><?php echo $firstname ?> <?php echo $lastname ?> ( <?php echo $position ?> )</option>
												    <?php
												        }
		  											?>
											    </select>
		  									</div>
	  										<div class="form-group col-md-4">
	      										<label>Payment Type</label>
	      										<select class="form-control" name="payment_type" id="payment_type" required="">
	      											<option value="">Select</option>
	      											<!-- <option value="weekly">Weekly</option> -->
	      											<option value="monthly">Monthly</option>
	      										</select>
	      									</div>
	  										
	  										<div class="form-group col-md-4">
	  											<label>PayDay</label>
	  											<input type="text" name="pay_date" id="pay_date" class="form-control" autocomplete="off" placeholder="Enter Date" required>
	  										</div>
	  									</div>
	  									<div class="row">
		  									<div class="form-group col-md-6">
		  										<label>Select Basic Pay</label>
		  										<select class="select2" name="pay_scale" id="pay_scale" style="width: 100%;">
		  											<option value=""></option>
		  											<?php
		  												foreach ($query->fetchAll() as $row) {
		  													extract($row);
		  											?>
												         <option value="<?php echo $p_id?>" data-amount="<?php echo $amount?>"><?php echo $salary_scale_name ?> (<small><?php echo $currency?></small> <?php echo $amount ?> )</option>
												    <?php
												        }
		  											?>
											    </select>
											    <input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>"> <!-- branchID -->
		  									</div>
		  									<div class="form-group col-md-6">
										    	<label>Selected Pay</label>
										    	<div class="input-group">
													<span class="input-group-text" id="currency_span"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
										    		<input type="text" name="salary_amount" id="salary_amount" class="form-control" placeholder="Will auto fill" readonly>
										    	</div>
										    	<input type="hidden" name="the_currency" id="the_currency" class="form-control" value="<?php echo getCurrency($connect, $_SESSION['parent_id'])?>">
										    </div>
										</div>
	  									<div id="addsDeducs" style="display: none;">
		  									<div class="row mt-5 ">
		      									<div class="col-md-6">
		      										<div class="card card-success">
			      										<div class="card-header">
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
			      								</div>
		      									<div class="col-md-6">
		      										<div class="card card-warning">
			      										<div class="card-header">
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
			      						</div>
	      							</div>
	      							<div class="card-footer">	      								
										<!-- <button class="btn btn-outline-secondary Calculate" id="Calculate" type="button">Calculate</button> -->
										<div id="calculations"></div>
	      							</div>
	      							
	      						</form>
      						</div>
      					</div>
      				</div>
      			</div>
      			<!-- END OF ALLOWANCES SETUP -->
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
										<input type="hidden" class="form-control" name="salary_addon" id="salary_addon">
										<em>You are setting up allowances that will appear on the pay of your staff.</em>
										<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
										<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
										<input type="hidden" name="ID" id="ID">
										<input type="text" name="staff_id" id="staff_id">
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
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>

		// function basicPay(amount){
		// 	// successNow(amount);
		// 	var salaryForm = document.getElementById('salaryForm');
		// 	var data = new FormData(salaryForm);
		// 	var url = 'calculations';
		// 	$.ajax({
		// 		url:url+'?<?php echo time()?>',
		// 		method:"post",
		// 		data:data,
		// 		cache : false,
		// 		processData: false,
		// 		contentType: false,
		// 		beforeSend:function(){
		// 			$("#Calculate").html("<i class='fa fa-spinner fa-spin'></i>");
		// 		},
		// 		success:function(data){
		// 			$("#calculations").html(data);
		// 			$("#Calculate").html("Calculate");
		// 			// document.getElementById('grosspay').value = amount;
		// 		}
		// 	})
		// }

		function calC(amount){
			
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
					$("#calculations").html(data);
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
					$("#calculations").html(data);
					$("#Calculate").html("Calculate");
				}
			})
		}

		function getStaffId(staff_id){
			if (staff_id === "") {
				document.getElementById('addsDeducs').style.display = "none";
			}else{
				document.getElementById('staff_id').value = staff_id;
				document.getElementById('addsDeducs').style.display = "block";
			}
		}

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
				var url = 'submitPayroll';
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
								window.location = 'check-payroll?allowed_user_id=<?php echo $_SESSION['parent_id']?>';
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
	    	// document.getElementById('grosspay').value = pay;
	    	// grosspay.value = pay;

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
					$("#calculations").html(data);
					$("#Calculate").html("Calculate");
					document.getElementById('grosspay').value = pay;
				}
			})
	    })

	    // add and remove salary advance
	    $(function(){
	    	$(".addAllowance").click(function(e){
	    		e.preventDefault();
	    		$("#modal-warning").modal("show");
	    		document.getElementById('salary_addon').value = 'Allowance';
	    		document.getElementById('modalname').innerHTML = 'Allowance';
	    		document.getElementById('labelname').innerHTML = 'Allowance';

	    	})

	    	$(".addDeduction").click(function(e){
	    		e.preventDefault();
	    		$("#modal-warning").modal("show");
	    		document.getElementById('salary_addon').value = 'Deduction';
	    		document.getElementById('modalname').innerHTML = 'Deduction';
	    		document.getElementById('labelname').innerHTML = 'Deduction';
	    	})

	    	$("#allowancesDeducForm").submit(function(e){
				e.preventDefault();
				// alert("Hello");
				var name = document.getElementById('name');
				var allowancesDeducForm = document.getElementById('allowancesDeducForm');
				var salary_addon = document.getElementById('salary_addon').value;
				var data = new FormData(allowancesDeducForm);
				var url = 'submitSalaryType';
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
						getAllowanceType();
						getDeductionType();

					}
				})
			});

			$(document).on("click", ".remove_allowance", function(e){
				e.preventDefault();
				var remove_allowance_id = $(this).attr("href");
				if(confirm("Confirm you wish to remove the allowance")){
					$.ajax({
						url:"editPayroll",
						method:"post",
						data:{remove_allowance_id:remove_allowance_id},
						success:function(data){
							successNow(data);
							getAllowanceType();
						}
					})
				}else{
					return false;
				}
			})
			// REMOVE DEDCUTION
			$(document).on("click", ".remove_deduction", function(e){
				e.preventDefault();
				var remove_deduction_id = $(this).attr("href");
				if(confirm("Confirm you wish to remove the allowance")){
					$.ajax({
						url:"editPayroll",
						method:"post",
						data:{remove_deduction_id:remove_deduction_id},
						success:function(data){
							successNow(data);
							getDeductionType();
						}
					})
				}else{
					return false;
				}
			})
			
	    })

	    function getAllowanceType(){
	    	var getAllowanceType = 'getAllowanceType';
	    	$.ajax({
				url:"getAllowanceType",
				method:"post",
				data:{getAllowanceType:getAllowanceType},
				success:function(data){
					$("#getAllowanceType").html(data);
				}
			})
	    }
	    getAllowanceType();

	    function getDeductionType(){
	    	var getDeductionType = 'getDeductionType';
	    	$.ajax({
				url:"getDeductionType",
				method:"post",
				data:{getDeductionType:getDeductionType},
				success:function(data){
					$(".getDeductionType").html(data);
				}
			})
	    }
	    getDeductionType();
 
	</script>

</body>
</html>