<?php
	include('includes/db.php');

	if(!empty($_POST['client_id'])){
		#update
		$client_id 				= $_POST['client_id'];
		$parent_id 				= $_SESSION['parent_id'];
		$firstname 				= filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$lastname 				= filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$address 				= filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$company_name 			= filter_var($_POST['company_name'], FILTER_SANITIZE_STRING);
		$email 					= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$phone 					= filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
		$branch_id 				= $_POST['branch_id'];

		

		$update = $connect->prepare("UPDATE `clients` SET `firstname`= ?, `lastname` = ?, `company_name`= ?,`address`= ?,`email`= ?,`phone`= ? WHERE id = ? AND parent_id = ? ");
		$ex = $update->execute(array($firstname, $lastname, $company_name, $address, $email, $phone, $client_id, $parent_id));

		if($ex){
			echo $firstname. ' details updated ';
		}else{
			echo "Error uploading User";
			exit();
		}	

	}else{
	
		$parent_id 				= $_SESSION['parent_id'];
		$firstname 				= filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$lastname 				= filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$address 				= filter_var($_POST['address'], FILTER_SANITIZE_STRING);
		$company_name 			= filter_var($_POST['company_name'], FILTER_SANITIZE_STRING);
		$email 					= filter_var($_POST['email'], FILTER_SANITIZE_STRING);
		$phone 					= filter_var($_POST['phone'], FILTER_SANITIZE_STRING);
		$branch_id 				= $_POST['branch_id'];


		if ($firstname == "" ) {
			echo 'Please add client name';
			exit();
		}
		
		$query = $connect->prepare("SELECT * FROM clients WHERE email = ? AND parent_id = ? ");
		$query->execute(array($email, $parent_id));
		if ($query->rowCount() > 0) {
			echo 'client with details email '. $email. '  is already added';
			exit();
		}
		
		$sql = $connect->prepare("INSERT INTO `clients`(`parent_id`, `branch_id`, `firstname`, `lastname`, `company_name`, `address`, `email`, `phone`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
		$ex = $sql->execute(array($parent_id, $branch_id, $firstname, $lastname, $company_name, $address, $email, $phone));
		$project_id = $connect->lastInsertId();
		
		#======== add team members =============

		if($ex){
			echo $firstname. ' added to clients list';
		}else{
			echo "Error uploading User";
			exit();
		}	
	}
?>