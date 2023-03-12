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
$sql = "select * from users where id = '$user_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$_SESSION['USER_NAME'] = $row['name'];

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
                            <span class="breadcrumb-item active"><?php echo $row['name'] ?></span>
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
            <!-- update profile -->
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">profile</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="update_user_form" method="post">
                            <div class="single-contact-form">
                                <label for="name">Name</label>
                                <div class="contact-box name">
                                    <input type="text" name="name" value="<?php echo $row['name'] ?>" id="name" placeholder="Your Name*" style="width:100%">
                                </div>
                                <span class="field_error" id="name_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="update_profile()" class="fv-btn update_btn">update</button>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege login_msg" id="success"></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- change password -->
            <div class="col-md-6">
                <div class="contact-form-wrap mt--60">
                    <div class="col-xs-12">
                        <div class="contact-title">
                            <h2 class="title__line--6">change password</h2>
                        </div>
                    </div>
                    <div class="col-xs-12">
                        <form id="change_password_form" method="post">
                            <div class="single-contact-form">
                                <label for="current_password">Current Password</label>
                                <div class="contact-box name">
                                    <input type="password" name="current_password" id="current_password" placeholder="Current password*" style="width:100%">
                                </div>
                                <span class="field_error" id="current_password_error" style="color: red;"></span>
                            </div>

                            <div class="single-contact-form">
                                <label for="new_password">New Password</label>
                                <div class="contact-box name">
                                    <input type="password" name="new_password" id="new_password" placeholder="New password*" style="width:100%">
                                </div>
                                <span class="field_error" id="new_password_error" style="color: red;"></span>
                            </div>

                            <div class="single-contact-form">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <div class="contact-box name">
                                    <input type="password" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm new password*" style="width:100%">
                                </div>
                                <span class="field_error" id="confirm_new_password_error" style="color: red;"></span>
                            </div>

                            <div class="contact-btn">
                                <button type="button" onclick="update_password()" class="fv-btn change_btn">change password</button>
                            </div>
                        </form>
                        <div class="form-output">
                            <p class="form-messege login_msg" id="password_change"></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</section>
<!-- End Contact Area -->

<script>
    // update profile 
    function update_profile() {

        let name = jQuery('#name').val();
        if (name == '') {
            jQuery('#name_error').html('Email Required');
        } else {
            jQuery('.update_btn').html("updating..");
            jQuery('.update_btn').attr("disabled", true);
            jQuery.ajax({
                url: "update_profile.php",
                type: "post",
                data: "name=" + name + "&type=update",
                success: function(result) {
                    if (result == "done") {
                        jQuery('#success').html("Profile update successfully!");
                        jQuery('.update_btn').attr("disabled", false);
                        jQuery('.update_btn').html("update");
                        window.location.href = "profile.php";
                    } else {
                        jQuery('#success').html('You are not a registered user');
                        jQuery('.update_btn').attr("disabled", false);
                        jQuery('.update_btn').html("update");
                    }
                }
            });
        }
    }

    // change password 
    function update_password() {
        jQuery('.field_error').html('');

        let current_password = jQuery('#current_password').val();
        let new_password = jQuery('#new_password').val();
        let confirm_new_password = jQuery('#confirm_new_password').val();

        let change_error = '';
        if (current_password == '') {
            jQuery('#current_password_error').html('Current password required!');
            change_error = "error";
        }
        if (new_password == '') {
            jQuery('#new_password_error').html('New password required!');
            change_error = "error";
        }
        if (confirm_new_password == '') {
            jQuery('#confirm_new_password_error').html('Confirm new password required!');
            change_error = "error";
        }
        if (new_password != '' && confirm_new_password != '' && new_password != confirm_new_password) {
            jQuery('#confirm_new_password_error').html('Password not matched!');
            change_error = "error";
        }

        if (change_error == '') {
            jQuery('.change_btn').html("updating..");
            jQuery('.change_btn').attr("disabled", true);
            jQuery.ajax({
                url: "update_profile.php",
                type: "post",
                data: "current_password=" + current_password + "&new_password=" + new_password + "&confirm_new_password=" + confirm_new_password + "&type=change_password",
                success: function(result) {
                    if (result == "done") {
                        jQuery('#password_change').html("Password change successfully!");
                        jQuery('.change_btn').attr("disabled", false);
                        jQuery('.change_btn').html("change password");
                        jQuery('#change_password_form')[0].reset();
                        // window.location.href = "profile.php";
                    } else {
                        jQuery('#password_change').html(result);
                        jQuery('.change_btn').attr("disabled", false);
                        jQuery('.change_btn').html("change password");
                    }
                }
            });
        }
    }
</script>

<?php
require('footer.php');
?>
