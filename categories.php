<?php
require('top.php');

$cat_id = mysqli_real_escape_string($con, $_GET['id']);
$sub_id = '';
if (isset($_GET['sub'])) {
    $sub_id = mysqli_real_escape_string($con, $_GET['sub']);
}

$sort_order = '';
$high_price_selected = '';
$low_price_selected = '';
$new_selected = '';
$old_selected = '';

// filtering category data
if (isset($_GET['sort'])) {
    $sort = mysqli_real_escape_string($con, $_GET['sort']);
    if ($sort == "price_high") {
        $sort_order = " order by products.price desc ";
        $high_price_selected = "selected";
    } elseif ($sort == "price_low") {
        $sort_order = " order by products.price asc ";
        $low_price_selected = "selected";
    } elseif ($sort == "new") {
        $sort_order = " order by products.id desc ";
        $new_selected = "selected";
    } elseif ($sort == "old") {
        $sort_order = " order by products.id asc ";
        $old_selected = "selected";
    }
}

if ($cat_id >=  0) {
    $result = get_product($con, '', '', $cat_id, '', '', $sort_order, '', $sub_id);
} else {
?>
    <script>
        // redirect if found unnecessary url
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
                            <span class="breadcrumb-item active">
                                <?php
                                if (count($result) > 0) {
                                    echo $result[0]['categories'];
                                } else {
                                    echo '';
                                }
                                ?>
                            </span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Product Grid -->
<section class="htc__product__grid bg__white ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="htc__product__rightidebar">
                    <div class="htc__grid__top">
                        <div class="htc__select__option">
                            <select class="ht__select" onchange="sort_product_dropo('<?php echo $cat_id; ?>', '<?php echo SITE_PATH; ?>')" id="sort_product_id">
                                <option>Default softing</option>
                                <option value="price_high" <?php echo $high_price_selected; ?>>Sort by high price</option>
                                <option value="price_low" <?php echo $low_price_selected; ?>>Sort by low price</option>
                                <option value="new" <?php echo $new_selected; ?>>Sort by new</option>
                                <option value="old" <?php echo $old_selected; ?>>Sort by old</option>
                            </select>
                        </div>
                    </div>
                    <!-- Start Product View -->
                    <div class="row">
                        <div class="shop__grid__view__wrap">
                            <div role="tabpanel" id="grid-view" class="single-grid-view tab-pane fade in active clearfix">
                                <?php

                                // prx($result);
                                if (count($result) > 0) {
                                    foreach ($result as $list) {

                                ?>
                                        <!-- Start Single Category -->
                                        <div class="col-md-4 col-lg-3 col-sm-4 col-xs-12">
                                            <div class="category">
                                                <div class="ht__cat__thumb">
                                                    <a href="product_details.php?id=<?php echo $list['id'] ?>">
                                                        <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $list['image']; ?>" alt="product images">
                                                    </a>
                                                </div>
                                                <div class="fr__hover__info">
                                                    <ul class="product__action">
                                                        <li><a href="javascript:void(0)" onclick="manage_wishlist('<?php echo $list['id']; ?>', 'add')"><i class="icon-heart icons"></i></a></li>

                                                        <li><a href="javascript:void(0)" onclick="manage_cart('<?php echo $list['id']; ?>', 'add')"><i class="icon-handbag icons"></i></a></li>
                                                    </ul>
                                                </div>
                                                <div class="fr__product__inner">
                                                    <h4><a href="product_details.php?id=<?php echo $list['id'] ?>"><?php echo $list['name'] ?></a></h4>
                                                    <ul class="fr__pro__prize">
                                                        <li class="old__prize">$<?php echo $list['mrp'] ?></li>
                                                        <li>$<?php echo $list['price'] ?></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End Single Category -->
                                <?php
                                    }
                                } else {
                                    echo "<h1 class='text-center' style='margin-top:100px;'>Data Not Found</h1>";
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- End Product View -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Product Grid -->

<script>
    function sort_product_dropo(cat_id, site_path) {
        let sort_product_id = jQuery('#sort_product_id').val();
        window.location.href = site_path + "categories.php?id=" + cat_id + "&sort=" + sort_product_id;
    }

    function manage_cart(id, type) {
        let quantity = jQuery('#quantity').val();
        console.log(quantity);
        if (quantity == undefined) {
            quantity = 1;
        }
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
