<?php 
  require ("includes/db.php");
  if (!isset($_COOKIE['ManagementApp']) && !isset($_SESSION['email'])) {?>
      <script>
          window.location = '../home';
      </script>
  <?php
    }else if ($_COOKIE['ManagementApp'] == 'payrolls') {
      echo "<script>
            window.location = '../payrolls';
          </script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title>Dashboard</title>
	<?php include("links.php") ?>
  	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  	<style>
  		.card-title {
  			text-align: center;
  		}
  	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
  		<?php include ("nav_side.php"); ?>
  		<div class="content-wrapper">
	  		<?php include ("dash_data.php"); ?>
		    <section class="content">
		    	<div class="container-fluid">
		    		<div class="row">
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="our-clients">
		    					<div class="card bg-primary">
		    						<div class="card-header">
		    							<h5 class="">OUR CLIENTS</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>List and manage your clients</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="create-payroll">
		    					<div class="card">
		    						<div class="card-header">
		    							<h5 class="">CREATE PROJECT</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Create New Project</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="kanban">
		    					<div class="card bg-info">
		    						<div class="card-header">
		    							<h5 class="">TO DO LIST</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Plan and manage your activities with</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="view-projects">
		    					<div class="card bg-secondary">
		    						<div class="card-header">
		    							<h5 class="">ALL PROJECTS</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>View and add milestones to your projects</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>

		    			<div class="col-md-4 text-center mb-5">
		    				<a href="members/add-staff-members">
		    					<div class="card bg-danger">
		    						<div class="card-header">
		    							<h5 class="">ADD STAFF</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Add your staff or partners</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="members/email-settings">
		    					<div class="card bg-warning">
		    						<div class="card-header">
		    							<h5 class="">EMAIL SETTINGS</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Set your SMTP email</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="members/sms-create-sender-id">
		    					<div class="card bg-info">
		    						<div class="card-header">
		    							<h5 class="">SMS SETTINGS</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Create SMS sender ID</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="create-payroll">
		    					<div class="card bg-secondary">
		    						<div class="card-header">
		    							<h5 class="">BRANDING</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Your business name, logo and address</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="members/branches">
		    					<div class="card bg-primary">
		    						<div class="card-header">
		    							<h5 class="">BRANCHES</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Create and choose branch to work from</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="members/branches">
		    					<div class="card">
		    						<div class="card-header">
		    							<h5 class="">POSITIONS</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Create company positions for staff and partners</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    			<div class="col-md-4 text-center mb-5">
		    				<a href="subscription">
		    					<div class="card bg-warning">
		    						<div class="card-header">
		    							<h5 class="">SUBSCRIPTION</h5>
		    						</div>
			    					<div class="card-body">
			    						<p>Upgrade your Subscription</p>
			    					</div>
			    				</div>
		    				</a>
		    			</div>
		    		</div>
		    	</div>
		    </section>
  		</div>
  		<aside class="control-sidebar control-sidebar-dark"></aside>
  		<?php include("footer_links.php")?>
  	</div>
</body>
</html>