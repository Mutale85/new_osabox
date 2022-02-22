<?php
	include '../../includes/db.php';
	extract($_POST);
	$user_id = $_SESSION['user_id'];
	$task = trim(filter_var($task, FILTER_SANITIZE_STRING));
	if (!empty($task_id)) {
		#update
		$update = $connect->prepare("UPDATE todolist SET task = ?, completed_by = ? WHERE id = ?");
		if($update->execute(array($task, $user_id, $task_id))){
			echo "updated";
		}

	}else{
		#post task
		$query = $connect->prepare("INSERT INTO `todolist`(`parent_id`, `branch_id`, `task`, `completed_by`) VALUES (?, ?, ?, ?)");
		$ex = $query->execute(array($parent_id, $branch_id, $task, $user_id));
		if ($ex) {
			echo "done";
		}
	}