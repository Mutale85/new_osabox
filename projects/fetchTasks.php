<?php 
  	require ("includes/db.php");
  	if(isset($_POST['tasks'])){
  		$branch_id = $_POST['branch_id'];
	 	$sql = $connect->prepare("SELECT * FROM `todolist` WHERE parent_id = ? AND branch_id = ?  AND status = '0' ORDER BY id DESC ");
	 	$sql->execute(array($_SESSION['parent_id'], $branch_id));
	 	if ($sql->rowCount() > 0) {
	 		foreach ($sql as $row) {
	 			extract($row);
	 			if ($status == 1 ) {
	 				$checked = 'checked';
	 			}else{
	 				$checked = '';
	 			}
	 		?>
	 			
 			<li class=" mb-4">
				<span class="handle">
					<i class="fas fa-ellipsis-v"></i>
					<i class="fas fa-ellipsis-v"></i>
				</span>
			
			
				<div  class="icheck-primary d-inline ml-2">
					<input type="checkbox" value="" name="todo<?php echo $id?>"  onclick="todoCheck('<?php echo $id?>', '<?php echo $status?>')" id="todoCheck<?php echo $id?>" <?php echo $checked?>>
					<label for="todoCheck<?php echo $id?>"></label>
				</div>
				<span class="text"><?php echo $task?></span>
				<?php if($_SESSION['user_id'] == $posted_by):?>
			
					<small class="badge badge-secondary"><i class="far fa-clock"></i> <?php echo time_ago_check($posted_date) ?></small>
					<div class="tools">
						<a href="<?php echo $id?>" class="editTask"><i class="fas fa-edit"></i></a>
						<a href="<?php echo $id?>" class="deleteTask text-danger"><i class="bi bi-trash"></i></a>
					</div>
				<?php endif;?>
			
				<div class="d-flex justify-content-between mt-4 border-top pt-2">
					<p>Posted: By</p>
					<?php echo getStaffMemberNames($connect, $posted_by, $parent_id)?>
					<p><img src="members/adminphotos/<?php echo getStaffMemberPhoto($connect, $posted_by, $parent_id)?>" style="width:35px; height:35px; border-radius: 50%;"></p>
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
		$branch_id = $_POST['branch_id'];
		$sql = $connect->prepare("SELECT * FROM `todolist` WHERE parent_id = ? AND branch_id = ?  AND status = '1' ORDER BY id DESC ");
	 	$sql->execute(array($_SESSION['parent_id'], $branch_id));
	 	if ($sql->rowCount() > 0) {
	 		foreach ($sql as $row) {
	 			extract($row);
	 			if ($status == 1 ) {
	 				$checked = 'checked';
	 			}else{
	 				$checked = '';
	 			}
	 		?>
	 			<li class="done mb-4">
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
					<?php if($_SESSION['user_id'] == $posted_by):?>
					<div class="tools">
						<a href="<?php echo $id?>" class="editTask"><i class="fas fa-edit"></i></a>
						<a href="<?php echo $id?>" class="deleteTask text-danger"><i class="bi bi-trash"></i></a>
					</div>
					<?php endif;?>
					<div class="d-flex justify-content-between mt-4 border-top pt-2">
						<p>Completed: By</p>
						<?php echo getStaffMemberNames($connect, $completed_by, $parent_id)?>
						<p><img src="members/adminphotos/<?php echo getStaffMemberPhoto($connect, $completed_by, $parent_id)?>" style="width:35px; height:35px; border-radius: 50%;"></p>
					</div>
				</li>
<?php
	 		}
	 	}else{
	 		echo '
	 			
	 		';
	 	}
	}