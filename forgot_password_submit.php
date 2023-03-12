<?php
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$type = get_safe_value($con, $_POST['type']);

if ($type == 'email') {
    $email = get_safe_value($con, $_POST['email']);

    $user = mysqli_query($con, "select * from users where email = '$email'");
    $user_count = mysqli_num_rows($user);

    if ($user_count > 0) {
        $row = mysqli_fetch_assoc($user);
        $password = $row['password'];
        $html = "Your password is '<strong>$password</strong>'";

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
        $mail->Subject = "Your password";
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
    } else {
        echo "You are not a registered user";
        die();
    }
}
