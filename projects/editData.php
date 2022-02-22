<?php
	include 'includes/db.php';
	if (isset($_POST['taskId'])) {
		$taskId = $_POST['taskId'];
		$status = $_POST['status'];
		if ($status == 0) {
			$status = 1;
		}else{
			$status = 0;
		}
		$completed_date = date("Y-m-d h:m:s");
		$update = $connect->prepare("UPDATE todolist SET status = ?, completed_date = ? WHERE id = ? and parent_id = ?");
		if($update->execute(array($status, $completed_date, $taskId, $_SESSION['parent_id']))){
			echo "updated";
		}
	}
	if (isset($_POST['edit_task_id'])) {
		$edit_task_id = $_POST['edit_task_id'];
		$query = $connect->prepare("SELECT * FROM todolist WHERE id = ? AND parent_id = ?");
		$query->execute(array($edit_task_id, $_SESSION['parent_id']));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (isset($_POST['delete_id'])) {
		$delete_id = $_POST['delete_id'];
		$query = $connect->prepare("DELETE FROM todolist WHERE id = ? AND parent_id = ?");
		if($query->execute(array($delete_id, $_SESSION['parent_id']))){
			echo "done";
		}
	}

	if (isset($_POST['milestone_id'])) {
		$milestone_id = $_POST['milestone_id'];
		$query = $connect->prepare("SELECT * FROM projectMilestone WHERE id = ? AND parent_id = ?");
		$query->execute(array($milestone_id, $_SESSION['parent_id']));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (isset($_POST['milestone_id_delete'])) {
		$milestone_id_delete = $_POST['milestone_id_delete'];
		$query = $connect->prepare("DELETE FROM projectMilestone WHERE id = ? AND parent_id = ?");
		if($query->execute(array($milestone_id_delete, $_SESSION['parent_id']))){
			echo "done";
		}
	}

	if (isset($_POST['projectID'])) {
		$projectID = $_POST['projectID'];
		$status = $_POST['status'];
		$update = $connect->prepare("UPDATE projects SET status = ? WHERE id = ? AND parent_id = ?");
		if($update->execute(array($status, $projectID, $_SESSION['parent_id']))){
			echo "done";
		}
	}

	if (isset($_POST['trashFile_id'])) {
		$trashFile_id = $_POST['trashFile_id'];
		$query = $connect->prepare("DELETE FROM projects_files WHERE id = ? AND parent_id = ?");
		if($query->execute(array($trashFile_id, $_SESSION['parent_id']))){
			echo "done";
		}
	}

	if (isset($_POST['team_member_id'])) {
		$team_member_id = $_POST['team_member_id'];
		$query = $connect->prepare("DELETE FROM projects_team_members WHERE team_member = ? AND parent_id = ?");
		if($query->execute(array($team_member_id, $_SESSION['parent_id']))){
			$query = $connect->prepare("DELETE FROM projectMilestone WHERE user_id = ? AND parent_id = ?");
			if($query->execute(array($team_member_id, $_SESSION['parent_id']))){
				echo "done";
			}
		}
	}

	if (isset($_POST['client_id_edit'])) {
		$client_id_edit = $_POST['client_id_edit'];
		$query = $connect->prepare("SELECT * FROM clients WHERE id = ? AND parent_id = ? ");
		$query->execute(array($client_id_edit, $_SESSION['parent_id']));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (isset($_POST['delete_clients_in_need_id'])) {
		$delete_clients_in_need_id = $_POST['delete_clients_in_need_id'];
		$query = $connect->prepare("DELETE FROM clients WHERE id = ? AND parent_id = ?");
		if($query->execute(array($delete_clients_in_need_id, $_SESSION['parent_id']))){
			echo "client Removed";
		}
	}
	
?>