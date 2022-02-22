<?php 
	include '../includes/db.php';
	extract($_POST);
	if (!empty($salary_addon)) {
	
		if($salary_addon == "Allowance"){
			//enter into allowances
			
			$sql = $connect->prepare("INSERT INTO `salary_allowances`(`name`,  `branch_id`, `parent_id`, `staff_id`) VALUES (?, ?, ?, ?) ");
			$exe = $sql->execute(array($name,  $branch_id, $parent_id, $staff_id));
			if ($exe) {
				echo "Allowance Added";
			}

			
		}elseif ($salary_addon == "Deduction") {
			
			$sql = $connect->prepare("INSERT INTO `salary_deductions`(`name`, `branch_id`, `parent_id`, `staff_id`) VALUES ( ?, ?, ?, ?) ");
			$exe = $sql->execute(array($name, $branch_id, $parent_id, $staff_id));
			if ($exe) {
				echo "Deduction Added";
			}
		}
	}


	if (!empty($salary_scale_name)) {
		if (!empty($salary_id)) {
			$sql = $connect->prepare("UPDATE `basicPaySetUp` SET `salary_scale_name` = ?, `amount` = ?, `currency` = ? WHERE p_id = ?");
			$ex = $sql->execute(array($salary_scale_name, $amount, $currency, $salary_id));
			if ($ex) {
				echo "update";
			}
		}else{
			$sql = $connect->prepare("INSERT INTO `basicPaySetUp`(`salary_scale_name`, `amount`, `currency`, `branch_id`, `parent_id`) VALUES (?, ?, ?, ?, ?)");
			$ex = $sql->execute(array($salary_scale_name, $amount, $currency, $branch_id, $parent_id));
			if ($ex) {
				echo "done";
			}
		}
	}

?>