<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");
	$option = $countries = '';
	$query = $connect->prepare("SELECT * FROM currencies");
	$query->execute();
	foreach ($query->fetchAll() as $row) {
		$option .= '<option value="'.$row['code'].'">'.$row['code'].'</option>';
		$countries .= '<option value="'.$row['id'].'">'.$row['country'].'</option>';
	}
	$branch_options = "";
	$sql = $connect->prepare("SELECT * FROM branches WHERE member_id = ?");
	$sql->execute(array($_SESSION['parent_id']));
	foreach ($sql->fetchAll() as $row) {
		$branch_options .= '<option value="'.$row['id'].'">'.$row['branch_name'].'</option>';
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Members</title>
	<?php include("../payrolls/links.php") ?>
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
		.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
		    border-color: #ff80ac;
		    height: 35px !important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
		    width: 100%;
		    margin-left: .375rem;
		    height: 35px;
		}
		.select2-container--default .select2-selection--single {
		    background-color: #f8f9fa;
		    border: 1px solid #aaa;
		    border-radius: 4px;
		    height: 35px;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__rendered {
		    box-sizing: border-box;
		    list-style: none;
		    margin: 0;
		    padding: .4em;
		    width: 100%;
		}
		img.img-rounded {
			border-radius: 50%;
		}
	</style>
</head>
<?php
	
?>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../payrolls/nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h4> <?php echo ucwords(getBranchName($connect, $_SESSION['parent_id'], $BRANCHID))?> BRANCH </h4>
  							<?php if($_SESSION['user_role'] == 'Admin'):?>
  								<a href="add-staff-members" class="btn btn-outline-primary" type="button"  ><i class="bi bi-person"></i> New Admin</a>
  							<?php endif;?>
  						</div>
      				</div>
      			</div>
      			<div class="container-fluid">
      				<div class="row">
      					<?php if($_SESSION['user_role'] == 'Admin'):?>
	      					<div class="col-md-12 mb-5">
	      						<a href="" class="gridView text-secondary btn btn-secondary" style="font-size: 2em;"><i class="bi bi-grid-3x3-gap text-white"></i></a>
	      						<a href="" class="listView text-secondary btn btn-secondary" style="font-size: 2em;"><i class="bi bi-list text-white"></i></a>
	      					</div>
      					<?php endif;?>
      				</div>
      			</div>
      			<div class="container-fluid border-top pt-3 gridViewDiv">
      				<div class="row">
  						<?php
		      				$query = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
							$query->execute(array($_SESSION['parent_id']));
							if ($query->rowCount() > 0) {
								foreach ($query->fetchAll() as $rows) {
									extract($rows);
									$_SESSION['parent_id'] = $parent_id;
									if ($photo == "") {
										$photo 	= 'dist/img/user2-160x160.jpg';
									}else{
										$photo 	= 'members/adminphotos/'.$photo;
									}
									$staff_id 	= $id;
									$parent_id 	= $parent_id;

									if($activate == '0'){
										$access = '<a href="'. $staff_id.'" class="allow_access btn btn-outline-success">Allow Access</a>';
									}elseif($activate == '1'){
										$access = '<a href="'. $staff_id.'" class="deny_access btn btn-outline-warning">Deny Access</a>';
									}
									
									if ($position == 'Admin') {
										$btn = '<a href="../members/editAdmin?staff_id='.base64_encode($staff_id).'" class="editAdmin btn btn-outline-primary" data-id="'.$id.'"><i class="bi bi-pencil-square"></i> Edit</a>';
										$title = 'Super Admin';
									}else{
										$btn = '
											<a href="../members/editAdmin?staff_id='.base64_encode($staff_id).'" class="editAdmin btn btn-outline-primary" data-id="'.$id.'"><i class="bi bi-pencil-square"></i> Edit</a>
											<a href="" class="deleteAdmin btn btn-outline-danger " data-id="'.$staff_id.'"><i class="bi bi-trash"></i> Remove</a>
										';
										$title = $position;
									}
								?>
			      			<div class="col-md-4">
	      						<div class="card card-widget widget-user">
					              	<div class="widget-user-header bg-info">
					                	<h3 class="widget-user-username"><?php echo $firstname; ?> <?php echo $lastname; ?></h3>
					                	<h5 class="widget-user-desc"><?php echo $title?> <small></small></h5>
					             	</div>
					              	<div class="widget-user-image">
					                	<img class="img-circle elevation-2" src="<?php echo $photo?>" alt="<?php echo $photo?>" style="width:90px; height:90px; border-radius: 50% ">
					              	</div>
						            <div class="card-footer">
						                <div class="row">
						                  	<div class="col-sm-6 border-right">
						                    	<div class="description-block">
						                      		<h5 class="description-header"><small><em><?php echo strtolower($email)?></em> </small></h5>
						                    	</div>

						                  	</div>
						                  	<div class="col-sm-6">
						                    	<div class="description-block">
						                      		<h5 class="description-header"><?php echo $phonenumber?></h5>
						                    	</div>
						                 	</div>
						                  	<div class="col-sm-12">
						                    	<div class="description-block">
						                      		<!-- <h5 class="description-header"> -->
						                      			<?php echo allowedBranches($connect, $staff_id, $parent_id)?>	
						                      		<!-- </h5> -->
						                    	</div>
						                  	</div>
						                  
						                  	<div class="col-md-12 d-flex justify-content-between">
						                  		<?php if ($_SESSION['user_role'] != 'Admin'):?>
						                  		<?php else:?>
							                  		<?php echo $access ?>
							                  		<?php echo $btn?>
							                  	<?php endif;?>
						                	</div>
						                </div>
						            </div>
					            </div>
					        </div>
						<?php } }?>
      				</div>
      			</div>
      			<div class="container-fluid listViewDiv" style="display: none;">
      				<div class="row">
      					<div class="col-md-12">
      						
      						<div class="card card-warning card-outline mb-5">
      							<div class="card-body box-profile">
      								
      								<div class="table table-responsive">
			      						<table id="adminsTable" class="cell-border" style="width:100%">
									        <thead>
									            <tr>
									            	<th>Photo</th>
									                <th>Names</th>
									                <th>Phone</th>
									                <th>Email</th>
									                <th>Position</th>
									                <th>Branches</th>
									                <?php if($_SESSION['user_role'] == 'Admin'):?>
									                <th>Actions</th>
									                <?php else:?>
									                <?php endif;?>
									            </tr>
									        </thead>
									        <tbody class="text-dark">
									        	<?php
									        		$query = $connect->prepare("SELECT * FROM admins WHERE parent_id = ? ");
													$query->execute(array($_SESSION['parent_id']));
													if ($query->rowCount() > 0) {
														foreach ($query->fetchAll() as $row) {
															$_SESSION['parent_id'] = $row['parent_id'];
															if ($row['photo'] == "") {
																$photo 	= 'dist/img/user2-160x160.jpg';
															}else{
																$photo 	= 'adminphotos/'.$row['photo'];
															}
															$staff_id 	= $row['id'];
															$parent_id 	= $row['parent_id'];
														?>
															<tr>
																<td><img src="<?php echo $photo?>" class="img-fluid" style="width:50px; height:50px; border-radius: 50% "> </td>
																<td><?php echo $row['firstname']?> <?php echo $row['lastname']?></td>
																
																<td><?php echo $row['phonenumber']?></td>
																<td><?php echo $row['email']?> </td>
																
																<td><?php echo $row['position']?></td>
																<td><?php echo allowedBranches($connect, $staff_id, $parent_id)?></td>
																<td>
																	<a href="../members/editAdmin?staff_id=<?php echo base64_encode($staff_id)?>" class="editAdmin text-primary" data-id="<?php echo $row['id']?>"><i class="bi bi-pencil-square"></i></a>
																	<a href="" class="deleteAdmin text-danger" data-id="<?php echo $row['id']?>"><i class="bi bi-trash"></i></a>
																</td>
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
	<?php include("../payrolls/footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		$(document).ready( function () {
		    $('#adminsTable').DataTable();
		    $("#branchesTable").DataTable();
		    // select
		    $('.select2').select2();
		    //datepicker
		    $("#open_date").datepicker({

				format: 'yyyy-mm-dd'
			});

			$(".listView").click(function(e){
				e.preventDefault();
				$(".gridViewDiv").hide();
				$(".listViewDiv").show();
			})

			$(".gridView").click(function(e){
				e.preventDefault();
				$(".gridViewDiv").show();
				$(".listViewDiv").hide();
			})
		});

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
	

	$(document).on("click", ".deleteAdmin", function(e){
		e.preventDefault();
		var delete_admin_id = $(this).data("id");
		// alert(delete_admin_id);
		if(confirm("If you remove admin, they wont have access to the system and it can't be reversed")){
			$.ajax({
				url:"edit",
				method:"post",
				data:{delete_admin_id:delete_admin_id},
				beforeSend:function(){

				},
				success:function(data){
					if (data === 'done') {
						successNow("Staff Deleted");
						setTimeout(function(){
							location.reload();
						}, 2000);
					}else{
						errorNow(data);
					}
				}
			})
		}else{
			return false;
		}
	})

	$(document).on("click", ".allow_access", function(e){
		e.preventDefault();
		var allow_access_id = $(this).attr("href");
		if(confirm("Confirm giving permisions to access the system?")){
			$.ajax({
				url:"edit",
				method:"post",
				data:{allow_access_id:allow_access_id},
				beforeSend:function(){

				},
				success:function(data){
					if (data === 'done') {
						successNow("Staff Permitted to log in to the system");
						setTimeout(function(){
							location.reload();
						}, 2000);
					}else{
						errorNow(data);
					}
				}
			})
		}else{
			return false;
		}
	})

	$(document).on("click", ".deny_access", function(e){
		e.preventDefault();
		var deny_access_id = $(this).attr("href");
		if(confirm("Confirm revoking permisions to access the system?")){
			$.ajax({
				url:"edit",
				method:"post",
				data:{deny_access_id:deny_access_id},
				beforeSend:function(){

				},
				success:function(data){
					if (data === 'done') {
						successNow("Staff has been banned from having access to the system !");
						setTimeout(function(){
							location.reload();
						}, 2000);
					}else{
						errorNow(data);
					}
				}
			})
		}else{
			return false;
		}
	})

</script>
</body>
</html>