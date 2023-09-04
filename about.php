<?php
include "inc/cu.common.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php
  site_seo();
  include '_header_links.php';
  ?>


</head>

<body>
  <!-- Page Preloder -->
  <div id="preloder">
    <div class="loader"></div>
  </div>
  <?php include '_header.php'; ?>

  <!-- Breadcrumb Section Begin -->
  <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb1.jpg">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="breadcrumb__text">
            <h2>About Us</h2>
            <div class="breadcrumb__option">
              <a href="./index.php">Home</a>
              <span>About Us</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Breadcrumb Section End -->

  <!-- About section Begin-->

  <section class="about_section layout_padding">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6 px-0">
          <div class="img-box">
            <img src="img/about-img.jpg" alt="">
          </div>
        </div>
        <div class="col-md-6 px-5">
          <div class="detail-box">
            <div class="heading_container text-center">
              <h2>About Our Grocery Shop</h2>
            </div>
            <p>Welcome to EasyGrocery, your one-stop destination for all your grocery shopping needs.
              We are delighted to bring you a convenient and hassle-free online grocery shopping experience right
              at your fingertips.<br>At EasyGrocery, we understand the value of your time and strive to make your
              shopping journey effortless and enjoyable. With just a few clicks, you can browse through our vast
              selection of high-quality products, sourced from trusted suppliers and renowned brands. Whether you're
              looking for fresh produce, pantry essentials, household items, or specialty ingredients, we've got
              you covered.<br>In our pursuit of sustainability, we actively promote eco-friendly practices. We strive
              to minimize waste, encourage responsible packaging, and support local producers whenever possible.
              Together, we can make a positive impact on our environment and create a better future.<br>We value your
              feedback and continuously strive to enhance our services. We are constantly updating our product range
              and features to meet your evolving needs. Your satisfaction is our ultimate goal.</p>
            <a href="javascript:void();" class="readmore-btn">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- About section end -->
  <!--footer section -->
  <?php include '_footer.php'; ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
  <script>
    $(".readmore-btn").on('click', function() {
      $(this).parent().toggleClass("showContent");

      var replaceText = $(this).parent().hasClass("showContent") ? "Read Less" : "Read More";
      $(this).text(replaceText);
    });
  </script>
</body>

</html>