<?php
require('top.inc.php');

$sql = "select * from users order by id desc";
$result = mysqli_query($con, $sql);
?>


<div class="content pb-0">
    <div class="orders">
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="box-title">Order Master </h4>
                    </div>
                    <div class="card-body--">
                        <div class="table-stats order-table ov-h">
                            <table class="table ">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Order Date</th>
                                        <th> Address </th>
                                        <th> Payment Type </th>
                                        <th>Payment Status</th>
                                        <th>Order Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "select orders.*, order_status.name as order_status_name from orders, order_status where order_status.id = orders.order_status";
                                    $result = mysqli_query($con, $sql);

                                    while ($row = mysqli_fetch_assoc($result)) {
                                    ?>
                                        <tr>
                                            <td class="product-add-to-cart"><a href="order_master_details.php?id=<?php echo $row['id']; ?>"><?php echo $row['id']; ?></a></td>
                                            <td><?php echo $row['added_on']; ?></td>
                                            <td>
                                                <?php echo $row['address']; ?><br>
                                                <?php echo $row['city']; ?><br>
                                                <?php echo $row['zip']; ?>
                                            </td>
                                            <td><?php echo $row['payment_type']; ?></td>
                                            <td><?php echo $row['payment_status']; ?></td>
                                            <td><?php echo $row['order_status_name']; ?></td>
                                        </tr>
                                    <?php } ?>
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
