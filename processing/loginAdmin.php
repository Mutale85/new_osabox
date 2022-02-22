<?php

	include("../includes/db.php");
	if (isset($_POST['email'])) {
		$email 		= trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
		$password 	= trim(filter_var($_POST['password'], FILTER_SANITIZE_STRING));
		$user_ip 	= getUserIpAddr();
		$ip_address = getUserIpAddr();
	  	$geo = unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip_address) );
		$user_country = $geo["geoplugin_countryName"];
		if ($email == "") {
			echo "email is empty";
			exit();
		}
		if ($password == "") {
			echo "password are empty";
			exit();
		}
		// if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// 	echo "invalid email";
		// 	exit();
		// }

		$query = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
		$query->execute(array($email));
		if ($query->rowCount() > 0) {
			foreach ($query->fetchAll() as $row) {
				if($row['activate'] == 1){
					if (password_verify($password, $row['password'])) {
						$_SESSION['email'] 		= $row['email'];
					    $_SESSION['user_id'] 	= $row['id'];
					    $_SESSION['user_role']  = $row['position'];
					    $_SESSION['admin_role'] = $row['admin_role'];
					    $_SESSION['firstname'] 	= $row['firstname'];
					    $_SESSION['lastname'] 	= $row['lastname'];
					    $_SESSION['parent_id'] 	= $row['parent_id'];
					    $_SESSION['photo'] 		= $row['photo'];
					    $sql = $connect->prepare("SELECT * FROM allowed_branches WHERE staff_id = ? AND parent_id = ?");
						$sql->execute(array($_SESSION['user_id'], $_SESSION['parent_id']));
						if($sql->rowCount() > 0){
							foreach($sql->fetchAll() as $rows){
								setcookie("allowed_branches".$rows['branch_id'], base64_encode(branchName($connect, $_SESSION['parent_id'], $rows['branch_id'])), time()+60*60*24*30, '/');
								$_SESSION['allowed_branches'] = base64_encode(branchName($connect, $_SESSION['parent_id'], $rows['branch_id']));

							}
						}
					    $password = $row['password'];
					    $parent_id = $row['parent_id'];
					    $sql = $connect->prepare("INSERT INTO `login_table`(`parent_id`, `email`, `password`, `user_ip`, `user_country`) VALUES(?, ?, ?, ?, ?) ");
					    $sql->execute(array($parent_id, $email, $password, $user_ip, $user_country));
					    $getID = $connect->lastInsertId();
					    $_SESSION['lastID'] = $getID;

					    setcookie("userLoggedin", base64_encode($_SESSION['email']. password_hash($_SESSION['email'], PASSWORD_DEFAULT)), time()+60*60*24*30, '/');
					    setcookie("userLoggedinBranch", base64_encode($_SESSION['firstname']), time()+60*60*24*30, '/');
					    if (isset($_POST['remember'])) {
					    	setcookie("userEMail", base64_encode($email), time()+60*60*24*30, '/');
					    	setcookie("userPass", base64_encode($password), time()+60*60*24*30, '/');
					    }else{
					    	setcookie("userEMail", "", time() - 3600, '/');
					    	setcookie("userPass", "", time() - 3600, '/');
					    }
					    echo "Redirecting you in 1 Second";

					}else{
						echo "Incorrect password or email";
						exit();
					}
				}else{
					echo "Please Activate Your Account";
					exit();
				}
			}
		}else{
			echo 'User not found';
			exit();
		}

	}
?>