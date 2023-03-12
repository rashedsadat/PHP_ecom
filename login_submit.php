<?php

require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$email = get_safe_value($con, $_POST['email']);
$password = get_safe_value($con, $_POST['password']);

$result = mysqli_query($con, "select * from users where email = '$email'");
$check_user = mysqli_num_rows($result);

if ($check_user > 0) {
    $row = mysqli_fetch_assoc($result);
    if ($row['email'] == $email && $row['password'] == $password) {
        $_SESSION['USER_LOGIN'] = 'yes';
        $_SESSION['USER_ID'] = $row['id'];
        $_SESSION['USER_NAME'] = $row['name'];
        echo "success";
    } else {
        echo 'error';
    }
} else {
    echo "error";
}
