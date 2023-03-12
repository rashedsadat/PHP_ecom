<?php
require('top.inc.php');

$categories = '';
$msg = '';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = get_safe_value($con, $_GET['id']);
    $sql = "select * from categories where id = '$id'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        $categories = $row['categories'];
    } else {
        header('location:categories.php');
        die();
    }
}

if (isset($_POST['submit'])) {
    $categories = get_safe_value($con, $_POST['categories']);
    $check_sql = mysqli_query($con, "select * from categories where categories = '$categories'");
    if (mysqli_num_rows($check_sql) > 0) {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $get_data = mysqli_fetch_assoc($check_sql);
            if ($id == $get_data['id']) {
                $sql = "update categories set categories = '$categories' where id = '$id'";
                $result = mysqli_query($con, $sql);
                header('location:categories.php');
                die();
            } else {
                $msg = 'Category already exist!';
            }
        } else {
            $msg = 'Category already exist!';
        }
    } else {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $sql = "update categories set categories = '$categories' where id = '$id'";
            $result = mysqli_query($con, $sql);
        } else {
            $sql = "insert into categories(categories, status) values('$categories', '1')";
            $result = mysqli_query($con, $sql);
        }
        header('location:categories.php');
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
                        <a class="btn btn-success" href="categories.php">Back</a>
                    </div>
                    <form action="" method="post">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label">Category</label>
                                <input type="text" name="categories" value="<?php echo $categories; ?>" placeholder="Enter categories name" class="form-control" required>
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
