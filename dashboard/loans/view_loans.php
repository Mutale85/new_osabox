<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>View Loans</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="plugins/select2/css/select2.min.css">
	<style>
		
		.cursor-pointer {
			cursor: pointer;
			font-size: 1em;
		}
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
<?php
	
?>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-5 border-bottom">
  							<h4><?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> Loans</h4>
  						</div>
      				</div>
      			</div>
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-primary">
      							<div class="card-header">
      								<h4 class="card-title"> Loans Table</h4>
      							</div>
      							<div class="card-body">
      								<div class="table table-reponsinve">
      									<table id="loansTable" class="cell-table  table-sm" style="width:100%">
      										<thead>
      											<th>Loan#</th>
      											<th>Borrower</th>
      											<th>Principal</th>
      											<th>Interest</th>
      											<th>Due</th>
      											<th>Paid</th>
      											<th>Last Payment</th>
      											<th>Status</th>
      											<th>Apply Date</th>
      											<th>View</th>
      										</thead>
      										<tbody class="text-dark">
			      								<?php
			      									// 
			      									function getPaidAmount($connect, $this_loan_number, $borrower_id){
			      										$output = '';
			      										$sql = $connect->prepare("SELECT *, SUM(amount) AS total FROM `loan_payments` WHERE loan_number = ? AND borrower_id = ? ");
				                     					$sql->execute(array($this_loan_number, $borrower_id));
				                     					if ($sql->rowCount() > 0) {
				                     						foreach ($sql->fetchAll() as $rows) {
				                     							
				                     							if ($rows['total'] == '') {
				                     								$output .= 0.00;
				                     							}else{
				                     								$output .= $rows['total']; 
				                     							}
				                     						}
				                     					}else{
				                     						$output .= 0.00;
				                     					}
				                     					return $output;
			      									}

			      									function getlastPaidDate($connect, $loan_number, $borrower_id){
			      										$output = '';
			      										$sql = $connect->prepare("SELECT *  FROM `loan_payments` WHERE loan_number = ? AND borrower_id = ? ");
				                     					$sql->execute(array($loan_number, $borrower_id));
				                     					if ($sql->rowCount() > 0) {
				                     						foreach ($sql->fetchAll() as $rows) {
				                     							$output .= $rows['paid_date']; 
				                     						}
				                     					}else{
				                     						$output .= 'N/A';
				                     					}
				                     					return $output;
			      									}

			      									function getGroupLeaderID($connect, $parent_id, $group_id) {
			      										$output = '';
			      										$sql = $connect->prepare("SELECT * FROM `group_borrowers` WHERE parent_id = ? AND group_id = ? ");
			      										$sql->execute(array($parent_id, $group_id));
			      										$row = $sql->fetch();
			      										if ($row) {
			      											$output = $row['group_leader_id'];
			      										}
			      										return $output;
			      									}
			      									$query = $connect->prepare("SELECT * FROM loans WHERE branch_id = ? AND parent_id = ? ");
													$query->execute(array($BRANCHID,  $_SESSION['parent_id']));

													if ($query->rowCount() > 0) {

														foreach ($query->fetchAll() as $row) {
															extract($row);

															$sql = $connect->prepare("SELECT * FROM `loanStatus` WHERE loan_id = ? AND branch_id = ? AND parent_id = ? ");
															$sql->execute(array($id, $branch_id, $parent_id));
															if ($sql->rowCount() > 0) {
																$rows = $sql->fetch();
																if ($rows) {
																	extract($rows);
																	$action_date = $action_date;
																}
															}else{
																$action_date = '<span class="text-warning">Pending</span>';
															}

														?>

														<tr>

															<td><a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>" class="text-primary"><?php echo $loan_number ?></a></td>
															<td>
																<a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>" class="text-primary">
																	<?php

																		if(!getBorrowerFullNamesByCardId($connect, $borrower_id)){
																			echo getBorrowerGroupNamesByCardId($connect, $loan_number) .' Group';
																		}else{
																			echo getBorrowerFullNamesByCardId($connect, $borrower_id);
																		}
																	?>
																</a>
															</td>

															<td><small><?php echo $currency ?></small> <?php echo number_format($principle_amount, 2)?></td>
															<td><?php echo $loan_interest ?>%</td>
															<td><small><?php echo $currency ?></small> <?php echo number_format($total_payable_amount, 2) ?></td>
															<td><small><?php echo $currency ?></small> <?php echo  getPaidAmount($connect, $loan_number, $borrower_id)?></td>
															<td><?php echo getlastPaidDate($connect, $loan_number, $borrower_id)?></td>
															<td><?php echo preg_replace("#[^a-zA-Z]#", " ", $loan_status)?></td>
															<td class="text-primary"><?php echo date("Y-m-d", strtotime($date_added)) ?></td>
															<?php

																if(!getBorrowerFullNamesByCardId($connect, $borrower_id)){?>
															<td>
																<a href="borrowers/view_group_borrowers?group_id=<?php echo $loan_number?>&parent_id=<?php echo $parent_id?>&group_leader_id=<?php echo getGroupLeaderID($connect, $parent_id, $borrower_id)?>" class="text-primary"><i class="bi bi-arrow-right-square"></i></a>
															</td>
															<?php		
																}else{?>
															<td>
																<a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>" class="text-primary"><i class="bi bi-arrow-right-square"></i></a>
															</td>
															<?php		
																}
															?>
															
														</tr>

													<?php
														}
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
      		</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<?php include("../footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#loansTable').DataTable();
		    // select
		    $('.select2').select2();
		});

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
	    saveLoanFees = () => {
	    	event.preventDefault();
	    	var fees_name = document.getElementById('fees_name');
	    	if (fees_name.value === "") {
	    		errorNow("Please enter Name of the Fees");
	    		fees_name.focus();
	    		return false;
	    	}
	    	var loan_fees = document.getElementById('loan_fees');
	    	if ($('input[name=loan_fees_radio]:checked').length < 1) {
			    errorNow("Please Select Your Loan Fees Setting");
			    return false;
			}
	    	
	    	var xhr = new XMLHttpRequest();
			var url = 'loans/actionsLoan';
			var LoanFeesForm = document.getElementById('LoanFeesForm');
			xhr.open("POST", url, true);
			var data = new FormData(LoanFeesForm);
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					if (xhr.responseText === 'done') {
						successNow(fees_name.value + ' added to the database');
						$("#LoanFeesForm")[0].reset();
						document.getElementById("addFeebtn").innerHTML = 'Submit';
						// location.reload();
						// $("#modalLoan").modal("show");

					}else if(xhr.responseText === 'Updated'){
						successNow(fee_name.value + ' Updated');

					}else{

						errorNow(xhr.responseText);
						document.getElementById("addFeebtn").innerHTML = 'Submit';
						return false;
					}
					document.getElementById("addFeebtn").innerHTML = 'Submit';
					// load();
				}
				
			}
			xhr.send(data);
			document.getElementById("addFeebtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
	    	
	    }

		saveLoanType = function(){
			event.preventDefault();
			var xhr = new XMLHttpRequest();
			var url = 'loans/addLoanType';
			var branchForm = document.getElementById('manage-loan-type');
			xhr.open("POST", url, true);
			var type_name = document.getElementById('type_name').value;
			if (type_name == "") {
				errorNow("Loan type is required");
				return false;
			}
			var data = new FormData(branchForm);
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					if (xhr.responseText === 'done') {
						successNow(type_name + ' added to the database');
						$("#manage-loan-type")[0].reset();
						document.getElementById("addbtn").innerHTML = 'Submit';
						// location.reload();
						// $("#modalLoan").modal("show");

					}else if(xhr.responseText === 'Updated'){
						successNow(type_name + ' Updated');

					}else{

						errorNow(xhr.responseText);
						document.getElementById("addbtn").innerHTML = 'Submit';
						return false;
					}
					document.getElementById("addbtn").innerHTML = 'Submit';
					// load();
				}
				
			}
			xhr.send(data);
			document.getElementById("addbtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
		}
		function _reset(){
			$('[name="id"]').val('');
			$('#manage-loan-type')[0].reset();
			$("#modalLoan").modal("hide");
			
			location.reload();
		}
		$(document).ready( function () {
		
		    $(document).on("click", ".editLoanType", function(e){
		    	e.preventDefault();
		    	var id = $(this).data('id');
		    	$("#modalLoan").modal("show");
		    	$.ajax({
		    		url: 'loans/editLoanType',
		    		method:'post',
		    		data:'editor_id='+id+'&loggedinID=<?php echo $_SESSION['parent_id']?>',
		    		dataType:"JSON",
		    		success:function(data){
		    			$("#type_name").val(data.type_name);
		    			$("#description").val(data.description);
		    			$("#id").val(data.id);
		    		}
		    	})
		    });
		    $(document).on("click", ".deleteLoanType", function(e){
		    	e.preventDefault();
		    	var id = $(this).data('id');
		    	if(confirm("Confirm deleting loan type")){
			    	$.ajax({
			    		url: 'loans/editLoanType',
			    		method:'post',
			    		data:'delete_id='+id+'&loggedParentId=<?php echo $_SESSION['parent_id']?>',
			    		
			    		success:function(data){
			    			if(data === 'done'){
			    				successNow("Loan Type Deleted");
			    				location.reload();
			    			}else{
			    				errorNow("Error Deleting Loan");
			    			}
			    		}
			    	})
			    }else{
			    	return false;
			    }
		    })
		});

	</script>
	<script>
		$(document).ready( function () {
		    $('#loanCalc').DataTable();
		    // select
		    $('.select2').select2();
		});

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

		saveLoanSetup = function(){
			event.preventDefault();
			var xhr = new XMLHttpRequest();
			var url = 'loans/actionsLoan';
			var loanSetupForm = document.getElementById('loanSetupForm');
			xhr.open("POST", url, true);
			var loan_type = document.getElementById('loan_type');
			if (loan_type.value === "") {
				errorNow("Please Select Loan");
				loan_type.focus();
				return false;
			}

			var months = document.getElementById('months');
			if (months.value === "") {
				errorNow("Please Add months");
				months.focus();
				return false;
			}
			var interest_percentage = document.getElementById('interest_percentage');
			if (interest_percentage.value === "") {
				interest_percentage.focus();
				errorNow("Please Add percentage");
				return false;
			}
			var data = new FormData(loanSetupForm);
			xhr.onreadystatechange = function(){
				if (xhr.readyState == 4 && xhr.status == 200) {
					if (xhr.responseText === 'done') {
						successNow(months.value + ' Months added to the database');
						$("#loanSetupForm")[0].reset();
						document.getElementById("addbtn").innerHTML = 'Submit';
						location.reload();
						// $("#modalLoan").modal("show");

					}else if(xhr.responseText === 'Updated'){
						successNow("Loan Settings Updated");

					}else{

						errorNow(xhr.responseText);
						document.getElementById("addbtn").innerHTML = 'Submit';
						return false;
					}
					document.getElementById("addbtn").innerHTML = 'Submit';
					// load();
				}
				
			}
			xhr.send(data);
			document.getElementById("addbtn").innerHTML = '<i class="fa fa-spinner fa-spin"></i>';
		}
		function _reset(){
			$('[name="id"]').val('');
			$('#loanSetupForm')[0].reset();
			location.reload();
		}

		$(document).ready( function () {
		
		    $(document).on("click", ".editLoanSets", function(e){
		    	e.preventDefault();
		    	var id = $(this).data('id');
		    	$("#modalLoan").modal("show");
		    	$.ajax({
		    		url: 'loans/actionsLoan',
		    		method:'post',
		    		data:'editor_id='+id+'&loggedinID=<?php echo $_SESSION['parent_id']?>',
		    		dataType:"JSON",
		    		success:function(data){
		    			$("#loan_type").val(data.loan_type);
		    			$("#months").val(data.months);
		    			$("#interest_percentage").val(data.interest_percentage);
		    			$("#penalty_rate").val(data.penalty_rate);
		    			$("#id").val(data.id);
		    		}
		    	})
		    });
		    $(document).on("click", ".deleteLoanCalc", function(e){
		    	e.preventDefault();
		    	var id = $(this).data('id');
		    	if(confirm("Confirm deleting loan set up")){
			    	$.ajax({
			    		url: 'loans/actionsLoan',
			    		method:'post',
			    		data:'delete_id='+id+'&loggedParentId=<?php echo $_SESSION['parent_id']?>',
			    		
			    		success:function(data){
			    			if(data === 'done'){
			    				successNow("Loan Type Deleted");
			    				location.reload();
			    			}else{
			    				errorNow("Error Deleting Loan");
			    			}
			    		}
			    	})
			    }else{
			    	return false;
			    }
		    })
		});

		function storeCurrencyValue(currency){
			
			var lg = localStorage['currency_main'] = currency;
			// document.getElementById('SelectedCurrency').innerHTML = currency;
			document.getElementById('SelectedValue').innerHTML = currency;

		}
		document.addEventListener('DOMContentLoaded', function (){
			var input = document.getElementById('currency');
		    if (localStorage['currency_main']) { 
		        input.value = localStorage['currency_main'];
		        // document.getElementById('SelectedCurrency').innerHTML = localStorage['currency_main'];
		        document.getElementById('SelectedValue').innerHTML = localStorage['currency_main'];
		    }
		})
	</script>
</body>
</html>