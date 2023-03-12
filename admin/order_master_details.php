<?php
require('top.inc.php');

$order_id = get_safe_value($con, $_GET['id']);

if (isset($_POST['update_order_status'])) {
    $update_order_status = $_POST['update_order_status'];
    $update_sql = "update orders set order_status = '$update_order_status' where id = '$order_id'";
    mysqli_query($con, $update_sql);
}
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master Details </h4>
                        <h4 class="box-title">
                            <a class="btn btn-success" href="order_master_pdf.php?id=<?php echo $order_id; ?>">Download Invoice</a>
                        </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th class="product-thumbnail">Product Name</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Quantity</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-price">Total Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select distinct(order_details.id), order_details.*, products.name, products.image, products.price, orders.address, orders.city, orders.zip, orders.order_status from order_details, products, orders where order_details.order_id = '$order_id' and order_details.product_id = products.id and orders.id = '$order_id'";
                                    $result = mysqli_query($con, $sql);

                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $total_price += round($row['quantity'] * $row['price']);
                                        $address = $row['address'];
                                        $city = $row['city'];
                                        $zip = $row['zip'];
                                        $order_status = $row['order_status'];
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a href="#"><?php echo $row['name']; ?></a></td>
                                            <td class="product-name"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt=""></td>
                                            <td class="product-name"><?php echo $row['quantity']; ?></td>
                                            <td class="product-name"><?php echo round($row['price']); ?></td>
                                            <td class="product-price">
                                                <?php echo round($row['quantity'] * $row['price']); ?>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="product-name">Total Price with( 9% ) Tax</td>
                                        <td class="product-name"><?php echo $total_price + round($total_price * $tax_percent) ?></td>
                                    </tr>
                                </tbody>
                            </table>
                            <div id="address_details">
                                <strong>Address</strong><br>
                                <?php echo $address; ?>, <?php echo $city; ?>, <?php echo $zip; ?><br><br>

                                <strong>Order Status</strong><br>
                                <?php
                                $row = mysqli_fetch_assoc(mysqli_query($con, "select name from order_status where id = '$order_status'"));
                                echo $row['name'];
                                ?>
                                <div style="margin-top: 20px; padding: 0px 20px">
                                    <form method="post">
                                        <select name="update_order_status" class="form-control" required>
                                            <option value="">Select Status</option>
                                            <?php
                                            $order_status_sql = "select * from order_status";
                                            $order_status_result = mysqli_query($con, $order_status_sql);
                                            while ($row = mysqli_fetch_assoc($order_status_result)) {
                                                if ($row['id'] == $order_status) {
                                                    echo '<option selected value=' . $row['id'] . '>' . $row['name'] . '</option>';
                                                } else {
                                                    echo '<option value=' . $row['id'] . '>' . $row['name'] . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                        <input type="submit" class="form-control btn btn-success" style="width: 150px; margin-top: 20px">
                                    </form>
                                </div>
                            </div>
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
