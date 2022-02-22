<?php
	include '../../includes/db.php';
	if(!empty($_POST['ID'])){
		#update 
		$id = $_POST['ID'];
		$milestone = $_POST['milestone'];
		$parent_id = $_POST['parent_id'];
		$branch_id = $_POST['branch_id'];
		$projectID = $_POST['projectID'];
		$user_id   = $_POST['user_id'];
		$spent_budget = $_POST['spent_budget'];
		$currency  = $_POST['currency'];
		if ($_FILES['attachment']['name'] == "") {
			$update = $connect->prepare("UPDATE `projectMilestone` SET `spent_budget` = ?, `currency` = ?, `milestone` = ? WHERE id = ? AND parent_id = ? ");
			$ex = $update->execute(array($spent_budget, $currency, $milestone, $id, $parent_id));
			if ($ex) {
				echo 'updated';
			}
		}else{
			$attachment = $_FILES['attachment']['name'];
			$filename = $_FILES['attachment']['tmp_name'];
			$destination = 'files/'.basename($attachment);
			move_uploaded_file($filename, $destination);
			$update = $connect->prepare("UPDATE `projectMilestone` SET `spent_budget` = ?, `currency` = ?, `milestone` = ?, `attachment` = ? WHERE id = ? AND parent_id = ? ");
			$ex = $update->execute(array($spent_budget, $currency, $milestone, $attachment, $id, $parent_id));
			if ($ex) {
				echo 'updated';
			}
		}

	}else{
	
		$milestone = $_POST['milestone'];
		$parent_id = $_POST['parent_id'];
		$branch_id = $_POST['branch_id'];
		$projectID = $_POST['projectID'];
		$user_id   = $_POST['user_id'];
		$attachment = $_FILES['attachment']['name'];
		$filename = $_FILES['attachment']['tmp_name'];
		$destination = 'files/'.basename($attachment);
		move_uploaded_file($filename, $destination);
		$spent_budget = $_POST['spent_budget'];
		$currency  = $_POST['currency'];
		$sql = $connect->prepare("INSERT INTO `projectMilestone`(`parent_id`, `branch_id`, `projectID`, `user_id`, `spent_budget`, `currency`, `milestone`, `attachment`) VALUES (?, ?, ?, ?, ?, ?, ?, ?) ");
		$ex = $sql->execute(array($parent_id, $branch_id, $projectID, $user_id, $spent_budget, $currency, $milestone, $attachment));
		if ($ex) {
			echo 'done';
		}

	}
?>