<?php 
  	require ("../../includes/db.php");
  	if(isset($_POST['tasks'])){
	 	$sql = $connect->prepare("SELECT * FROM `todolist` WHERE parent_id = ? AND status = '0' ORDER BY id DESC ");
	 	$sql->execute(array($_SESSION['parent_id']));
	 	if ($sql->rowCount() > 0) {
	 		foreach ($sql as $row) {
	 			extract($row);
	 			if ($status == 1 ) {
	 				$checked = 'checked';
	 			}else{
	 				$checked = '';
	 			}
	 		?>
	 			<li class="">
					<span class="handle">
						<i class="fas fa-ellipsis-v"></i>
						<i class="fas fa-ellipsis-v"></i>
					</span>
					<div  class="icheck-primary d-inline ml-2">
						<input type="checkbox" value="" name="todo<?php echo $id?>"  onclick="todoCheck('<?php echo $id?>', '<?php echo $status?>')" id="todoCheck<?php echo $id?>" <?php echo $checked?>>
						<label for="todoCheck<?php echo $id?>"></label>
					</div>
					<span class="text"><?php echo $task?></span>
					<small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo time_ago_check($posted_date) ?></small>
					<div class="tools">
						<a href="<?php echo $id?>" class="editTask"><i class="fas fa-edit"></i></a>
						<a href="<?php echo $id?>" class="deleteTask"><i class="bi bi-trash"></i></a>
					</div>
				</li>
<?php
	 		}
	 	}else{
	 		echo '
	 			Add to do tasks.
	 		';
	 	}
	}

	if (isset($_POST['fetchCompletedTasks'])) {
		$sql = $connect->prepare("SELECT * FROM `todolist` WHERE parent_id = ? AND status = '1' ORDER BY id DESC ");
	 	$sql->execute(array($_SESSION['parent_id']));
	 	if ($sql->rowCount() > 0) {
	 		foreach ($sql as $row) {
	 			extract($row);
	 			if ($status == 1 ) {
	 				$checked = 'checked';
	 			}else{
	 				$checked = '';
	 			}
	 		?>
	 			<li class="done">
					<span class="handle">
						<i class="fas fa-ellipsis-v"></i>
						<i class="fas fa-ellipsis-v"></i>
					</span>
					<div  class="icheck-primary d-inline ml-2">
						<input type="checkbox" value="" name="todo<?php echo $id?>"  onclick="todoCheck('<?php echo $id?>', '<?php echo $status?>')" id="todoCheck<?php echo $id?>" <?php echo $checked?>>
						<label for="todoCheck<?php echo $id?>"></label>
					</div>
					<span class="text"><?php echo $task?></span>
					<small class="badge badge-danger"><i class="far fa-clock"></i> <?php echo time_ago_check($completed_date) ?></small>
					<div class="tools">
						<a href="<?php echo $id?>" class="editTask"><i class="fas fa-edit"></i></a>
						<a href="<?php echo $id?>" class="deleteTask"><i class="bi bi-trash"></i></a>
					</div>
				</li>
<?php
	 		}
	 	}else{
	 		echo '
	 			
	 		';
	 	}
	}