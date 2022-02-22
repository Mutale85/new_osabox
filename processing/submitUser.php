<?php
ini_set("pcre.jit", "0");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
include '../includes/db.php';
if (isset($_POST['firstname'])) {
	$firstname 			= filter_var($_POST['firstname'], FILTER_SANITIZE_STRING);
    $lastname           = filter_var($_POST['lastname'], FILTER_SANITIZE_STRING);
	$email 				= filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
	$phonenumber		= $_POST['phonenumber'];
	$generatedPassword 	= $_POST['password'];
	$plan				= $_POST['plan'];	 
	$price				= $_POST['price'];
	$end_date 		    = date('Y-m-d', strtotime("+ 1 month"));
    $currency           = 'USD';
	$token              = passwordGenerate();
    $allowed_branches   = $_POST['allowed_branches'];
	

	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "Invalid Email";
		exit();
	}

	$check_list = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
	$check_list->execute(array($email));
	$count = $check_list->rowCount();
	if ($count > 0) {
		echo $email . " Already Registered";
		exit();
	}
	
	$password = password_hash($generatedPassword, PASSWORD_DEFAULT);
    $transaction_id = 0;
	$currency = "USD";
    $start_date = date("Y-m-d");
    $end_date = date('Y-m-d', strtotime("+ 1 month"));
    $pass_w = base64_encode($_POST['password']);
    $position = 'Admin';
    $QUERY = $connect->prepare("INSERT INTO `admins` (`firstname`, `lastname`, `email`, `password`, `pass_w`, `phonenumber`, `plan`, `price`, `currency`, `transaction_id`, `start_date`, `end_date`, `position`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $execute = $QUERY->execute(array($firstname, $lastname, $email, $password, $pass_w, $phonenumber, $plan, $price, $currency, $transaction_id, $start_date, $end_date, $position));
    $parent_id = $connect->lastInsertId();
        
    $subs = $connect->prepare("INSERT INTO `subscriptions`(`username`, `email`, `plan`, `price`, `currency`, `transaction_id`, `parent_id`, `end_date`, `allowed_branches`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?) ");
    $subs->execute(array($firstname, $email, $plan, $price, $currency, $transaction_id, $parent_id, $end_date, $allowed_branches));

	
	if($execute){ 
        $update = $connect->prepare("UPDATE admins SET parent_id = ? WHERE email = ? ");
        $update->execute(array($parent_id, $email));
		
		// Send an Email
		
    	$message = '
        <!doctype html>
            <html lang="en-US">

            <head>
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                <title>Osabox - Registration</title>
                <meta name="description" content="Reset Password Email Template.">
                <style type="text/css">
                    a:hover {text-decoration: underline !important;}
                </style>
            </head>

            <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                <!--100% body table-->
                <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8"
                    style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
                    <tr>
                        <td>
                            <table style="background-color: #f2f3f8; max-width:670px;  margin:0 auto;" width="100%" border="0"
                                align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="height:80px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                      <a href="https://osabox.net" title="logo" target="_blank">
                                        <img width="80" src="http://localhost/osabox.net/images/icon2.png" title="logo" alt="logo">
                                      </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td>
                                        <table width="95%" border="0" align="center" cellpadding="0" cellspacing="0"
                                            style="max-width:670px;background:#fff; border-radius:3px; text-align:center;-webkit-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);-moz-box-shadow:0 6px 18px 0 rgba(0,0,0,.06);box-shadow:0 6px 18px 0 rgba(0,0,0,.06);">
                                            <tr>
                                                <td style="height:40px;">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td style="padding:0 35px;">
                                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif; text-align:left;">Welcome '.$firstname.'</h1>
                                                    <span
                                                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>


                                                    <div style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                        <h2 class="title2">Thank you for subscribing to osabox.net</h2>
                                                        <a href="http://localhost/osabox.net/activation?userid='.$parent_id.'&email='.$email.'&pass='.$password.'" class="linkBtn"> Activate Account</a>
                                                        <p> You can also copy and paste the link below into your browser.</p>
                                                        <p>http://localhost/osabox.net/activation?userid='.$parent_id.'&email='.$email.'&pass='.$password.'</p>
                                                        <p>Your login details are as follows: Email: '.$email.' and Your Password is: <b><i>'.$generatedPassword.'</b></p>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="height:40px;">&nbsp;</td>
                                            </tr>
                                        </table>
                                    </td>
                                <tr>
                                    <td style="height:20px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <h4>Uncomplicated Loans and Payroll Management System</h4>
                                        <p>Manage your borrowers, team members and payroll system on one platform.</p>
                                        <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.osabox.net</strong></p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="height:80px;">&nbsp;</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>

            </html>
        ';
    	
		$mail = new PHPMailer();
		$mail->Host = "smtp.zoho.com";
		$mail->isSMTP();
		$mail->SMTPAuth = true;
		$mail->Username = "info@osabox.net";
		$mail->Password = "Mutale@85";
		$mail->SMTPSecure = "ssl";//TLS
		$mail->Port = 465; //TLS port= 587
		$mail->addAddress($email, $firstname); //$inst_admin_email;
		$mail-> setFrom("info@osabox.net", 'Account');
		$mail-> Subject = "Account Reistration Successful";
		$mail->isHTML(TRUE);
		// $mail->SMTPDebug = 2;
		$mail->Body = $message;
		if($mail->send()){
			echo 'Account created please check your email inbox or spam for a verification link sent to {$email}'; 
		}else{
			echo "Mailer Error: " . $mail->ErrorInfo;
		} 
	}
}
?>