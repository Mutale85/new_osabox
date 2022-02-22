<?php
	include("../includes/db.php");
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';

	if (isset($_POST['email'])) {
		$email 	= trim(filter_var($_POST['email'], FILTER_SANITIZE_EMAIL));
		
		if ($email == "") {
			echo "email is empty";
			exit();
		}
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "invalid email";
			exit();
		}

		$query = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
		$query->execute(array($email));

		if ($query->rowCount() > 0) {
			// create a new email and send it to the email
			$row = $query->fetch();
			$firstname = $row['firstname'];

			$password  	= passwordGenerate();
			$pass_w = base64_encode($password);
			$hashed_pasword = password_hash($password, PASSWORD_DEFAULT);
			$update = $connect->prepare("UPDATE admins SET password = ?, pass_w = ? WHERE email = ? ");
			$ex = $update->execute(array($hashed_pasword, $pass_w, $email));

			if ($ex) {
				# send email

				$message = '
			        <!doctype html>
			            <html lang="en-US">

			            <head>
			                <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
			                <title>Osabox - Password Recover</title>
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
			                                                    <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif; text-align:left;">Hello '.$firstname.'</h1>
			                                                    <span
			                                                        style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>


			                                                    <div style="color:#455056; font-size:15px;line-height:24px; margin:0;">
			                                                        <h2 class="title2">You have requested a new password</h2>
			                                                        <p>Your login details are as follows: Email: '.$email.' and Your New Password is: <b><i>'.$password.'</b></p>
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
					$mail-> setFrom("info@osabox.net", 'Password');
					$mail-> Subject = "Password Recovery";
					$mail->isHTML(TRUE);
					// $mail->SMTPDebug = 2;
					$mail->Body = $message;
					if($mail->send()){
						echo 'Email with New Password Sent to your email'; 
					}else{
						echo "Mailer Error: " . $mail->ErrorInfo;
					} 
			}

		}else{
			echo "User email not found in our system";
			exit();
		}
	}
?>