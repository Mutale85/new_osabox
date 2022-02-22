<?php
	include '../includes/db.php';
	extract($_POST);
	if (!empty($edit_allowance_id)) {
		$query = $connect->prepare("SELECT * FROM salary_allowances WHERE id = ?");
		$query->execute(array($edit_allowance_id));
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
		$staff_id = $_POST['staff_id'];
		$d = $connect->prepare("DELETE FROM payroll WHERE id = ? AND staff_id = ? AND parent_id = ? ");
		if($d->execute(array($payroll_id, $staff_id, $_SESSION['parent_id']))){
			
			$del = $connect->prepare("DELETE FROM payroll_allowances WHERE payroll_id = ? AND employee_id = ? AND parent_id = ? ");
			$del->execute(array($payroll_id, $staff_id, $_SESSION['parent_id']));
			$del = $connect->prepare("DELETE FROM payroll_deductions WHERE payroll_id = ? AND employee_id = ? AND parent_id = ? ");
			$ex = $del->execute(array($payroll_id, $staff_id, $_SESSION['parent_id']));
			if ($ex) {
				echo " Payroll Deleted";
			}
		}
	}

	// =========== DELETE ALLOWANCES AND DEDUCTIONS ============
	if (isset($_POST['allowance_id'])) {
		$allowance_id = $_POST['allowance_id'];
		$branch_id = $_POST['branch_id'];
		$staff_id = $_POST['staff_id'];
		$d = $connect->prepare("DELETE FROM salary_allowances WHERE id = ? AND parent_id = ? AND staff_id = ? ");
		if($d->execute(array($allowance_id, $_SESSION['parent_id'], $staff_id))){
			echo "Allowance Removed";
		}
	}

	if (isset($_POST['remove_deduction_id'])) {
		$remove_deduction_id = $_POST['remove_deduction_id'];

		$d = $connect->prepare("DELETE FROM salary_deductions WHERE id = ? AND parent_id = ? ");
		if($d->execute(array($remove_deduction_id, $_SESSION['parent_id']))){
			echo "Deduction Removed";
		}
	}

	if (isset($_POST['remove_allowance_id_and_amount'])) {
		$remove_allowance_id_and_amount = $_POST['remove_allowance_id_and_amount'];

		$d = $connect->prepare("DELETE FROM salary_allowances WHERE id = ? AND parent_id = ? ");
		if($d->execute(array($remove_allowance_id_and_amount, $_SESSION['parent_id']))){
			$del = $connect->prepare("DELETE FROM payroll_allowances WHERE allowance_id = ? AND parent_id = ? ");
			$del->execute(array($remove_allowance_id_and_amount, $_SESSION['parent_id']));
			echo "Allowance Removed";
		}
	}

	if (isset($_POST['remove_deduction_and_amount_id'])) {
		$remove_deduction_and_amount_id = $_POST['remove_deduction_and_amount_id'];
		$branch_id = $_POST['branch_id'];
		$staff_id = $_POST['staff_id'];
		$d = $connect->prepare("DELETE FROM salary_deductions WHERE id = ? AND parent_id = ? AND staff_id = ? ");
		if($d->execute(array($remove_deduction_and_amount_id, $_SESSION['parent_id'], $staff_id))){
			echo "Deduction Removed";
		}
	}

	// if (isset($_POST['payroll_id'])) {
	// 	# code...
	// }
	

	
?>