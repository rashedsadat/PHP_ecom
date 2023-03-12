<?php
require('top.php');

if (isset($_SESSION['USER_LOGIN']) && ($_SESSION['USER_LOGIN'] == 'yes')) {
?>
    <script>
        window.location.href = 'index.php';
    </script>
<?php

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
                            <span class="breadcrumb-item active">forgot password</span>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Bradcaump area -->
<!-- Start Contact Area -->
<section class="htc__contact__area ptb--100 bg__white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">forgot password</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="login-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="email" id="forgot_email" placeholder="Your Email*" style="width:100%">
                                </div>
                                <span class="field_error" id="forgot_email_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="forgot_password()" class="fv-btn forgot_btn">submit</button>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege login_msg"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<!-- End Contact Area -->

<script>
    // forget password
    function forgot_password() {

        let email = jQuery('#forgot_email').val();
        if (email == '') {
            jQuery('#forgot_email_error').html('Email Required');
        } else {
            jQuery('.forgot_btn').html("submitting..");
            jQuery('.forgot_btn').attr("disabled", true);
            jQuery.ajax({
                url: "forgot_password_submit.php",
                type: "post",
                data: "email=" + email + "&type=email",
                success: function(result) {
                    if (result == "done") {
                        window.location.href = "login.php";
                    } else {
                        jQuery('#forgot_email_error').html('You are not a registered user');
                        jQuery('.forgot_btn').attr("disabled", false);
                        jQuery('.forgot_btn').html("submit");
                    }
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>
