<?php
/*
	Session management for backend by connecting to database and storing variables in PHP SESSIONS
*/
######	ConnectSQL
$CON = ConnectSQL();

###### User Roles
$SUPER_ADMIN = 1;
$ADMIN = 2;
$MANAGER = 3;
$CU_SUPPORT = 4;

######	SESSION VARIABLES
$is_super_admin = $is_admin = $is_manager = $is_support = false;
$logged = 0;

if (isset($_SESSION[AD_SESSION_ID]->log_stat)) // if the session variable has been set...
{
	if ($_SESSION[AD_SESSION_ID]->log_stat == "A") {
		$logged = 1;
		$sess_user_id = $_SESSION[AD_SESSION_ID]->user_id;
		$sess_user_name = $_SESSION[AD_SESSION_ID]->user_name;
		$sess_user_role = $_SESSION[AD_SESSION_ID]->user_role;
		$sess_user_sess = $_SESSION[AD_SESSION_ID]->sess_id;
		$sess_login_time = $_SESSION[AD_SESSION_ID]->log_time;

		switch ($sess_user_role) {
			case $SUPER_ADMIN: {
					$is_super_admin = true;
					break;
				}
			case $ADMIN: {
					$is_admin = true;
					break;
				}
			case $MANAGER: {
					$is_manager = true;
					break;
				}
			case $CU_SUPPORT: {
					$is_support = true;
					break;
				}
		}
	}
}

$sess_info_str = "";
if ($logged) {
	$sess_info = isset($_SESSION[AD_SESSION_ID]->info) ? AlertMsg($_SESSION[AD_SESSION_ID]->info, 'info') : '';
	$sess_success_info = isset($_SESSION[AD_SESSION_ID]->success_info) ? AlertMsg($_SESSION[AD_SESSION_ID]->success_info, 'success') : '';
	$sess_error_info = isset($_SESSION[AD_SESSION_ID]->error_info) ? AlertMsg($_SESSION[AD_SESSION_ID]->error_info, 'error') : '';
	$sess_alert_info = isset($_SESSION[AD_SESSION_ID]->alert_info) ? AlertMsg($_SESSION[AD_SESSION_ID]->alert_info, 'alert') : '';

	$sess_info_str = $sess_info . $sess_success_info . $sess_error_info . $sess_alert_info;
	$_SESSION[AD_SESSION_ID]->info = "";
	$_SESSION[AD_SESSION_ID]->success_info = "";
	$_SESSION[AD_SESSION_ID]->error_info = "";
	$_SESSION[AD_SESSION_ID]->alert_info = "";

	$fname = basename($_SERVER['PHP_SELF']);
	access_matrix($sess_user_role, $fname); // restriceted access to user
}


if (!$logged && empty($NO_REDIRECT)) {
	ForceOut(6);
}
// ADMIN MENU 
// menu
$menu = array();
// Home

if (!$is_support) {
	$menu[] = array(
		'title' => "Home",
		'link' => "dashboard.php",
		'icon' => '<i class="fa fa-home" aria-hidden="true"></i>',
		'has_dropdown' => "N",
		'URLS' => array()
	);
}
// Orders
$menu[] = array(
	'title' => "Orders",
	'link' => "orders.php",
	'icon' => '<i class="fa fa-first-order" aria-hidden="true"></i>',
	'has_dropdown' => "N",
	'URLS' => array("order-edit.php")
);
// Product Menu
$product_sub = array();

$product_sub[] = array(
	'title' => "Category",
	'link' => "category.php",
	'icon' => "",
);

// $product_sub[] = array(
// 	'title' => "Offers",
// 	'link' => "offer.php",
// 	'icon' => "",
// );

$product_sub[] = array(
	'title' => "Items",
	'link' => "items.php",
	'icon' => "",
);

$product_sub[] = array(
	'title' => "Product Reviews",
	'link' => "reviews.php",
	'icon' => "",
);
// Product
$menu[] = array(
	'title' => "Product",
	'link' => "product.php",
	'icon' => '<i class="fa fa-product-hunt" aria-hidden="true"></i>',
	'has_dropdown' => "Y",
	'dropdown' => $product_sub,
	'URLS' => array("category.php", "category-edit.php", "items.php", "items-edit.php", "reviews.php", "reviews-edit.php")
);
//coupon
$menu[] = array(
	'title' => "Coupon",
	'link' => "coupon.php",
	'icon' => '<i class="fa fa-gift" aria-hidden="true"></i>',
	'has_dropdown' => "N",
	'dropdown' => array(),
	'URLS' => array("coupon.php", "coupon-edit.php")
);
// Vendor Sub Menu
$vendor_sub = array();

$vendor_sub[] = array(
	'title' => "Stock Request",
	'link' => "stock_request.php",
	'icon' => "",
);

$vendor_sub[] = array(
	'title' => "Vendors",
	'link' => "vendor.php",
	'icon' => "",
);
// Vendors
$menu[] = array(
	'title' => "Vendors",
	'link' => "vendor.php",
	'icon' => '<i class="fa fa-truck" aria-hidden="true"></i>',
	'has_dropdown' => "N",
	'dropdown' => $vendor_sub,
	'URLS' => array("vendor.php", "vendor-edit.php")
);
// Customers
$customer_sub[] = array(
	'title' => "Customer Details",
	'link' => "customer.php",
	'icon' => "",
);

$customer_sub[] = array(
	'title' => "Customer Feedback",
	'link' => "customer-feedback.php",
	'icon' => "",
);

$menu[] = array(
	'title' => "Customers",
	'link' => "customer.php",
	'icon' => '<i class="fa fa-users" aria-hidden="true"></i>',
	'has_dropdown' => "Y",
	'dropdown' => $customer_sub,
	'URLS' => array("customer.php", "customer-edit.php", "customer-feedback.php", "customer-feedback-edit.php")
);

if ($is_admin || $is_super_admin) {
	// Users
	$menu[] = array(
		'title' => "Users",
		'link' => "users.php",
		'icon' => '<i class="fa fa-user" aria-hidden="true"></i>',
		'has_dropdown' => "N",
		'URLS' => array("users.php", "user-edit.php")
	);
	//Inventory
	$menu[] = array(
		'title' => "Inventory",
		'link' => "inventory.php",
		'icon' => '<i class="fa fa-boxes-stacked" aria-hidden="true"></i>',
		'has_dropdown' => "N",
		'dropdown' => array(),
		'URLS' => array("inventory.php", "inventory-edit.php")
	);

	// Settings
	$menu[] = array(
		'title' => "SEO",
		'link' => "seo.php",
		'icon' => '<i class="fa fa-cog" aria-hidden="true"></i>',
		'has_dropdown' => "N",
		'dropdown' => array(),
		'URLS' => array("seo.php")
	);
}
