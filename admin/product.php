<?php
require('top.inc.php');

if (isset($_GET['type']) && $_GET['type'] != '') {
    $type = get_safe_value($con, $_GET['type']);
    // Active or Deactive
    if ($type == 'status') {
        $operation = get_safe_value($con, $_GET['operation']);
        $id = get_safe_value($con, $_GET['id']);
        if ($operation == 'active') {
            $status = 1;
        } elseif ($operation == 'deactive') {
            $status = 0;
        }
        $update_status_sql = "update products set status = '$status' where id = '$id'";
        mysqli_query($con, $update_status_sql);
    }

    // delete product
    if ($type == 'delete') {
        $id = get_safe_value($con, $_GET['id']);
        $delete_sql = "delete from products where id = '$id'";
        mysqli_query($con, $delete_sql);
    }
}

$sql = "select products.*, categories.categories, sub_categories.sub_categories from products,categories, sub_categories where products.categories_id = categories.id and products.sub_categories_id = sub_categories.id order by products.id desc";
$result = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Products </h4>
                        <h4 class="box-title"><a class="btn btn-success" href="manage_product.php">Add Product </a> </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="serial">#</th>
                                        <th>Categories</th>
                                        <th>Sub Category</th>
                                        <th>Name</th>
                                        <th>Image</th>
                                        <th>MRP</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Best seller</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    while ($row = mysqli_fetch_assoc($result)) { ?>
                                        <tr>
                                            <td class="serial"><?php echo $i; ?>.</td>
                                            <td><?php echo $row['categories']; ?></td>
                                            <td><?php echo $row['sub_categories']; ?></td>
                                            <td><?php echo $row['name']; ?></td>
                                            <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image']; ?>" class="img-fluid" alt=""></td>
                                            <td><?php echo $row['mrp']; ?></td>
                                            <td><?php echo $row['price']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td><?php
                                                echo ($row['best_seller'] == 1) ? "<span class='badge bg-primary'>Yes</span>" : "<span class='badge bg-danger'>No</span>";
                                                ?></td>
                                            <td>
                                                <?php
                                                if ($row['status'] == 1) {
                                                    echo "<a class='btn btn-success' href='?type=status&operation=deactive&id=" . $row['id'] . "'>Active</a>&nbsp;";
                                                } else {
                                                    echo "<a class='btn btn-secondary' href='?type=status&operation=active&id=" . $row['id'] . "'>Deactive</a>&nbsp;";
                                                }

                                                // for edit categories
                                                echo "<a class='btn btn-warning' href='manage_product.php?id=" . $row['id'] . "'>Edit</a>&nbsp;";

                                                // for delete categories
                                                echo "<a class='btn btn-danger' href='?type=delete&id=" . $row['id'] . "'>Delete</a>&nbsp;";
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
require('footer.inc.php');
?>
