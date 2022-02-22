<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Payslip for <?php echo getStaffMemberNames($connect, $_GET['staff-id'], $_GET['parent-id']) ?></title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	
	
	
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<!-- <h4> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> BRANCH </h4> -->
  						</div>
      				</div>
      			</div>
      			<?php

			  		$sql = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
			        $sql->execute(array($_SESSION['parent_id']));

			        $query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE parent_id = ? ");
			        $query->execute(array($_SESSION['parent_id']));
      			?>
      			<div class="container">
      				<div class="row">
      					<div class="col-md-12">
			      			<div class="card">
			      				<div class="card-header">
			      					<h4 class="card-title">Template Three</h4>
			      				</div>
			      				<div class="card-body text-center">
			      					<img src="temps/payslip_template_one.png" class="img-fluid" alt="payslip_template_one">
			      				</div>
			      				<div class="card-footer d-flex justify-content-between">
			      					<a href="">Print </a>
			      					<a href="">Generate PDF</a>
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

</body>
</html>