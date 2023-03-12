<?php
require('top.inc.php');

$sub_categories = '';
$category_id = '';
$msg = '';

// to show edit data
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = get_safe_value($con, $_GET['id']);
    $sql = "select * from sub_categories where id = '$id'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        $sub_categories = $row['sub_categories'];
        $category_id = $row['category_id'];
    } else {
        header('location:sub_categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $category_id = get_safe_value($con, $_POST['category_id']);
    $sub_categories = get_safe_value($con, $_POST['sub_categories']);
    $check_sql = mysqli_query($con, "select * from sub_categories where sub_categories = '$sub_categories'");
    if (mysqli_num_rows($check_sql) > 0) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            // update existing sub categories 
            $get_data = mysqli_fetch_assoc($check_sql);
            if ($id == $get_data['id']) {
                $sql = "update sub_categories set sub_categories = '$sub_categories', category_id = '$category_id' where id = '$id'";
                $result = mysqli_query($con, $sql);
                header('location:sub_categories.php');
                die();
            } else {
                $msg = 'Category already exist!';
            }
        } else {
            $msg = 'Category already exist!';
        }
    } else {
        if (isset($_GET['id']) && !empty($_GET['id'])) {

            // update new sub category to an existing row
            $sql = "update sub_categories set sub_categories = '$sub_categories', category_id = '$category_id' where id = '$id'";
            $result = mysqli_query($con, $sql);
        } else {

            // insert new data to database
            $sql = "insert into sub_categories(category_id, sub_categories, status) values('$category_id', '$sub_categories', '1')";
            $result = mysqli_query($con, $sql);
        }
        header('location:sub_categories.php');
        die();
    }
}

?>


<div class="content pb-0">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>Categories </strong>
                        <small> Form</small>
                    </div>
                    <div class="card-header">
                        <a class="btn btn-success" href="sub_categories.php">Back</a>
                    </div>
                    <form action="" method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" class="form-control" id="category_id">
                                    <option value="">Select Category</option>
                                    <?php
                                    $category_result = mysqli_query($con, "select * from categories");
                                    while ($row = mysqli_fetch_assoc($category_result)) {
                                    ?>
                                        <option value="<?php echo $row['id'] ?>" <?php echo ($category_id == $row['id']) ? "selected" : ""; ?>><?php echo $row['categories'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_categories" class=" form-control-label">Sub Category</label>
                                <input type="text" name="sub_categories" value="<?php echo $sub_categories; ?>" placeholder="Enter sub categories name" class="form-control" required>
                            </div>
                            <button name="submit" type="submit" class="btn btn-lg btn-info btn-block">
                                <span id="payment-button-amount">Submit</span>
                            </button>
                            <div style="color: red; margin-top: 15px;"><?php echo $msg; ?></div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


<?php
require('footer.inc.php');
?>
