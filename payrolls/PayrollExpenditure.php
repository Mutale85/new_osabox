<?php
	require ("includes/db.php");
  	require ("includes/tip.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payroll Expenditure</title>
  	<?php include("links.php") ?>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
  		<?php include ("nav_side.php"); ?>

  		<div class="content-wrapper">
    		<div class="content-header mt-5">
      			<div class="container mt-5">
        			<div class="row mb-2 mt-5">
          				<div class="col-sm-6">
            				<h4 class="m-0"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?></h4>
          				</div>
			          	<div class="col-sm-6">
			            	<ol class="breadcrumb float-sm-right">
			              		<li class="breadcrumb-item"><a href="./" id="timeRemaining">Home</a></li>
			              		<li class="breadcrumb-item active"><?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> </li>
			            	</ol>
			          	</div>
			        </div>
      			</div>
    		</div>
    		<section class="content">
    			<div class="container">
    				<div class="row">
    					<div class="col-md-12">
    						<div class="card card-success">
    							<div class="card-header">
    								<h4 class="card-title">Payroll Expenditure</h4>
    							</div>
    							<div class="card-body">
    								<div class="table table-responsive">
    									<table class="cell-table" id="PayrollExpe">
    										<thead>
    											<tr>
    												<th>Staff Name</th>
    												<th>Month Paid</th>
                                                    <th>Amount Paid</th>
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
						                       		<td><?php echo getStaffMemberNames($connect, $staff_id, $parent_id)?></td>
						    						<td><?php echo date("F", strtotime($pay_date))?></td>
                                                    <td><?php echo $the_currency?> <?php echo number_format($net_pay, 2) ?></td>
						                       	</tr>
						                        <?php

						                            }
    											?>
    										</tbody>
    										<tfoot>
    											<th>Total Enumerations</th>
    											<th></th>
    											<th><?php echo getCurrency($connect, $_SESSION['parent_id'])?> <?php echo TotalPaid($connect, $_SESSION['parent_id'])?></th>
    										</tfoot>
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
	<?php include("footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script>
		$(function(){
			$("#PayrollExpe").DataTable();
		})
	</script>
</body>
</html>