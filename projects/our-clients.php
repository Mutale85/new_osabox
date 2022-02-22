<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php"); 

  	$query = $connect->prepare("SELECT * FROM admins WHERE parent_id = ?");
  	$query->execute(array($_SESSION['parent_id']));
  	$results = $query->fetchAll();
  	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Our clients</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<?php include ("dash_data.php"); ?>
			<section class="content  mt-5">
	      		<div class="container-fluid mb-5">
	      			
	      			<div class="row">
	        			<div class="col-md-5">
		        			<form method="post" id="clientsForm">	
		          				<div class="card card-primary">
						            <div class="card-header">
						              	<h3 class="card-title">New Client's Form</h3>
						              	<div class="card-tools">
						                	<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						                  		<i class="fas fa-minus"></i>
						                	</button>
						              	</div>
						            </div>
						            <div class="card-body">
						            	<div class="row">
							              	<div class="form-group col-md-6">
							                	<label for="project_name">First Names</label>
							                	<input type="text" id="firstname" name="firstname" class="form-control">
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="project_name">Last Name</label>
							                	<input type="text" id="lastname" name="lastname" class="form-control">
							              	</div>
							              	<input type="hidden" name="client_id" id="client_id" value="">
							              	<div class="form-group col-md-6">
							                	<label for="project_name">Business Name</label>
							                	<input type="text" id="company_name" name="company_name" class="form-control">
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="project_name">address</label>
							                	<textarea id="address" name="address" class="form-control" rows="2"></textarea>
							              	</div>
							              	
							              	<div class="form-group col-md-6">
							                	<label for="start_date">Email</label>
							                	<input type="text" id="email" name="email" class="form-control">
							                	<input type="hidden" id="branch_id" name="branch_id" class="form-control" value="<?php echo $BRANCHID?>">
							                	<em>You will be able to send emails to the your client</em>
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="start_date">Phone</label>
							                	<input type="text" id="phone" name="phone" class="form-control">
							                	<input type="hidden" id="parent_id" name="parent_id" class="form-control" value="<?php echo $_SESSION['parent_id']?>">
							                	<em>You will be able to send sms to the your client</em>
							              	</div>
							              	<button class="btn btn-success float-right" type="submit" id="submit_project">Add New Client</button>
							            </div>
						            </div>
		          				</div>
		          			</form>
	        			</div>
	        			<div class="col-md-7">
	          				<div class="card card-secondary">
	            				<div class="card-header">
	              					<h3 class="card-title">Clients</h3>

	              					<div class="card-tools">
						                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						                  	<i class="fas fa-minus"></i>
						                </button>
						            </div>
	            				</div>
					            <div class="card-body">
					              	<div class="table table-responsive">
					              		<table class="table table-striped" id="clientsTable">
					              			<thead>
					              				<tr>
					              					<th>Clients Name</th>
					              					<th>Company</th>
					              					<th>Address</th>
					              					<th>Email & Phone</th>
					              					<th>Edit</th>
					              					<th>Remove</th>
					              				</tr>
					              			</thead>
					              			<tbody>
					              				<?php
					              					$query = $connect->prepare("SELECT * FROM `clients` WHERE parent_id = ? AND branch_id = ? ");
					              					$query->execute(array($_SESSION['parent_id'], $BRANCHID));
					              					if ($query->rowCount() > 0) {
					              						foreach ($query as $row) {
					              							extract($row);
					              				?>
					              					<tr>
					              						<td><?php echo $firstname ?> <?php echo $lastname ?></td>
					              						<td>
					              							<?php echo $company_name ?>
					              						</td>
					              						<td><?php echo $address ?> </td>
					              						<td><?php echo $email ?> & <?php echo $phone ?></td>
					              						<td><a href="<?php echo $id ?>" class="editData text-primary"><i class="bi bi-pen"></i></a></td>
					              						<td><a href="<?php echo $id ?>" class="deleteData text-danger"><i class="bi bi-trash"></i></a></td>
					              					</tr>
					              				<?php
					              						}
					              					}else{

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
    <?php include("footer_links.php")?>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<script>
		//========== GET CURRENCY
		$(function(){
			$("#clientsTable").DataTable();
			$('#description').summernote({
				height: 200,
				toolbar: [
				  ['style', ['style']],
				  ['font', ['bold', 'underline', 'clear']],
				  ['fontname', ['fontname']],
				  ['fontsize', ['fontsize']],
				  ['color', ['color']],
				  ['para', ['ul', 'ol', 'paragraph']],
				  ['table', ['table']],
				  ['insert', ['link']],
				  ['view', ['fullscreen']],
				],
				
			});


			// =================== SUBMITE THE data =================================

			$("#clientsForm").submit(function(e){
				e.preventDefault();
				var clientsForm = document.getElementById('clientsForm');
				
				var data = new FormData(clientsForm);
				var url = 'client-submit';
				$.ajax({
					url:url+'?<?php echo time()?>',
					method:"post",
					data:data,
					cache : false,
					processData: false,
					contentType: false,
					beforeSend:function(){
						$("#submit_project").html("<i class='fa fa-spinner fa-spin'></i>");
					},
					success:function(data){
						successNow(data);
						// setTimeout(function(){
						// 	location.reload();
						// }, 1000);
						
					}
				})
			})
		})

		$(document).on("click", ".editData", function(e){
			e.preventDefault();
			var client_id_edit = $(this).attr("href");
			$.ajax({
				url:"editData",
				method:"post",
				data:{client_id_edit:client_id_edit},
				dataType:"JSON",
				success:function(data){
					$("#client_id").val(data.id);
					$("#firstname").val(data.firstname);
					$("#lastname").val(data.lastname);
					$("#address").val(data.address);
					$("#company_name").val(data.company_name);
					$("#email").val(data.email);
					$("#phone").val(data.phone);
				}
			})
		})

		$(document).on("click", ".deleteData", function(e){
			e.preventDefault();
			var delete_clients_in_need_id = $(this).attr("href");
			if(confirm("You wish to remove the client")){
				$.ajax({
					url:"editData",
					method:"post",
					data:{delete_clients_in_need_id:delete_clients_in_need_id},
					success:function(data){
						
					successNow(data);
					setTimeout(function(){
						location.reload();
					}, 1000);
						
					}
				})
			}else{
				return false;
			}
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

	</script>
</body>
</html>