<?php
include "./inc/cu.common.php";
?>
<!DOCTYPE html>
<html lang="en">

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

    <!-- Hero Section Begin -->
    <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>All categories</span>
                        </div>
                        <ul>
                            <?php
                            $limit = 10;
                            $i = 1;
                            if (!empty($PROD_CATEGORY)) {
                                if ($i <= $limit) {
                                    foreach ($PROD_CATEGORY as $P_OBJ) {
                                        $c_url = "shop.php?cid=" . $P_OBJ->id;
                                        echo '<li><a href="' . $c_url . '">' . $P_OBJ->title . '</a></li>';
                                        $i++;
                                    }
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="hero__search">
                        <div class="hero__search__form">
                            <form action="search_product.php" method="get">
                                <input type="text" placeholder="What do yo u need?" id="search-box" name="search-box" required="required" value="<?php echo isset($_GET['search-box']) ? $_GET['search-box'] : '' ?>">
                                <button type="submit" class="site-btn" name="search" value="Search">SEARCH</button>
                            </form>
                        </div>
                        <div class="hero__search__phone">
                            <div class="hero__search__phone__icon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <div class="hero__search__phone__text">
                                <h5>+44 088 05673451</h5>
                                <span>support 24/7 time</span>
                            </div>
                        </div>
                    </div>
                    <div class="hero__item set-bg" data-setbg="img/hero/banner1.jpg">
                        <div class="hero__text">
                            <span>Better Products at the Right Price</span>
                            <h2>Online Grocery <br> Store & Delivery</h2>
                            <p>Free Pickup and Delivery Available</p>
                            <a href="shop.php" class="primary-btn">SHOP NOW</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    <?php
                    if (!empty($PROD_CATEGORY)) {
                        foreach ($PROD_CATEGORY as $P_OBJ) {
                            $c_url = "shop.php?cid=" . $P_OBJ->id;
                            $cat_img = (!empty($P_OBJ->image) && file_exists(CAT_IMG_UPLOAD . $P_OBJ->image)) ? CAT_IMG_PATH . $P_OBJ->image : BLANK_IMAGE;
                    ?>
                            <div class="col-lg-3">
                                <div class="categories__item set-bg" data-setbg="<?php echo $cat_img; ?>" style="background-image: url('<?php echo $cat_img; ?>');">
                                    <h5><a href="<?php echo $c_url; ?>"><?php echo $P_OBJ->title; ?></a></h5>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Banner Begin -->
    <section class="featured spad">
        <div class="section-title">
            <h2>Best Offers</h2>
        </div>
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="img/banner/banner-4.jpg" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="img/banner/banner-3.jpg" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Featured Product</h2>
                    </div>
                    <div class="featured__controls">
                        <ul>
                            <li class="active" data-filter="*">All</li>
                            <?php
                            if (!empty($PROD_CATEGORY)) {
                                foreach ($PROD_CATEGORY as $P_OBJ) {
                                    $urlname = GetUrlName($P_OBJ->title);
                                    echo '<li data-filter=".' . $urlname . '">' . $P_OBJ->title . '</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                <?php
                $PRODUCTS = getDataFromTable("product", "", " order by categoryId", "SELECT * FROM (SELECT *,ROW_NUMBER() OVER (PARTITION BY categoryId ORDER BY id) AS row_num FROM product) AS products_with_row_num WHERE row_num <= 8 ORDER BY categoryId, id");

                if (!empty($PRODUCTS)) {
                    foreach ($PRODUCTS as $PROD_OBJ) {
                        $prd_id = $PROD_OBJ->id;
                        $prod_url = "shop-details.php?id=" . $prd_id;
                        $cat_name = isset($PROD_CATEGORY_ARR[$PROD_OBJ->categoryId]) ? $PROD_CATEGORY_ARR[$PROD_OBJ->categoryId] : "";
                        $cat_urlname = GetUrlName($cat_name);
                        $prod_price = (!empty($PROD_OBJ->productPrice)) ?  ($PROD_OBJ->productPrice) : "";
                        $sale_price = (!empty($PROD_OBJ->salePrice)) ? ($PROD_OBJ->salePrice) : "";
                        $prod_img = !empty($PROD_OBJ->productImg) ? PROD_IMG_PATH . $PROD_OBJ->productImg : BLANK_IMAGE;
                        if ($prod_price > 0 && $sale_price > 0 && $prod_price > $sale_price) {
                            $discount = ($prod_price - $sale_price) / $prod_price * 100;
                            $discount = round($discount);
                        } else {
                            $discount = 0;
                        }

                        if ($discount > 0) {
                ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $cat_urlname; ?> fresh-meat">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/product/discount/pd-6.jpg">
                                        <div class="product__item__pic set-bg" data-setbg="<?php echo $prod_img; ?>" style="background-image: url('<?php echo $prod_img; ?>');">
                                            <div class="product__discount__percent">-<?php echo $discount; ?>%</div>
                                            <ul class="product__item__pic__hover">
                                                <li><a onclick="addToWishlist(this, '<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                                                <li><a onclick="addToCart(this, '<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h6><a href="<?php echo $prod_url; ?>"><?php echo $PROD_OBJ->productName; ?></a></h6>
                                        <div class="product__item__price"><?php echo ($PROD_OBJ->salePrice > 0) ? Rs . $PROD_OBJ->salePrice : ''; ?><span><?php echo ($PROD_OBJ->productPrice > 0) ? Rs . $PROD_OBJ->productPrice : ''; ?></span></div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6 mix <?php echo $cat_urlname; ?> fresh-meat">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="<?php echo $prod_img; ?>" style="background-image: url('<?php echo $prod_img; ?>');">
                                        <ul class="featured__item__pic__hover">
                                            <li><a onclick="addToWishlist(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                                            <li><a onclick="addToCart(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="<?php echo $prod_url; ?>"><?php echo $PROD_OBJ->productName; ?></a></h6>
                                        <h5><?php echo ($PROD_OBJ->productPrice > 0) ? Rs . "&nbsp;" . $PROD_OBJ->productPrice : ""; ?></h5>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>
        </div>
        <div class="col-lg-12 text-center">
            <a href="shop.php" class="site-btn">View All Products</a>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Services Section Start -->
    <div class="section-title"> </div>
    <div class="section-title">
        <h2>Our Services</h2>
    </div>
    <section class="delivery_bg">
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 delivery_col my-2 my-3 text-center">
                    <div class="icon_img_circle">
                        <img src="img/services/truck.png" class="icon_image" alt="delivery">
                    </div>
                    <h5 class="font-weight-bold mb-2">Free Delivery</h5>
                    <p class="mb-0">Free delivery on <br> all orders</p>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 delivery_col my-2 my-3 text-center">
                    <div class="icon_img_circle">
                        <img src="img/services/people.png" class="icon_image" alt="order">
                    </div>
                    <h5 class="font-weight-bold mb-2"> Order before 8pm </h5>
                    <p class="mb-0">Next day delivery subject<br> to availability</p>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 delivery_col my-2 my-3 text-center">
                    <div class="icon_img_circle">
                        <img src="img/services/time.png" class="icon_image" alt="time">
                    </div>
                    <h5 class="font-weight-bold mb-2">Delivered on Time</h5>
                    <p class="mb-0">We will deliver your <br>order on time</p>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-6 delivery_col my-2 my-3 text-center">
                    <div class="icon_img_circle">
                        <img src="img/services/quality.png" class="icon_image" alt="quality">
                    </div>
                    <h5 class="font-weight-bold mb-2">Excellent Quality</h5>
                    <p class="mb-0">We provide high quality <br>and cost effective services</p>
                </div>
            </div>
        </div>
    </section>
    <!-- Services Section End -->

    <?php include "_footer.php"; ?>
</body>

</html>