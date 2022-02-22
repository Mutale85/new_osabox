<?php
	include('includes/db.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';
	$query = $connect->prepare("SELECT * FROM emailSettingForm WHERE parent_id = ?  ");
	$query->execute(array($_SESSION['parent_id']));
	$row = $query->fetch();
	if ($row) {
		$sender_name = $row['sender_name'];
		$smtp_server = $row['smtp_server'];
		$smtp_port = $row['smtp_port'];
		$sender_email = $row['sender_email'];
		$sender_password = $row['sender_password'];
	}

	if(!empty($_POST['project_id'])){
		#update
		$project_id 			= $_POST['project_id'];
		$parent_id 				= $_SESSION['parent_id'];
		$project_name 			= filter_var($_POST['project_name'], FILTER_SANITIZE_STRING);
		$description 			= $_POST['description'];
		$status 				= filter_var($_POST['status'], FILTER_SANITIZE_STRING);
		$leader 				= filter_var($_POST['leader'], FILTER_SANITIZE_STRING);
		$start_date 			= $_POST['start_date'];
		$deadline 				= $_POST['deadline'];
		$estimated_budget 		= filter_var($_POST['estimated_budget'], FILTER_SANITIZE_STRING);
		$currency 				= filter_var($_POST['currency'], FILTER_SANITIZE_STRING);
		$estimated_duration 	= filter_var($_POST['estimated_duration'], FILTER_SANITIZE_EMAIL);
		$estimated_period 		= $_POST['estimated_period'];
		$project_client 		= $_POST['project_client'];
		$branch_id 				= $_POST['branch_id'];

		if ($project_client == '') {
			$project_client = 'In House';
		}

		$update = $connect->prepare("UPDATE `projects` SET `project_name`= ?, `project_client` = ?, `description`= ?,`status`= ?,`leader`= ?,`start_date`= ?,`deadline`= ?,`estimated_budget`= ?,`currency`= ?,`estimated_duration`= ?, `estimated_period`= ? WHERE id = ? AND parent_id = ? ");
		$ex = $update->execute(array($project_name, $project_client, $description, $status, $leader, $start_date, $deadline, $estimated_budget, $currency, $estimated_duration, $estimated_period, $project_id, $parent_id));

		
		foreach ($_FILES['project_files']['name'] as $key => $value) {
		 	$project_files = $value;
		 	
		 	if(!empty($_FILES['project_files']['tmp_name'][$key])){
		 		$filename = $_FILES['project_files']['tmp_name'][$key];
			 	$destination = 'files/'.basename($value);
			 	move_uploaded_file($filename, $destination);
			 	$sql = $connect->prepare("INSERT INTO `projects_files`(`parent_id`, `project_id`, `project_files`) VALUES ( ?, ?, ?)" );
			 	$ex = $sql->execute(array($parent_id, $project_id, $project_files));
		 	}else{
		 		echo "";
		 	}
		}
		
		if (isset($_POST['send_email'])) {
			// Send Emails to the Admins
			$subject = $project_name .' Update';
			$message = $description;

			foreach ($_POST['team_members'] as $id) {
				$email = getStaffMemberEmail($connect, $id, $parent_id);
				$msg = '
					<!doctype html>
		    			<html lang="en-US">
		              	<head>
							<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
							<title>Email</title>
							<meta name="description" content="Loan Email For '.getStaffMemberNames($connect, $id, $parent_id).'">
							<style type="text/css">
							    a:hover {text-decoration: none !important;}
							      th, td {
							        text-align: left;
							        padding: 16px;
							        border-bottom:1px solid #ddd;
							    }
							    
		    				</style>
		  				</head>
						<body style="font-family:sans-serif; background-color: #f2f3f8;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
							<div class="logo" style="margin:20px auto;width:80px;height:80px;">
								'.getOrganisationLogo($connect, $_SESSION['parent_id']).'
							</div>
							<div class="messageBody" style="background-color: #ffffff; max-width:670px; margin:0 auto;padding:25px;">
								<h1 class="title" style="text-align:center;margin-bottom:20px; font-size:1.2em;">Hello '.getStaffMemberNames($connect, $id, $parent_id).'</h1>        
								<h4 align="center">'.$subject.'</h4><hr>
		            			<p>'.$message.'</p>
								<br><br>				
							</div>
							'.getOrganisationFooterDetails($connect, $_SESSION['parent_id']).'
						</body>
					</html>
				';
			
			    
				$mail = new PHPMailer(true);
				try {
				    //Server settings
				    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				    $mail->isSMTP();                                            //Send using SMTP
				    $mail->Host       = $smtp_server;                     //Set the SMTP server to send through
				    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				    $mail->Username   = $sender_email;                     //SMTP username
				    $mail->Password   = $sender_password;                               //SMTP password
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				    $mail->Port       = $smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				    $mail->setFrom($sender_email, $sender_name);
				    $mail->addAddress($email, getBorrowerFullNamesByEmail($connect, $email));     //Add a recipient
				    $mail->addReplyTo($sender_email, $sender_name);

				    //Attachments
				  //   if($_FILES['project_files']['name'] != ""){
						// $mail->addAttachment($path);         //Add attachments
				  //  	}
				    $mail->isHTML(true);                                  //Set email format to HTML
				    $mail->Subject = $subject;
				    $mail->Body    = $msg;
				    $mail->AltBody = $msg;

				    $mail->send();
				    // echo 'done';

				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			}

		}else{

		}

		#======== add team members =============
		$dele = $connect->prepare("DELETE FROM projects_team_members WHERE project_id = ? AND parent_id = ? ");
		$dele->execute(array($project_id, $parent_id));
		foreach ($_POST['team_members'] as $key => $value) {
			$team_member = $value;
			$insert = $connect->prepare("INSERT INTO `projects_team_members`(`parent_id`, `project_id`, `team_member`) VALUES( ?, ?, ?)");
			$insert->execute(array($parent_id, $project_id, $team_member));
		}

		if($ex){
			echo "updated";
		}else{
			echo "Error uploading User";
			exit();
		}	

	}else{
	
		$parent_id 				= $_SESSION['parent_id'];
		$project_name 			= filter_var($_POST['project_name'], FILTER_SANITIZE_STRING);
		$project_client 		= $_POST['project_client'];
		$description 			= $_POST['description'];
		$status 				= filter_var($_POST['status'], FILTER_SANITIZE_STRING);
		$leader 				= filter_var($_POST['leader'], FILTER_SANITIZE_STRING);
		$start_date 			= $_POST['start_date'];
		$deadline 				= $_POST['deadline'];
		$estimated_budget 		= filter_var($_POST['estimated_budget'], FILTER_SANITIZE_STRING);
		$currency 				= filter_var($_POST['currency'], FILTER_SANITIZE_STRING);
		$estimated_duration 	= filter_var($_POST['estimated_duration'], FILTER_SANITIZE_EMAIL);
		$estimated_period 		= $_POST['estimated_period'];
		$branch_id 				= $_POST['branch_id'];

		if ($project_name == "" ) {
			echo 'Please add project name';
			exit();
		}
		if ($project_client == '') {
			$project_client = 'In House';
		}
		
		$query = $connect->prepare("SELECT * FROM projects WHERE description = ? AND parent_id = ? ");
		$query->execute(array($description, $parent_id));
		if ($query->rowCount() > 0) {
			echo 'user with details: ( '. $description. ')  is already posted';
			exit();
		}
		$spent_budget = '0';
		$sql = $connect->prepare("INSERT INTO `projects`(`parent_id`, `branch_id`, `project_name`, `project_client`, `description`, `status`, `leader`, `start_date`, `deadline`, `estimated_budget`, `currency`, `estimated_duration`, `estimated_period`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
		$ex = $sql->execute(array($parent_id, $branch_id, $project_name, $project_client, $description, $status, $leader, $start_date, $deadline, $estimated_budget, $currency, $estimated_duration, $estimated_period));
		$project_id = $connect->lastInsertId();
		if($_FILES['project_files']['name'] != ""){
			foreach ($_FILES['project_files']['name'] as $key => $value) {
			 	$project_files = $value;
			 	$filename = $_FILES['project_files']['tmp_name'][$key];
			 	$destination = 'files/'.basename($value);
			 	move_uploaded_file($filename, $destination);
			 	$sql = $connect->prepare("INSERT INTO `projects_files`(`parent_id`, `project_id`, `project_files`) VALUES ( ?, ?, ?)" );
			 	$ex = $sql->execute(array($parent_id, $project_id, $project_files));
			}
		}

		#======== add team members =============

		foreach ($_POST['team_members'] as $key => $value) {
			$team_member = $value;
			$insert = $connect->prepare("INSERT INTO `projects_team_members`(`parent_id`, `branch_id`, `project_id`, `team_member`) VALUES( ?, ?, ?)");
			$insert->execute(array($parent_id, $branch_id, $project_id, $team_member));

			#send an email to the member about the project. 
			#project name
			#start date, 
			#end date.
			#send an sms to the members.
			
		}

		#================= SEND EMAIL ================
		if (isset($_POST['send_email'])) {
			// Send Emails to the Admins
			$subject = $project_name .' Update';
			$message = $description;

			foreach ($_POST['team_members'] as $id) {
				$email = getStaffMemberEmail($connect, $id, $parent_id);
				$msg = '
					<!doctype html>
		    			<html lang="en-US">
		              	<head>
							<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
							<title>Email</title>
							<meta name="description" content="Loan Email For '.getStaffMemberNames($connect, $id, $parent_id).'">
							<style type="text/css">
							    a:hover {text-decoration: none !important;}
							      th, td {
							        text-align: left;
							        padding: 16px;
							        border-bottom:1px solid #ddd;
							    }
							    
		    				</style>
		  				</head>
						<body style="font-family:sans-serif; background-color: #f2f3f8;" marginheight="0" topmargin="0" marginwidth="0" leftmargin="0">
							<div class="logo" style="margin:20px auto;width:80px;height:80px;">
								'.getOrganisationLogo($connect, $_SESSION['parent_id']).'
							</div>
							<div class="messageBody" style="background-color: #ffffff; max-width:670px; margin:0 auto;padding:25px;">
								<h1 class="title" style="text-align:center;margin-bottom:20px; font-size:1.2em;">Hello '.getStaffMemberNames($connect, $id, $parent_id).'</h1>        
								<h4 align="center">'.$subject.'</h4><hr>
		            			<p>'.$message.'</p>
								<br><br>				
							</div>
							'.getOrganisationFooterDetails($connect, $_SESSION['parent_id']).'
						</body>
					</html>
				';
			
			    
				$mail = new PHPMailer(true);
				try {
				    //Server settings
				    //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
				    $mail->isSMTP();                                            //Send using SMTP
				    $mail->Host       = $smtp_server;                     //Set the SMTP server to send through
				    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
				    $mail->Username   = $sender_email;                     //SMTP username
				    $mail->Password   = $sender_password;                               //SMTP password
				    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				    $mail->Port       = $smtp_port;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				    $mail->setFrom($sender_email, $sender_name);
				    $mail->addAddress($email, getBorrowerFullNamesByEmail($connect, $email));     //Add a recipient
				    $mail->addReplyTo($sender_email, $sender_name);

				    //Attachments
				  //   if($_FILES['project_files']['name'] != ""){
						// $mail->addAttachment($path);         //Add attachments
				  //  	}
				    $mail->isHTML(true);                                  //Set email format to HTML
				    $mail->Subject = $subject;
				    $mail->Body    = $msg;
				    $mail->AltBody = $msg;

				    $mail->send();
				    // echo 'done';

				} catch (Exception $e) {
				    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
				}
			}

		}else{

		}

		if($ex){
			echo "done";
		}else{
			echo "Error uploading User";
			exit();
		}	
	}
?>