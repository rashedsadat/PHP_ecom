<?php
require('top.php');

$product_id = mysqli_real_escape_string($con, $_GET['id']);

if ($product_id >=  0) {
    $result = get_product($con, '', '', '', $product_id);
} else {
?>
    <script>
        // redirect if found unnecessary utl
        window.location.href = 'index.php';
    </script>
<?php

}
// prx($result);
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
                            <a class="breadcrumb-item" href="categories.php?id=<?php echo $result[0]['categories_id'] ?>"><?php echo $result[0]['categories'] ?></a>
                            <span class="brd-separetor"><i class="zmdi zmdi-chevron-right"></i></span>
                            <span class="breadcrumb-item active"><?php echo $result[0]['name'] ?></span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Details Area -->
<section class="htc__product__details bg__white ptb--100">
    <!-- Start Product Details Top -->
    <div class="htc__product__details__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-5 col-sm-12 col-xs-12">
                    <div class="htc__product__details__tab__content">
                        <!-- Start Product Big Images -->
                        <div class="product__big__images">
                            <div class="portfolio-full-image tab-content">
                                <div role="tabpanel" class="tab-pane fade in active" id="img-tab-1">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $result[0]['image'] ?>" alt="full-image">
                                </div>
                            </div>
                        </div>
                        <!-- End Product Big Images -->

                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-sm-12 col-xs-12 smt-40 xmt-40">
                    <div class="ht__product__dtl">
                        <h2><?php echo $result[0]['name'] ?></h2>
                        <ul class="pro__prize">
                            <li class="old__prize">$<?php echo $result[0]['mrp'] ?></li>
                            <li>$<?php echo $result[0]['price'] ?></li>
                        </ul>
                        <p class="pro__info"><?php echo $result[0]['short_desc'] ?></p>
                        <div class="ht__pro__desc">
                            <div class="sin__desc">
                                <p><span>Availability:</span>
                                    <?php
                                    if ($result[0]['quantity'] > 0) {
                                        echo "In Stock";
                                    } else {
                                        echo "Out of Stock";
                                    }
                                    ?>
                                </p>
                            </div>
                            <div class="sin__desc">
                                <p style="display: flex; align-items:center; margin-top:20px;"><span>Quantity:</span>
                                    <select name="" id="quantity" style="height: 30px; width:60px; margin-left:10px;">
                                        <?php
                                        $quantity = $result[0]['quantity'];
                                        for ($i = 0; $i < $quantity; $i++) {
                                            echo '<option>' . ($i + 1) . '</option>';
                                        }
                                        ?>
                                    </select>
                                </p>
                            </div>
                            <div class="sin__desc align--left">
                                <p><span>Categories:</span></p>
                                <ul class="pro__cat__list">
                                    <li><a href="categories.php?id=<?php echo $result[0]['categories_id'] ?>"><?php echo $result[0]['categories'] ?></a></li>
                                </ul>
                            </div>
                            <div class="cr__btn" style="margin-top: 20px;">
                                <a href="javascript:void()" onclick="manage_cart('<?php echo $result[0]['id'] ?>', 'add')">Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- End Product Details Top -->
</section>
<!-- End Product Details Area -->
<!-- Start Product Description -->
<section class="htc__produc__decription bg__white">
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <!-- Start List And Grid View -->
                <ul class="pro__details__tab" role="tablist">
                    <li role="presentation" class="description active"><a href="#description" role="tab" data-toggle="tab">description</a></li>
                </ul>
                <!-- End List And Grid View -->
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="ht__pro__details__content">
                    <!-- Start Single Content -->
                    <div role="tabpanel" id="description" class="pro__single__content tab-pane fade in active">
                        <div class="pro__tab__content__inner">
                            <p><?php echo $result[0]['description'] ?></p>
                        </div>
                    </div>
                    <!-- End Single Content -->

                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Description -->

<script>
    function manage_cart(id, type) {
        let quantity = jQuery('#quantity').val();

        jQuery.ajax({
            url: 'manage_cart.php',
            type: 'post',
            data: 'id=' + id + '&quantity=' + quantity + '&type=' + type,
            success: function(result) {
                jQuery('.cart_count').html(result);
            }
        });

    }
</script>

<?php
require('footer.php');
?>
