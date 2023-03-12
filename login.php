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
                            <span class="breadcrumb-item active">Login/Ragistration</span>
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
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Login</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="login-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="email" id="login_email" placeholder="Your Email*" style="width:100%">
                                </div>
                                <span class="field_error" id="login_email_error" style="color: red;"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="password" id="login_password" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="field_error" id="login_password_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="user_login()" class="fv-btn">Login</button>
                            </div>

                            <!-- Forget password -->
                            <div class="contact-btn">
                                <div class="ft__inner">
                                    <ul class="ft__list">
                                        <li><a href="forgot_password.php">Forgot Password</a></li>
                                    </ul>
                                </div>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege login_msg"></p>
                        </div>
                    </div>
                </div>

            </div>


            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">Register</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="register-form" method="post">
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="name" id="name" placeholder="Your Name*" style="width:100%">
                                </div>
                                <span class="field_error" id="name_error" style="color: red;"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="email" name="email" id="email" placeholder="Your Email*" style="width:66%">

                                    <button style="height: 60px;" type="button" onclick="email_sent_otp()" class="fv-btn email_sent_otp">Send OTP</button>

                                    <input type="text" name="email_otp" id="email_otp" placeholder="Your OTP" style="width:65%; display:none;" class="email_verify_otp">

                                    <button style="height: 60px; display:none;" type="button" onclick="email_verify_otp()" class="fv-btn email_verify_otp">Verify OTP</button>
                                </div>
                                <span class="field_error" id="email_otp_result" style="color: green;"></span>
                                <span class="field_error" id="email_error" style="color: red;"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="text" name="mobile" id="mobile" placeholder="Your Mobile*" style="width:66%">

                                    <!-- <button style="height: 60px;" type="button" onclick="mobile_sent_otp()" class="fv-btn mobile_sent_otp">Send OTP</button> -->

                                    <!-- <input type="text" name="mobile_otp" id="mobile_otp" placeholder="Your OTP" style="width:65%; display:none;" class="mobile_verify_otp">

                                    <button style="height: 60px; display:none;" type="button" onclick="mobile_verify_otp()" class="fv-btn mobile_verify_otp">Verify OTP</button> -->
                                </div>
                                <span class="field_error" id="mobile_otp_result" style="color: green;"></span>
                                <span class="field_error" id="mobile_error" style="color: red;"></span>
                            </div>
                            <div class="single-contact-form">
                                <div class="contact-box name">
                                    <input type="password" name="password" id="password" placeholder="Your Password*" style="width:100%">
                                </div>
                                <span class="field_error" id="password_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="user_registration()" class="fv-btn registration">Register</button>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege register_msg"></p>
                        </div>
                    </div>
                </div>

            </div>

        </div>
</section>
<!-- End Contact Area -->

<script>
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
                        document.querySelector('#register-form').reset();
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
                        window.location.href = 'index.php';
                    }
                }
            });
        }
    }

    // OTP send to mail 
    function email_sent_otp() {
        jQuery('.registration').attr("disabled", true);
        let email = jQuery('#email').val();
        if (email == '') {
            jQuery('#email_error').html('Email Required');
        } else {
            jQuery('.email_sent_otp').html("Sending..");
            jQuery('.email_sent_otp').attr("disabled", true);

            jQuery.ajax({
                url: 'send_otp.php',
                type: 'post',
                data: 'email=' + email + '&type=email',
                success: function(result) {
                    if (result == "done") {
                        jQuery('#email_error').html('');
                        jQuery('#email').hide();
                        jQuery('.email_verify_otp').show();
                        jQuery('.email_sent_otp').hide();
                    } else {
                        jQuery('#email_error').html('Please try after some time');
                    }
                }
            });
        }
    }

    // OTP varification by mail
    function email_verify_otp() {
        let email_otp = jQuery('#email_otp').val();
        if (email_otp == '') {
            jQuery('#email_error').html('Enter OTP');
        } else {
            jQuery.ajax({
                url: 'check_otp.php',
                type: 'post',
                data: 'otp=' + email_otp + '&type=email',
                success: function(result) {
                    if (result == "done") {
                        jQuery('#email_error').html('');
                        jQuery('#email').show();
                        jQuery('#email').attr('disabled', true);
                        jQuery('#email').css('width', '100%');
                        jQuery('.email_verify_otp').hide();
                        jQuery('#email_otp_result').html('Email id Verified');

                        jQuery('.registration').attr("disabled", false);
                    } else {
                        jQuery('#email_error').html('Please enter VALID otp');
                    }
                }
            });
        }
    }

    // send OTP to mobile
    function mobile_sent_otp() {
        jQuery('.registration').attr("disabled", true);
        let mobile = jQuery('#mobile').val();
        if (mobile == '') {
            jQuery('#mobile_error').html('Mobile number Required');
        } else {
            jQuery('.mobile_sent_otp').html("Sending..");
            jQuery('.mobile_sent_otp').attr("disabled", true);

            jQuery.ajax({
                url: 'send_otp.php',
                type: 'post',
                data: 'mobile=' + mobile + '&type=mobile',
                success: function(result) {
                    if (result == "done") {
                        jQuery('#mobile_error').html('');
                        jQuery('#mobile').hide();
                        jQuery('.mobile_verify_otp').show();
                        jQuery('.mobile_sent_otp').hide();
                    } else {
                        jQuery('#mobile_error').html('Please try after some time');
                    }
                }
            });
        }
    }

    // OTP varification by mobile sms
    function mobile_verify_otp() {
        let mobile_otp = jQuery('#mobile_otp').val();
        if (mobile_otp == '') {
            jQuery('#mobile_error').html('Enter OTP');
        } else {
            jQuery.ajax({
                url: 'check_otp.php',
                type: 'post',
                data: 'otp=' + mobile_otp + '&type=mobile',
                success: function(result) {
                    if (result == "done") {
                        jQuery('#mobile_error').html('');
                        jQuery('#mobile').show();
                        jQuery('#mobile').attr('disabled', true);
                        jQuery('#mobile').css('width', '100%');
                        jQuery('.mobile_verify_otp').hide();
                        jQuery('#mobile_otp_result').html('Mobile number Verified');

                        jQuery('.registration').attr("disabled", false);
                    } else {
                        jQuery('#mobile_error').html('Please enter VALID otp');
                    }
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>
