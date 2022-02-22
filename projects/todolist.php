<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="card">
        <div class="card-header">
			<h3 class="card-title">
				<i class="ion ion-clipboard mr-1"></i>
				Todo List <br>
				<small id="nowTime"></small>
			</h3>
			<div class="card-tools">
                <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
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
</body>
</html>