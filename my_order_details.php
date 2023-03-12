<?php
require('top.php');

$order_id = get_safe_value($con, $_GET['id']);
?>


<!-- Start Bradcaump area -->
<div class="ht__bradcaump__area" style="background: rgba(0, 0, 0, 0) url(https://png.pngtree.com/background/20210711/original/pngtree-high-tech-background-picture-image_1133072.jpg) no-repeat scroll center center / cover ;">
    <div class="ht__bradcaump__wrap">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <div class="bradcaump__inner">
                        <nav class="bradcaump-inner">
                            <a class="breadcrumb-item" href="index.php">Home</a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active">Order details</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- wishlist-area start -->
<div class="wishlist-area ptb--100 bg__white">
    <div class="container">
        <div class="cr__btn" style="margin-bottom: 20px;">
            <a href="order_pdf.php?id=<?php echo $order_id; ?>">Download Invoice</a>
        </div>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="wishlist-content">

                    <form action="#">

                        <div class="wishlist-table table-responsive">
                            <table>
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
                                    $user_id = $_SESSION['USER_ID'];

                                    $sql = "select distinct(order_details.id), order_details.*, products.name, products.image, products.price from order_details, products, orders where order_details.order_id = '$order_id' and orders.user_id = '$user_id' and products.id = order_details.product_id";
                                    $result = mysqli_query($con, $sql);

                                    $total_price = 0;
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $total_price += round($row['quantity'] * $row['price']);
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- wishlist-area end -->


<?php
require('footer.php');
?>
