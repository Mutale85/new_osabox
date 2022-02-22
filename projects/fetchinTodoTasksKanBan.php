<?php
	require ("includes/db.php");
	if (isset($_POST['fetchinTodoTasksKanBan'])) {
		$branch_id = $_POST['branch_id'];
		$sql = $connect->prepare("SELECT * FROM `todolist` WHERE parent_id = ? AND branch_id = ?  AND task_status = 'todo' ");
	 	$sql->execute(array($_SESSION['parent_id'], $branch_id));
	 	$i = 1;
	 	if ($sql->rowCount() > 0) {
	 		foreach ($sql as $row) {
	 			extract($row);
	 			if ($status == 1 ) {
	 				$checked = 'checked';
	 			}else{
	 				$checked = '';
	 			}
	 		?>
	 		<div class='task border-primary' draggable='true'>
				<div class='task__tags'><span class='task__tag task__tag--copyright'><?php echo $title?></span>
					<button class='task__options'>
						<a href="<?php echo $id?>" class="btn btn-tool editTask"><i class="bi bi-pencil-square"></i></a>
	              		<a href="<?php echo $id?>" class=" btn btn-tool deleteTask text-danger"><i class="bi bi-trash"></i></a>
              		</button>
				</div>
				<p><?php echo url_to_clickable_link($task)?></p>
				<div class='task__stats'>
					<span><time datetime="2021-11-24T20:00:00"><i class="fas fa-flag"></i> <?php echo date("M-d, Y", strtotime($posted_date)) ?></time></span>
					<span><?php echo getStaffMemberNames($connect, $posted_by, $parent_id)?> </span>
					<span class='task__owner'> </span>
					<span><img src="members/adminphotos/<?php echo getStaffMemberPhoto($connect, $posted_by, $parent_id)?>" alt="photo" class="img-fluid photo"></span>
				</div>
			</div>
<?php
	 		}
	 	}else{
	 		echo '
	 			nothing
	 		';
	 	}
	}
?>