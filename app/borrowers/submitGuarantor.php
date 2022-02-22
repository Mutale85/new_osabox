<?php
	include('../../includes/db.php');
	if (isset($_POST['firstname'])) {
		$borrower_id    = filter_var($_POST['borrower_id'], FILTER_SANITIZE_STRING);
		$branch_id		= preg_replace("#[^0-9]#", "", $_POST['branch_id']);
		$parent_id 		= preg_replace("#[^0-9]#", "", $_POST['parent_id']);
		$firstname 		= filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$lastname 		= filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$business 		= filter_var($_POST['business'], FILTER_SANITIZE_STRING);
		$gender  		= filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
		$ID 			= filter_var($_POST['ID'], FILTER_SANITIZE_STRING);
		$country 		= filter_var($_POST['country'], FILTER_SANITIZE_STRING);
		$city 			= filter_var($_POST['city'], FILTER_SANITIZE_STRING);
		$address 		= filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$email 			= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$phone 			= filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
		$dateofbirth 	= $_POST['dateofbirth'];
		$working_status = filter_var($_POST['working_status'], FILTER_SANITIZE_STRING);

		$photo 	= $_FILES['photo']['name'];
		$filename 					= $_FILES['photo']['tmp_name'];
		$destination = '../fileuploads/'.basename($photo);
		move_uploaded_file($filename, $destination);
		$files = "";
		if ($branch_id == "") {
			echo "Please add select branch";
			exit();
		}
		if ($firstname == "" ) {
			echo 'Please add guarantors names';
			exit();
		}
		foreach ($_FILES['files']['name'] as $key => $value) {
		 	$files .= $value. ', ';
		 	$file_name = $_FILES['files']['tmp_name'][$key];
		 	$destination2 = '../fileuploads/'.basename($value);
		 	//move to upload folder
		 	move_uploaded_file($file_name, $destination2);
		} 

		$files =  rtrim($files, ", ");

		$officers = 0;
		$query = $connect->prepare("SELECT * FROM guarantors WHERE card_id = ? AND parent_id = ? ");
		$query->execute(array($ID, $parent_id));
		if ($query->rowCount() > 0) {
			echo 'Guarantor ID: '. $ID. ' is already registered';
			exit();
		}

		$sql = $connect->prepare("INSERT INTO `guarantors`(borrower_id, branch_id, parent_id, `firstname`, `lastname`, `business`, `gender`, `card_id`, `country`, `city`, `address`, `email`, `phone`, `dateofbirth`, `working_status`, `photo`, `files`, `loan_officers`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
		$ex = $sql->execute(array($borrower_id, $branch_id, $parent_id, $firstname, $lastname, $business, $gender, $ID, $country, $city, $address, $email, $phone, $dateofbirth, $working_status, $photo, $files, $officers));
		$id = $connect->lastInsertId();
		// we insert loan officers, 
		$date_added = date("Y-m-d");

		foreach ($_FILES['files']['name'] as $key => $value) {
		 	$file_name = $value;
		 	$in = $connect->prepare("INSERT INTO `guarantor_files`(`guarantor_id`, `parent_id`, `branch_id`, `card_id`, `file_name`) VALUES (?, ?, ?, ?, ?)");
		 	$in->execute(array($id, $parent_id, $branch_id, $ID, $file_name));
		 }
		
		if($ex){
			echo "done";
		}else{
			echo "Error uploading User";
			exit();
		}
		
	}
?>