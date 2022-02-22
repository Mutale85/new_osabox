<?php
	include 'includes/db.php';
	extract($_POST);
	$user_id 	= $_SESSION['user_id'];
	$posted_by 	= $_SESSION['user_id'];
	$task = trim(filter_var($task, FILTER_SANITIZE_STRING));
	if (!empty($task_id)) {
		#update
		$update_date = date("Y-m-d h:m:s");
		if ($task_status == 'progress') {
			#update progress_date
			
			$update = $connect->prepare("UPDATE todolist SET title = ?, task = ?, completed_by = ?, task_status = ?, progress_date = ? WHERE id = ?");
			if($update->execute(array($title, $task,  $user_id, $task_status, $update_date, $task_id))){
				echo "Task Update";
			}
		}elseif ($task_status == 'done') {
			
			$update = $connect->prepare("UPDATE todolist SET title = ?, task = ?, completed_by = ?, task_status = ?, completed_date = ? WHERE id = ?");
			if($update->execute(array($title, $task,  $user_id, $task_status, $update_date, $task_id))){
				echo "Task Update";
			}
		}

	}else{
		#post task
		$query = $connect->prepare("INSERT INTO `todolist`(`parent_id`, `branch_id`, `title`, `task`, `posted_by`, `completed_by`, `task_status`) VALUES (?, ?, ?, ?, ?, ?, ?)");
		$ex = $query->execute(array($parent_id, $branch_id, $title, $task, $posted_by, $user_id, $task_status));
		if ($ex) {
			echo "Task Posted ";
		}
	}