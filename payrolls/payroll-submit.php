<?php
	include("../includes/db.php");
	extract($_POST);
	$parent_id = $_SESSION['parent_id'];

	$MONTH = date("m");

	if (!empty($PAYROLL_ID)) {
		#update
		$sql = $connect->prepare("UPDATE `payroll` SET `payment_type` = ?, `pay_date` = ?, `pay_scale` = ?, `salary_amount` = ?, `the_currency` = ?, `grosspay` = ?, `total_deductions` = ?, `net_pay` = ?, `payment_method` = ?, `bank_name` = ?, `account_number` = ? WHERE id = ? AND staff_id = ? AND parent_id = ? ");
		$ex = $sql->execute(array($payment_type, $pay_date, $pay_scale, $salary_amount, $the_currency, $grosspay, $total_deductions, $net_pay, $payment_method, $bank_name, $account_number, $PAYROLL_ID, $staff_id, $parent_id));

		$del = $connect->prepare("DELETE FROM payroll_allowances WHERE employee_id = ? AND parent_id = ? AND MONTH(pay_date) = ? ");
		$del->execute(array($staff_id, $parent_id, $MONTH));

		if (isset($allowance_amount)) {
		
			foreach ((array) $allowance_amount as $key => $value) {
				$amount = $value;
				$all_id = $allowance_id[$key];
				$allowance = $allowance_name[$key];
				$q = $connect->prepare("INSERT INTO `payroll_allowances`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `allowance_id`, `allowance_name`,  `allowance_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
				$q->execute(array($PAYROLL_ID, $staff_id, $branch_id, $parent_id, $all_id, $allowance, $amount, $pay_date));
			}
		}

		if (isset($deduction_amount)) {
			
			foreach ((array) $deduction_amount as $key => $value) {
				$amount = $value;
				$d_id = $deduction_id[$key];
				$deduction = $deduction_name[$key];
				$q = $connect->prepare("INSERT INTO `payroll_deductions`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `deduction_id`, `deduction_name`, `deduction_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
				$q->execute(array($PAYROLL_ID, $staff_id, $branch_id, $parent_id, $d_id, $deduction, $amount, $pay_date));
			}
		}

		echo "Payslip Updated";

	}else{
		$query = $connect->prepare("SELECT * FROM payroll WHERE staff_id = ? AND MONTH(pay_date) = ? ");
		$MONTH = date("m");
		$query->execute(array($staff_id, $MONTH));
		if ($query->rowCount() > 0) {
			echo "Payslip for ".date("F") . " for ". getStaffMemberNames($connect, $staff_id, $parent_id). ' has already been added';
			exit();
		}

		$sql = $connect->prepare("INSERT INTO `payroll`(`staff_id`, `man_number`, `payment_type`, `pay_date`, `pay_scale`, `salary_amount`, `the_currency`, `grosspay`, `total_deductions`, `net_pay`, `payment_method`, `bank_name`, `account_number`, `branch_id`, `parent_id`) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
	
		$ex = $sql->execute(array($staff_id, $man_number, $payment_type, $pay_date, $pay_scale, $salary_amount, $the_currency, $grosspay, $total_deductions, $net_pay, $payment_method, $bank_name, $account_number, $branch_id, $parent_id));
		$payroll_id = $connect->lastInsertId();
		if (isset($allowance_amount)) {
		
			foreach ((array) $allowance_amount as $key => $value) {
				$amount = $value;
				$all_id = $allowance_id[$key];
				$allowance = $allowance_name[$key];
				$q = $connect->prepare("INSERT INTO `payroll_allowances`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `allowance_id`, `allowance_name`,  `allowance_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
				$q->execute(array($payroll_id, $staff_id, $branch_id, $parent_id, $all_id, $allowance, $amount, $pay_date));
			}
		}

		if (isset($deduction_amount)) {
			
			foreach ((array) $deduction_amount as $key => $value) {
				$amount = $value;
				$d_id = $deduction_id[$key];
				$deduction = $deduction_name[$key];
				$q = $connect->prepare("INSERT INTO `payroll_deductions`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `deduction_id`, `deduction_name`, `deduction_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?)");
				$q->execute(array($payroll_id, $staff_id, $branch_id, $parent_id, $d_id, $deduction, $amount, $pay_date));
			}
		}

		echo "Payslip Created";
	}
?>