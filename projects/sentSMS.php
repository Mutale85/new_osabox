<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");  
	
  	if (isset($_GET['user_phone']) && isset($_GET['username'])) {
  		$user_phone = $_GET['user_phone'];
  		$username = $_GET['username'];
  	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>SMS Details</title>
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
      					<?php 
      						$query = $connect->prepare("SELECT * FROM sms_settings WHERE parent_id = ?");
							$query->execute(array($_SESSION['parent_id']));
							if ($query->rowCount() > 0) {
								$row = $query->fetch();
								if ($row) {
									extract($row);
									
									$query_two = $connect->prepare("SELECT * FROM sms_prices WHERE Prefix = ?");
      								$query_two->execute(array($prefix));
      								if ($query_two->rowCount() > 0) {
      									$roq = $query_two->fetch();
      									if ($roq) {
      										extract($roq);
      										$remaining = "Trial SMS: ". (ceil(1 / $Price) - 1);
      										// We check how many have been sent
      									}
      								}else{
      									$remaining = 'You have no SMS';
      								}
								}
							}else{

							}
      					?>
      					<div class="col-md-12 d-flex justify-content-between mt-5 border-bottom border-primary">
      						<h4><?php echo $remaining?></h4>
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

	      							<?php 
	      								$output = '';
			      						$query = $connect->prepare("SELECT * FROM sms WHERE receiver = ? AND parent_id = ?");
			      						$query->execute(array($user_phone, $_SESSION['parent_id']));
			      						$count = $query->rowCount();
			      						if ($count > 0) {
			      							foreach ($query as $row) {
			      								extract($row);

			      								$output .= '
			      									<div class="col-md-4">
			      										<div class="card mb-4 border border-primary shadow">
				      										<div class="card-body">
				      											<p><i class="bi bi-chat-left"></i> '.$message.'<p>
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
			      							echo "<p class='text-center'>You have not sent any SMS to ".$username." </p>";
			      							
			      						}
			      					?>
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