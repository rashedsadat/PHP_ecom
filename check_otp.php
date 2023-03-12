<?php
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$type = get_safe_value($con, $_POST['type']);

if ($type == 'email') {
    $otp = get_safe_value($con, $_POST['otp']);
    if ($otp == $_SESSION['EMAIL_OTP']) {
        unset($_SESSION['EMAIL_OTP']);
        echo "done";
    } else {
        echo "error";
    }
}

if ($type == 'mobile') {
    $otp = get_safe_value($con, $_POST['otp']);
    if ($otp == $_SESSION['MOBILE_OTP']) {
        unset($_SESSION['MOBILE_OTP']);
        echo "done";
    } else {
        echo "error";
    }
}
