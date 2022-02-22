<?php 
    require ("../../includes/db.php");
    require ("../../includes/tip.php"); 
?>
<!DOCTYPE html>
<html>
<head>
	<?php include("../links.php") ?>
	<title>Payment Receipt </title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
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
</head>
<body>
	<div class="wrapper">
  		<section class="invoice">
  			<div class="row">
		      <div class="col-12">
		        	<h2 class="page-header">
		          		<img src="members/adminphotos/<?php echo $org_logo?>" alt="<?php echo $org_logo?>" class="img-fluid img-responsive" width="50">
			            <small class="float-right">Date: <?php echo date("d/m/Y") ?></small>
		        	</h2>
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
                  <?php echo createReceiptNumber($connect, $_GET['borrower_id'], $parent_id)?>
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
			    <!-- accepted payments column -->
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
	                        	<td><small><?php echo getCurrency($connect, $parent_id)?></small> <?php echo number_format(getTotalPrinciple($connect, $parent_id, $loan_number), 2)?></td>
	                      	</tr>
	                      	<tr>
	                        	<th>Paid:</th>
	                        	<td><small><?php echo getCurrency($connect, $parent_id)?></small> <?php echo number_format(getTotalPaid($connect, $loan_number, $parent_id), 2)?></td>
	                      	</tr>
	                      	<tr>
	                        	<th>Balance:</th>
	                        	<td><small><?php echo getCurrency($connect, $parent_id)?></small> <?php echo number_format(getTotalPrinciple($connect, $parent_id, $loan_number) - getTotalPaid($connect, $loan_number, $parent_id), 2)?></td>
	                      	</tr>
	                    </table>
                  	</div>
                </div>
            </div>
  		</section>
  	</div>
  	<script>
  		window.addEventListener("load", window.print());
	</script>
</body>
</html>