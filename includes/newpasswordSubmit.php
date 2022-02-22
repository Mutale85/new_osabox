<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

include("db.php");
$base_url = 'https://osabox.co/';
if (isset($_POST['token']) AND isset($_POST['new_password'])) {
    $token     = filter_var($_POST['token'], FILTER_SANITIZE_STRING);
    $password  = filter_var($_POST['new_password'], FILTER_SANITIZE_STRING);
    $email     = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $query     = $connect->prepare("SELECT * FROM admins WHERE email = ? AND token = ? ") or die(mysqli_error($conn));
    $query->execute(array($email, $token));
    $row = $query->fetch();
    $count = $query->rowCount();
    if($count == 1) { // there is a match
        // update the password
        $username = $row['firstname'];
        // $email    = $row['email'];
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $tokenNow = "";
        $update = $connect->prepare("UPDATE admins SET password = ?, token = ? WHERE email = ? ") or die(mysqli_error());
        if($update->execute(array($hashed, $tokenNow, $email))){
            
        // email admin and the user about the email change
            $message = '
                <!doctype html>
                <html lang="en-US">

                <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>Password Changed</title>
                    <meta name="description" content="Uptime Status.">
                    <style type="text/css">
                        a:hover {text-decoration: underline !important;}
                    </style>
                </head>

                <body marginheight="0" topmargin="0" marginwidth="0" style="margin: 0px; background-color: #f2f3f8;" leftmargin="0">
                    <!--100% body table-->
                    <table cellspacing="0" border="0" cellpadding="0" width="100%" bgcolor="#f2f3f8" style="@import url(https://fonts.googleapis.com/css?family=Rubik:300,400,500,700|Open+Sans:300,400,600,700); font-family: "Open Sans", sans-serif;">
                    <tr>
                        <td>
                            <table style="background-color: #f2f3f8; max-width:670px; margin:0 auto;" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="height:80px;">&nbsp;</td>
                                </tr>
                                <tr>
                                    <td style="text-align:center;">
                                        <a href="https://osabox.co" title="logo" target="_blank">
                                            <img width="80" src="https://osabox.co/images/icon2.png" title="logo" alt="logo">
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
                                            <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">'.$username.'</h1>
                                            <span style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;">
                                            </span>
                                            <div style="color:#455056; font-size:18px;line-height:24px; margin:0;">
                                              You have successfuly reset your password to: '.$password.'
                                            </div>

                                        </td>
                                        </tr>
                                        <tr>
                                           <td style="height:40px;">&nbsp;</td>
                                       </tr>
                                    </table>
                                </td>
                                
                                <tr>
                                   <td style="height:80px;">&nbsp;</td>
                                </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                    <!--/100% body table-->
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
            $mail->addAddress($email, $username); //$inst_admin_email;
            $mail-> setFrom("info@osabox.net", $username);
            $mail-> Subject = "Password Changed";
            $mail->isHTML(TRUE);

            $message_body = $message;
            

            $mail->Body = $message_body;
            if($mail->send()){
                echo "Password Changed Successfully";
                
            }else{
                echo "Mailer Error: " . $mail->ErrorInfo;
            } 
                    
        }else{
            echo "";
        }

    }else{
        echo "Invalid Token";
        exit();
    }
}else{
    echo "Invalid credentials";
    exit();
}

?>