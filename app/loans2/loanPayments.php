<?php
	include '../../includes/db.php';
	if (isset($_POST['delete_id'])) {
		$d = $connect->prepare("DELETE FROM loan_payments WHERE id = ? ");
		$q = $d->execute(array($_POST['delete_id']));
		if ($q) {
			echo "success";
		}
	}else{
		extract($_POST);
		if(empty($edit_id)){
			$amount  = preg_replace("#[^0-9.]#", "", $amount);
			$comment = filter_var($comment, FILTER_SANITIZE_STRING);
			$sql = $connect->prepare("INSERT INTO `loan_payments`( `loan_id`, `loan_number`, `borrower_id`, `amount`, `paid_date`, `payment_method`, `collected_by`, `comment`, `branch_id`, `parent_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
			$q = $sql->execute(array($loan_id, $loan_number, $borrower_id, $amount, $paid_date, $payment_method, $collected_by, $comment, $branch_id, $parent_id));
			if ($q) {
				echo "success";
			}
		}else{
			$up = $connect->prepare("UPDATE loan_payments SET amount = ?, paid_date = ?, payment_method = ? , collected_by = ?, comment = ? WHERE id = ? AND borrower_id = ? ");
			$q = $up->execute(array($amount, $paid_date, $payment_method, $collected_by, $comment, $edit_id, $borrower_id));
			if($q){
				echo "updated";
			}
		}
	}
		
?>