<?php
$PAGE_TITLE = "Login";
$dashboard_page = "dashboard.php";
//validate
$msg = "";
if (isset($_GET['err']) && !empty($_GET["err"])) {
    if (is_numeric($_GET['err'])) $msg = "Invalid Username or Password";
    else $msg = "Access is resitricted!";
}
?>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login</title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Login Register area Start-->
    <div class="login-content">
        <!-- Login -->
        <div class="nk-block toggled" id="l-login">
            <div class="nk-form">
                <h2><?php echo $PAGE_TITLE; ?></h2>
                <form action="auth.php" method="post" autocomplete="off">
                    <span class="text-danger"><?php echo $msg; ?></span>
                    <div class="input-group">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-support"></i></span>
                        <div class="nk-int-st">
                            <input type="text" class="form-control" placeholder="Username" name="txtusername" value="" required autofocus>
                        </div>
                    </div>
                    <div class="input-group mg-t-15">
                        <span class="input-group-addon nk-ic-st-pro"><i class="notika-icon notika-edit"></i></span>
                        <div class="nk-int-st">
                            <input type="password" class="form-control" placeholder="Password" name="txtpassword" required>
                        </div>
                    </div>
                    <!-- <div class="fm-checkbox">
                        <label><input type="checkbox" class="i-checks"> <i></i> Keep me signed in</label>
                    </div> -->
                    <button type="submit" name="submit_btn" class="btn btn-login btn-success btn-float"><i class="notika-icon notika-right-arrow right-arrow-ant"></i></button>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Register area End-->
    <?php include "_footer_scripts.php"; ?>
</body>

</html>