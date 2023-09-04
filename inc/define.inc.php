<?php
// session defines
define("AD_SESSION_ID", "ECOM_AD"); # admin session management
define("CU_SESSION_ID", "ECOM_CU"); # customer session management
define("SQL_ERROR", "1");
define("NOW", date("Y-m-d H:i:s"));
define("TODAY", date("Y-m-d"));
define("NEWLINE", "\n\r");
define("TAB_SPACE", "\t");

// path defines
define("LOG_PATH", DOCROOT . "logs/"); # path to store logs


define("CAT_IMG_PATH", SITE_ADDRESS . "images/category_images/"); # path to retrive logs
define("CAT_IMG_UPLOAD", DOCROOT . "images/category_images/"); # path to store logs

define("PROD_IMG_PATH", SITE_ADDRESS . "images/product_images/"); # path to retrive logs
define("PROD_IMG_UPLOAD", DOCROOT . "images/product_images/"); # path to store logs

define("BLANK_IMAGE", ADMIN_ADDRESS . "img/blank-img.png"); #blank image

$STATUS_ARR = array("A" => "Active", "I" => "Inactive");
$ORDER_STATUSES = array('A' => 'Accepted Order', 'I' => 'Order on Hold', 'ORD' => "Order Received", 'PACK' => "Order Packed", 'DELIV' => "Order Delivered");
$ORDER_TYPES = array('ORD' => "Order", 'RET' => "Order Returned", 'REF' => "Order Refund", 'REP' => "Order Replaced");
$PAYMENT_METHOD = array('CARD' => 'Card', 'PAL' => 'PayPal', 'COD' => "Cash on delivery");

$ACCESS_ARR = array();

// for role 3
$ACCESS_ARR['3'] = array("users.php", "user-edit.php", "seo.php", "customer.php");
// for role 4
$ACCESS_ARR["4"] = array("category-edit.php", "dashboard.php", "vendor-edit.php", "item-edit.php", "customer.php");

##############// FRONT-END DEFINES
define("SITE_EMAIL", "hello@easygrocery.com");
define("SHOP_ADR", "University of Huddersfield<br/>Queensgate,<br/>Huddersfield HD1 3DH");
define("SHOP_PHONE", "+44 088 05673451");
define("FB_LINK", "https://www.facebook.com");
define("TW_LINK", "https://www.twiter.com");
define("IN_LINK", "https://www.instagram.com");
define("HEADER_LOGO", SITE_ADDRESS . "img/logo1.png");
define("Rs", "&#163;");
