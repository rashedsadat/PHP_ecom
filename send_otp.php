<?php
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$type = get_safe_value($con, $_POST['type']);

if ($type == 'email') {
    $email = get_safe_value($con, $_POST['email']);
    $otp = rand(1111, 9999);
    $_SESSION['EMAIL_OTP'] = $otp;

    $html = "Your OTP is $otp";

    require("smtp/PHPMailerAutoload.php");
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587;
    $mail->SMTPSecure = "tls";
    $mail->SMTPAuth = true;
    $mail->Username = "rashedsadat27@gmail.com"; //your gmail
    $mail->Password = "ckqtneclbbllxyit"; //your gmail app password
    $mail->setFrom("rashedsadat27@gmail.com", 'ECOM'); //user gmail/ From
    $mail->addAddress("$email"); //your gmail/ recipient/ TO
    $mail->isHTML(true);
    $mail->Subject = "Registration OTP";
    $mail->Body = $html;
    // $mail->WordWrap = 50;
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    $mail->SMTPOptions = array('ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => false
    ));
    if ($mail->send()) {
        echo "done";
    } else {
        mysqli_error($con);
    }
}

if ($type == "mobile") {
    $mobile = get_safe_value($con, $_POST['mobile']);
    $otp = rand(1111, 9999);
    $_SESSION['MOBILE_OTP'] = $otp;
}
