<?php
include "./inc/cu.common.php";
$cat_id = (isset($_GET['cid']) && is_numeric($_GET['cid'])) ? $_GET['cid'] : "";
$prod_cond = "";
$cat_name = GetXFromYID("SELECT title from category WHERE id = '$cat_id' ");
if (!empty($cat_id) && !empty($cat_name)) {
    $prod_cond = " AND categoryId = $cat_id";
}
$product_low_selected = "";
$product_high_selected = "";
$product_asc_selected = "";
$product_desc_selected = "";
if (isset($_GET['sort_by'])) {
    $sort = $_GET['sort_by'];
    if ($sort == "price_desc") {
        $prod_cond .= " ORDER BY productPrice DESC";
        $product_high_selected = "selected";
    } elseif ($sort == "price_asc") {
        $prod_cond .= " ORDER BY productPrice ASC";
        $product_low_selected = "selected";
    } elseif ($sort == "name_asc") {
        $prod_cond .= " ORDER BY productName ASC";
        $product_asc_selected = "selected";
    } elseif ($sort == "name_desc") {
        $prod_cond .= " ORDER BY productName DESC";
        $product_desc_selected = "selected";
    }
}
$PRODUCTS = getDataFromTable("product", "*", $prod_cond);
$prod_count = count($PRODUCTS);
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php
    site_seo($cat_name);
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
                        <h2>Easygrocery Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <?php
                            echo !empty($cat_name) ? "<a href='shop.php?cid=" . $cat_id . "'>" . $cat_name . "</a>" : "";
                            ?>
                            <span>Shop</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Department</h4>
                            <ul>
                                <?php
                                if (!empty($PROD_CATEGORY)) {
                                    foreach ($PROD_CATEGORY as $P_OBJ) {
                                        $urlname = GetUrlName($P_OBJ->title);
                                        $cat_url = "shop.php?cid=" . $P_OBJ->id;
                                        echo '<li><a href="' . $cat_url . '">' . $P_OBJ->title . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <?php
                                    $topRatedProducts = getDataFromTable("product", "*", "ORDER BY id DESC LIMIT 6");

                                    if (!empty($topRatedProducts)) {
                                        $chunkedProducts = array_chunk($topRatedProducts, 3); // Divide products into groups of three
                                        foreach ($chunkedProducts as $productGroup) {
                                    ?>
                                            <div class="latest-prdouct__slider__item">
                                                <?php foreach ($productGroup as $product) { ?>
                                                    <a href="shop-details.php?id=<?php echo $product->id; ?>" class="latest-product__item">
                                                        <div class="latest-product__item__pic">
                                                            <img src="<?php echo !empty($product->productImg) ? PROD_IMG_PATH . $product->productImg : BLANK_IMAGE; ?>" alt="">
                                                        </div>
                                                        <div class="latest-product__item__text">
                                                            <h6><?php echo $product->productName; ?></h6>
                                                            <span><?php echo ($product->productPrice > 0) ? Rs . $product->productPrice : ''; ?></span>
                                                        </div>
                                                    </a>
                                                <?php } ?>
                                            </div>
                                    <?php
                                        }
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">

                            <div class="col-lg-8 col-md-3">
                                <div class="filter__found">
                                    <h6><span><?php echo $prod_count; ?></span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-2">
                                <div class="filter__sort">
                                    <span>Sort By</span>
                                    <select id="sort_product_id" onchange="selectionChange('<?php echo $cat_id ?>', '<?php echo SITE_ADDRESS ?>')">
                                        <option value="default">Default</option>
                                        <option value="price_asc" <?php echo $product_low_selected ?>>Price: Low to High</option>
                                        <option value="price_desc" <?php echo $product_high_selected ?>>Price: High to Low</option>
                                        <option value="name_asc" <?php echo $product_asc_selected ?>>Product Name: A to Z</option>
                                        <option value="name_desc" <?php echo $product_desc_selected ?>>Product Name: Z to A</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        if (!empty($PRODUCTS)) {
                            foreach ($PRODUCTS as $PROD_OBJ) {
                                $prd_id = $PROD_OBJ->id;
                                $prod_url = "shop-details.php?id=" . $prd_id;
                                $prod_price = (!empty($PROD_OBJ->productPrice)) ?  ($PROD_OBJ->productPrice) : "";
                                $sale_price = (!empty($PROD_OBJ->salePrice)) ? ($PROD_OBJ->salePrice) : "";
                                $prod_img = (!empty($PROD_OBJ->productImg) && file_exists(PROD_IMG_UPLOAD . $PROD_OBJ->productImg)) ? PROD_IMG_PATH . $PROD_OBJ->productImg : BLANK_IMAGE;

                                if ($prod_price > 0 && $sale_price > 0 && $prod_price > $sale_price) {
                                    $discount = ($prod_price - $sale_price) / $prod_price * 100;
                                    $discount = round($discount);
                                } else {
                                    $discount = 0;
                                }

                                if ($discount > 0) {
                        ?>
                                    <div class="col-lg-4 col-md-6 col-sm-6">
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
                                    <div class="col-lg-4 col-md-6 col-sm-6">
                                        <div class="product__item">
                                            <div class="product__item__pic set-bg" data-setbg="<?php echo $prod_img; ?>" style="background-image: url('<?php echo $prod_img; ?>');">
                                                <ul class="product__item__pic__hover">
                                                    <li><a onclick="addToWishlist(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                                                    <li><a onclick="addToCart(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__item__text">
                                                <h6><a href="<?php echo $prod_url; ?>"><?php echo $PROD_OBJ->productName; ?></a></h6>
                                                <h5><?php echo ($PROD_OBJ->productPrice > 0) ? Rs . $PROD_OBJ->productPrice : ''; ?></h5>
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
            </div>
        </div>
    </section>
    <!-- Product Section End -->
    <?php include "_footer.php"; ?>
</body>

</html>
<script>
    function selectionChange(cat_id, SITE_ADDRESS) {
        var sort_product_id = jQuery('#sort_product_id').val();
        window.location.href = SITE_ADDRESS + "shop.php?cid=" + cat_id + "&sort_by=" + sort_product_id;
    }
</script>