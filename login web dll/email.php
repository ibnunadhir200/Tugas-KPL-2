<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($user_object->save_data()) {

    $mail = new PHPMailer(true);

    $mail->isSMTP();

    $mail->Host = 'Host Name';

    $mail->SMTPAuth = true;

    $mail->Username = 'mohibnunadhir@gmail.com'; // SMTP username
    $mail->Password = 'kejuasin123';

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

    $mail->Port = 80;

    $mail->setFrom('mohibnunadhir@gmail.com', 'Forgot Password');

    $mail->addAddress($user_object->getUserEmail());

    $mail->isHTML(true);

    $mail->Subject = 'Password Update Request';

    $mail->Body = '</p>Dear ' . $userDetails['first_name'] . '</p>, 
    <p>Recently a request was submitted to reset a password for your account. If this was a mistake, just ignore this email and nothing will happen.</p>
    <p>To reset your password, visit the following link: <a href="' . $resetPassLink . '">' . $resetPassLink . '</a></p>
    <p><br/>Regards</p>,
    <p>Ibnu Nader</p>';

    $mail->send();

    $success_message = 'Verification for Update Password sent to ' . $user_object->getUserEmail() . ', so before login first verify your email';
    $sessData['status']['type'] = 'success';
    $sessData['status']['msg'] = 'Please check your e-mail, we have sent a password reset link to your registered email.';
} else {
    $error = 'Something went wrong try again';
    $sessData['status']['type'] = 'error';
    $sessData['status']['msg'] = 'Some problem occurred, please try again.';
}
//store reset password status into the session
$_SESSION['sessData'] = $sessData;
//redirect to the forgot pasword page
header("Location:forgotPassword.php");