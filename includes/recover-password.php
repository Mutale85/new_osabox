<?php
// -------------------------------------------------------
include ("db.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


if (isset($_POST['email'])) {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $sql = $connect->prepare("SELECT * FROM admins WHERE email = ? ");
    $sql->execute(array($email));
    $count = $sql->rowCount();

    if ($count > 0) {
        $row = $sql->fetch();
        $email = $row['email'];
        $username = $row['firstname'];
        $userForgotten = $row['password'];
        $string = "1234567890qwertyuiopasdfghjklzxcvbnm";
        $shuffle = str_shuffle($string);
        $token = substr($shuffle, 0, 10);
        $update = $connect->prepare("UPDATE admins SET token = ? WHERE email = ? ");
        $update->execute(array($token, $email));
        // We send email to user
        $message = '
            <!Doctype html>
                <html lang="en-US">
                
                <head>
                    <meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
                    <title>'.$email.' Reset Password Email</title>
                    <meta name="description" content="'.$email.' Reset Password Email.">
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
                                          <a href="https://osabox.co" title="logo" target="_blank">
                                            <img width="90" src="https://osabox.co/images/icon2.png" title="logo" alt="logo">
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
                                                        <h1 style="color:#1e1e2d; font-weight:500; margin:0;font-size:32px;font-family:"Rubik",sans-serif;">Hello '.$username.' <br>You have
                                                            requested to reset your password</h1>
                                                        <span
                                                            style="display:inline-block; vertical-align:middle; margin:29px 0 26px; border-bottom:1px solid #cecece; width:100px;"></span>
                                                        <p style="color:#455056; font-size:15px;line-height:24px; margin:0;">
                                                            We cannot simply send you your old password. A unique link to reset your
                                                            password has been generated for you. To reset your password, click the
                                                            following link and follow the instructions.
                                                        </p>
                                                        <a href="https://password.osabox.co/reset?token='.$token.'&email='.$email.'"
                                                            style="background:#20e277;text-decoration:none !important; font-weight:500; margin-top:35px; color:#fff;text-transform:uppercase; font-size:14px;padding:10px 24px;display:inline-block;border-radius:50px;">Reset
                                                            Password</a>
                                                      
                                                      <br><br>
                                                      Or copy and paste the link below in your browser
                                                     <br><br>
                                                      https://password.osabox.co/reset?token='.$token.'&email='.$email.'
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
                                            <p style="font-size:14px; color:rgba(69, 80, 86, 0.7411764705882353); line-height:18px; margin:0 0 0;">&copy; <strong>www.osabox.co</strong></p>
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
            $mail->addAddress($email, $username); //$inst_admin_email;
            $mail-> setFrom("info@osabox.net", $username);
            $mail-> Subject = "Password Reset Request";
            $mail->isHTML(TRUE);
            //  $mail->SMTPDebug = 2;
            $mail->Body = $message;
            if($mail->send()){
                echo "An email with a password reset has been sent to <b>".$email."</b> check your email inbox / spam mails";
            }else{
                echo $mail->ErrorInfo;
            }
                            
    }else{
        echo "<span style='color:red;'>Email Not Found In Our Server</span>";
    }
}
?>