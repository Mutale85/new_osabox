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
	<style>
		.task_footer {
			display: inline-grid;
		}
		.task_footer {
			position: relative;
			width: 100%;
			color: var(--light-grey);
			font-size: 12px;
		}
		.task_footer span:not(:last-of-type) {
			margin-right: 1rem;
		}
		img.photo {
			width: 25px;
			height: 25px;
			border-radius: 100rem;
			position: absolute;
			display: inline-block;
			right: 5px;
			bottom: 5px; 
		}
		.wrapper {
			background-color: red !important;
		}
		/*.content-wrapper {
		    background-color: red;
		}*/
		:root {
			 --bg: #ebf0f7;
			 --header: #fbf4f6;
			 --text: #2e2e2f;
			 --white: #fff;
			 --light-grey: #c4cad3;
			 --tag-1: #ceecfd;
			 --tag-1-text: #2e87ba;
			 --tag-2: #d6ede2;
			 --tag-2-text: #13854e;
			 --tag-3: #ceecfd;
			 --tag-3-text: #2d86ba;
			 --tag-4: #f2dcf5;
			 --tag-4-text: #a734ba;
			 --purple: #7784ee;
		}
		 * {
			 margin: 0;
			 padding: 0;
			 box-sizing: border-box;
			 font-family: 'Poppins', sans-serif;
		}
		 body {
			 color: var(--text);
		}
		
		 .task {
			 cursor: move;
			 background-color: var(--white);
			 padding: 1rem;
			 border-radius: 8px;
			 width: 100%;
			 box-shadow: rgba(99, 99, 99, 0.1) 0px 2px 8px 0px;
			 margin-bottom: 1rem;
			 border: 1px dashed transparent;
		}
		 .task:hover {
			 box-shadow: rgba(99, 99, 99, 0.3) 0px 2px 8px 0px;
			 border-color: rgba(162, 179, 207, .2) !important;
		}
		 .task p {
			 font-size: 15px;
			 margin: 1.2rem 0;
		}
		 .task__tag {
			 border-radius: 100px;
			 padding: 2px 13px;
			 font-size: 12px;
		}
		 .task__tag--copyright {
			 color: var(--tag-4-text);
			 background-color: var(--tag-4);
		}
		 .task__tag--design {
			 color: var(--tag-3-text);
			 background-color: var(--tag-3);
		}
		 .task__tag--illustration {
			 color: var(--tag-2-text);
			 background-color: var(--tag-2);
		}
		 .task__tags {
			 width: 100%;
			 display: flex;
			 align-items: center;
			 justify-content: space-between;
		}
		 .task__options {
			 background: transparent;
			 border: 0;
			 color: var(--light-grey);
			 font-size: 17px;
		}
		 .task__stats {
			 position: relative;
			 width: 100%;
			 color: var(--light-grey);
			 font-size: 12px;
		}
		 .task__stats span:not(:last-of-type) {
			 margin-right: 1rem;
		}
		 .task__stats svg {
			 margin-right: 5px;
		}
		 .task__owner {
			 width: 25px;
			 height: 25px;
			 border-radius: 100rem;
			 background: var(--purple);
			 position: absolute;
			 display: inline-block;
			 right: 0;
			 bottom: 0;
		}
		 .task-hover {
			 border: 3px dashed var(--light-grey) !important;
		}
		 .task-details {
			 width: 24%;
			 border-left: 1px solid #d9e0e9;
			 display: inline-block;
			 height: 100%;
			 vertical-align: top;
			 padding: 3rem 2rem;
		}
		 .tag-progress {
			 margin: 1.5rem 0;
		}
		 .tag-progress h2 {
			 font-size: 16px;
			 margin-bottom: 1rem;
		}
		 .tag-progress p {
			 display: flex;
			 width: 100%;
			 justify-content: space-between;
		}
		 .tag-progress p span {
			 color: #b4b4b4;
		}
		 .tag-progress .progress {
			 width: 100%;
			 -webkit-appearance: none;
			 appearance: none;
			 border: none;
			 border-radius: 10px;
			 height: 10px;
		}
		 .tag-progress .progress::-webkit-progress-bar, .tag-progress .progress::-webkit-progress-value {
			 border-radius: 10px;
		}
		 .tag-progress .progress--copyright::-webkit-progress-bar {
			 background-color: #ecd8e6;
		}
		 .tag-progress .progress--copyright::-webkit-progress-value {
			 background: #d459e8;
		}
		 .tag-progress .progress--illustration::-webkit-progress-bar {
			 background-color: #dee7e3;
		}
		 .tag-progress .progress--illustration::-webkit-progress-value {
			 background-color: #46bd84;
		}
		 .tag-progress .progress--design::-webkit-progress-bar {
			 background-color: #d8e7f4;
		}
		 .tag-progress .progress--design::-webkit-progress-value {
			 background-color: #08a0f7;
		}
		 .task-activity h2 {
			 font-size: 16px;
			 margin-bottom: 1rem;
		}
		 .task-activity li {
			 list-style: none;
			 margin: 1rem 0;
			 padding: 0rem 1rem 1rem 3rem;
			 position: relative;
		}
		 .task-activity time {
			 display: block;
			 color: var(--light-grey);
		}
		 .task-icon {
			 width: 30px;
			 height: 30px;
			 border-radius: 100rem;
			 position: absolute;
			 top: 0;
			 left: 0;
			 display: flex;
			 align-items: center;
			 justify-content: center;
		}
		 .task-icon svg {
			 font-size: 12px;
			 color: var(--white);
		}
		 .task-icon--attachment {
			 background-color: #fba63c;
		}
		 .task-icon--comment {
			 background-color: #5dc983;
		}
		 .task-icon--edit {
			 background-color: #7784ee;
		}
		 @media only screen and (max-width: 1300px) {
			 .project {
				 max-width: 100%;
			}
			 .task-details {
				 width: 100%;
				 display: flex;
			}
			 .tag-progress, .task-activity {
				 flex-basis: 50%;
				 background: var(--white);
				 padding: 1rem;
				 border-radius: 8px;
				 margin: 1rem;
			}
		}
		 @media only screen and (max-width: 1000px) {
			 .project-column:nth-child(2), .project-column:nth-child(3) {
				 display: none;
			}
			 .project-tasks {
				 grid-template-columns: 1fr 1fr;
			}
		}
		 @media only screen and (max-width: 600px) {
			 .project-column:nth-child(4) {
				 display: none;
			}
			 .project-tasks {
				 grid-template-columns: 1fr;
			}
			 .task-details {
				 flex-wrap: wrap;
				 padding: 3rem 1rem;
			}
			 .tag-progress, .task-activity {
				 flex-basis: 100%;
			}
			 h1 {
				 font-size: 25px;
			}
		}
		
		.card-body {
			height: 600px;
			overflow: auto;
			padding-bottom: 1em;
		}
	</style>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<?php include ("nav_side.php"); ?>
		<div class="content-wrapper">
			<?php include ("dash_data.php"); ?>
      		<section class="content">
		      	<div class="container-fluid h-100">
		      		
		      		<div class="row">
		      			<div class='col-md-12 mb-4'>
					      	<div class='project-participants'>
					        	<a class='project-participants__add btn btn-outline-secondary'><i class="bi bi-plus-circle-dotted"></i> Add Task</a>
					        </div>
					    </div>
		      			<div class="col-md-4">
		      				<div class="card card-primary">
		      					<div class="card-header">
		      						<h4 class="card-title">New Tasks</h4>
		      					</div>
		      					<div class="card-body">
		      						<div id="fetchinTodoTasksKanBan"></div>
		      					</div>
		      				</div>
		      			</div>
		      			<div class="col-md-4">
		      				<div class="card card-info">
		      					<div class="card-header">
		      						<h4 class="card-title">In Progress</h4>
		      					</div>
		      					<div class="card-body">
		      						<div id="fetchinProgressTasksKanBan"></div>
		      					</div>
		      				</div>
		      			</div>
		      			<div class="col-md-4">
		      				<div class="card card-success">
		      					<div class="card-header">
		      						<h4 class="card-title">Completed</h4>
		      					</div>
		      					<div class="card-body">
		      						<div id="fetchCompletedTasksKanBan"></div>
		      					</div>
		      				</div>
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

    <?php include("footer_links.php")?>
	</div>
	<script src="plugins/toastr/toastr.min.js"></script>
	<script>
		// ========== ad to do list =========
		function clearForm(){
	        document.getElementById('task').value = '';
	        $("#task_id").val("");
	    }
	    $(function(){
	    	$(".project-participants__add").click(function(e){
	    		// e.preventDefault();
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
	                $("#modal-lg").modal("hide");
	              }, 1000);
	              clearForm();
	            }else if(data === 'updated'){
	              successNow("Task Updated");
	              setTimeout(function(){
	                clearForm();
	                fetchinTodoTasksKanBan();
	                fetchinProgressTasksKanBan();
	                fetchCompletedTasksKanBan();
	                $("#modal-lg").modal("hide");
	              }, 1000);
	            }else{
	              errorNow(data);
	              setTimeout(function(){
	                fetchinTodoTasksKanBan();
	                fetchinProgressTasksKanBan();
	                fetchCompletedTasksKanBan();
	                // $("#modal-lg").modal("hide");
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

	    document.addEventListener('DOMContentLoaded', (event) => {

  var dragSrcEl = null;
  
  function handleDragStart(e) {
    this.style.opacity = '0.1';
    this.style.border = '3px dashed #c4cad3';
    
    dragSrcEl = this;

    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.innerHTML);
  }

  function handleDragOver(e) {
    if (e.preventDefault) {
      e.preventDefault();
    }

    e.dataTransfer.dropEffect = 'move';
    
    return false;
  }

  function handleDragEnter(e) {
    this.classList.add('task-hover');
  }

  function handleDragLeave(e) {
    this.classList.remove('task-hover');
  }

  function handleDrop(e) {
    if (e.stopPropagation) {
      e.stopPropagation(); // stops the browser from redirecting.
    }
    
    if (dragSrcEl != this) {
      dragSrcEl.innerHTML = this.innerHTML;
      this.innerHTML = e.dataTransfer.getData('text/html');
    }
    
    return false;
  }

  function handleDragEnd(e) {
    this.style.opacity = '1';
    this.style.border = 0;
    
    items.forEach(function (item) {
      item.classList.remove('task-hover');
    });
  }
  
  
  let items = document.querySelectorAll('.task'); 
  items.forEach(function(item) {
    item.addEventListener('dragstart', handleDragStart, false);
    item.addEventListener('dragenter', handleDragEnter, false);
    item.addEventListener('dragover', handleDragOver, false);
    item.addEventListener('dragleave', handleDragLeave, false);
    item.addEventListener('drop', handleDrop, false);
    item.addEventListener('dragend', handleDragEnd, false);
  });
});
	</script>
</body>
</html>