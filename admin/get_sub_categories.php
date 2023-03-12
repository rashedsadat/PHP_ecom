<?php
require('connection.inc.php');
require('constant.inc.php');
require('functions.inc.php');

if (isset($_SESSION['ADMIN_LOGIN']) && !empty($_SESSION['ADMIN_LOGIN'])) {
} else {
    header('location:index.php');
    die();
}

$category_id = get_safe_value($con, $_POST['category_id']);
$sub_categories_id = get_safe_value($con, $_POST['sub_categories_id']);

$result = mysqli_query($con, "select * from sub_categories where category_id = '$category_id' and status = 1");
if (mysqli_num_rows($result) > 0) {
    $html = "<option value=''>Select Sub Category</option>";
    while ($row = mysqli_fetch_assoc($result)) {
        if ($sub_categories_id == $row['id']) {
            $html .= "<option value='" . $row['id'] . "' selected>" . $row['sub_categories'] . "</option>";
        } else {
            $html .= "<option value='" . $row['id'] . "'>" . $row['sub_categories'] . "</option>";
        }
    }
    echo $html;
} else {
    echo "<option value=''>Create Sub Categories</option>";
}
