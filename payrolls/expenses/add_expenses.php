<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Income and Expenses</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
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
  							<button class="btn btn-warning" type="button"  data-toggle="modal" data-target="#modalExpenses"><i class="bi bi-folder-plus"></i> ADD INCOME/EXPENSES</button>
  						</div>
      				</div>
      			</div>
      			<!-- Start of Income Table -->
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-secondary">
      							<div class="card-header">
      								<h4 class="card-title">Income Table </h4>
      							</div>
      							<div class="card-body">
		      						<div class="table table-responsive">
		      							<table class="cell-table table-sm" id="incomeTable" style="width: 100%">
		      								<thead>
		      									<tr>
		      										<th>#</th>
		      										<th>Expense Name</th>
		      										<th>Amount</th>
		      										<th>Date</th>
		      										<th>Receipt or Invoice</th>
		      										<th>Loan Number:</th>
		      										<th>Edit</th>
		      										<th>Remove</th>
		      									</tr>
		      								</thead>
		      								<tbody class="text-dark">
		      									<?php
		      										$number = 1;
		      										$query = $connect->prepare("SELECT * FROM income_table WHERE branch_id = ? AND parent_id = ? ORDER BY income_date ");
		      										$query->execute(array($BRANCHID, $_SESSION['parent_id']));
		      										if ($query->rowCount() > 0) {
		      											foreach ($query->fetchAll() as $row) {
		      												extract($row);
		      												if ($receipt_no_1 == "" AND $receipt_no_2 == "") {
		      													$receipt = "N/A"; 
		      												}elseif ($receipt_no_1 == "" AND $receipt_no_2 != "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_2.'">'.$receipt_no_2.'</a> <i class="bi bi-trash deleteIncomeFile text-danger" id="'.$id.'" data-row="receipt_no_2"></i>;
		      														';
		      												}elseif ($receipt_no_1 != "" AND $receipt_no_2 == "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_1.'">'.$receipt_no_1.'</a> <i class="bi bi-trash deleteIncomeFile text-danger" id="'.$id.'" data-row="receipt_no_1"></i>
		      														';
		      												}elseif ($receipt_no_1 != "" AND $receipt_no_2 != "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_1.'">'.$receipt_no_1.'</a> <i class="bi bi-trash deleteIncomeFile text-danger" id="'.$id.'" data-row="receipt_no_1"></i><br>
		      															<a href="expenses/files/'.$receipt_no_2.'">'.$receipt_no_2.'</a> <i class="bi bi-trash deleteIncomeFile text-danger" id="'.$id.'" data-row="receipt_no_2"></i>;
		      														';
		      												}
		      												if ($income_loan_linked_to == "") {
		      													$lnumber = "N/A ";
		      												}else{
		      													$lnumber = $income_loan_linked_to;
		      												}

		      									?>
		      										<tr>
		      											<td><?php echo $number++ ?></td>
		      											<td><?php echo $income_name ?></td>
		      											<td><small><?php echo $currency ?></small> <?php echo number_format($income_amount,2) ?></td>
		      											<td><?php echo $income_date ?></td>
		      											<td><?php echo $receipt ?></td>
		      											<td><?php echo $lnumber ?></td>
		      											<td><a href="" data-id="<?php echo $id?>" class="editIncome"><i class="bi bi-pencil-square"></i></a> </td>
		      											<td>
		      												<a href="" data-id="<?php echo $id?>" class="deleteIncome"><i class="bi bi-trash text-danger"></i></a>
		      											</td>
		      										</tr>
		      									<?php			
		      											}
		      										}else{

		      										}

		      									?>
		      								</tbody>
		      								<?php
		      								$query = $connect->prepare("SELECT *, SUM(income_amount) AS total_incomes FROM income_table WHERE branch_id = ? AND parent_id = ?  ");
		      								$query->execute(array($BRANCHID, $_SESSION['parent_id']));
		      								$rows = $query->fetch();
		      								if ($rows) {
		      									$total_incomes = $rows['total_incomes'];
		      									$currency = $rows['currency'];	
		      								}
		      								?>
		      								<tfoot>
		      									<tr>
		      										<th></th>
		      										<th>Total Income</th>
		      										<th><small><?php echo getCurrency($connect, $_SESSION['parent_id'])?></small> <?php echo number_format($total_incomes,2)?></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      									</tr>
		      								</tfoot>
		      							</table>
		      						</div>
		      					</div>
		      				</div>
      					</div>
      				</div>
      			</div>
      			<!-- Start of Expenses Table -->
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card card-warning">
      							<div class="card-header">
      								<h4 class="card-title">Expenses Table</h4>
      							</div>
      							<div class="card-body">
		      						<div class="table table-responsive">
		      							<table class="cell-table  table-sm" id="expensesTable" style="width: 100%">
		      								<thead>
		      									<tr>
		      										<th>#</th>
		      										<th>Expense Name</th>
		      										<th>Amount</th>
		      										<th>Date</th>
		      										<th>Receipt or Invoice</th>
		      										<th>Loan Number:</th>
		      										<th>Edit</th>
		      										<th>Remove</th>
		      									</tr>
		      								</thead>
		      								<tbody class="text-dark">
		      									<?php
		      										$number = 1;
		      										$query = $connect->prepare("SELECT * FROM expenses WHERE branch_id = ? AND parent_id = ? ORDER BY expense_date ");
		      										$query->execute(array($BRANCHID, $_SESSION['parent_id']));
		      										if ($query->rowCount() > 0) {
		      											foreach ($query->fetchAll() as $row) {
		      												extract($row);
		      												if ($receipt_no_1 == "" AND $receipt_no_2 == "") {
		      													$receipt = "N/A"; 
		      												}elseif ($receipt_no_1 == "" AND $receipt_no_2 != "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_2.'">'.$receipt_no_2.'</a> <i class="bi bi-trash deleteFile text-danger" id="'.$id.'" data-row="receipt_no_2"></i>;
		      														';
		      												}elseif ($receipt_no_1 != "" AND $receipt_no_2 == "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_1.'">'.$receipt_no_1.'</a> <i class="bi bi-trash deleteFile text-danger" id="'.$id.'" data-row="receipt_no_1"></i>
		      														';
		      												}elseif ($receipt_no_1 != "" AND $receipt_no_2 != "") {
		      													$receipt = '
		      															<a href="expenses/files/'.$receipt_no_1.'">'.$receipt_no_1.'</a> <i class="bi bi-trash deleteFile text-danger" id="'.$id.'" data-row="receipt_no_1"></i><br>
		      															<a href="expenses/files/'.$receipt_no_2.'">'.$receipt_no_2.'</a> <i class="bi bi-trash deleteFile text-danger" id="'.$id.'" data-row="receipt_no_2"></i>;
		      														';
		      												}
		      												if ($expense_loan_linked_to == "") {
		      													$lnumber = "N/A ";
		      												}else{
		      													$lnumber = $expense_loan_linked_to;
		      												}

		      									?>
		      										<tr>
		      											<td><?php echo $number++ ?></td>
		      											<td><?php echo $expense_name ?></td>
		      											<td><small><?php echo $currency ?></small> <?php echo number_format($expense_amount, 2) ?></td>
		      											<td><?php echo $expense_date ?></td>
		      											<td><?php echo $receipt ?></td>
		      											<td><?php echo $lnumber ?></td>
		      											<td>
		      												<a href="" data-id="<?php echo $id?>" class="editExpense"><i class="bi bi-pencil-square"></i></a> 
		      											</td>
		      											<td>
		      												<a href="" data-id="<?php echo $id?>" class="deleteExpense"><i class="bi bi-trash text-danger"></i></a> 
		      											</td>
		      										</tr>
		      									<?php			
		      											}
		      										}else{

		      										}

		      									?>
		      								</tbody>
		      								<?php
		      								$query = $connect->prepare("SELECT *, SUM(expense_amount) AS total_expenses FROM expenses WHERE branch_id = ? AND parent_id = ? ORDER BY expense_date ");
		      								$query->execute(array($BRANCHID, $_SESSION['parent_id']));
		      								$rows = $query->fetch();
		      								if ($rows) {
		      									$total_expenses = $rows['total_expenses'];
		      									$currency = $rows['currency'];	
		      								}
		      								?>
		      								<tfoot>
		      									<tr>
		      										<th></th>
		      										<th>Total Expenses</th>
		      										<th><small><?php echo getCurrency($connect, $_SESSION['parent_id'])?></small> <?php echo number_format($total_expenses, 2)?></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      										<th></th>
		      									</tr>
		      								</tfoot>
		      							</table>
		      						</div>
		      					</div>
		      				</div>
      					</div>
      				</div>
      			</div>
      			<!-- End of Expenses Table -->
      			<!-- CHARTS PHP -->
			      	<?php
			      	
			            $sql = $connect->prepare("SELECT *, SUM(income_amount) AS total_amount FROM `income_table` WHERE branch_id = ? AND parent_id = ? AND income_date > (NOW() - INTERVAL 30 DAY) ");
						$sql->execute(array($BRANCHID, $_SESSION['parent_id']));
						$result = $sql->fetchAll();
						$labels = $uptime = $downtime = '';
							foreach ($result as $row) {
								extract($row);
								$labels .= '\''.date("M-d", strtotime($income_date,  strtotime("+1 day")) ).'\''.',';
								$uptime .= $total_amount.','; 
							}
							$income_expenses_lable = rtrim($labels, ',');
							
							$incomes = rtrim($uptime, ',');

						$query = $connect->prepare("SELECT *, SUM(expense_amount) AS total_amount FROM `expenses` WHERE branch_id = ? AND parent_id = ? AND expense_date > (NOW() - INTERVAL 30 DAY) ");
		                $query->execute(array($BRANCHID, $_SESSION['parent_id']));
						$count = $query->rowCount();
						$results = $query->fetchAll();
						if ($count > 0) {
							
							foreach ($results as $row) {
								extract($row);
								$downtime .= $total_amount.',';
								$labels .= '\''.date("M-d", strtotime($expense_date,  strtotime("+1 day")) ).'\''.',';
							}

							$downtimes_expenses = rtrim($downtime, ',');
					    }else{
					    	$downtimes_expenses = $count;
					    }

					    $income_expenses_lable = rtrim($labels, ',');

			            // ============ FOR DONUT CHART ================

			            $query = $connect->prepare("SELECT *, SUM(income_amount) AS total_amount FROM `income_table` WHERE branch_id = ? AND parent_id = ? ");
		                $query->execute(array($BRANCHID, $_SESSION['parent_id']));
		                if($query->rowCount() > 0){
		                	$row = $query->fetch();
		                	if ($row) {
		                		$total_income = $row['total_amount'];;
		                	}
		                }else{
		                	$zero = 0;
		                	$total_income = $zero;
		                }

		                $query = $connect->prepare("SELECT *, SUM(expense_amount) AS total_amount FROM `expenses` WHERE branch_id = ? AND parent_id = ? ");
		                $query->execute(array($BRANCHID, $_SESSION['parent_id']));
		                if($query->rowCount() > 0){
		                	$row = $query->fetch();
		                	if ($row) {
		                		$total_expenses = $row['total_amount'];;
		                	}
		                }else{
		                	$zero = 0;
		                	$total_expenses = $zero;
		                }

		                if ($total_expenses > $total_income) {
		                	$balance = 0;
		                }else{
		                	$balance = $total_income - $total_expenses;
		            	}
			      	?>
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-6 mt-5 mb-5">
      						<!-- BAR CHART -->
                            <div class="card card-success">
                                <div class="card-header">
                                    <h3 class="card-title">Income & Expepense for 30 Days</h3>

                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <div class="position-relative mb-4">
											<canvas id="uptimebarchart" height="250"></canvas>
										</div>
                                    </div>
                                </div>
                            </div>
      					</div>
      					<div class="col-md-6 mt-5 mb-5">
      					<!-- LINE CHART -->
				            <div class="card card-info">
				              	<div class="card-header">
				                	<h3 class="card-title">INCOME & EXPENSES TOTAL TALLY</h3>

				                	<div class="card-tools">
				                  		<button type="button" class="btn btn-tool" data-card-widget="collapse">
				                    		<i class="fas fa-minus"></i>
				                  		</button>
				                  		<button type="button" class="btn btn-tool" data-card-widget="remove">
				                    		<i class="fas fa-times"></i>
				                  		</button>
				                	</div>
				              	</div>
				              	<div class="card-body">
				                	
				                	<div class="card-body">
                						<canvas id="donutChart" style="min-height: 220px; height: 220px; max-height: 220px; max-width: 100%;"></canvas>
              						</div>
				              	</div>
				            </div>
				        </div>
      				</div>
      			</div>
      			<!-- Modal Form -->
      			<div class="modal fade" id="modalExpenses">
					<div class="modal-dialog modal-lg">
						<div class="modal-content bg-warning">
							<form class="" method="post" id="income_expenseForm" enctype="multipart/form-data">
								<div class="modal-header">
									<h4 class="modal-title">INCOME / EXPENSES FORM</h4>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div class="row">
										<div class="form-group col-md-12">
											<label>Select Income or Expense</label>
											<select class="form-control" name="income_or_expense" id="income_or_expense" onchange="check(this.value)" required>
												<option value=""></option>
												<option value="Income">Income</option>
												<option value="Expense">Expense</option>
											</select>
										</div>
										<script>
											function check(args) {
												if (args == "") {
													document.getElementById('labelname').innerHTML = "";
												}else{
													document.getElementById('labelname').innerHTML = args;
												}
											}
										</script>
										<div class="form-group col-md-6">
											<label>Date</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-calendar"></i></span>
												<input type="text" name="date" id="date" class="form-control" autocomplete="off">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label for=""><span id="labelname"></span> Name</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-wallet"></i></span>
												<input type="text" name="name" id="name" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Amount</label>
											<div class="input-group">
												<span class="input-group-text" id="currency_"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
												<input type="number" name="amount" id="amount" step="any" class="form-control">
											</div>
											<input type="hidden" name="currency" id="currency" value="<?php echo getCurrency($connect, $_SESSION['parent_id'])?>">
										</div>
										<div class="form-group col-md-6">
											<label>Invoice/Receipt #1</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-file-pdf"></i></span>
												<input type="file" name="receipt_no_1" id="receipt_no_1" class="form-control">
												<input type="hidden" name="receipt_no_1_edit" id="receipt_no_1_edit" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-6">
											<label>Invoice/Receipt #2</label>
											<div class="input-group">
												<span class="input-group-text"><i class="bi bi-file-pdf"></i></span>
												<input type="file" name="receipt_no_2" id="receipt_no_2" class="form-control">
												<input type="hidden" name="receipt_no_2_edit" id="receipt_no_2_edit" class="form-control">
											</div>
										</div>
										<div class="form-group col-md-6">
											<?php 
												$sql = $connect->prepare("SELECT * FROM `loans` WHERE branch_id = ? AND parent_id = ? ");
												$sql->execute(array($BRANCHID, $_SESSION['parent_id']));

											?>
											<label>Loan name and ID.</label>
											
											<select class="form-control" name="loan_linked_to" id="loan_linked_to">
												<option value=""></option>
												<?php
													if ($sql->rowCount() > 0) {
														foreach ($sql->fetchAll() as $row) {
															extract($row);
															?>
														<option value="<?php echo $loan_number?>"><?php echo getBorrowerFullNamesByCardId($connect, $borrower_id) ?>  ( Loan ID: <?php echo $loan_number?>) </option>
												<?php			
														}
													}else{
														echo '<option>No Loan Found in the Branch</option>';
													}
												?>
											</select>
											
											<em><b>IF EXPENSE IS LINKED TO A LOAN, SELECT THE LOAN, ELSE SKIP.</b></em>
										</div>
									</div>
								</div>
								<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
								<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
								<input type="hidden" name="ID" id="ID">
								<div class="modal-footer justify-content-between">
									<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									<button class="btn btn-secondary w-50 " type="submit" id="expenseBtn">Submit</button>
								</div>
							</form>
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

	<script>
		$("#date").datepicker({
			format: 'yyyy-mm-dd',
			autoclose:true,
			startDate: '-3d',
			defaultViewDate: 'today',
		});
		$('.select2').select2();
		 $("#expensesTable").DataTable();
		 $("#incomeTable").DataTable();

		//========== GET CURRENCY
		// document.addEventListener('DOMContentLoaded', function () {
		//  	var currency_ = document.getElementById('currency_');
		//  	var currency = document.getElementById('currency');
		//  	if (localStorage['currency']) { 
		//      	currency_.innerHTML = localStorage['currency'];
		//      	currency.value = localStorage['currency'];
		//  	}
		// });

		// ============================== ADD ADMINS ==========================================

		$(function(){
			$("#income_expenseForm").submit(function(e){
				e.preventDefault();
				// alert("Hello");
				var name = document.getElementById('name');
				var amount = document.getElementById('amount');
				var income_expenseForm = document.getElementById('income_expenseForm');
				var income_or_expense = document.getElementById('income_or_expense').value;
				var data = new FormData(income_expenseForm);
				var url = 'expenses/submitExpense';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#expenseBtn").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						if (data === 'done') {
							successNow(income_or_expense +" "+ name.value +' '+ amount.value + ' Added');
							setTimeout(function(){
								location.reload();
							}, 2000);
							$("#expenseBtn").html("Submit");
						}else if(data === 'update'){
							successNow(income_or_expense +" "+ name.value +' '+ amount.value + ' updated');
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							errorNow(data);
							$("#expenseBtn").html("Submit");
							return false;
						}
					}
				})
			})
	

		// ============= EDIT AND DELETE EXPENSE 
			$(document).on("click",".editExpense", function(e){
				e.preventDefault();
				$("#modalExpenses").modal("show");
				var expense_id = $(this).data("id");
				// alert(id);
				$.ajax({
					url:"expenses/editExpense",
					method:"post",
					data:{expense_id:expense_id},
					dataType:"JSON",
					success:function(data){
						$('#ID').val(data.id);
						$('#name').val(data.expense_name);
						$('#amount').val(data.expense_amount);
						$('#loan_linked_to').val(data.expense_loan_linked_to);
						$('#date').val(data.expense_date);
						$('#receipt_no_1_edit').val(data.receipt_no_1);
						$('#receipt_no_2_edit').val(data.receipt_no_2);
						$("#income_or_expense").val("Expense");
					}
				})
			})
		//=========== income ======== editIncome

			$(document).on("click",".editIncome", function(e){
				e.preventDefault();
				$("#modalExpenses").modal("show");
				var income_id = $(this).data("id");
				// alert(id);
				$.ajax({
					url:"expenses/editExpense",
					method:"post",
					data:{income_id:income_id},
					dataType:"JSON",
					success:function(data){
						$('#ID').val(data.id);
						$('#name').val(data.income_name);
						$('#amount').val(data.income_amount);
						$('#loan_linked_to').val(data.income_loan_linked_to);
						$('#date').val(data.income_date);
						$('#receipt_no_1_edit').val(data.receipt_no_1);
						$('#receipt_no_2_edit').val(data.receipt_no_2);
						$("#income_or_expense").val("Income");
					}
				})
			})

		//-===== delete file===========

			$(document).on("click", ".deleteFile", function(){
				var fileID = $(this).attr("id");
				var editableRow = $(this).data("row");
				if(confirm("Deleted files cannot be restored, Confirm delete")){
					$.ajax({
						url:"expenses/editExpense",
						method:"post",
						data:{fileID:fileID, editableRow:editableRow},
						success:function(data){
							successNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}
					})
				}else{
					return false;
				}
			})

			$(document).on("click", ".deleteIncomeFile", function(){
				var incomefileID = $(this).attr("id");
				var editIncometableRow = $(this).data("row");
				if(confirm("Deleted files cannot be restored, Confirm delete")){
					$.ajax({
						url:"expenses/editExpense",
						method:"post",
						data:{incomefileID:incomefileID, editIncometableRow:editIncometableRow},
						success:function(data){
							successNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}
					})
				}else{
					return false;
				}
			})
		
		//========== DELETE INCOME =====================

			$(document).on("click",".deleteIncome", function(e){
				e.preventDefault();
				var income_id_delete = $(this).data("id");
				// alert(investor_id_delete);
				if (!confirm("You wish to remove this Income? It cannot be undone")) {
					return false;
				}else{
					$.ajax({
						url:"expenses/editExpense",
						method:"post",
						data:{income_id_delete:income_id_delete},
						success:function(data){
							errorNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
							
						}
					})
				}
			})

			//============ DELETE EXPENSE ========= deleteExpense
			$(document).on("click",".deleteExpense", function(e){
				e.preventDefault();
				var expense_id_delete = $(this).data("id");
				// alert(investor_id_delete);
				if (!confirm("You wish to remove this expense? It cannot be undone")) {
					return false;
				}else{
					$.ajax({
						url:"expenses/editExpense",
						method:"post",
						data:{expense_id_delete:expense_id_delete},
						success:function(data){
							errorNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
							
						}
					})
				}
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

	//==================================== BAR CHART ===================
    Chart.Legend.prototype.afterFit = function() {
		    this.height = this.height + 50;
		};

		var areaChartData = {
	      labels  : [<?php echo $income_expenses_lable?>],
	      datasets: [
	        {
				label               : 'Income ',
				backgroundColor     : '#5b9291',
				borderColor         : 'rgba(60,141,188,0.8)',
				pointRadius          : true,
				pointColor          : '#3b8bba',
				pointStrokeColor    : 'rgba(60,141,188,1)',
				pointHighlightFill  : '#fff',
				pointHighlightStroke: 'rgba(60,141,188,1)',
				data                : [<?php echo $incomes?>] // data will come from loan_payments,
	        },
	        {
				label               : 'Expenses',
				backgroundColor     : '#790201',
				borderColor         : 'rgba(255, 0, 0, 1)',
				pointRadius         : true,
				pointColor          : 'rgba(255, 0, 0, 1)',
				pointStrokeColor    : '#fbff00',
				pointHighlightFill  : '#fbff00',
				pointHighlightStroke: 'rgba(255, 0, 0, 1)',
				data                : [<?php echo $downtimes_expenses?>] // data will come  with status released
	        },
	      ]
	    }

	    var barChartCanvas = $('#uptimebarchart').get(0).getContext('2d')
	    var barChartData = $.extend(true, {}, areaChartData)
	    var temp0 = areaChartData.datasets[0]
	    var temp1 = areaChartData.datasets[1]
	    	barChartData.datasets[0] = temp1
	    	barChartData.datasets[1] = temp0

	    var barChartOptions = {
	      	responsive              : true,
	      	maintainAspectRatio     : false,
	      	datasetFill             : false,
	      	scales: {
		        xAxes: [{
		            gridLines: {
		                display:false
		            }
		        }],
		        yAxes: [{
		            gridLines: {
		                display:false
		            }   
		        }]
		    }
	    }

	    new Chart(barChartCanvas, {
	      	type: 'bar',
	      	data: barChartData,
	      	options: barChartOptions
	    })



		var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
	    var donutData        = {
	      labels: [
	          'Expenses <?php echo getCurrency($connect, $_SESSION['parent_id'])?>',
	          'Income <?php echo getCurrency($connect, $_SESSION['parent_id'])?>',
	          'Balance <?php echo getCurrency($connect, $_SESSION['parent_id'])?>',
	      ],
	      datasets: [
	        {
	          data: [<?php echo $total_expenses ?>,<?php echo $total_income?>, <?php echo $balance?>],
	          backgroundColor : ['#f56954', '#00a65a', '#d2d6de'],
	        }
	      ]
	    }
	    var donutOptions     = {
	      maintainAspectRatio : false,
	      responsive : true,
	    }
	    //Create pie or douhnut chart
	    // You can switch between pie and douhnut using the method below.
	    new Chart(donutChartCanvas, {
	      type: 'doughnut',
	      data: donutData,
	      options: donutOptions
	    })
	</script>
</body>
</html>
