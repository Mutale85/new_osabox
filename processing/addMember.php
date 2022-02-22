<?php
	include("../includes/db.php");
	if (isset($_POST['firstname'])) {
		$firstname 	= filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
		$lastname 	= filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
		$email 		= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$password 	= filter_var($_POST['password'], FILTER_SANITIZE_STRING);

		if ($firstname == "") {
			echo "Names are empty";
			exit();
		}
		if ($email == "") {
			echo "email is empty";
			exit();
		}
		if ($password == "") {
			echo "password are empty";
			exit();
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "invalid email";
			exit();
		}
		
		$query = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
		$query->execute(array($email));
		if ($query->rowCount() > 0) {
			echo $firstname . ' is already registered';
			exit();
		}
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$sql = $connect->prepare("INSERT INTO admins(firstname, lastname, email, password, user_role) VALUES (?, ?, ?, ?, ?)");
		$user_role = 'Admin';
		if($sql->execute(array($firstname, $lastname, $email, $pass, $user_role))){
			echo $firstname . ' Account Created';
			$parent_id = $connect->lastInsertId();
			$sql = $connect->prepare("UPDATE admins SET parent_id = ? WHERE id = ? ");
			$sql->execute(array($parent_id, $parent_id));
			// we should create a branch for the user so that we long them to that branch.
			exit();
		}else{
			echo "error adding admin";
		}

	}
?>