<?php 
  	require ("../../includes/db.php");
  	require ("../../includes/tip.php");
  	
?>
<!DOCTYPE html>
<html>
<head>
	<title>Add Projects</title>
	<?php include("../links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" /> -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
	<style type="text/css">
		.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
		    border-color: #ff80ac;
		    height: 30px !important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
		    width: 100%;
		    margin-left: .375rem;
		    height: 30px;
		}
		.select2-container--default .select2-selection--single {
		    background-color: #6499cd;
		    border: 1px solid #aaa;
		    border-radius: 4px;
		    height: 30px;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__rendered {
		    box-sizing: border-box;
		    list-style: none;
		    margin: 0;
		    padding: .4em;
		    width: 100%;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("../nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content  mt-5">
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
						}
					}
      			?>
      			<form method="post" id="projectForm">
	      			<div class="row">
	        			<div class="col-md-6">
	          				<div class="card card-primary">
					            <div class="card-header">
					              	<h3 class="card-title">General</h3>
					              	<div class="card-tools">
					                	<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
					                  		<i class="fas fa-minus"></i>
					                	</button>
					              	</div>
					            </div>
					            <div class="card-body">
					            	<div class="row">
						              	<div class="form-group col-md-6">
						                	<label for="project_name">Project Name</label>
						                	<input type="text" id="project_name" name="project_name" class="form-control" required value="<?php echo $project_name ?>">
						              	</div>
						              	<div class="form-group col-md-6">
						              		<input type="hidden" name="project_id" id="project_id" value="<?php echo $projectID?>">
						                	<label for="status">Status</label>
							                <select id="status" name="status" class="form-control custom-select">
							                  	<option selected value="<?php echo $Status?>"><?php echo $Status?></option>
							                  	<option value="Starting">Starting</option>
							                  	<option value="On Going">On Going</option>
							                  	<option value="On Hold">On Hold</option>
							                  	<option value="Canceled">Canceled</option>
							                  	<option value="Success">Success</option>
							                </select>
						              	</div>
						              	<div class="form-group col-md-12">
						                	<label for="description">Project Description</label>
						                	<textarea id="description" name="description" class="form-control" rows="4" required> <?php echo htmlspecialchars_decode($description) ?></textarea>
						              	</div>
						              	
						              	<div class="form-group col-md-12">
						                	<label for="leader">Project Leader</label>
						                	<select id="leader" name="leader" class="form-control" required>
						                		<option selected value="<?php echo $leader ?>"><?php echo getStaffMemberNames($connect, $leader, $parent_id) ?></option>
						                		<?php
						                			$query = $connect->prepare("SELECT * FROM admins WHERE id != ? AND parent_id = ? ");
												  	$query->execute(array($leader, $_SESSION['parent_id']));
												  	$results_admin = $query->fetchAll();
						                			foreach ($results_admin as $row) {
						                				extract($row);
						                		?>
						                				<option value="<?php echo $id ?>"><?php echo $firstname ?> <?php echo $lastname ?> </option>
												<?php  		 	
												  	} 
						                		?>
						                	</select>
						              	</div>
						              	<div class="form-group col-md-6">
						                	<label for="start_date">Project Start Date</label>
						                	<input type="text" id="start_date" name="start_date" class="form-control" required value="<?php echo date( "Y-m-d", strtotime($start_date))?>">
						              	</div>

						              	<div class="form-group col-md-6">
						                	<label for="deadline">Project Deadline</label>
						                	<input type="text" id="deadline" name="deadline" class="form-control" required value="<?php echo $deadline?>">
						              	</div>

						              	<div class="form-group col-md-6">
						                	<label for="leader">Project Team Members</label><br>
						                		
					                		<?php
					                			echo getOtherTeamMembers($connect, $_SESSION['parent_id']);
					                		?>
					                	</div>
					                	<div class="form-group col-md-6">
					                		<label><input type="checkbox" name="send_email" id="send_email" value=""> Send Notification</label>
					                		<p><b>NOTE:</b> Check the box to send email nofitication on project updates to all team members</p> 
						              	</div>

						              	<div class="col-md-12 mt-5 mb-5">
						              		<a href="members/add_admin" class="mt-3"> Add Staff / Admin</a>
						              	</div>
						            </div>
					            </div>
	          				</div>
	        			</div>
	        			<div class="col-md-6">
	          				<div class="card card-secondary">
	            				<div class="card-header">
	              					<h3 class="card-title">Budget</h3>

	              					<div class="card-tools">
						                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						                  	<i class="fas fa-minus"></i>
						                </button>
						            </div>
	            				</div>
					            <div class="card-body">
					              	<div class="form-group">
					                	<label for="estimated_budget">Estimated budget</label>
					                	<div class="input-group">
					                		<span id="currency_span" class="input-group-text"></span>
					                		<input type="number" id="estimated_budget" name="estimated_budget" class="form-control" min="0" step="any" value="<?php echo $estimated_budget?>">
					                	</div>
					                	<input type="hidden" name="currency" id="currency">
					              	</div>
					              	<div class="form-group">
					                	<label for="estimated_duration">Estimated project duration</label>
					                	<div class="input-group">
					                		<input type="number" id="estimated_duration" name="estimated_duration" class="form-control" value="<?php echo $estimated_duration?>">
					                		<select name="estimated_period" id="estimated_period" class="form-control">
					                			<option selected value="<?php echo $estimated_period?>"><?php echo $estimated_period?>(<sub>s</sub>)</option>
					                			<option value="Day">Day(<sub>s</sub>)</option>
					                			<option value="Week">Week(<sub>s</sub>)</option>
					                			<option value="Month">Month(<sub>s</sub>)</option>
					                			<option value="Year">Year(<sub>s</sub>)</option>
					                		</select>
					                	</div>
					              	</div>
					            </div>
	          				</div>

	          				<div class="card card-info">
	          					<div class="card-header">
	          						<h3 class="card-title">Project Files</h3>
	              					<div class="card-tools">
						                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
						                  	<i class="fas fa-minus"></i>
						                </button>
						            </div>
	          					</div>
	          					<div class="card-body">
	          						
	          						<input type="file" name="project_files[]" id="project_files" multiple onchange="javascript:filesList()" style="display: none;">
	          						<p class="fs-4"><a href="" class="callFileUploader btn btn-info"><i class="bi bi-paperclip"></i> Add More Files</a></p>
	          						<div id="fileList"></div>
	          						<div class="table table-responsive">	
		          							<table class="table table mt-5">
									            <thead>
									                <tr>
									                    <th>File Name</th>
									                    <th>File Size</th>
									                    <th></th>
									                </tr>
									            </thead>
									            <tbody>
					              			<?php
						              			function getSize($file) {
											        $size = filesize($file);
											        if ($size <= 0)
											            if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')) {
											                $size = trim(`stat -c%s $file`);
											            }
											            else{
											                $fsobj = new COM("Scripting.FileSystemObject");
											                $f = $fsobj->GetFile($file);
											                $size = $f->Size;
											            }
											        return $size;
											    }
					              				$sql = $connect->prepare("SELECT * FROM projects_files  WHERE parent_id = ? AND project_id = ? ");
					              				$sql->execute(array($projectID, $parent_id));
					              				if($sql->rowCount() > 0){
					              					foreach ($sql->fetchAll() as $row) {
					              						$file = $row['project_files'];
					              						$file_id = $row['id'];
					              						$file_data = 'files/'.$file;
					              			?>
							              	
								                <tr>
								                	<td><?php echo $file?></td>
								                  	<td><?php echo getSize($file_data)?> Bytes</td>
								                  	<td class="text-right py-0 align-middle">
								                      	<div class="btn-group btn-group-sm">
								                        	<a href="projects/files/<?php echo $file?>" target="_blank" class="btn btn-info"><i class="fas fa-eye"></i></a>
								                        	<a href="<?php echo $file_id?>" class="btn btn-danger trashFile"><i class="fas fa-trash"></i></a>
								                      </div>
								                    </td>
								                </tr>
								            <?php
								                	}
					              				}
								            ?>
							              	</tbody>
							            </table>
							        </div>
	          						
	          					</div>
	          				</div>
	        			</div>
	      			</div>
	      			<div class="row mb-5">
	        			<div class="col-12 mb-5">
	          				<!-- <a href="#" class="btn btn-secondary">Cancel</a> -->
	          				<button class="btn btn-success float-right" type="submit" id="submit_project">Update Project</button>
	        			</div>
	      			</div>
	      		</form>
    		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <?php include("../footer_links.php")?>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
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

		filesList = function() {
			var input = document.getElementById('project_files');
			var output = document.getElementById('fileList');

			output.innerHTML = '<ul>';
			for (var i = 0; i < input.files.length; ++i) {
				output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
			}
			output.innerHTML += '</ul>';
		}
		
		$(function(){
			$(".callFileUploader").click(function(e){
				e.preventDefault();
				$("#project_files").click();
			})

			$("#start_date, #deadline").datepicker({
				format: 'yyyy-mm-dd',
				autoclose:true,
				startDate: '-1d',
        		todayHighlight: true
			});
			$('.select2').select2();

			// $('#description').summernote();

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

			$("#projectForm").submit(function(e){
				e.preventDefault();
				var projectForm = document.getElementById('projectForm');
				
				var data = new FormData(projectForm);
				var url = 'projects/project-submit';
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
							successNow("New project added");
							setTimeout(function(){
								location.reload();
							}, 1500);
						}else if(data === 'updated'){
							successNow("Project data updated");
							setTimeout(function(){
								location.reload();
							}, 1500);
						}else{
							errorNow(data);
							// setTimeout(function(){
							// 	location.reload();
							// }, 2500);
						}
					}
				})
			})
		})

		$(document).on("click", ".trashFile", function(e){
			e.preventDefault();
			var trashFile_id = $(this).attr("href");
			if(confirm("confirm you wish to trash the file?")){
				$.ajax({
					url:"projects/editData",
					method:"post",
					data:{trashFile_id:trashFile_id},
					success:function(data){
						if (data === 'done') {
							successNow("File Deleted");
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

		$(document).on("click", ".removeMember", function(e){
			e.preventDefault();
			var team_member_id = $(this).attr("href");
			if(confirm("confirm you wish to remove Staff from the project?")){
				$.ajax({
					url:"projects/editData",
					method:"post",
					data:{team_member_id:team_member_id},
					success:function(data){
						if (data === 'done') {
							successNow("Staff Removed From Project");
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							errorNow(data);
							setTimeout(function(){
								location.reload();
							}, 2000);
						}
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