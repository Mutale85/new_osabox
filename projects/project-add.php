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
	<title>Add Projects</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css"/>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
	<link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
	<style type="text/css">
		.select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container--default.select2-container--focus .select2-selection--single {
		    border-color: #ff80ac;
		    height: 25px !important;
		}

		.select2-container--default .select2-selection--multiple .select2-selection__rendered li:first-child.select2-search.select2-search--inline {
		    width: 100%;
		    margin-left: .375rem;
		    height: 25px;
		}
		.select2-container--default .select2-selection--single {
		    background-color: #6499cd;
		    border: 1px solid #aaa;
		    border-radius: 4px;
		    height: 25px;
		}
		.select2-container--default .select2-selection--multiple .select2-selection__rendered {
		    box-sizing: border-box;
		    list-style: none;
		    margin: 0;
		    padding: .4em;
		    width: 100%;
		}
		.content-wrapper>.content {
		    padding: 0 .5rem;
		    background: white;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content  mt-5">
      			<div class="container-fluid mt-5 mb-5">
      				<div class="row mt-5">
      					<div class="col-md-12 mt-4 pb-2 d-flex justify-content-between">
  							<h4> <?php echo ucwords(getOrganisationName($connect, $_SESSION['parent_id']))?> </h4>
  						</div>
      				</div>
      			</div>

	      		<div class="container-fluid mb-5">
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
							                	<input type="text" id="project_name" name="project_name" class="form-control" required>
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="project_name">Client Name</label>
							                	<input type="text" id="project_client" name="project_client" class="form-control">
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="status">Status</label>
								                <select id="status" name="status" class="form-control custom-select">
								                  	<option selected disabled>Select one</option>
								                  	<option value="Starting">Starting</option>
								                  	<option value="Urgent">Urgent</option>
								                </select>
							              	</div>
							              	
							              	<input type="hidden" name="project_id" id="project_id" value="">
							              	<div class="form-group col-md-6">
							                	<label for="leader">Project Leader</label>
							                	<select id="leader" name="leader" class="form-control" required>
							                		<option selected disabled>Select one</option>
							                		<?php
							                			foreach ($results as $row) {
							                				extract($row);
							                		?>
							                				<option value="<?php echo $id ?>"><?php echo $firstname ?> <?php echo $lastname ?> </option>
													<?php  		 	
													  	} 
							                		?>
							                	</select>
							              	</div>
							              	<div class="form-group col-md-12">
							                	<label for="description">Project Description</label>
							                	<textarea id="description" name="description" class="form-control" rows="4" required></textarea>
							              	</div>
							              	<div class="form-group col-md-6">
							                	<label for="start_date">Project Start Date</label>
							                	<input type="text" id="start_date" name="start_date" class="form-control" required>
							                	<input type="hidden" id="branch_id" name="branch_id" class="form-control" value="<?php echo $BRANCHID?>">
							              	</div>

							              	<div class="form-group col-md-6">
							                	<label for="deadline">Project Deadline</label>
							                	<input type="text" id="deadline" name="deadline" class="form-control" required>
							              	</div>

							              	<div class="col-md-12">
							              		<div class="form-group mb-3">
								                	<label for="leader">Project Team Members</label><br>
								                	<!-- <select id="team_members" name="team_members[]" class="select2 form-control mb-3" multiple required> -->
								                		
								                		<?php
								                			foreach ($results as $row) {
								                				extract($row);
								                		?>
								                				<!-- <option value="<?php echo $id ?>"><?php echo $firstname ?> <?php echo $lastname ?> </option> -->
								                				<label><input type="checkbox" name="team_members[]" id="team_members<?php echo $id ?>" value="<?php echo $id ?>"> <?php echo $firstname ?> <?php echo $lastname ?></label><br>
														<?php  		 	
														  	} 
								                		?>
								                	<!-- </select> -->
								                </div>
							                	<div class="form-group border-top border-primary pb-3">
							                		<label><input type="checkbox" name="send_email" id="send_email"> Send Email To Team Members</label>
							                	</div>
							                	<div class="mt-3">
							                		<a href="members/add_admin" class="mt-3"> Add Staff / Admin</a>
							                	</div>
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
						                		<span id="currency_span" class="input-group-text"><?php echo getCurrency($connect, $_SESSION['parent_id'])?></span>
						                		<input type="number" id="estimated_budget" name="estimated_budget" class="form-control" min="0" step="any">
						                	</div>
						                	<input type="hidden" name="currency" id="currency">
						              	</div>
						              	<div class="form-group">
						                	<label for="estimated_duration">Estimated project duration</label>
						                	<div class="input-group">
						                		<input type="number" id="estimated_duration" name="estimated_duration" class="form-control">
						                		<select name="estimated_period" id="estimated_period" class="form-control">
						                			<option selected disabled>Select one</option>
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
		          						<p class="fs-4"><a href="" class="callFileUploader btn btn-info"><i class="bi bi-paperclip"></i> Add Project Files</a></p>
		          						<div id="fileList"></div>
		          					</div>
		          					<div class="card-footer">
		          						<button class="btn btn-success float-right" type="submit" id="submit_project">Create New Project</button>
		          					</div>
		          				</div>
		        			</div>
		      			</div>
		      		</form>
	      		</div>
    		</section>
      	</div>
      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <?php include("footer_links.php")?>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script src="plugins/summernote/summernote-bs4.min.js"></script>
	<script>
		//========== GET CURRENCY

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
						}
					}
				})
			})
		})

		$(document).on("click", ".editData", function(e){
			e.preventDefault();
			var clients_in_need_id = $(this).attr("href");
			$.ajax({
				url:"projects/editData",
				method:"post",
				data:{clients_in_need_id:clients_in_need_id},
				dataType:"JSON",
				success:function(data){
					$("#ID").val(data.id);
					$("#firstname").val(data.firstname);
					$("#lastname").val(data.lastname);
					$("#city").val(data.city);
					$("#business_type").val(data.business_type);
					$("#required_amount").val(data.required_amount);
					$("#id_type").val(data.id_type);
					$("#id_number").val(data.id_number);
					$("#email").val(data.email);
					$("#phone").val(data.mobile_number);
					$("#result").html(data.mobile_number);
					$("#details").val(data.details);
				}
			})
		})

		$(document).on("click", ".deleteData", function(e){
			e.preventDefault();
			var delete_clients_in_need_id = $(this).attr("href");
			if(confirm("You wish to remove the client")){
				$.ajax({
					url:"projects/editData",
					method:"post",
					data:{delete_clients_in_need_id:delete_clients_in_need_id},
					success:function(data){
						if (data === 'done') {
							successNow("Client Deleted");
							setTimeout(function(){
								location.reload();
							}, 2000);
						}else{
							errorNow(Data);
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