<?php
include "./inc/cu.common.php";

if (!$cust_logged || !is_numeric($sess_cust_id)) {
    ForceOutCu(3);
    exit;
}

$cust_email = GetXFromYID("SELECT custEmail from customer WHERE id = $sess_cust_id");

$q = "SELECT p.id, p.productName, p.productPrice,p.salePrice, p.productImg, c.fkCustomerId, c.qty FROM customer_cart c left join product p on c.fkProductId = p.id WHERE c.fkCustomerId = $sess_cust_id";
$r = sql_query($q);
$cart_items = sql_get_data($r);

if (isset($_SESSION['COUPON_ID'])) {
    $couponId = $_SESSION['COUPON_ID'];
    $couponValue = $_SESSION['COUPON_VALUE'];
    $coupon_code = $_SESSION['COUPON_CODE'];
    // $TOTAL_AMT = $TOTAL_AMT - $couponValue;
    unset($_SESSION['COUPON_ID'], $_SESSION['COUPON_CODE'], $_SESSION['COUPON_VALUE']);
} else {
    $couponId = $couponValue = $coupon_code = '';
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
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.php">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#" id="coupon_link">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <?php if (!empty($cart_items)) { ?>
                <div class="checkout__form">
                    <h4>Billing Details</h4>
                    <form action="order_success1.php" method="post">
                        <div class="row">
                            <div class="col-lg-8 col-md-6">
                                <div class="checkout-cust">
                                    <table class="cust-table">
                                        <tr>
                                            <td><b>Customer Name: </b><?php echo $sess_cust_name; ?></td>
                                            <td><b>Email: </b><?php echo $cust_email; ?></td>
                                        </tr>
                                    </table>
                                    <div class="">
                                        <br />
                                        <h5><b>Choose Address</b></h5>
                                        <?php
                                        $addresses = getDataFromTable("customer_address", "id, address, title", "and fkCustomerId = $sess_cust_id");

                                        if (!empty($addresses) && count($addresses)) {
                                            foreach ($addresses as $_ADR) {
                                                $selected = "checked";
                                                $ctrl_id = "rd_" . $_ADR->id;
                                        ?>
                                                <div class="add-radio">
                                                    <input type="radio" <?php echo $selected; ?> id="<?php echo $ctrl_id; ?>" name="rdaddress" value="<?php echo $_ADR->id; ?>" />
                                                    <label for="<?php echo $ctrl_id; ?>">
                                                        <b><?php echo $_ADR->title; ?></b><br />
                                                        <?php echo $_ADR->address; ?>
                                                    </label>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6">
                                <div id="apply_coupon_section" style="display: none;">
                                    <div class="input-group">
                                        <input type="text" class="form-control p-4" id="coupon_code" name="coupon_code" placeholder="Enter Coupon Code">
                                        <div class="input-group-append">
                                            <a href="javascript:;" class="site-btn" style="font-size:15px" onclick="applyCouponCode('<?php echo $sess_cust_id; ?>')">Apply Coupon</a>
                                        </div>
                                    </div>
                                    <div id="coupon_result"><small id="coupon_result" class="text-danger"></small></div>
                                </div>
                                <div class="checkout__order">
                                    <h4>Your Order</h4>
                                    <div class="checkout__order__products">Products <span>Total</span></div>
                                    <ul>
                                        <?php
                                        $TOT_AMT = 0;
                                        if (!empty($cart_items) && count($cart_items)) {
                                            foreach ($cart_items as $obj_w) {
                                                $p_img = (!empty($obj_w->productImg) && file_exists(PROD_IMG_UPLOAD . $obj_w->productImg)) ? PROD_IMG_PATH . $obj_w->productImg : "img/cart/cart-1.jpg";
                                                $p_url = "product-detail.php?id=" . $obj_w->id;

                                                $prod_price = (!empty($obj_w->salePrice)) ? $obj_w->salePrice : $obj_w->productPrice;
                                                $tot_amt = $obj_w->qty * $prod_price;
                                                $TOT_AMT += $tot_amt;
                                                $_SESSION['TOT_AMT'] = $TOT_AMT;
                                        ?>
                                                <li><?php echo $obj_w->productName; ?> <span><?php echo Rs . $tot_amt; ?></span></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                    <hr />
                                    <ul id="coupon_box">
                                        <li>Coupon discount <span id="coupon_price"></span></li>
                                    </ul>
                                    <div>
                                    </div>
                                    <div class="checkout__order__total">Total <span id="order_total_amt"><?php echo Rs . $TOT_AMT; ?></span></div>
                                    <p>Estimated date of arrival
                                        <b><?php echo date("d-m-Y", strtotime("+4days")) . " - " . date("d-m-Y", strtotime("+7days")); ?></b>.
                                    </p>
                                    <div class="payment-method-container">
                                        <label>
                                            <input type="radio" name="payment_method" id="payment_method_COD" value="COD">
                                            Cash on Delivery
                                        </label>
                                        <label>
                                            <input type="radio" name="payment_method" id="payment_method_credit" value="CARD">
                                            Credit/Debit Card
                                        </label>
                                        <label>
                                            <input type="radio" name="payment_method" id="payment_method_paypal" value="PAL">
                                            PayPal
                                        </label>
                                    </div>

                                    <?php if ($TOT_AMT > 0) { ?>
                                        <a href="javascript:;" class="checkout__order_btn" onclick="placeOrder('<?php echo $sess_cust_id; ?>', '<?php echo $couponId; ?>', '<?php echo $coupon_code; ?>','<?php echo $couponValue; ?>', '<?php echo $_SESSION['TOT_AMT']; ?>', $('input[name=rdaddress]:checked').val(), $('input[name=payment_method]:checked').val());">
                                            PLACE ORDER
                                        </a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            <?php } ?>
        </div>
    </section>
    <!-- Checkout Section End -->

    <?php include "_footer.php"; ?>

    <script type="text/javaScript">
        // Function to toggle the coupon section visibility
    function toggleCouponSection() {
            var couponSection = document.getElementById("apply_coupon_section");
            if (couponSection.style.display === "none") {
                couponSection.style.display = "block";
            } else {
                couponSection.style.display = "none";
            }
        }

        // Attach click event to the "Click here" link
        var couponLink = document.getElementById("coupon_link");
        couponLink.addEventListener("click", function(event) {
            event.preventDefault();
            toggleCouponSection();
        });

    function applyCouponCode(cust_id){
        jQuery('#coupon_result').html('');
        var coupon_code=jQuery('#coupon_code').val();
        var totalAmount = <?php echo $TOT_AMT; ?>;
        if(coupon_code!=''){
            jQuery.ajax({
                type:'post',
                url:'set_coupon.php',
                data: {
                    custId:cust_id,
                    coupon_code: coupon_code,
                    totalAmount: totalAmount 
                },
                success: function (result) {
                    var data = JSON.parse(result);
                    if (data.is_error === 'yes') {
                        jQuery('#coupon_box').hide();
                        jQuery('#coupon_result').html(data.dd);
                        jQuery('#order_total_amt').html(parseFloat(data.result).toFixed(2));
                    } else {
                        jQuery('#coupon_box').show();
                        jQuery('#coupon_price').html(parseFloat(data.dd).toFixed(2));
                        jQuery('#order_total_amt').html(parseFloat(data.result).toFixed(2));
                    }
                }
            })
        }else{
            jQuery('#coupon_code_msg').html('Please enter coupon code');
        }
    }
 
    function placeOrder(cust_id, couponId, coupon_code, couponValue, TOTAL_AMT, address_id, payment_method) {
    var ret = false;
    if (cust_id != "") {
        $.ajax({
            url: ajax_url,
            type: "post",
            data: {
                mode: "PLACE_ORDER",
                cid: cust_id,
                couponId: couponId,
                coupon_code: coupon_code,
                couponValue:couponValue,
                TOTAL_AMT: TOTAL_AMT,
                address_id: address_id,
                payment_method: payment_method
            },
            async: false,
            success: function(result) {
                        res = JSON.parse(result);
                        ret = (res.code == '1') ? true : false;
                        if (res.code == '0') {
                            showMessage(res.message);
                        }
                    },
                    error: function(errores) {
                        console.log(errores.responseText);
                    }
                });

                if (ret) {
                    window.location.href = "order_success.php";
                }
            }
        }

   </script>
</body>

</html>