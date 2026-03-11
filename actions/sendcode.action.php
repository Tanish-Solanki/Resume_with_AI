<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';


require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';

if($_POST){
$post = $_POST;

if($post['email_id']){

$email_id = $db->real_escape_string($post['email_id']);

$result = $db->query("SELECT usr_id,full_name FROM users WHERE (email_id='$email_id')");
$result = $result->fetch_assoc();

if($result){
    $otp = rand(100000,999999);

    //Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'breezebeamteam@gmail.com';                     //SMTP username
    $mail->Password   = 'bmyo nhwb pajt qnvb';                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('breezebeamteam@gmail.com', 'Resumify');
    $mail->addAddress($email_id);     //Add a recipient


    // //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

    //Content
    $mail->isHTML(true);  // Set email format to HTML
    $mail->Subject = 'Your OTP Verification Code from Resumify - BreezeBeamCreationsTeam';
    $mail->Body    = '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f7f9;
                margin: 0;
                padding: 0;
            }
            .email-container {
                max-width: 600px;
                margin: 30px auto;
                background-color: #e8e8e8;
                border-radius: 8px;
                box-shadow: 0 8px 16px rgba(71, 71, 71, 0.5);
                padding: 20px;
                text-align: center;
            }
            .header {
                background-color: #696055; /* Orange */
                color: #ffffff;
                padding: 20px;
                border-radius: 8px 8px 0 0;
            }
            .header h1 {
                margin: 0;
                font-size: 32px;
            }
            .content {
                padding: 20px;
            }
            .otp {
                display: inline-block;
                font-size: 2.5em;
                font-weight: bold;
                color: #ffffff;
                background-color: #445567; /* Dodger Blue */
                padding: 15px;
                border-radius: 8px;
                margin: 20px 0;
                border: 2px solid #46525e;
            }
            .txt{
                font-size: 1.3em;
            }
            .footer {
                margin-top: 20px;
                font-size: 1em;
                color: #6c757d;
            }
            .footer a {
                color: #696055; /* Orange */
                text-decoration: none;
            }
            .footer a:hover {
                text-decoration: underline;
            }
            .footer img {
                width: 24px;
                vertical-align: middle;
                margin-right: 5px;
            }
        </style>
    </head>
    <body>
        <div class="email-container">
            <div class="header">
                <h1>Resumify</h1>
            </div>
            <div class="content">
                <p class="txt">Hello,</p>
                <p class="txt">Thank you for signing up with <b>Resumify - BreezeBeamCreationsTeam!</b> To complete your registration, we need to verify your email address.</p>
                <div class="otp">'.$otp.'</div>
                <p class="txt">Please use it on our website to verify your email.</p>
                <p class="txt">If you did not request this, please disregard this email.</p>
            </div>
            <div class="footer">
                <p>If you need any help, feel free to <a href="mailto:breeezebeamteam@gmail.com"><b>contact us</b></a>.</p>
                <p>Thank you,<br>The Resumify - BreezeBeamCreationsTeam</p>
                <p><a href="https://127.0.0.1/resume_bld/login.php/"><img src="./assets/images/logo.png" alt="Website Icon"/> Visit Our Website</a></p>
            </div>
        </div>
    </body>
    </html>';
    $mail->AltBody = 'Hello,
    
    Thank you for signing up with Resumify - BreezeBeamCreationsTeam! To complete your registration, use the following One-Time Password (OTP): '.$otp.'
    
    Please use it on our website to verify your email.
    
    If you did not request this, please disregard this email.
    
    If you need any help, feel free to contact us at breeezebeamteam@gmail.com.
    
    Thank you,
    The Resumify - BreezeBeamCreationsTeam';
    

    
    $mail->send();

    $fn->setSession('otp',$otp);
    $fn->setSession('email',$email_id);
    $fn->redirect('../verification.php');

} catch (Exception $e) {
    $fn->setError($mail->ErrorInfo);
    $fn->redirect('../forgot-password.php');
}


}else{
    $fn->setError($email_id.' is not registered !!!');
    $fn->redirect('../forgot-password.php'); 
}


}else{
    $fn->setError('Please Enter Email Id !!');
    $fn->redirect('../forgot-password.php');
}

}else{
    $fn->redirect('../forgot-password.php');
}

?>