<?php
include 'includes/db.php';
if (isset($_GET['userid']) && isset($_GET['email']) && isset($_GET['pass'])) {
	$userid = preg_replace("#[^0-9]#", "", $_GET['userid']);
	$email = filter_var($_GET['email'], FILTER_SANITIZE_EMAIL);
	$password = $_GET['pass'];
	$activate = 1;
	if ($userid == "" || strlen($email) < 5 ) {
		header("location:activate-message?message= string length issues");
		exit();
	}
	$query = $connect->prepare("SELECT * FROM admins WHERE id = ? AND email = ?  AND password = ? ");
	$query->execute(array($userid, $email, $password));
	$count = $query->rowCount();
	if ($count > 0) {
		$update = $connect->prepare("UPDATE admins SET activate = ? WHERE id = ? AND email = ? AND password = ? ");
		$ex = $update->execute(array($activate, $userid, $email, $password));

		if ($ex) {
			header("location:activate-message?message=Activated");
			exit();
		}

	}else{
		header("location:activate-message?message=user not found");
		exit();
	}
}else{
	echo "You have not created an account with us";
}
?>