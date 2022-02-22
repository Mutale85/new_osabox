<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include("../includes/db.php");

if (isset($_POST['name'])) {
    $name 		= filter_var($_POST['name'], FILTER_SANITIZE_STRING); 
	$email 		= filter_var($_POST['email'], FILTER_SANITIZE_STRING); 
	$subject 	= filter_var($_POST['subject'], FILTER_SANITIZE_STRING);	 
	$message 	= filter_var($_POST['message'], FILTER_SANITIZE_STRING);
	$ip_address = getUserIpAddr();
	$geo 		= unserialize( file_get_contents('http://www.geoplugin.net/php.gp?ip='. $ip_address) );
	$countryName = $geo["geoplugin_countryName"];
	
	$sql = $connect->prepare("
		INSERT INTO contacts(username, email, subject, message, countryName) 
		VALUES(?, ?, ?, ?, ?) ") or die(mysqli_error($conn));
	$execute = $sql->execute(array($name, $email, $subject, $message, $countryName));
	if($execute){
		$send = "";
	    $to = "mutamuls@gmail.com";
	    // $to = 'info@weblister.co';
		$mail = new PHPMailer();
		$mail->addAddress($to);
		$mail->setFrom($email);
		$mail->Subject = $subject;
		$mail->Body = $message;
		$mail->isHTML(true);
		// $mail->SMTPDebug = 2;

	    if($mail->send())
	        $send = "<div class='text-success text-center'><h4>Thank you for contacting us, We will respond to you withing a short possible time.</h4></div>";

	    else
	       $send = $mail->ErrorInfo; 
		
		echo $send;	
		
	}else{
		echo die(mysqli_error($conn));
	}
}

?>