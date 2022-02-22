<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");  
	
  	if (isset($_GET['user_email']) && isset($_GET['username'])) {
  		$user_email = $_GET['user_email'];
  		$username = $_GET['username'];
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $username?> - </title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>
<?php
	
?>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content bg-light mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 d-flex justify-content-between mt-5 border-bottom border-primary">
      						<h4>Emails Sent To <?php echo ucwords($username) ?></h4>
      					</div>
      				</div>
      			</div>
      			<!-- borrower form -->
      			<div class="container-fluid pt-3">
      				<div class="row">
      					<div class="col-md-12">
      						<div class="card mb-5">
      							<div class="card-header">
      								<h4 class="card-title"><?php echo ucwords($username) ?></h4>
      							</div>
      							<div class="card-body">
      								<div class="row">
		      							<?php 
		      								$output = '';
				      						$query = $connect->prepare("SELECT * FROM sent_emails WHERE receiver = ? AND parent_id = ?");
				      						$query->execute(array($user_email, $_SESSION['parent_id']));
				      						$count = $query->rowCount();
				      						if ($count > 0) {
				      							foreach ($query as $row) {
				      								extract($row);

				      								$output .= '
				      									<div class="col-md-4">
				      										<div class="card mb-4 border border-primary shadow">
				      											<div class="card-header">
								      								<h4 class="card-title"><i class="bi bi-chat-left"></i></h4>
								      							</div>
					      										<div class="card-body">
					      											<p> '.$message.'<p>
				      											</div>
				      											<div class="card-footer">
				      												<em><i class="bi bi-clock-history"></i> '.$date_sent.'</em>
				      											</div>
				      										</div>
				      									</div>
				      								';
				      							}
				      							echo $output;
				      						}else{
				      							echo "<h4 class='text-center'>".$count. "  Emails Sent </h4>";
				      							
				      						}
				      					?>
				      				</div>
	      						</div>
      						</div>
      					</div>
      				</div>
      			</div>
      			
				<!-- Editing Modal -->
      		</section>
		</div>
		<aside class="control-sidebar control-sidebar-dark"></aside>
	</div>
	<?php include("footer_links.php")?>
	
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#myTable').DataTable();
		});

		function errorNow(msge){
	  		toastr.error(msge)
	  		toastr.options.progressBar = true;
	  		toastr.options.positionClass = "toast-top-center";
	  	}

	  	function successNow(msge){
	  		toastr.success(msge)
	  		toastr.options.progressBar = true;
	  		toastr.options.positionClass = "toast-top-center";
	  	}
    	
	</script>
</body>
</html>