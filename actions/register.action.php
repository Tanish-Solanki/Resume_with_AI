<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../assets/class/database.class.php';
require '../assets/class/function.class.php';

require '../assets/packages/phpmailer/src/Exception.php';
require '../assets/packages/phpmailer/src/PHPMailer.php';
require '../assets/packages/phpmailer/src/SMTP.php';

if ($_POST) {
    $post = $_POST;

    if ($post['full_name'] && $post['email_id'] && $post['password']) {
        $full_name = $db->real_escape_string($post['full_name']);
        $email_id = $db->real_escape_string($post['email_id']);
        $password = md5($db->real_escape_string($post['password']));
        $result = $db->query("SELECT COUNT(*) as user FROM users WHERE email_id='$email_id'");
        $result = $result->fetch_assoc();

        if ($result['user']) {
            $fn->setError($email_id . ' is already registered!');
            $fn->redirect('../login.php');
        } else {
            try {
                $db->query("INSERT INTO users(full_name, email_id, password) VALUES('$full_name', '$email_id', '$password')");

                $mail = new PHPMailer(true);

                //Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'breezebeamteam@gmail.com';
                $mail->Password   = 'bmyo nhwb pajt qnvb';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                $mail->Port       = 465;

                //Recipients
                $mail->setFrom('breezebeamteam@gmail.com', 'Resumify');
                $mail->addAddress($email_id);

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Welcome to the Resumify Community - BreezeBeamCreationsTeam';
                $mail->Body    = '
                <!DOCTYPE html>
                <html>
                <head>
                    <meta charset="UTF-8">
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f0f0f0;
                            margin: 0;
                            padding: 0;
                        }
                        .email-container {
                            max-width: 600px;
                            margin: 30px auto;
                            background-color: #ffffff;
                            border-radius: 10px;
                            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                            overflow: hidden;
                        }
                        .header {
                            background: linear-gradient(90deg, #ff6f61, #de5246);
                            color: #ffffff;
                            padding: 30px;
                            text-align: center;
                        }
                        .header h1 {
                            margin: 0;
                            font-size: 36px;
                        }
                        .content {
                            padding: 30px;
                            text-align: center;
                        }
                        .content p {
                            font-size: 18px;
                            color: #333333;
                            margin: 0 0 20px;
                        }
                        .btn {
                            display: inline-block;
                            padding: 10px 20px;
                            margin: 20px 0;
                            font-size: 18px;
                            color: #ffffff;
                            background-color: #ff6f61;
                            border-radius: 5px;
                            text-decoration: none;
                            transition: background-color 0.3s;
                        }
                        .btn:hover {
                            background-color: #de5246;
                        }
                        .footer {
                            background-color: #f4f4f4;
                            padding: 20px;
                            text-align: center;
                            color: #777777;
                            font-size: 14px;
                        }
                        .footer a {
                            color: #ff6f61;
                            text-decoration: none;
                        }
                        .footer a:hover {
                            text-decoration: underline;
                        }
                        .social-icons img {
                            width: 30px;
                            margin: 0 10px;
                            vertical-align: middle;
                        }
                    </style>
                </head>
                <body>
                    <div class="email-container">
                        <div class="header">
                            <h1>Welcome to Resumify!</h1>
                        </div>
                        <div class="content">
                            <p>Hello <strong>'.$full_name.'</strong>,</p>
                            <p>Thank you for joining <b>Resumify - BreezeBeamCreationsTeam!</b> We are thrilled to have you as part of our community.</p>
                            <p>Feel free to explore our website and create amazing resumes. Click the button below to get started:</p>
                            <a href="https://127.0.0.1/resume_bld/login.php/" class="btn">Get Started</a>
                            <p>If you have any questions, don\'t hesitate to reach out to us.</p>
                        </div>
                        <div class="footer">
                            <p>If you need any help, feel free to <a href="mailto:breezebeamteam@gmail.com"><b>contact us</b></a>.</p>
                            <p>Thank you,<br>The Resumify - BreezeBeamCreationsTeam</p>
                           
                            <p><a href="https://127.0.0.1/resume_bld/login.php/"><img src="./assets/images/logo.png" alt="Website Icon"/> Visit Our Website</a></p>
                        </div>
                    </div>
                </body>
                </html>';
                $mail->AltBody = 'Hello '.$full_name.',
                
                Thank you for joining Resumify - BreezeBeamCreationsTeam! We are thrilled to have you as part of our community.
                
                Feel free to explore our website and create amazing resumes. Visit our website to get started.
                
                If you need any help, feel free to contact us at breezebeamteam@gmail.com.
                
                Thank you,
                The Resumify - BreezeBeamCreationsTeam';

                $mail->send();
                $fn->setAlert('You Registered Successfully !!');
                $fn->redirect('../login.php');

            } catch (Exception $error) {
                $fn->setError($error->getMessage());
                $fn->redirect('../login.php');
            }
        }
    } else {
        $fn->setError('Please Fill The Form !!');
        $fn->redirect('../login.php');
    }
} else {
    $fn->redirect('../login.php');
}

?>
