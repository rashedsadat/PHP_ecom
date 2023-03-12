<?php
require('connection.inc.php');
require('functions.inc.php');

$product_id = get_safe_value($con, $_POST['id']);
$type = get_safe_value($con, $_POST['type']);


if ($type == 'add') {
    if (isset($_SESSION['USER_LOGIN'])) {
        $user_id = $_SESSION['USER_ID'];

        $wish_sql = "select * from wishlist where user_id = '$user_id' and product_id = '$product_id'";
        $count = mysqli_num_rows(mysqli_query($con, $wish_sql));
        if ($count > 0) {
            echo "have";
        } else {
            $added_on = date('Y-m-d h:i:s');

            $sql = "insert into wishlist(user_id, product_id, added_on) values('$user_id', '$product_id', '$added_on')";
            $result = mysqli_query($con, $sql);
            echo "success";
        }
    } else {
        echo "yes";
    }
}

if ($type == 'remove') {
    if (isset($_SESSION['USER_LOGIN'])) {
        $user_id = $_SESSION['USER_ID'];
        $sql = "select * from wishlist where id = '$product_id' and user_id = '$user_id'";
        $result = mysqli_query($con, $sql);
        $count = mysqli_num_rows($result);
        if ($count == 1) {
            $sql = "delete from wishlist where id = '$product_id'";
            $result = mysqli_query($con, $sql);
        }
        echo "success";
    } else {
        echo "yes";
    }
}
