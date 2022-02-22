<?php
	include '../../includes/db.php';
	extract($_POST);
	if (!empty($allowance_id)) {
		$query = $connect->prepare("SELECT * FROM salary_allowances WHERE id = ?");
		$query->execute(array($allowance_id));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (!empty($deduction_id)) {
		$query = $connect->prepare("SELECT * FROM salary_deductions WHERE id = ?");
		$query->execute(array($deduction_id));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (!empty($deleteAllowance_id)) {
		$d = $connect->prepare("DELETE FROM salary_allowances WHERE id = ?");
		if($d->execute(array($deleteAllowance_id))){
			echo "Allowance removed";
		}
	}

	if (!empty($deleteDeduction_id)) {
		$d = $connect->prepare("DELETE FROM salary_deductions WHERE id = ?");
		if($d->execute(array($deleteDeduction_id))){
			echo "Deduction removed";
		}
	}

	// ======== BASIC PAY 
	

	if (!empty($salary_scale_id)) {
		$query = $connect->prepare("SELECT * FROM basicPaySetUp WHERE p_id = ?");
		$query->execute(array($salary_scale_id));
		$row = $query->fetch();
		if ($row) {
			$data = json_encode($row);
		}
		echo $data;
	}

	if (!empty($deleteBasicPay_id)) {
		$d = $connect->prepare("DELETE FROM basicPaySetUp WHERE p_id = ?");
		if($d->execute(array($deleteBasicPay_id))){
			echo "Basic Pay Scale removed";
		}
	}

	if (isset($_POST['payroll_id'])) {
		$payroll_id = $_POST['payroll_id'];
		$d = $connect->prepare("DELETE FROM payroll WHERE id = ? AND parent_id = ? ");
		if($d->execute(array($payroll_id, $_SESSION['parent_id']))){
			echo "done";
		}
	}

	
?>