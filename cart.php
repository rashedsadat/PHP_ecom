<?php
require('top.php');
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
                            <span class="breadcrumb-item active">shopping cart</span>
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
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                    <th class="product-remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_SESSION['CART'])) {
                                    foreach ($_SESSION['CART'] as $key => $value) {
                                        $productArr = get_product($con, '', '', '', $key);

                                        $name = $productArr[0]['name'];
                                        $mrp = $productArr[0]['mrp'];
                                        $price = $productArr[0]['price'];
                                        $image = $productArr[0]['image'];
                                        $quantity = $value['QTY'];
                                ?>
                                        <tr>
                                            <td class="product-thumbnail"><a href="#"><img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="product img" /></a></td>
                                            <td class="product-name"><a href="#"><?php echo $name ?></a>
                                                <ul class="pro__prize">
                                                    <li class="old__prize">$<?php echo $mrp ?></li>
                                                    <li>$<?php echo $price ?></li>
                                                </ul>
                                            </td>
                                            <td class="product-price"><span class="amount">£<?php echo $price ?></span></td>
                                            <td class="product-quantity"><input type="number" id="<?php echo $key ?>quantity" value="<?php echo $quantity ?>" /><br>
                                                <div class="buttons-cart checkout--btn" style="margin-top: 10px;">
                                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>', 'update')">update</a>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">£<?php echo $quantity * $price ?></td>
                                            <td class="product-remove"><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>', 'remove')"><i class="icon-trash icons"></i></a></td>
                                        </tr>
                                <?php
                                    }
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
