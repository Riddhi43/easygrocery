<?php
include "./inc/cu.common.php";

$coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : "";
$jsonArr = array();
$total_amt = $_SESSION['TOT_AMT'];

$minCartValue = 0; 
$couponValue = 0; 
$couponId = ''; 

if (isset($_SESSION['COUPON_ID'])) {
    unset($_SESSION['COUPON_ID']);
    unset($_SESSION['COUPON_CODE']);
    unset($_SESSION['COUPON_VALUE']);
}

if (!empty($coupon_code)) {
  
        $q = "SELECT * FROM coupons WHERE couponCode = '$coupon_code' AND status = 'A'";
        $r = sql_query($q);
        $arr = mysqli_fetch_assoc($r);
        if (sql_num_rows($r)) {
            $couponId = $arr['id'];
            $couponValue = $arr['couponValue'];
            $minCartValue = $arr['minCartValue'];

            if ($minCartValue > $total_amt) {
                $jsonArr = array('is_error' => 'yes', 'result' => $total_amt, 'dd' => "Cart value must be at least $minCartValue");
            } else {
                // Check if the coupon has been used in previous orders
                $custId = $_POST['custId'];
                $q = "SELECT * FROM orders WHERE couponCode = '$coupon_code' AND fkCustomerId = '$custId'";
                $r = sql_query($q);
                if (sql_num_rows($r) > 0) {
                    $jsonArr = array('is_error' => 'yes', 'result' => $total_amt, 'dd' => "Coupon has already been applied.");
                } else {
                    $final_price = $total_amt - (($total_amt * $couponValue) / 100);
                    $dd = $total_amt - $final_price;
                    $_SESSION['COUPON_ID'] = $couponId;
                    $_SESSION['FINAL_PRICE'] = $final_price;
                    $_SESSION['COUPON_VALUE'] = $dd;
                    $_SESSION['COUPON_CODE'] = $coupon_code;
                    
                    // Mark the coupon as applied
                    $_SESSION['COUPON_APPLIED'] = true;
                    
                    $jsonArr = array('is_error' => 'no', 'result' => $final_price, 'dd' => $dd);
                }
            }
        } else {
            // Coupon not found
            $jsonArr = array('is_error' => 'yes', 'result' => $total_amt, 'dd' => "Coupon code not found");
        }
} else {
    // Empty coupon code
    $jsonArr = array('is_error' => 'yes', 'result' => $total_amt, 'dd' => "Coupon code is empty");
}

echo json_encode($jsonArr);
