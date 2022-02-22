<?php
	include '../../includes/db.php';
	extract($_POST);
	if ($income_or_expense == "Income") {
		#insert into income table
		if (!empty($ID)) {
			if ($_FILES['receipt_no_1']['name']) {
				$receipt_no_1 	= $_FILES['receipt_no_1']['name'];
				$filename = $_FILES['receipt_no_1']['tmp_name'];
				$destination = 'files/'.basename($receipt_no_1);
				move_uploaded_file($filename, $destination);
			}else{
				$receipt_no_1 = $receipt_no_1_edit;
			}

			if ($_FILES['receipt_no_2']['name']) {
				$receipt_no_2 	= $_FILES['receipt_no_2']['name'];
				$filename = $_FILES['receipt_no_2']['tmp_name'];
				$destination = 'files/'.basename($receipt_no_2);
				move_uploaded_file($filename, $destination);
			}else{
				$receipt_no_2 = $receipt_no_2_edit;
			}

			$update = $connect->prepare("UPDATE income_table SET  `income_date` = ?, `income_name` = ?, `income_amount` = ?, `currency` = ?, `receipt_no_1` = ?, `receipt_no_2` = ?, `income_loan_linked_to` = ? WHERE id = ? ");
			$ex = $update->execute(array($date, $name, $amount, $currency, $receipt_no_1, $receipt_no_2, $loan_linked_to, $ID));
			if($ex){
				echo "update";
			}
		}else{
			$receipt_no_1 = $_FILES['receipt_no_1']['name'];
			$filename = $_FILES['receipt_no_1']['tmp_name'];
			$destination = 'files/'.basename($receipt_no_1);
			move_uploaded_file($filename, $destination);

			$receipt_no_2 = $_FILES['receipt_no_2']['name'];
			$file_name = $_FILES['receipt_no_2']['tmp_name'];
			$_destination = 'files/'.basename($receipt_no_2);
			move_uploaded_file($file_name, $_destination);

			$sql = $connect->prepare("INSERT INTO `income_table`(`branch_id`, `parent_id`, `income_date`, `income_name`, `income_amount`, `currency`, `receipt_no_1`, `receipt_no_2`, `income_loan_linked_to`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
			$ex = $sql->execute(array($branch_id, $parent_id, $date, $name, $amount, $currency, $receipt_no_1, $receipt_no_2, $loan_linked_to));
			if ($ex) {
				echo "done";
			}
		}

	}elseif ($income_or_expense == "Expense") {
		# insert into expenses
	
		if (!empty($ID)) {
			if ($_FILES['receipt_no_1']['name']) {
				$receipt_no_1 	= $_FILES['receipt_no_1']['name'];
				$filename = $_FILES['receipt_no_1']['tmp_name'];
				$destination = 'files/'.basename($receipt_no_1);
				move_uploaded_file($filename, $destination);
			}else{
				$receipt_no_1 = $receipt_no_1_edit;
			}

			if ($_FILES['receipt_no_2']['name']) {
				$receipt_no_2 	= $_FILES['receipt_no_2']['name'];
				$filename = $_FILES['receipt_no_2']['tmp_name'];
				$destination = 'files/'.basename($receipt_no_2);
				move_uploaded_file($filename, $destination);
			}else{
				$receipt_no_2 = $receipt_no_2_edit;
			}

			$update = $connect->prepare("UPDATE expenses SET  `expense_date` = ?, `expense_name` = ?, `expense_amount` = ?, `currency` = ?, `receipt_no_1` = ?, `receipt_no_2` = ?, `expense_loan_linked_to` = ? WHERE id = ? ");
			$ex = $update->execute(array($date, $name, $amount, $currency, $receipt_no_1, $receipt_no_2, $loan_linked_to, $ID));
			if($ex){
				echo "update";
			}
		}else{
			$receipt_no_1 = $_FILES['receipt_no_1']['name'];
			$filename = $_FILES['receipt_no_1']['tmp_name'];
			$destination = 'files/'.basename($receipt_no_1);
			move_uploaded_file($filename, $destination);

			$receipt_no_2 = $_FILES['receipt_no_2']['name'];
			$file_name = $_FILES['receipt_no_2']['tmp_name'];
			$_destination = 'files/'.basename($receipt_no_2);
			move_uploaded_file($file_name, $_destination);

			$sql = $connect->prepare("INSERT INTO `expenses`(`branch_id`, `parent_id`, `expense_date`, `expense_name`, `expense_amount`, `currency`, `receipt_no_1`, `receipt_no_2`, `expense_loan_linked_to`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
			$ex = $sql->execute(array($branch_id, $parent_id, $date, $name, $amount, $currency, $receipt_no_1, $receipt_no_2, $loan_linked_to));
			if ($ex) {
				echo "done";
			}
		}
	}

?>