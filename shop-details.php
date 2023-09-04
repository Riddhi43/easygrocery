<?php
include "./inc/cu.common.php";
$prod_id = (isset($_GET['id']) && is_numeric($_GET['id'])) ? $_GET['id'] : "";

if (empty($prod_id) || !is_numeric($prod_id)) {
    header("location: index.php");
    exit;
}

$PRODUCTS = getDataFromTable("product", "*", "and id = $prod_id");
$prodObj = $PRODUCTS[0];

$categoryId = $prodObj->categoryId;
$cat_name = GetXFromYID("SELECT title from category WHERE id = '$categoryId' ");
$productName = $prodObj->productName;
$productPrice = $prodObj->productPrice;
$salePrice = $prodObj->salePrice;
//$productQty = $prodObj->productQty;
$productDesc = $prodObj->productDesc;
$productMoreDesc = $prodObj->productMoreDesc;
$productImg = $prodObj->productImg;

$productImgPath = (!empty($productImg) && file_exists(PROD_IMG_UPLOAD . $productImg)) ? PROD_IMG_PATH . $productImg : BLANK_IMAGE;

$cat_url = "shop.php?cid=" . $categoryId;

$relatedProducts = array();
if (!empty($categoryId) && !empty($prod_id))
    $relatedProducts = getDataFromTable("product", "*", "and categoryId = $categoryId and id <> $prod_id LIMIT 4");

$personalizedRecommendations = array();
if (!empty($sess_cust_id) && !empty($prod_id)) {
    $personalizedRecommendations = getPersonalizedRecommendations($prod_id, $sess_cust_id);
    if (!empty($personalizedRecommendations)) {
        $recommendProduct = getDataFromTable("product", "*", "and id IN (" . implode(",", $personalizedRecommendations) . ")LIMIT 4");
    }
}

$relatedProductIds = array();
foreach ($relatedProducts as $PROD_OBJ) {
    $relatedProductIds[] = $PROD_OBJ->id;
}

$filteredRelatedProducts = array();
foreach ($relatedProducts as $PROD_OBJ) {
    if (!in_array($PROD_OBJ->id, $personalizedRecommendations)) {
        $filteredRelatedProducts[] = $PROD_OBJ;
    }
}
$PROD_REVIEWS = array();
if (!empty($categoryId) && !empty($prod_id)) {
    $PROD_REVIEWS = getDataFromTable("product_ratings", "*", "and fkProductId = $prod_id AND status = 'A'");
}
if (!empty($PROD_REVIEWS)) {
    $review_Obj = $PROD_REVIEWS[0];
    $fkCustomerID = $review_Obj->fkCustomerID;
    $custName = GetXFromYID("SELECT custName from customer WHERE id = '$fkCustomerID' ");
} else {

    $custName = "No reviews available";
}
$review_count = count($PROD_REVIEWS);

// Fetch the product quantity from the product_stock table
$q = "SELECT totalQty FROM product_stock WHERE fkProductId = $prod_id";
$r = sql_query($q);
if ($r) {
    if (mysqli_num_rows($r) > 0) {
        $productStockObj = mysqli_fetch_object($r);
        $productQtyStock = $productStockObj->totalQty;
    } else {
        $productQtyStock = 0;
    }
} else {
    $productQtyStock = 0;
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <?php
    site_seo($productName, '', $productDesc, $productImgPath);
    include "_header_links.php";
    ?>
</head>

<body>
    <!-- Page Preloder -->
    <!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->
    <?php include "_header.php"; ?>

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="img/breadcrumb1.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2><?php echo $productName; ?></h2>
                        <div class="breadcrumb__option">
                            <a href="index.php">Home</a>
                            <a href="<?php echo $cat_url; ?>"><?php echo $cat_name; ?></a>
                            <span><?php echo $productName; ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Details Section Begin -->
    <section class="product-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large" src="<?php echo $productImgPath; ?>" alt="<?php echo $productName; ?>" alt="">
                        </div>
                        <!-- <div class="product__details__pic__slider owl-carousel">
                            <img src="<?php echo $productImgPath; ?>" alt="<?php echo $productName; ?>">
                            <img src="<?php echo $productImgPath; ?>" alt="<?php echo $productName; ?>">
                            <img src="<?php echo $productImgPath; ?>" alt="<?php echo $productName; ?>">
                            <img data-imgbigurl="<?php echo $productImgPath; ?>" src="<?php echo $productImgPath; ?>" alt="<?php echo $productName; ?>">
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3><?php echo $productName; ?></h3>
                        <div class="product__details__rating">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <span>(<?php echo $review_count ?> reviews)</span>
                        </div>
                        <div class="product__details__price">
                            <?php if ($salePrice != 0) : ?>
                                <?php echo Rs . $salePrice; ?><span><?php echo Rs . $productPrice; ?></span>
                            <?php else : ?>
                                <?php echo Rs . $productPrice; ?>
                            <?php endif; ?>
                        </div>
                        <p><?php echo $productDesc; ?></p>
                        <div class="product__details__quantity">
                            <div class="quantity">
                                <div class="pro-qty">
                                    <input type="number" id="productQty" value="1" min="1">
                                </div>
                            </div>
                        </div>
                        <a href="javascript:;" onclick="addToCart(this, '<?php echo $prod_id; ?>', '<?php echo $sess_cust_id; ?>', document.getElementById('productQty').value)" class="primary-btn">ADD TO CART</a>
                        <a href="javascript:;" onclick="addToWishlist(this,'<?php echo $prod_id; ?>', '<?php echo $sess_cust_id; ?>');" class="heart-icon">
                            <span class="icon_heart_alt"></span>
                        </a>
                        <ul>
                            <li><b>Availability</b> <span><?php echo ($productQtyStock > 0) ? "In Stock" : "Out of Stock"; ?></span></li>
                            <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                            <li><b>Share on</b>
                                <div class="share">
                                    <a href="<?php echo FB_LINK; ?>"><i class="fa fa-facebook"></i></a>
                                    <a href="<?php echo TW_LINK; ?>"><i class="fa fa-twitter"></i></a>
                                    <a href="<?php echo IN_LINK; ?>"><i class="fa fa-instagram"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Description</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(<?php echo $review_count ?>)</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Products Description</h6>
                                    <p><?php echo $productMoreDesc ?></p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6>Product Reviews</h6>
                                            <?php
                                            if (!empty($PROD_REVIEWS)) {
                                                foreach ($PROD_REVIEWS as $REV_OBJ) {
                                                    $review = $REV_OBJ->review;
                                                    $rating = $REV_OBJ->ratings;
                                                    $custId = $REV_OBJ->fkCustomerID;
                                                    $cust_Name = GetXFromYID("SELECT custName from customer WHERE id = '$custId' ");
                                                    $integerPart = floor($rating); // Extract the integer part of the rating
                                                    $decimalPart = $rating - $integerPart; // Extract the decimal part of the rating
                                                    $starRating = "";
                                                    for ($i = 0; $i < $integerPart; $i++) {
                                                        $starRating .= '<i class="fa fa-star"></i>';
                                                    }
                                                    if ($decimalPart >= 0.5) {
                                                        $starRating .= '<i class="fa fa-star-half-o"></i>';
                                                    }
                                                    // Fill remaining stars with empty stars if the rating is less than 5
                                                    for ($i = ceil($rating); $i < 5; $i++) {
                                                        $starRating .= '<i class="fa fa-star-o"></i>';
                                                    }
                                                    echo '<div class="review mb-4">';
                                                    echo '<div class="review-body">';
                                                    echo '<div class="d-flex align-items-center">';
                                                    echo '<h6>' . $cust_Name . '</h6>';
                                                    echo '<div class="product__details__rating ml-2">' . $starRating . '</div>';
                                                    echo '</div>';
                                                    echo '<p>' . $review . '</p>';
                                                    echo '</div>';
                                                    echo '</div>';
                                                }
                                            } else {
                                                echo 'No review found!';
                                            }
                                            ?>
                                        </div>
                                        <?php if ($cust_logged) { ?>
                                            <div>
                                                <div class="product__details__tab__desc">
                                                    <h6>Leave a review</h6>
                                                    <small>Your email address will not be published. Required fields are marked *</small>
                                                    <form>
                                                        <div class="d-flex my-3">
                                                            <p class="mb-0 mr-2">Your Rating * :</p>
                                                            <div>
                                                                <div class="rating-wrap">
                                                                    <div class="center">
                                                                        <fieldset class="rating">
                                                                            <input type="radio" id="star5" name="rating" value="5" /><label for="star5" class="full" title="Awesome"></label>
                                                                            <input type="radio" id="star4.5" name="rating" value="4.5" /><label for="star4.5" class="half"></label>
                                                                            <input type="radio" id="star4" name="rating" value="4" /><label for="star4" class="full"></label>
                                                                            <input type="radio" id="star3.5" name="rating" value="3.5" /><label for="star3.5" class="half"></label>
                                                                            <input type="radio" id="star3" name="rating" value="3" /><label for="star3" class="full"></label>
                                                                            <input type="radio" id="star2.5" name="rating" value="2.5" /><label for="star2.5" class="half"></label>
                                                                            <input type="radio" id="star2" name="rating" value="2" /><label for="star2" class="full"></label>
                                                                            <input type="radio" id="star1.5" name="rating" value="1.5" /><label for="star1.5" class="half"></label>
                                                                            <input type="radio" id="star1" name="rating" value="1" /><label for="star1" class="full"></label>
                                                                            <input type="radio" id="star0.5" name="rating" value="0.5" /><label for="star0.5" class="half"></label>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="review">Your Review *</label>
                                                            <textarea id="review" cols="30" rows="5" class="form-control"></textarea>
                                                        </div>
                                                        <div class="form-group mb-0">
                                                            <a href="javascript:;" onclick="postReview('<?php echo $prod_id; ?>', '<?php echo $sess_cust_id; ?>');" class="site-btn">
                                                                Leave Your Review</a>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        <?php }
                                        ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- Product Details Section End -->
    <!-- Personalized Recommendations Section Begin -->
    <?php if (!empty($sess_cust_id) && isset($filteredRelatedProducts) && count($filteredRelatedProducts) > 0) { ?>
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Recommended Product</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <?php
                    foreach ($filteredRelatedProducts as $PROD_OBJ) {
                        $prd_id = $PROD_OBJ->id;
                        $prod_url = "shop-details.php?id=" . $prd_id;
                        $cat_name = isset($PROD_CATEGORY_ARR[$PROD_OBJ->categoryId]) ? $PROD_CATEGORY_ARR[$PROD_OBJ->categoryId] : "";
                        $cat_urlname = GetUrlName($cat_name);
                        $productPrice = (!empty($PROD_OBJ->productPrice)) ?  ($PROD_OBJ->productPrice) : "";
                        $salePrice = (!empty($PROD_OBJ->salePrice)) ? ($PROD_OBJ->salePrice) : "";
                        $prod_img = (!empty($PROD_OBJ->productImg) && file_exists(PROD_IMG_UPLOAD . $PROD_OBJ->productImg)) ? PROD_IMG_PATH . $PROD_OBJ->productImg : BLANK_IMAGE;
                        if ($productPrice > 0 && $salePrice > 0 && $productPrice > $salePrice) {
                            $discount = ($productPrice - $salePrice) / $productPrice * 100;
                            $discount = round($discount);
                        } else {
                            $discount = 0;
                        }

                        if ($discount > 0) {
                    ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
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
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="<?php echo $prod_img; ?>" style="background-image: url('<?php echo $prod_img; ?>');">
                                        <ul class="product__item__pic__hover">
                                            <li><a onclick="addToWishlist(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-heart"></i></a></li>
                                            <li><a onclick="addToCart(this,'<?php echo $prd_id; ?>', '<?php echo $sess_cust_id; ?>');" href="javascript:;"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="<?php echo $prod_url; ?>"><?php echo $PROD_OBJ->productName; ?></a></h6>
                                        <h5><?php echo ($PROD_OBJ->productPrice > 0) ? Rs . "&nbsp;" . $PROD_OBJ->productPrice : ""; ?></h5>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>
            </div>
        </section>
    <?php } ?>
    <!-- Personalized Recommendations Section End -->
    <?php include "_footer.php"; ?>
    <script type="text/javascript">
        function postReview(prod_id, cust_id) {
            var rating = $('input[name="rating"]:checked').val();
            var review = $('#review').val();
            if (cust_id != "") {
                var ret = false;
                $.ajax({
                    url: ajax_url,
                    type: "post",
                    data: {
                        mode: "POST_REVIEW",
                        cid: cust_id,
                        pid: prod_id,
                        rating: rating,
                        review: review
                    },
                    async: false,
                    success: function(result) {
                        var res = JSON.parse(result);

                        if (res.code == '1') {
                            showMessage(res.message);
                        }
                    },
                    error: function(errores) {
                        console.log(errores.responseText);
                    }
                });
            }
        }
    </script>

</body>

</html>