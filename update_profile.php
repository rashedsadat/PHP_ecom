<?php
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

if (!isset($_SESSION['USER_LOGIN'])) {
?>
    <script>
        window.location.href = 'login.php';
    </script>
<?php
}

$type = get_safe_value($con, $_POST['type']);

// update user info
if ($type == "update") {
    if (isset($_POST['name'])) {
        $name = get_safe_value($con, $_POST['name']);
        $id = $_SESSION['USER_ID'];
        $user = mysqli_query($con, "update users set name = '$name' where id = '$id'");
        if ($user) {
            echo "done";
        } else {
            mysqli_error($con);
        }
    }
}

// change password
if ($type == "change_password") {
    $current_password = get_safe_value($con, $_POST['current_password']);
    $id = $_SESSION['USER_ID'];
    $user = mysqli_fetch_assoc(mysqli_query($con, "select * from users where id = '$id'"));

    if ($user['password'] == $current_password) {
        $new_password = get_safe_value($con, $_POST['new_password']);

        $result = mysqli_query($con, "update users set password = '$new_password' where id = '$id'");
        if ($result) {
            echo "done";
        } else {
            mysqli_error($con);
        }
    } else {
        echo "please enter your valid current password!";
    }
}
