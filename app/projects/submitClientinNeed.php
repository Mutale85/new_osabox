<?php
	include '../../includes/db.php';
	extract($_POST);
	$photo = $_FILES['photo']['name'];
	$filename = $_FILES['photo']['tmp_name'];
	$destination = 'images/'.basename($photo);
	
	if (!empty($ID)) {
		$query = $connect->prepare("SELECT * FROM clients_in_need WHERE id = ? AND parent_id = ? ");
		$query->execute(array($ID, $parent_id));
		$row = $query->fetch();
		if ($row) {
			$image = $row['photo'];
		}
		if ($_FILES['photo']['name'] == "") {
			$photo = $image;
		}else{
			$photo = $_FILES['photo']['name'];
			$filename = $_FILES['photo']['tmp_name'];
		}
		$update = $connect->prepare("UPDATE `clients_in_need` SET `photo` = ?, `firstname` = ?, `lastname` = ?, `city` = ?, `business_type` = ?, `required_amount` = ?, `details` = ?, `id_type` = ?, `id_number` = ?, `email` = ?, `mobile_number` = ? WHERE id = ? AND parent_id = ? ");
		if($update->execute(array($photo, $firstname, $lastname, $city, $business_type, $required_amount, $details, $id_type, $id_number, $email, $mobile_number, $ID, $parent_id))){
			move_uploaded_file($filename, $destination);
			echo "updated";
		}
	}else{
		$query = $connect->prepare("SELECT * FROM clients_in_need WHERE id_number = ? AND parent_id = ? ");
		$query->execute(array($id_number, $parent_id));
		if ($query->rowCount() > 0) {
			echo $firstname . ' is already listed and seeking funding';
			exit();
		}

		$sql = $connect->prepare("INSERT INTO `clients_in_need`(`photo`, `firstname`, `lastname`, `city`, `business_type`, `currency`, `required_amount`, `details`, `id_type`, `id_number`, `email`, `mobile_number`, `parent_id`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		if($sql->execute(array($photo, $firstname, $lastname, $city, $business_type, $currency, $required_amount, $details, $id_type, $id_number, $email, $mobile_number, $parent_id))){
			move_uploaded_file($filename, $destination);
			echo 'done';
		}
	}
	
?>