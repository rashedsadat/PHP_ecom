<?php

require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$name = get_safe_value($con, $_POST['name']);
$email = get_safe_value($con, $_POST['email']);
$mobile = get_safe_value($con, $_POST['mobile']);
$password = get_safe_value($con, $_POST['password']);

$added_on = date('Y-m-d h:i:s');

$check_user = mysqli_num_rows(mysqli_query($con, "select * from users where email = '$email'"));

if ($check_user > 0) {
    echo "exist";
} else {
    $sql = "insert into users (name, email, mobile, password, added_on) values('$name', '$email', '$mobile', '$password', '$added_on')";

    $result = mysqli_query($con, $sql);

    echo "insert";
}
