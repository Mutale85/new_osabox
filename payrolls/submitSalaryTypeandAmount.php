<?php 
	include '../includes/db.php';
	extract($_POST);
	if (!empty($salary_addon)) {
	
		if($salary_addon == "Allowance"){
			//enter into allowances
			
			$sql = $connect->prepare("INSERT INTO `salary_allowances`(`name`,  `branch_id`, `parent_id`, `staff_id`) VALUES (?, ?, ?, ?) ");
			$exe = $sql->execute(array($name,  $branch_id, $parent_id, $employee_id));
			$allowance_id = $connect->lastInsertId();
			if ($exe) {
				echo "Allowance Added";
				$insert = $connect->prepare("INSERT INTO `payroll_allowances`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `allowance_id`, `allowance_name`, `allowance_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?) ");
				$pay_date = date("Y-m-d");
				$insert->execute(array($payroll_id, $employee_id, $branch_id, $parent_id, $allowance_id, $name, $amount, $pay_date));

				$query = $connect->prepare("SELECT SUM(allowance_amount) AS grosspay FROM payroll_allowances WHERE payroll_id =? AND employee_id = ? AND parent_id = ? ");
				$query->execute(array($payroll_id, $employee_id, $parent_id));
				$row = $query->fetch();
				$new_gross = $row['grosspay'];
				//update payroll 

				// $sql = $connect->prepare("UPDATE `payroll` SET `payment_type` = ?, `pay_date` = ?, `employee_id` = ?, `pay_scale` = ?, `salary_amount` = ?, `the_currency` = ?, `grosspay` = ?, `total_deductions` = ?, `net_pay` = ?, `payment_method` = ?, `bank_name` = ?, `account_number` = ?, `paid_amount` = ? WHERE id = ? ");
				// $ex = $sql->execute(array($payment_type, $pay_date, $employee, $pay_scale, $salary_amount, $the_currency, $new_gross, $total_deductions, $net_pay, $payment_method, $bank_name, $account_number, $paid_amount, $payrollID));
			}

			
		}elseif ($salary_addon == "Deduction") {
			
			$sql = $connect->prepare("INSERT INTO `salary_deductions`(`name`, `branch_id`, `parent_id`, `staff_id`) VALUES (?, ?, ?, ?) ");
			$exe = $sql->execute(array($name, $branch_id, $parent_id, $employee_id));
			$deduction_id = $connect->lastInsertId();
			if ($exe) {
				echo "Deduction Added";
				$insert = $connect->prepare("INSERT INTO `payroll_deductions`(`payroll_id`, `employee_id`, `branch_id`, `parent_id`, `deduction_id`, `deduction_name`, `deduction_amount`, `pay_date`) VALUES(?, ?, ?, ?, ?, ?, ?, ?) ");
				$pay_date = date("Y-m-d");
				$insert->execute(array($payroll_id, $employee_id, $branch_id, $parent_id, $deduction_id, $name, $amount, $pay_date));

				$query = $connect->prepare("SELECT SUM(allowance_amount) AS total_deductions FROM payroll_deductions WHERE payroll_id =? AND employee_id = ? AND parent_id = ? ");
				$query->execute(array($payroll_id, $employee_id, $parent_id));
				$row = $query->fetch();
				$new_total_deductions = $row['total_deductions'];

				$sql = $connect->prepare("UPDATE `payroll` SET `payment_type` = ?, `pay_date` = ?, `employee_id` = ?, `pay_scale` = ?, `salary_amount` = ?, `the_currency` = ?, `grosspay` = ?, `total_deductions` = ?, `net_pay` = ?, `payment_method` = ?, `bank_name` = ?, `account_number` = ?, `paid_amount` = ? WHERE id = ? ");
				$ex = $sql->execute(array($payment_type, $pay_date, $employee, $pay_scale, $salary_amount, $the_currency, $new_gross, $new_total_deductions, $net_pay, $payment_method, $bank_name, $account_number, $paid_amount, $payrollID));
			}
		}
	}


?>