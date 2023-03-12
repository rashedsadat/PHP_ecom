<?php
require('top.inc.php');

$categories_id      = '';
$sub_categories_id  = '';
$name               = '';
$mrp                = '';
$price              = '';
$quantity           = '';
$image              = '';
$short_desc         = '';
$description        = '';
$best_seller        = '';
$meta_title         = '';
$meta_desc          = '';
$meta_keyword       = '';

$msg = '';

$image_required = 'required';

// retrive data for showing when update data
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $image_required = '';
    $id = get_safe_value($con, $_GET['id']);
    $sql = "select * from products where id = '$id'";
    $result = mysqli_query($con, $sql);
    $count = mysqli_num_rows($result);
    if ($count > 0) {
        $row = mysqli_fetch_assoc($result);
        $categories_id      = $row['categories_id'];
        $sub_categories_id  = $row['sub_categories_id'];
        $name               = $row['name'];
        $mrp                = $row['mrp'];
        $price              = $row['price'];
        $quantity           = $row['quantity'];
        $short_desc         = $row['short_desc'];
        $description        = $row['description'];
        $best_seller        = $row['best_seller'];
        $meta_title         = $row['meta_title'];
        $meta_desc          = $row['meta_desc'];
        $meta_keyword       = $row['meta_keyword'];
    } else {
        header('location:product.php');
        die();
    }
}

// create and update
if (isset($_POST['submit'])) {
    $categories_id      = get_safe_value($con, $_POST['categories_id']);
    $sub_categories_id  = get_safe_value($con, $_POST['sub_categories']);
    $name               = get_safe_value($con, $_POST['name']);
    $mrp                = get_safe_value($con, $_POST['mrp']);
    $price              = get_safe_value($con, $_POST['price']);
    $quantity           = get_safe_value($con, $_POST['quantity']);
    $short_desc         = get_safe_value($con, $_POST['short_desc']);
    $description        = get_safe_value($con, $_POST['description']);
    $best_seller        = get_safe_value($con, $_POST['best_seller']);
    $meta_title         = get_safe_value($con, $_POST['meta_title']);
    $meta_desc          = get_safe_value($con, $_POST['meta_desc']);
    $meta_keyword       = get_safe_value($con, $_POST['meta_keyword']);

    $check_sql = mysqli_query($con, "select * from products where name = '$name'");

    // check image type

    if (mysqli_num_rows($check_sql) > 0) {
        // if name is not updated
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $get_data = mysqli_fetch_assoc($check_sql);
            if ($id == $get_data['id']) {
                if ($_FILES['image']['name'] != '') {
                    // upload image
                    $image = rand(1111111111, 9999999999) . '_' . $_FILES['image']['name'];
                    move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);

                    $sql = "update products set categories_id = '$categories_id', sub_categories_id = '$sub_categories_id', name = '$name', mrp = '$mrp', price = '$price', quantity = '$quantity', short_desc = '$short_desc', description = '$description', meta_title = '$meta_title', meta_desc = '$meta_desc', meta_keyword = '$meta_keyword', image = '$image', best_seller = '$best_seller' where id = '$id'";
                } else {
                    $sql = "update products set categories_id = '$categories_id',sub_categories_id = '$sub_categories_id', name = '$name', mrp = '$mrp', price = '$price', quantity = '$quantity', short_desc = '$short_desc', description = '$description', meta_title = '$meta_title', meta_desc = '$meta_desc', meta_keyword = '$meta_keyword', best_seller = '$best_seller' where id = '$id'";
                }
                $result = mysqli_query($con, $sql);
                header('location:product.php');
                die();
            } else {
                $msg = 'Product already exist!';
            }
        } else {
            $msg = 'Product already exist!';
        }
    } else {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            if ($_FILES['image']['name'] != '') {
                // upload image
                $image = rand(1111111111, 9999999999) . '_' . $_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);

                $sql = "update products set categories_id = '$categories_id', sub_categories_id = '$sub_categories_id', name = '$name', mrp = '$mrp', price = '$price', quantity = '$quantity', short_desc = '$short_desc', description = '$description', meta_title = '$meta_title', meta_desc = '$meta_desc', meta_keyword = '$meta_keyword', image = '$image' best_seller = '$best_seller' where id = '$id'";
            } else {
                $sql = "update products set categories_id = '$categories_id', sub_categories_id = '$sub_categories_id', name = '$name', mrp = '$mrp', price = '$price', quantity = '$quantity', short_desc = '$short_desc', description = '$description', meta_title = '$meta_title', meta_desc = '$meta_desc', meta_keyword = '$meta_keyword' best_seller = '$best_seller' where id = '$id'";
            }
            $result = mysqli_query($con, $sql);
        } else {
            // upload image
            $image = rand(1111111111, 9999999999) . '_' . $_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'], PRODUCT_IMAGE_SERVER_PATH . $image);

            $sql = "insert into products(categories_id, sub_categories_id, name, mrp, price, quantity, short_desc, description, meta_title, meta_desc, meta_keyword, status, image, best_seller) values('$categories_id', '$sub_categories_id', '$name', '$mrp', '$price', '$quantity', '$short_desc', '$description', '$meta_title', '$meta_desc', '$meta_keyword', '1', '$image', '$best_seller')";
            $result = mysqli_query($con, $sql);
        }
?>
        <script>
            window.location.href = 'product.php';
        </script>
<?php
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
                        <strong>Product </strong>
                        <small> Form</small>
                    </div>
                    <div class="card-header">
                        <a class="btn btn-success" href="product.php">Back</a>
                    </div>
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="card-body card-block">
                            <div class="form-group">
                                <label for="categories" class=" form-control-label text-success">Category</label>
                                <select name="categories_id" id="categories" class="form-control" required onchange="get_sub_categories('')">
                                    <option value="">Select Category</option>
                                    <?php
                                    $category_sql = "select id, categories from categories order by categories desc";
                                    $category_result = mysqli_query($con, $category_sql);
                                    while ($row = mysqli_fetch_assoc($category_result)) {
                                        if ($row['id'] == $categories_id) {
                                            echo '<option selected value=' . $row['id'] . '>' . $row['categories'] . '</option>';
                                        } else {
                                            echo '<option value=' . $row['id'] . '>' . $row['categories'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="sub_categories" class=" form-control-label text-success">Sub Category</label>
                                <select name="sub_categories" id="sub_categories" class="form-control" required>
                                    <option value="">Select Sub Category</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Product name</label>
                                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter product name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">MRP</label>
                                <input type="text" name="mrp" value="<?php echo $mrp; ?>" placeholder="Enter product mrp" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Price</label>
                                <input type="text" name="price" value="<?php echo $price; ?>" placeholder="Enter product price" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Quantity</label>
                                <input type="text" name="quantity" value="<?php echo $quantity; ?>" placeholder="Enter product quantity" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Image</label>
                                <input type="file" name="image" class="form-control" <?php echo $image_required ?>>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Short Description</label>
                                <textarea name="short_desc" placeholder="Enter short description" class="form-control" required><?php echo $short_desc; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Description</label>
                                <textarea name="description" placeholder="Enter Description" class="form-control" required><?php echo $description; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="categories" class=" form-control-label text-success">Best Seller</label>
                                <select name="best_seller" id="best_seller" class="form-control" required>
                                    <option value="">Select</option>
                                    <option value="1" <?php if ($best_seller == 1) echo "selected"; ?>>Yes</option>
                                    <option value="2" <?php if ($best_seller == 0) echo "selected"; ?>>No</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Meta Title</label>
                                <textarea name="meta_title" placeholder="Enter Meta Title" class="form-control"><?php echo $meta_title; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Meta Description</label>
                                <textarea name="meta_desc" placeholder="Enter Meta Description" class="form-control"><?php echo $meta_desc; ?></textarea>
                            </div>
                            <div class="form-group">
                                <label for="product_name" class=" form-control-label text-success">Meta Keyword</label>
                                <textarea name="meta_keyword" placeholder="Enter Meta Keyword" class="form-control"><?php echo $meta_keyword; ?></textarea>
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

<script>
    function get_sub_categories(sub_categories_id) {
        let category_id = jQuery('#categories').val();
        jQuery.ajax({
            url: "get_sub_categories.php",
            type: "post",
            data: "category_id=" + category_id + "&sub_categories_id=" + sub_categories_id,
            success: function(result) {
                jQuery("#sub_categories").html(result);
            }
        });
    }
</script>

<?php
require('footer.inc.php');
?>

<script>
    <?php
    if (isset($_GET['id']) && !empty($_GET['id'])) {
    ?>
        get_sub_categories(<?php echo $sub_categories_id; ?>);
    <?php
    }
    ?>
</script>
