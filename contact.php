<?php
include "./inc/cu.common.php";
?>
<!DOCTYPE html>
<html lang="zxx">

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
                        <h2>Contact Us</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <span>Contact Us</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-8 text-center">
                    <div class="contact__widget">
                        <span class="icon_phone"></span>
                        <h4>Phone</h4>
                        <p><?php echo SHOP_PHONE; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 text-center">
                    <div class="contact__widget">
                        <span class="icon_pin_alt"></span>
                        <h4>Address</h4>
                        <p><?php echo SHOP_ADR; ?></p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-8 text-center">
                    <div class="contact__widget">
                        <span class="icon_mail_alt"></span>
                        <h4>Email</h4>
                        <p><?php echo SITE_EMAIL; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Section End -->

    <!-- Map Begin -->
    <div class="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d49116.39176087041!2d-86.41867791216099!3d39.69977417971648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x886ca48c841038a1%3A0x70cfba96bf847f0!2sPlainfield%2C%20IN%2C%20USA!5e0!3m2!1sen!2sbd!4v1586106673811!5m2!1sen!2sbd" height="500" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
        <div class="map-inside">
            <i class="icon_pin"></i>
            <div class="inside-widget">
                <h4>EasyGrocery Shop</h4>
                <ul>
                    <li>Phone: <?php echo SHOP_PHONE; ?></li>
                    <li>Add: <?php echo SHOP_ADR; ?></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Map End -->

    <!-- Contact Form Begin -->
    <div class="contact-form spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="contact__form__title">
                        <h2>Leave Message</h2>
                    </div>
                </div>
            </div>
            <form action="feedback.php" method="post" autocomplete="off" id="feedback_form">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <input type="text" id="f_name" name="f_name" placeholder="Your name" required>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <input type="email" id="f_email" name="f_email" placeholder="Email" required>
                    </div>
                    <div class="col-lg-12 text-center">
                        <textarea placeholder="How can we help you?" id="f_message" name="f_message"></textarea>
                        <button type="submit" class="site-btn">SEND MESSAGE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Contact Form End -->
    <?php include "_footer.php"; ?>
</body>

</html>