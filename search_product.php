<?php
include "./inc/cu.common.php";

if (isset($_GET['search'])) {
    $keyword = $_GET['search-box'];
}
$prod_cond = " productName LIKE '%$keyword%'";
$cat_id = (isset($_GET['cid']) && is_numeric($_GET['cid'])) ? $_GET['cid'] : "";
$cat_name = GetXFromYID("SELECT title from category WHERE id = '$cat_id' ");
if (!empty($cat_id) && !empty($cat_name)) {
    $prod_cond = " AND categoryId = $cat_id";
}

$PRODUCTS = searchDataFromTable("product", "*", $prod_cond);
$prod_count = count($PRODUCTS);
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
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-12 col-md-4">
                                <div class="filter__found">
                                    <h6><span><?php echo $prod_count; ?></span> Products found</h6>
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
                                $prod_price = (!empty($PROD_OBJ->productPrice)) ? Rs . $PROD_OBJ->productPrice : "";
                                $prod_img = (!empty($PROD_OBJ->productImg) && file_exists(PROD_IMG_UPLOAD . $PROD_OBJ->productImg)) ? PROD_IMG_PATH . $PROD_OBJ->productImg : BLANK_IMAGE;
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
                                            <h5><?php echo $prod_price; ?></h5>
                                        </div>
                                    </div>
                                </div>
                        <?php
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