<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Projects View</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h1 class="h3"> <?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> </h1>
  						</div>
      				</div>
      			</div>
      		</section>
      		<section class="content">
      			<?php
      				$parent_id = $_SESSION['parent_id']; 
      				if (isset($_COOKIE['projectID'])) {
      					$projectID = $_COOKIE['projectID'];
      					$query = $connect->prepare("SELECT * FROM projects WHERE id = ? AND parent_id = ? ");
						$query->execute(array($projectID, $parent_id));
						$roq = $query->fetch();
						if ($roq) {
							extract($roq);
							$Status = $status;
      			?>
		      	<div class="card">
		        	<div class="card-header">
		          		<h3 class="card-title">Projects Detail - <span class="badge badge-info"><?php echo $Status?></span></h3>
		          		<div class="card-tools">
		            		<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
		              			<i class="fas fa-minus"></i>
		            		</button>
		            		<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
		              			<i class="fas fa-times"></i>
		            		</button>
		          		</div>
		        	</div>
		        	<div class="card-body">
		          		<div class="row">
		          			<!-- Project Name and Description -->
		            		<div class="col-12 col-md-12 col-lg-4 order-1 order-md-1 bg-light p-4 shadow mb-5">
		              			<h3 class="text-primary border-bottom pb-2"> <?php echo $project_name ?></h3>
		              			<p class="text-muted"><?php echo htmlspecialchars_decode($description) ?></p>
		              			<br>
		              			<hr>
		              			<h5 class="mt-5 text-muted">Project files</h5>
		              			<ul class="list-unstyled">
		              			<?php 
		              				$sql = $connect->prepare("SELECT * FROM projects_files  WHERE parent_id = ? AND project_id = ? ");
		              				$sql->execute(array($projectID, $parent_id));
		              				if($sql->rowCount() > 0){
		              					foreach ($sql->fetchAll() as $row) {
		              						$file = $row['project_files'];
		              						
		              			?>
				              	
					                <li>
					                  	<a href="projects/files/<?php echo $file?>" target="_blank" class="btn-link text-secondary"><i class="far fa-fw fa-file"></i> <?php echo $file?></a>
					                </li>
					            <?php
					                	}
		              				}
					            ?>
				              	</ul>
				              	<hr>
		              			<div class="text-muted">
			                		<p class="text-sm">
			                			<span class="mb-3">Project Leader</span>
			                			<b class="d-block">
			                				<img alt="<?php echo getStaffMemberImage($connect, $leader, $parent_id)?>" class="table-avatar img-circle" src="<?php echo getStaffMemberImage($connect, $leader, $parent_id)?>" style="width: 40px; height:40px;">
			                  			<?php echo getStaffMemberNames($connect, $leader, $parent_id) ?></b>
			                		</p>
		              			</div>
		              			<div class=" mt-5 mb-3">
		              				<?php if($leader == $_SESSION['user_id']):?>
		                				<div class="form-group col-md-6">
						                	<label for="status">Change Project Status</label>
							                <select id="status" name="status" class="form-control custom-select" onchange="updateProjectStatus(this.value, '<?php echo $projectID?>')">
							                  	<option value="<?php echo $Status?>" selected ><?php echo $Status?></option>
							                  	<option value="Starting">Starting</option>
							                  	<option value="On Going">On Going</option>
							                  	<option value="On Hold">On Hold</option>
							                  	<option value="Canceled">Canceled</option>
							                  	<option value="Success">Success</option>
							                </select>
						              	</div>
		                			<?php else:?>

		                			<?php endif;?>
		              			</div>
		            		</div>
		            		<div class="col-12 col-md-12 col-lg-8 order-2 order-md-2">
		              			<div class="row">
		                			<div class="col-12 col-sm-4">
		                  				<div class="info-box bg-light">
		                    				<div class="info-box-content">
		                     					<span class="info-box-text text-center text-muted">Estimated budget</span>
		                      					<span class="info-box-number text-center text-muted mb-0"><?php echo $currency?> <?php echo $estimated_budget?></span>
		                    				</div>
		                  				</div>
		                			</div>
					                <div class="col-12 col-sm-4">
					                  	<div class="info-box bg-light">
					                    	<div class="info-box-content">
					                      		<span class="info-box-text text-center text-muted">Total amount spent</span>
					                     		<span class="info-box-number text-center text-muted mb-0"><?php echo $currency?> <?php echo calculateSpentBudget($connect, $projectID, $parent_id)?></span>
					                    	</div>
					                  	</div>
					                </div>
		                			<div class="col-12 col-sm-4">
					                  	<div class="info-box bg-light">
					                    	<div class="info-box-content">
					                      		<span class="info-box-text text-center text-muted">Estimated project duration</span>
					                      		<span class="info-box-number text-center text-muted mb-0"><?php echo $estimated_duration?> <?php echo $estimated_period?>(s)</span>
					                    	</div>
					                  	</div>
		                			</div>
		              			</div>
		              			<!-- end of intro -->
		              			<div class="row">
		                			<div class="col-12">
		                  				<h4 class="mb-3 mt-5">Project Milestone</h4>
		                  				<?php
		                  					$query = $connect->prepare("SELECT * FROM `projectMilestone` WHERE parent_id = ? AND projectID = ? ");
											$query->execute(array($parent_id, $projectID));
											foreach ($query->fetchAll() as $qow):
												extract($qow);
												if ($user_id == $_SESSION['user_id']) {
													$edit = '<p><a href="'.$id.'" class="editMilestone"><i class="bi bi-pencil-square"></i></a> <a href="'.$id.'" class="deleteMilestone"><i class="bi bi-trash text-danger"></i></a></p>';
												}else{
													$edit = '';
												}
		                  				?>
		                    			<div class="post mb-5 shadow p-4">
		                      				<div class="user-block">
		                       	 				<img alt="<?php echo getStaffMemberImage($connect, $user_id, $parent_id)?>" class="table-avatar img-circle" src="<?php echo getStaffMemberImage($connect, $user_id, $parent_id)?>" style="width: 40px; height:40px;">
	                        					<span class="username">
	                          						<a href=""><?php echo getStaffMemberNames($connect, $user_id, $parent_id) ?></a>
	                        					</span>
	                        					<span class="description"><?php echo time_ago_check($date_added)?></span>
		                      				</div>
						                    <p><?php echo $milestone ?></p>
						                    <p>Amount Spent: <?php echo $currency?> <?php echo $spent_budget?></p>
		                      				<p>
		                        				<a href="projects/files/<?php echo $attachment?>" target="_blank" class=" text-primary text-sm"><i class="fas fa-link mr-1"></i> <?php echo $attachment?></a>
		                      				</p>
		                      				<?php echo $edit;?>
		                    			</div>
		                    			<?php
		                    			 	endforeach;	
		                    			?>
		                			</div>
		                			<div class="col-md-12">
		                				<div class="text-center mt-5 mb-3">
		                					<a href="<?php echo $projectID?>" class="btn btn-primary shadow projectMilestone" >ADD MILESTONES</a>
		              					</div>
		                			</div>
		              			</div>
		            		</div>

		          		</div>
		        	</div>
		      	</div>
		    	<?php
		    		}
		    	}
		    	?>
		    	<!-- TODO LIST MODAL -->
      			 <div class="modal fade" id="modal-lg">
			        <div class="modal-dialog modal-lg">
			          	<div class="modal-content">
			            	<div class="modal-header">
			              		<h4 class="modal-title"><span id="modal-title">Create Milestone</span></h4>
			              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                		<span aria-hidden="true"><i class="bi bi-x-circle text-danger"></i></span>
			              		</button>
			            	</div>
			            	<form method="post" id="milestoneForm">

				            	<div class="modal-body">

				            		<img alt="<?php echo getStaffMemberImage($connect, $_SESSION['user_id'], $parent_id)?>" class="table-avatar img-circle" src="<?php echo getStaffMemberImage($connect, $_SESSION['user_id'], $parent_id)?>" style="width: 40px; height:40px;">
				            		<b><?php echo getStaffMemberNames($connect, $_SESSION['user_id'], $parent_id) ?></b>
				            		<div class="mb-3"></div>
				            		<div class="form-group">
					                	<label for="spent_budget">Total amount spent</label>
					                	<div class="input-group">
					                		<span id="currency_span" class="input-group-text"></span>
					                		<input type="number" id="spent_budget" name="spent_budget" class="form-control" min="0" step="any"> 
					                		<input type="hidden" name="currency" id="currency">
					                	</div>
					              	</div>
				            		<div class="form-group">
					              		<textarea class="form-control" id="milestone" name="milestone" rows="4" required></textarea>
					              	</div>
				              		<input type="hidden" name="ID" id="ID">
				              		<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
				              		<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
				              		<input type="hidden" name="projectID" id="projectID" value="<?php echo $projectID?>">
				              		<input type="hidden" name="user_id" id="user_id" value="<?php echo $_SESSION['user_id']?>">
				              		<label><input type="file" name="attachment" id="attachment"> Attach File <i class="bi bi-paperclip"></i></label>
				            	</div>
				            	<div class="modal-footer justify-content-between">
				              		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearForm()">Close</button>
				              		<button type="submit" class="btn btn-primary postTask" id="submit_project">Save Milestone</button>
				            	</div>
				            </form>
			          	</div>
			        </div>
			    </div>
			    <!-- END OF MODAL -->
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
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>
		//========== GET CURRENCY
		document.addEventListener('DOMContentLoaded', function () {
		 	var currency_span = document.getElementById('currency_span');
		 	var the_currency = document.getElementById('currency');
		 	if (localStorage['currency_main']) { 
		     	currency_span.innerHTML = localStorage['currency_main'];
		     	the_currency.value = localStorage['currency_main'];
		 	}
		});

		function clearForm(){
	        document.getElementById('milestone').value = '';
	        $("#ID").val("");
	    }
		$(function(){
			$(".projectMilestone").click(function(e){
				e.preventDefault();
				$("#modal-lg").modal("show");
			});

			$('#milestone').summernote({
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

			$("#start_date").datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true,
				startDate: '-1d',
				defaultViewDate: 'today',
			});
			// =================== SUBMITE THE data =================================

			$("#milestoneForm").submit(function(e){
				e.preventDefault();
				var milestoneForm = document.getElementById('milestoneForm');
				
				var data = new FormData(milestoneForm);
				var url = 'projects/submit-projectMilestone';
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
						if (data === 'done') {
							successNow(" Project Milestone Added");
							setTimeout(function(){
								location.reload();
							}, 1500);
						}else if(data == 'updated'){
							successNow("Project Milestone Updated");
							setTimeout(function(){
								location.reload();
							}, 1500);
						}else{
							errorNow(data);
						}
					}
				})
			})
		})

		$(document).on("click", ".editMilestone", function(e){
			e.preventDefault();
			var milestone_id = $(this).attr("href");
			$("#modal-lg").modal("show");
			$.ajax({
				url:"projects/editData",
				method:"post",
				data:{milestone_id:milestone_id},
				dataType:"JSON",
				success:function(data){
					$("#ID").val(data.id);
					$('#milestone').summernote('code', data.milestone);
					$("#spent_budget").val(data.spent_budget);
				}
			})
		})

		$(document).on("click", ".deleteMilestone", function(e){
			e.preventDefault();
			var milestone_id_delete = $(this).attr("href");
			if(confirm("Confirm you wish to remove the milestone?")){
				$.ajax({
					url:"projects/editData",
					method:"post",
					data:{milestone_id_delete:milestone_id_delete},
					success:function(data){
						if (data === 'done') {
							successNow("Milestone Removed");
							setTimeout(function(){
								location.reload();
							}, 1000);
						}else{
							errorNow(Data);
						}
					}
				})
			}else{
				return false;
			}
		})

		function updateProjectStatus(status, project_id){
			// successNow(status);
			if(confirm("Confirm you wish to change project status?")){
				$.ajax({
					url:"projects/editData",
					method:"post",
					data:{status:status, projectID:project_id},
					success:function(data){
						if (data === 'done') {
							successNow("Project Status Changed");
							setTimeout(function(){
								location.reload();
							}, 1000);
						}else{
							errorNow(Data);
						}
					}
				})
			}else{
				return false;
			}
		}

		
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