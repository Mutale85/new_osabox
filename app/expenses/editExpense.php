<?php
	include '../../includes/db.php';
	
	extract($_POST);
	if (!empty($expense_id)) {
		$query = $connect->prepare("SELECT * FROM expenses WHERE id = ?");
		$query->execute(array($expense_id));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (!empty($income_id)) {
		$query = $connect->prepare("SELECT * FROM income_table WHERE id = ?");
		$query->execute(array($income_id));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	
	
	if (isset($_POST['editableRow'])) {
		$editableRow = $_POST['editableRow'];
		$fileID = $_POST['fileID'];
		$d = $connect->prepare("UPDATE expenses SET $editableRow = '' WHERE id = ?");
		if($d->execute(array($fileID))){
			echo "file Deleted";
		}
	}

	if (isset($_POST['editIncometableRow'])) {
		$editIncometableRow = $_POST['editIncometableRow'];
		$incomefileID = $_POST['incomefileID'];
		$d = $connect->prepare("UPDATE income_table SET $editIncometableRow = '' WHERE id = ?");
		if($d->execute(array($incomefileID))){
			echo "Income Income/Receipt Deleted";
		}
	}

	if (!empty($income_id_delete)) {
		$d = $connect->prepare("DELETE FROM income_table WHERE id = ? ");
		if($d->execute(array($income_id_delete))){
			echo "Income removed with all associated files";
		}
	}

	if (!empty($expense_id_delete)) {
		$d = $connect->prepare("DELETE FROM expenses WHERE id = ? ");
		if($d->execute(array($expense_id_delete))){
			echo "Expense removed with all associated files";
		}
	}
	
	
?>