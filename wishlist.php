<?php
require('top.php');

if (!isset($_SESSION['USER_LOGIN'])) {
?>
    <script>
        window.location.href = 'login.php';
    </script>
<?php
}
$user_id = $_SESSION['USER_ID'];
$sql = "select wishlist.*, products.image, products.name, products.mrp, products.price from wishlist, products where wishlist.user_id = '$user_id' and wishlist.product_id = products.id";
$result = mysqli_query($con, $sql);

// prx(mysqli_fetch_assoc($result));
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
                            <span class="breadcrumb-item active">Wishlist</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="cart-main-area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <form action="#">
                    <div class="table-content table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product-thumbnail">products</th>
                                    <th class="product-name">name of products</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                while ($row = mysqli_fetch_assoc($result)) {
                                    // $productArr = get_product($con, '', '', '', $key);
                                ?>
                                    <tr>
                                        <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $row['image'] ?>" alt="product img" /></a></td>
                                        <td class="product-name"><a href="#"><?php echo $row['name'] ?></a>
                                            <ul class="pro__prize">
                                                <li class="old__prize">$<?php echo $row['mrp']; ?></li>
                                                <li>$<?php echo $row['price'] ?></li>
                                            </ul>
                                        </td>
                                        <td class="product-remove"><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $row['id'] ?>', 'remove')"><i class="icon-trash icons"></i></a></td>
                                    </tr>
                                <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <div class="buttons-cart--inner">
                                <div class="buttons-cart">
                                    <a href="<?php echo SITE_PATH; ?>">Continue Shopping</a>
                                </div>
                                <div class="buttons-cart checkout--btn">
                                    <!-- <a href="#">update</a> -->
                                    <a href="<?php echo SITE_PATH; ?>checkout.php">checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- cart-main-area end -->


<script>
    function manage_cart(id, type) {
        let quantity = '';
        if (type == 'update') {
            quantity = jQuery('#' + id + 'quantity').val();
        } else if (type == 'remove') {
            quantity = 0;
        } else {
            quantity = jQuery('#quantity').val();
        }

        jQuery.ajax({
            url: 'manage_cart.php',
            type: 'post',
            data: 'id=' + id + '&quantity=' + quantity + '&type=' + type,
            success: function(result) {
                if (type == 'update' || type == 'remove') {
                    window.location.href = 'cart.php';
                }
                jQuery('.cart_count').html(result);
            }
        });

    }
</script>

<?php
require('footer.php');
?>
