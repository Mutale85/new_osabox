<?php 
  	require ("../includes/db.php");
  	require ("../includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>To do list / Accomplished to do list</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.11.2/css/bootstrap-select.min.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
	<link href="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.css" rel="stylesheet">
	<style>
		
		div.todoCard {
			background-color: lightblue;
			
			height: 400px;
			overflow: scroll;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<section class="content mt-5">
      			<?php include ("dash_data.php"); ?>
      			
      			<div class="container-fluid">
      				<div class="row">
      					<div class="col-md-6">
      						<div class="card card-info">
      							<div class="card-header">
      								<h4 class="card-title"><i class="bi bi-clipboard"></i> Todo Tasks</h4>
      								<div class="card-tools">
					                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
					                      	<i class="fas fa-minus"></i>
					                    </button>
					                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
					                      	<i class="fas fa-times"></i>
					                    </button>
					                </div>
      							</div>
      							<div class="card-body">
      								<ul class="todo-list" data-widget="todo-list" id="fetchTasks"></ul>
      							</div>
      							<div class="card-footer clearfix">
									<button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i> Add item</button>
								</div>
      						</div>
      					</div>
      					<div class="col-md-6">
      						<div class="card card-warning">
      							<div class="card-header">
      								<h3 class="card-title"><i class="bi bi-clipboard-check"></i> Completed Tasks</h3>
      								<div class="card-tools">
					                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="collapse">
					                      	<i class="fas fa-minus"></i>
					                    </button>
					                    <button type="button" class="btn bg-warning btn-sm" data-card-widget="remove">
					                      	<i class="fas fa-times"></i>
					                    </button>
					                </div>
      							</div>
      							<div class="card-body todoCard">
      								<ul class="todo-list" data-widget="todo-list" id="fetchCompletedTasks"></ul>
      							</div>
      						</div>
      					</div>
      				</div>
      			</div>
      			<!-- TODO LIST MODAL -->
      			 <div class="modal fade" id="modal-lg">
			        <div class="modal-dialog modal-lg">
			          	<div class="modal-content">
			            	<div class="modal-header">
			              		<h4 class="modal-title"><span id="modal-title">Create Task</span></h4>
			              		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			                		<span aria-hidden="true"><i class="bi bi-x-circle text-danger"></i></span>
			              		</button>
			            	</div>
			            	<form method="post" id="taskForm">
				            	<div class="modal-body">
				            		<div class="form-group mb-2">
				            			<label>Tatsk Title</label>
				            			<input type="text" name="title" id="title" class="form-control" required>
				            		</div>
				              		<textarea class="form-control" id="task" name="task" rows="4" required></textarea>
				              		<input type="hidden" name="task_id" id="task_id">
				              		<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
				              		<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
				            	</div>
				            	<div class="modal-footer justify-content-between">
				              		<button type="button" class="btn btn-default" data-dismiss="modal" onclick="clearForm()">Close</button>
				              		<button type="submit" class="btn btn-primary postTask">Save Task</button>
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
    <?php include("footer_links.php")?>
	<script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="plugins/select2/js/select2.full.min.js"></script>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script src="plugins/chart.js/Chart.min.js"></script>
	<!-- <script src="https://cdn.jsdelivr.net/npm/jquery/dist/jquery.min.js"></script> -->
	<script src="https://unpkg.com/multiple-select@1.5.2/dist/multiple-select.min.js"></script>
	<script>
		// ========== ad to do list =========
		function clearForm(){
	        document.getElementById('task').value = '';
	        $("#task_id").val("");
	    }
	    $(function(){
	      $(document).on("submit", "#taskForm", function(e){
	        e.preventDefault();
	        $.ajax({
	          url:"postTask",
	          method:"post",
	          data:$(this).serialize(),
	          success:function(data){
	            if (data === "done") {
	              successNow("Task Added");
	              setTimeout(function(){
	                fetchTasks();
	              }, 1000);
	              clearForm();
	            }else if(data === 'updated'){
	              successNow("Task Updated");
	              setTimeout(function(){
	                clearForm();
	                fetchTasks();
	              }, 1000);
	            }else{
	              errorNow(data);
	              setTimeout(function(){
	                fetchTasks();
	              }, 1000);
	            }
	          }
	        })
	      })
	      // ================ CHECK TASK =============

	      //========= edit ==============

	      $(document).on("click", ".editTask", function(e){
	        e.preventDefault();
	        var edit_task_id = $(this).attr("href");
	        $("#modal-lg").modal("show");
	        $.ajax({
	            url:"editData",
	            method:"post",
	            data:{edit_task_id:edit_task_id},
	            dataType:"JSON",
	            success:function(data){
	              $("#task_id").val(data.id);
	              $("#task").val(data.task);
	            }
	          })
	        })
	      })

	    // DELETE TASK --------

	    $(document).on("click", ".deleteTask", function(e){
	      e.preventDefault();
	      var delete_id = $(this).attr("href");
	      if (!confirm("You wish to remove the task from?")) {
	        return false;
	      }else{
	        $.ajax({
	          url:"editData",
	          method:"post",
	          data:{delete_id:delete_id},
	          
	          success:function(data){
	            fetchTasks();
	          }
	        })
	      }
	    })

		$('.todo-list').sortable({
	        placeholder: 'sort-highlight',
	        handle: '.handle',
	        forcePlaceholderSize: true,
	        zIndex: 999999
	      })


		function fetchTasks(){
	      var tasks = "fetchTasks";
	       var branch_id = '<?php echo $BRANCHID?>';
	      $.ajax({
	          url:"fetchTasks",
	          method:"post",
	          data:{tasks:tasks, branch_id:branch_id},
	          success:function(data){
	            $("#fetchTasks").html(data);
	          }

	        })
	    }
	    fetchTasks();

	    function fetchCompletedTasks(){
		    var fetchCompletedTasks = "fetchCompletedTasks";
		    var branch_id = '<?php echo $BRANCHID?>';
		    $.ajax({
		        url:"fetchTasks",
		        method:"post",
		        data:{fetchCompletedTasks:fetchCompletedTasks, branch_id:branch_id},
		        success:function(data){
		          $("#fetchCompletedTasks").html(data);
		        }

		    })
		}
		fetchCompletedTasks();


    // ======= UPDATE TASK IF COMPLETED =========
	    function todoCheck(taskId, status){
	      if(confirm("Confirm you are changing status of the Task")){
	        $.ajax({
	            url:"editData",
	            method:"post",
	            data:{taskId:taskId, status:status},
	            success:function(data){
	              if(data === 'updated'){
	                successNow("Task Updated");
	                setTimeout(function(){
	                  fetchTasks();
	                  fetchCompletedTasks();
	                }, 1500);
	              }
	            }
	          })
	      }else{
	        return false;
	      }
    	}

    // ========= ALERTS ============
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