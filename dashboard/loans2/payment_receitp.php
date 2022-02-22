<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payment Receipt</title>
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
		/*Payslip table*/
		.tableDiv {
			margin: 2em auto;
			width: 70%;
		}
		.tableDiv h2 {
			margin-bottom: 1em;
		}
		.intro_table {
			width: 100%;
			border: 1px solid #ddd;
			padding: 1em;
		}
		.anotherTable {
			width: 100%;
			border: 1px solid #ddd;
			padding: 1em;
			border-top: none;
		}
		td, th {
			text-align: left;
			padding: 8px;
		}

		* {
			box-sizing: border-box;
		}

		.row {
			margin-left:-5px;
			margin-right:-5px;
		}

		.column {
			float: left;
			width: 50%;
			padding: 5px;
		}

		.row::after {
			content: "";
			clear: both;
			display: table;
		}

		table {
			border-collapse: collapse;
			border-spacing: 0;
			width: 100%;
			border: 1px solid #ddd;
		}

		th, td {
			text-align: left;
			padding: 16px;
		}

		tr:nth-child(even) {
			background-color: #f2f2f2;
		}
	</style>
</head>
<?php
	if (isset($_GET['loan_number']) AND isset($_GET['branch_id']) AND isset($_GET['parent_id']) AND $_GET['borrower_id']) {
		$loan_number = $_GET['loan_number'];
		$branch_id = $_GET['branch_id'];
		$parent_id = $_GET['parent_id'];
		$borrower_id = $_GET['borrower_id'];
	}
	$query = $connect->prepare("SELECT * FROM `organisations` WHERE parent_id = ? ");
	$query->execute(array($parent_id));
	if ($query->rowCount() > 0) {
		$row = $query->fetch();
		if ($row) {
			$organisation_name = $row['organisation_name'];
			$org_logo 	= $row['org_logo'];
			$admin_email = $row['admin_email'];
			$hq_address = $row['hq_address'];
			$hq_phone = $row['hq_phone'];

		}
	}
?>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content bg-light mt-5">
      			<div class="container-fluid mt-5">
			        <div class="row">
			          <div class="col-12 mt-5">
			            <div class="callout callout-info">
			              <h5><i class="fas fa-info"></i> Note:</h5>
			              This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
			            </div>


			            <!-- Main content -->
			            <div class="invoice p-3 mb-3">
			              <div class="row">
			                <div class="col-12">
			                  <h4>
			                    <img src="members/adminphotos/<?php echo $org_logo?>" alt="<?php echo $org_logo?>" class="img-fluid img-responsive" width="50">
			                    <small class="float-right">Date: <?php echo date("d/m/Y") ?></small>
			                  </h4>
			                </div>
			              </div>
			              <div class="row invoice-info">
			                <div class="col-sm-4 invoice-col">
			                  From
			                  
								<address>
			                    <strong><?php echo $organisation_name ?></strong><br>
			                    <?php echo nl2br($hq_address) ?><br>
			                    
			                    Phone: <?php echo $hq_phone?><br>
			                    Email: <?php echo $admin_email?>
		                  	</address>
			                </div>
			                
			                <div class="col-sm-4 invoice-col">
			                  	To
			                  	<?php echo getBorrowerAddress($connect, $_GET['borrower_id'], $parent_id)?>
			                </div>
			                
			                <div class="col-sm-4 invoice-col">
			                  <?php echo createReceiptNumber($connect, $_GET['loan_number'], $parent_id)?>
			                </div>
			                
			              </div>
			              

			              <!-- Table row -->
		              	<?php
		              		$sql = $connect->prepare("SELECT * FROM `loan_payments` WHERE loan_number = ? AND parent_id = ? ");
         					$sql->execute(array($loan_number, $parent_id));
		              	?>
			            <div class="row">
			                <div class="col-12 table-responsive">
			                  	<table class="table table-striped">
			                    	<thead>
			                    		<tr>
					                      	<th>Serial #</th>
					                      	<th>Amount Paid</th>
					                      	<th>Payment Date</th>
					                      	<th>Collected By</th>
			                    		</tr>
			                    	</thead>
			                    	<tbody>

			                    	<?php
			                    		$i = 1;
			                    		foreach ($sql->fetchAll() as $rows) {
			         						extract($rows);
			         				?>
		         						<tr>
		         							<td><?php echo $i++?></td>
		             						<td><?php echo number_format($amount, 2)?></td>
		             						<td><?php echo $paid_date?></td>
		             						<td><?php echo getStaffMemberNames($connect, $collected_by, $parent_id)?> </td>
		             					</tr>
			         				<?php
			         					}
			                    	?>
			                    	</tbody>
			                  	</table>
			                </div>
			            </div>
			              

			            <div class="row">
			                <div class="col-6">
			                  	<p class="lead">Payment Methods:</p>
			                  	<?php
				              		$sqln = $connect->prepare("SELECT * FROM `loan_payments` WHERE loan_number = ? AND parent_id = ? ");
	             					$sqln->execute(array($loan_number, $parent_id));
	             					$r = $sqln->fetch();
	             					if ($r) {
	             						extract($r);
	             				?>
	             				<p><?php echo $payment_method ?></p>
				                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
				                    <?php echo $comment?>
				                </p>
				                <?php	
	             					}
				              	?>
			                </div>
			                
			                <div class="col-6">
			                  	<?php echo checkPaymentDate($connect, $loan_number, $parent_id)?>

			                  	<div class="table-responsive">
				                    <table class="table">
				                      	<tr>
				                        	<th style="width:50%">Principal:</th>
				                        	<td><small><?php echo getCurrency($connect, $parent_id, $loan_number)?></small> <?php echo number_format(getTotalPrinciple($connect, $parent_id, $loan_number), 2)?></td>
				                      	</tr>
				                      	<tr>
				                        	<th>Paid:</th>
				                        	<td><small><?php echo getCurrency($connect, $parent_id, $loan_number)?></small> <?php echo number_format(getTotalPaid($connect, $loan_number, $parent_id), 2)?></td>
				                      	</tr>
				                      	<tr>
				                        	<th>Balance:</th>
				                        	<td><small><?php echo getCurrency($connect, $parent_id, $loan_number)?></small> <?php echo number_format(getTotalPrinciple($connect, $parent_id, $loan_number) - getTotalPaid($connect, $loan_number, $parent_id), 2)?></td>
				                      	</tr>
				                    </table>
			                  	</div>
			                </div>
			            </div>
			              

			              <!-- this row will not appear when printing -->
			              <div class="row no-print">
			                <div class="col-12">
			                  	<!-- <a href="invoice-print.html" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a> -->
			                  	<a href="loans/print-receipt?loan_number=<?php echo $loan_number?>&branch_id=<?php echo $branch_id?>&parent_id=<?php echo $parent_id?>&borrower_id=<?php echo $borrower_id?>" rel="noopener" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
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
	<script src="plugins/chart.js/Chart.min.js"></script>
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>
		$("#paymentsTable").DataTable();
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