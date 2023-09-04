<?php
include "./inc/cu.common.php";

if (!$cust_logged || !is_numeric($sess_cust_id)) {
    ForceOutCu(3);
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    site_seo();
    include "_header_links.php";
    ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "_header.php"; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Easy Grocery</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Password reset</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h4>Your Password updated successfully!</h4>
                    </div>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <a href="login.php" class="site-btn">LOGIN</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Form End -->

    <?php include "_footer.php"; ?>
</body>

</html>