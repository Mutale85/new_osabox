<?php 
  	require ("includes/db.php");
  	require ("includes/tip.php");  
?>
<!DOCTYPE html>
<html>
<head>
	<title>KanBan</title>
	<?php include("links.php") ?>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
	<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper ">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper kanban">
			<?php include ("dash_data.php"); ?>
      		<section class="content">
		      	<div class="container-fluid">
		        <div class="card card-row">
		          	<div class="card-header">
	            		<a href="" class=" btn btn-primary callForm">
	                    	Add Task <i class="fas fa-plus"></i>
	                  	</a>
		          	</div>
		          	<div class="card-body">
		            	<div id="fetchinTodoTasksKanBan"></div>
		          	</div>
		        </div>
		        <div class="card card-row card-default" style="width: ;">
		          	<div class="card-header bg-info">
		            	<h3 class="card-title">In Progress</h3>
		          	</div>
		          	<div class="card-body">
		            	<div id="fetchinProgressTasksKanBan"></div>
		          	</div>
		        </div>
		        <div class="card card-row card-success" style="width: ;">
		          	<div class="card-header">
		            	<h3 class="card-title">Completed</h3>
		          	</div>
		          	<div class="card-body">
		          		<div id="fetchCompletedTasksKanBan"></div>
		          	</div>
		        </div>
		      </div>
		    </section>
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
		            		<div class="form-group">
		            			<input type="text" name="title" id="title" placeholder="Enter title" class="form-control">
		            		</div>
		              		<textarea class="form-control mb-2" id="task" name="task" rows="4" required></textarea>
		              		<input type="hidden" name="task_id" id="task_id">
		              		<input type="hidden" name="parent_id" id="parent_id" value="<?php echo $_SESSION['parent_id']?>">
		              		<input type="hidden" name="branch_id" id="branch_id" value="<?php echo $BRANCHID?>">
		              		<div class="form-group">
		              			<select name="task_status" id="task_status" class="form-control">
		              				<option value="">Choose Task Status</option>
		              				<option value="todo">Starting Task</option>
		              				<option value="progress">In Progress</option>
		              				<option value="done"> Completed</option>
		              			</select>
		              		</div>
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

      	<aside class="control-sidebar control-sidebar-dark"></aside>
    </div>
    <?php include("footer_links.php")?>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		// ========== ad to do list =========
		function clearForm(){
	        document.getElementById('task').value = '';
	        $("#task_id").val("");
	    }
	    $(function(){
	    	$(".callForm").click(function(e){
	    		e.preventDefault();
	    		$("#modal-lg").modal("show");

	    	})
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
	                fetchinTodoTasksKanBan();
	                fetchinProgressTasksKanBan();
	                fetchCompletedTasksKanBan();
	              }, 1000);
	              clearForm();
	            }else if(data === 'updated'){
	              successNow("Task Updated");
	              setTimeout(function(){
	                clearForm();
	                fetchinTodoTasksKanBan();
	                fetchinProgressTasksKanBan();
	                fetchCompletedTasksKanBan();
	              }, 1000);
	            }else{
	              errorNow(data);
	              setTimeout(function(){
	                fetchinTodoTasksKanBan();
	                fetchinProgressTasksKanBan();
	                fetchCompletedTasksKanBan();
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
	              $("#title").val(data.title);
	              $("#task").val(data.task);
	              $("#task_status").val(data.task_status);
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
	            fetchinTodoTasksKanBan();
	            fetchinProgressTasksKanBan();
	            fetchCompletedTasksKanBan();
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
		

	    function fetchinTodoTasksKanBan(){
	      var fetchinTodoTasksKanBan = "fetchinTodoTasksKanBan";
	      var branch_id = '<?php echo $BRANCHID?>';
	      $.ajax({
	          url:"fetchinTodoTasksKanBan",
	          method:"post",
	          data:{fetchinTodoTasksKanBan:fetchinTodoTasksKanBan, branch_id:branch_id},
	          success:function(data){
	            $("#fetchinTodoTasksKanBan").html(data);
	          }

	        })
	    }
	    fetchinTodoTasksKanBan();

	    function fetchinProgressTasksKanBan(){
	      var fetchinProgressTasksKanBan = "fetchinProgressTasksKanBan";
	      var branch_id = '<?php echo $BRANCHID?>';
	      $.ajax({
	          url:"fetchinProgressTasksKanBan",
	          method:"post",
	          data:{fetchinProgressTasksKanBan:fetchinProgressTasksKanBan, branch_id:branch_id},
	          success:function(data){
	            $("#fetchinProgressTasksKanBan").html(data);
	          }

	        })
	    }
	    fetchinProgressTasksKanBan();

	    function fetchCompletedTasksKanBan(){
	      var fetchCompletedTasksKanBan = "fetchCompletedTasksKanBan";
	      var branch_id = '<?php echo $BRANCHID?>';
	      $.ajax({
	          url:"fetchCompletedTasksKanBan",
	          method:"post",
	          data:{fetchCompletedTasksKanBan:fetchCompletedTasksKanBan, branch_id:branch_id},
	          success:function(data){
	            $("#fetchCompletedTasksKanBan").html(data);
	          }

	        })
	    }
	    fetchCompletedTasksKanBan();


	    

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
	                  fetchinTodoTasksKanBan();
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