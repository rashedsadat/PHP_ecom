<?php
require('top.php');

$cart_total = 0;
$total_tax = 0;
$tax_percent = 0.09;

foreach ($_SESSION['CART'] as $key => $value) {
    $productArr = get_product($con, '', '', '', $key);

    $price = $productArr[0]['price'];
    $quantity = $value['QTY'];

    $cart_total += ($price * $quantity);
    $total_tax += ($price * $quantity) * $tax_percent;
}

if (!isset($_SESSION['CART']) || empty($_SESSION['CART'])) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
    <?php
}

if (isset($_POST['submit'])) {
    // pr($_POST);
    $address = get_safe_value($con, $_POST['street_add']);
    $city = get_safe_value($con, $_POST['city']);
    $zip = get_safe_value($con, $_POST['zip']);
    $payment_type = get_safe_value($con, $_POST['payment_type']);
    $user_id = $_SESSION['USER_ID'];
    $total_price = round($cart_total + $total_tax);
    if ($payment_type == 'cod') {
        $payment_status = 'success';
    } else {
        $payment_status = 'pending';
    }
    $order_status = 1;
    $added_on = date('Y-m-d h:i:s');

    $order_sql = "insert into orders(user_id, address, city, zip, payment_type, total_price, payment_status, order_status, added_on) values('$user_id', '$address', '$city', '$zip', '$payment_type', '$total_price', '$payment_status', '$order_status', '$added_on')";

    $result = mysqli_query($con, $order_sql);

    if ($result) {
        $order_id = mysqli_insert_id($con);

        foreach ($_SESSION['CART'] as $key => $value) {
            $productArr = get_product($con, '', '', '', $key);

            $price = $productArr[0]['price'];
            $quantity = $value['QTY'];
            $order_price = round(($price * $quantity) + ($price * $quantity) * $tax_percent);

            $order_details_sql = "insert into order_details(order_id, product_id, quantity, price) values('$order_id', '$key', '$quantity', '$order_price')";

            $result = mysqli_query($con, $order_details_sql);
        }
        unset($_SESSION['CART']);
    ?>
        <script>
            window.location.href = 'thank_you.php';
        </script>
<?php
    }
}
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
                            <span class="breadcrumb-item active">checkout</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End Bradcaump area -->
<!-- cart-main-area start -->
<div class="checkout-wrap ptb--100">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="checkout__inner">
                    <div class="accordion-list">
                        <div class="accordion">
                            <?php
                            if (!isset($_SESSION['USER_LOGIN']) && empty($_SESSION['USER_ID']) && empty($_SESSION['USER_NAME'])) {
                            ?>
                                <div class="accordion__title">
                                    Checkout Method
                                </div>

                                <div class="accordion__body">
                                    <div class="accordion__body__form">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form action="#">
                                                        <h5 class="checkout-method__title">Login</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email" id="login_email" style="width:100%">
                                                            <span class="field_error" id="login_email_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="password" id="login_password" style="width:100%">
                                                            <span class="field_error" id="login_password_error" style="color: red;"></span>
                                                        </div>
                                                        <p class="require">* Required fields</p>
                                                        <div class="dark-btn">
                                                            <a type="button" href="javascript:void()" onclick="user_login()">LogIn</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="checkout-method__login">
                                                    <form id="checkout_form">
                                                        <h5 class="checkout-method__title">Register</h5>
                                                        <div class="single-input">
                                                            <label for="user-email">Name</label>
                                                            <input type="text" name="name" id="name" style="width:100%">
                                                            <span class="field_error" id="name_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="single-input">
                                                            <label for="user-email">Email Address</label>
                                                            <input type="email" name="email" id="email" style="width:100%">
                                                            <span class="field_error" id="email_error" style="color: red;"></span>
                                                        </div>

                                                        <div class="single-input">
                                                            <label for="user-email">Mobile Number</label>
                                                            <input type="text" name="mobile" id="mobile" style="width:100%">
                                                            <span class="field_error" id="mobile_error" style="color: red;"></span>
                                                        </div>

                                                        <div class="single-input">
                                                            <label for="user-pass">Password</label>
                                                            <input type="password" name="password" id="password" style="width:100%">
                                                            <span class="field_error" id="password_error" style="color: red;"></span>
                                                        </div>
                                                        <div class="dark-btn">
                                                            <a href="javascript:void()" type="button" onclick="user_registration()">Register</a>
                                                        </div>
                                                    </form>
                                                    <div class="form-output">
                                                        <p class="form-messege register_msg"></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            } else {
                            ?>
                                <form method="post">
                                    <div class="accordion__title">
                                        Address Information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="bilinfo">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="single-input">
                                                        <input type="text" name="street_add" id="street_add" placeholder="Street Address" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="city" id="city" placeholder="City/State" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="single-input">
                                                        <input type="text" name="zip" id="zip" placeholder="Post code/ zip" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="accordion__title">
                                        payment information
                                    </div>
                                    <div class="accordion__body">
                                        <div class="paymentinfo">
                                            <div class="single-method">
                                                <input type="radio" name="payment_type" id="cod" value="cod" required>
                                                <label for="cod">COD</label>
                                                &nbsp;&nbsp;<input type="radio" name="payment_type" id="payu" value="payu" required>
                                                <label for="payu">PayU</label>
                                            </div>
                                            <div class="single-method">
                                                <input type="submit" name="submit">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="order-details">
                    <h5 class="order-details__title">Your Order</h5>
                    <div class="order-details__item">
                        <?php
                        $cart_total = 0;
                        $total_tax = 0;
                        $tax_percent = 0.09;
                        foreach ($_SESSION['CART'] as $key => $value) {
                            $productArr = get_product($con, '', '', '', $key);

                            $name = $productArr[0]['name'];
                            $mrp = $productArr[0]['mrp'];
                            $price = $productArr[0]['price'];
                            $image = $productArr[0]['image'];
                            $quantity = $value['QTY'];

                            $cart_total += ($price * $quantity);
                            $total_tax += ($price * $quantity) * $tax_percent;
                        ?>
                            <div class="single-item">
                                <div class="single-item__thumb">
                                    <img src="<?php echo PRODUCT_IMAGE_SITE_PATH . $image ?>" alt="ordered item">
                                </div>
                                <div class="single-item__content">
                                    <a href="#"><?php echo $name; ?></a>
                                    <span class="price">$<?php echo $price * $quantity; ?></span>
                                </div>
                                <div class="single-item__remove">
                                    <a href="javascript:void(0)" onclick="manage_cart('<?php echo $key ?>', 'remove')"><i class="zmdi zmdi-delete"></i></a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="order-details__count">
                        <div class="order-details__count__single">
                            <h5>sub total</h5>
                            <span class="price">$<?php echo $cart_total; ?></span>
                        </div>
                        <div class="order-details__count__single">
                            <h5>Tax</h5>
                            <span class="price">$<?php echo round($total_tax); ?> (<?php echo $tax_percent * 100; ?>%)</span>
                        </div>
                    </div>
                    <div class="ordre-details__total">
                        <h5>Order total</h5>
                        <span class="price">$<?php echo round($cart_total + $total_tax); ?></span>
                    </div>
                </div>
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
                    // this reload within the page
                    window.location.href = window.location.href;
                }
                jQuery('.cart_count').html(result);
            }
        });

    }

    function user_registration() {
        jQuery('.field_error').html('');

        let name = jQuery('#name').val();
        let email = jQuery('#email').val();
        let mobile = jQuery('#mobile').val();
        let password = jQuery('#password').val();

        let is_error = "";

        if (name == '') {
            jQuery('#name_error').html('Name Required');
            is_error = 'Error';
        }
        if (email == '') {
            jQuery('#email_error').html('Email Required');
            is_error = 'Error';
        }
        if (mobile == '') {
            jQuery('#mobile_error').html('Mobile Required');
            is_error = 'Error';
        }
        if (password == '') {
            jQuery('#password_error').html('Password Required');
            is_error = 'Error';
        }
        if (is_error == '') {
            jQuery.ajax({
                url: 'register_submit.php',
                type: 'post',
                data: 'name=' + name + '&email=' + email + '&mobile=' + mobile + '&password=' + password,
                success: function(result) {
                    if (result == 'exist') {
                        jQuery('#email_error').html('Try with another email!');
                    }
                    if (result == 'insert') {
                        jQuery('.register_msg').html('Registration Complete!');
                        document.querySelector('#checkout_form').reset();
                        return false;
                    }
                }
            });
        }

    }

    function user_login() {
        jQuery('.field_error').html('');

        let email = jQuery('#login_email').val();
        let password = jQuery('#login_password').val();

        let is_error = "";

        if (email == '') {
            jQuery('#login_email_error').html('Email Required');
            is_error = 'Error';
        }
        if (password == '') {
            jQuery('#login_password_error').html('Password Required');
            is_error = 'Error';
        }
        if (is_error == '') {
            jQuery.ajax({
                url: 'login_submit.php',
                type: 'post',
                data: 'email=' + email + '&password=' + password,
                success: function(result) {
                    if (result == 'error') {
                        jQuery('.login_msg').html('Enter Valid Information!');
                    }
                    if (result == 'success') {
                        window.location.href = 'checkout.php';
                    }
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>
