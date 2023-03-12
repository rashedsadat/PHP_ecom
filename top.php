<?php
require('connection.inc.php');
require('functions.inc.php');
require('constant.inc.php');

$cat_resource = mysqli_query($con, "select * from categories where status = 1 order by categories asc");

$category_arr = array();

while ($row = mysqli_fetch_assoc($cat_resource)) {
    $category_arr[] = $row;
}
?>


<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecom Website</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.ico">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">


    <!-- All css files are included here. -->
    <!-- Bootstrap fremwork main css -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <!-- Owl Carousel min css -->
    <link rel="stylesheet" href="./css/owl.carousel.min.css">
    <link rel="stylesheet" href="./css/owl.theme.default.min.css">
    <!-- This core.css file contents all plugings css file. -->
    <link rel="stylesheet" href="./css/core.css">
    <!-- Theme shortcodes/elements style -->
    <link rel="stylesheet" href="./css/shortcode/shortcodes.css">
    <!-- Theme main style -->
    <link rel="stylesheet" href="style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="./css/responsive.css">
    <!-- User style -->
    <link rel="stylesheet" href="css/custom.css">


    <!-- Modernizr JS -->
    <script src="./js/vendor/modernizr-3.5.0.min.js"></script>
</head>

<body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->

    <!-- Body main wrapper start -->
    <div class="wrapper">
        <!-- Start Header Style -->
        <header id="htc__header" class="htc__header__area header--one">
            <!-- Start Mainmenu Area -->
            <div id="sticky-header-with-topbar" class="mainmenu__wrap sticky__header">
                <div class="container">
                    <div class="row">
                        <div class="menumenu__container clearfix">
                            <div class="col-lg-2 col-md-2 col-sm-3 col-xs-5">
                                <div class="logo">
                                    <a href="index.html"><img src="images/logo/4.png" alt="logo images"></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-5 col-xs-3">
                                <nav class="main__menu__nav hidden-xs hidden-sm">
                                    <ul class="main__menu">
                                        <li class="drop"><a href="index.php">Home</a></li>
                                        <?php
                                        foreach ($category_arr as $list) {
                                        ?>
                                            <li class="drop">
                                                <a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>

                                                <?php
                                                $category_id = $list['id'];
                                                $sub_categories_result = mysqli_query($con, "select * from sub_categories where category_id = '$category_id' and status = 1");
                                                ?>
                                                <ul class="dropdown">
                                                    <?php
                                                    while ($sub_row = mysqli_fetch_assoc($sub_categories_result)) {
                                                        // prx($row);
                                                    ?>
                                                        <li><a href="categories.php?id=<?php echo $list['id'] ?>&sub=<?php echo $sub_row['id'] ?>"><?php echo $sub_row['sub_categories']; ?></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                        <li><a href="contact.php">contact</a></li>
                                    </ul>
                                </nav>

                                <div class="mobile-menu clearfix visible-xs visible-sm">
                                    <nav id="mobile_dropdown">
                                        <ul>
                                            <li><a href="index.php">Home</a></li>
                                            <?php
                                            foreach ($category_arr as $list) {
                                            ?>
                                                <li>
                                                    <a href="categories.php?id=<?php echo $list['id'] ?>"><?php echo $list['categories'] ?></a>
                                                    <ul class="dropdown">
                                                        <?php
                                                        while ($sub_row = mysqli_fetch_assoc($sub_categories_result)) {
                                                            // prx($row);
                                                        ?>
                                                            <li><a href="categories.php?id=<?php echo $list['id'] ?>&sub=<?php echo $sub_row['id'] ?>"><?php echo $sub_row['sub_categories']; ?></a></li>
                                                        <?php
                                                        }
                                                        ?>
                                                    </ul>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                            <li><a href="contact.php">contact</a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                            <div class="col-md-4 col-lg-4 col-sm-4 col-xs-4">
                                <div class="header__right">
                                    <div class="header__search search search__open">
                                        <a href="#"><i class="icon-magnifier icons"></i></a>
                                    </div>
                                    <div class="header__account">
                                        <?php
                                        // check if user logged in or not
                                        if (isset($_SESSION['USER_LOGIN'])) {
                                        ?>
                                            <div class='dropdown'>
                                                <button style='background: transparent; margin:0; padding:0; font-size:20px;margin-right:20px;' class='btn btn-secondary dropdown-toggle' type='button' data-toggle='dropdown' aria-expanded='true'>
                                                    <?php
                                                    $user_name = explode(" ", $_SESSION['USER_NAME']);
                                                    echo $user_name[0];
                                                    ?>
                                                </button>
                                                <div class='dropdown-menu'>
                                                    <a href='my_order.php'>My Order</a><br>
                                                    <a href='profile.php'>Profile</a><br>
                                                    <a href='logout.php'>Logout</a><br>
                                                </div>
                                            </div>
                                        <?php
                                        } else {
                                            echo '<a href="login.php">Login/Register</a>';
                                        }
                                        ?>
                                    </div>
                                    <div class="htc__shopping__cart" style="margin-right: 20px;">
                                        <a class="cart__menu" href="cart.php"><i class="icon-handbag icons"></i></a>
                                        <a href="cart.php"><span class="htc__qua cart_count">
                                                <?php
                                                if (isset($_SESSION['CART'])) {
                                                    echo count($_SESSION['CART']);
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                            </span></a>
                                    </div>
                                    <div class="htc__shopping__cart">
                                        <a class="cart__menu" href="wishlist.php"><i class="icon-heart icons"></i></a>
                                        <a href="wishlist.php"><span class="htc__qua">
                                                <?php
                                                if (isset($_SESSION['USER_LOGIN'])) {
                                                    $user_id = $_SESSION['USER_ID'];
                                                    $sql = "select * from wishlist where user_id = '$user_id'";
                                                    $count = mysqli_num_rows(mysqli_query($con, $sql));

                                                    if ($count > 0) {
                                                        echo $count;
                                                    } else {
                                                        echo '0';
                                                    }
                                                } else {
                                                    echo '0';
                                                }
                                                ?>
                                            </span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mobile-menu-area"></div>
                </div>
            </div>
            <!-- End Mainmenu Area -->
        </header>
        <!-- End Header Area -->
        <div class="body__overlay"></div>
        <!-- Start Offset Wrapper -->
        <div class="offset__wrapper">
            <!-- Start Search Popap -->
            <div class="search__area">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="search__inner">
                                <form action="search.php" method="get">
                                    <input placeholder="Search here... " type="text" name="str">
                                    <button type="submit"></button>
                                </form>
                                <div class="search__close__btn">
                                    <span class="search__close__btn_icon"><i class="zmdi zmdi-close"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Search Popap -->
            <!-- Start Cart Panel -->
            <!-- <div class="shopping__cart">
                <div class="shopping__cart__inner">
                    <div class="offsetmenu__close__btn">
                        <a href="#"><i class="zmdi zmdi-close"></i></a>
                    </div>
                    <div class="shp__cart__wrap">
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/1.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">BO&Play Wireless Speaker</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$105.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                        <div class="shp__single__product">
                            <div class="shp__pro__thumb">
                                <a href="#">
                                    <img src="images/product-2/sm-smg/2.jpg" alt="product images">
                                </a>
                            </div>
                            <div class="shp__pro__details">
                                <h2><a href="product-details.html">Brone Candle</a></h2>
                                <span class="quantity">QTY: 1</span>
                                <span class="shp__price">$25.00</span>
                            </div>
                            <div class="remove__btn">
                                <a href="#" title="Remove this item"><i class="zmdi zmdi-close"></i></a>
                            </div>
                        </div>
                    </div>
                    <ul class="shoping__total">
                        <li class="subtotal">Subtotal:</li>
                        <li class="total__price">$130.00</li>
                    </ul>
                    <ul class="shopping__btn">
                        <li><a href="cart.html">View Cart</a></li>
                        <li class="shp__checkout"><a href="checkout.html">Checkout</a></li>
                    </ul>
                </div>
            </div> -->
            <!-- End Cart Panel -->
        </div>
        <!-- End Offset Wrapper -->
