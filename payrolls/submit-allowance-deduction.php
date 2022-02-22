<?php 
	include '../includes/db.php';
	extract($_POST);
	if (!empty($salary_addon)) {
	
		if($salary_addon == "Allowance"){
			//enter into allowances
			$total = 0;
			$currency = getCurrency($connect, $_SESSION['parent_id']);
			$sql = $connect->prepare("INSERT INTO `salary_allowances`(`name`, `amount`, currency, `branch_id`, `parent_id`, `staff_id`, total) VALUES (?, ?, ?, ?, ?, ?, ?) ");
			$exe = $sql->execute(array($name, $amount, $currency,  $branch_id, $parent_id, $staff_id, $total));
			// $allowance_id = $connect->lastInsertId();
			$query = $connect->prepare("SELECT SUM(amount) AS total_allowances FROM `salary_allowances` WHERE branch_id = ?  AND parent_id = ? AND staff_id = ?");
			$query->execute(array($branch_id, $parent_id, $staff_id));
			$row  = $query->fetch();
			$total = $row['total_allowances'];
			$update = $connect->prepare("UPDATE salary_allowances SET total = ? WHERE branch_id = ?  AND parent_id = ? AND staff_id = ? ");
			$update->execute(array($total, $branch_id, $parent_id, $staff_id));
				
			if ($exe) {
				# code...
				echo $name .' added as allowance';
			}

			
		}elseif ($salary_addon == "Deduction") {
			$total = 0;
			$currency = getCurrency($connect, $_SESSION['parent_id']);

			$sql = $connect->prepare("INSERT INTO `salary_deductions`(`name`, `amount`, currency, `branch_id`, `parent_id`, `staff_id`, total) VALUES (?, ?, ?, ?, ?, ?, ?) ");
			$exe = $sql->execute(array($name, $amount, $currency,  $branch_id, $parent_id, $staff_id, $total));
			
			if ($exe) {
				echo "Deduction Added";
				
				$query = $connect->prepare("SELECT SUM(amount) AS total_deductions FROM salary_deductions WHERE branch_id = ?  AND parent_id = ? AND staff_id = ? ");
				$query->execute(array($branch_id, $parent_id, $staff_id));
				$row = $query->fetch();
				$total = $row['total_deductions'];

				$update = $connect->prepare("UPDATE salary_deductions SET total = ? WHERE branch_id = ?  AND parent_id = ? AND staff_id = ? ");
				$update->execute(array($total, $branch_id, $parent_id, $staff_id));
			}
		}
	}


?>