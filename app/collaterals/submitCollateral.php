<?php
	include '../../includes/db.php';
	extract($_POST);
	if (!empty($ID)) {
		#update
		
		if ($_FILES['photo']['name'] == "") {
			$photo = $col_photo;
		}else{
			$photo 	  = $_FILES['photo']['name'];
			$filename = $_FILES['photo']['tmp_name'];
			$destination = 'files/'.basename($photo);
			move_uploaded_file($filename, $destination);
		}
		if($_FILES['files']['name'] != ""){
			$file = "";
			foreach ((array) $_FILES['files']['name'] as $key => $value) {
				$file .= $value.', ';
				$filename = $_FILES['files']['tmp_name'][$key];
				$destination = 'files/'.basename($value);
				move_uploaded_file($filename, $destination);

				$get = $connect->prepare("DELETE FROM `collaterals_files` WHERE col_id = ? ");
				
				if($get->execute(array($ID))){
					// unlink($destination);
					$insert = $connect->prepare("INSERT INTO `collaterals_files`(`col_id`, `filename`, `loan_number`, `borrower_id`) VALUES (?, ?, ?, ?) ");
					$insert->execute(array($ID, $value, $loan_number, $borrower_id));
				}
			}
			$files = rtrim($file, ", ");
		}else{
			$files = $col_filesID;
		}
		

		$update = $connect->prepare("UPDATE  collaterals  SET  collateral_type = ?, product_name = ?, register_date = ?, product_value = ?, currency = ?, product_location = ?, action_date = ?, address = ?, serial_number = ?, model_name = ?, model_number = ?, color = ?, manufature_date = ?, product_condition = ?, description = ?, photo = ?, files = ?, vehicle_reg_number = ?, millage = ?, vehicle_engine_num = ? WHERE id = ? ");
		if($update->execute(array($collateral_type, $product_name, $register_date, $product_value, $currency, $product_location, $action_date, $address,  $serial_number, $model_name, $model_number, $color, $manufature_date, $product_condition, $description, $photo, $files, $vehicle_reg_number, $millage, $vehicle_engine_num, $ID))){
			
			echo 'updated';
		
		}

	}else{
		$file = "";
		
		foreach ($_FILES['files']['name'] as $key => $value) {
			$file .= $value.', ';
			$filename = $_FILES['files']['tmp_name'][$key];

			$destination = 'files/'.basename($value);
			move_uploaded_file($filename, $destination);
		}
		$files = rtrim($file, ', ');
		$photo = $_FILES['photo']['name'];
		$file_name = $_FILES['photo']['tmp_name'];
		$destination = 'files/'.basename($photo);
		move_uploaded_file($file_name, $destination);

		$sql = $connect->prepare("INSERT INTO `collaterals`(`collateral_type`, `branch_id`, `parent_id`, `loan_number`, `borrower_id`, `product_name`, `register_date`, `product_value`, `currency`, `product_location`, `action_date`, `address`, `serial_number`, `model_name`, `model_number`, `color`, `manufature_date`, `product_condition`, `description`, `photo`, `files`, `vehicle_reg_number`, `millage`, `vehicle_engine_num`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$ex = $sql->execute(array($collateral_type, $branch_id, $parent_id, $loan_number, $borrower_id, $product_name, $register_date, $product_value, $currency, $product_location, $action_date, $address,  $serial_number, $model_name, $model_number, $color, $manufature_date, $product_condition, $description, $photo, $file, $vehicle_reg_number, $millage, $vehicle_engine_num));

		$col_id = $connect->lastInsertId();

		if ($ex) {
			foreach ($_FILES['files']['name'] as $key => $value) {
				$filename = $value;
				$insert = $connect->prepare("INSERT INTO `collaterals_files`(`col_id`, `filename`, `loan_number`, `borrower_id`) VALUES (?, ?, ?, ?) ");
				$insert->execute(array($col_id, $filename, $loan_number, $borrower_id));
				
			}
			echo "done";
		}
	}
?>