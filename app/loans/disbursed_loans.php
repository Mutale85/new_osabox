<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php");  
		
?>
<!DOCTYPE html>
<html>
<head>
	<title>Disbursed Loans</title>
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
      					<div class="col-md-12 mt-4 pb-2 border-bottom">
  							<h1 class="h4"><?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> Disbursed Loans</h1>
      				</div>
      			</div>	
      			<div class="container-fluid pt-3">
      				<div class="row">
      					<div class="col-md-12"> 						
      						<div class="card card-success mb-5">
      							<div class="card-header">
      								<h4 class="card-title">Disbursed Loans</h4>
      							</div>
      							<div class="card-body box-profile">
      								<div class="table table-responsive">
      									<table id="loanTypes" class="cell-border text-dark" style="width:100%">
									        <thead>
									            <tr>
									            	<th>#</th>
									                <th>Loan Number</th>
									                <th>Borrower Names</th>
									                <th>Date Disbursed</th>
									            </tr>
									        </thead>
									        <tbody>
									        	<?php
									        		$status = 'Released';
													$parent_id = $_SESSION['parent_id'];
													$query = $connect->prepare("SELECT * FROM loans WHERE parent_id = ? AND branch_id = ? AND loan_status = ? ");
													$query->execute(array($parent_id, $BRANCHID, $status));
													$numRows = $query->rowCount();
													$i = 1;
													if ($numRows > 0 ) {
														
														$i = 1;
														foreach ($query->fetchAll() as $row) {
															extract($row);
														?>
															<tr>
																<td><?php echo $i++?></td>
																<td><a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>">
																	<?php echo $loan_number?></a></td>
																<td>
																	<a href="loans/view_loan_details?loan_number=<?php echo $loan_number?>&borrower_id=<?php echo $borrower_id?>">
																		<?php echo ucfirst(getBorrowerFullNamesByCardId($connect, $borrower_id))?>
																	</a>
																</td>
																<td>
																	<?php echo $row['release_date'];?>
																</td>
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
		    $('#loanTypes').DataTable();
		    // select
		    $('.select2').select2();
		});

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

	</script>
</body>
</html>