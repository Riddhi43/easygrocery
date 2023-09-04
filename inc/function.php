<?php
/*
	- generic funtions for the project
	- ensure re-use of code as much as possible
	- add appropriate comments if modifying a particular function and inform other team members
*/

// Connecting the project to database
function ConnectSQL()
{
	$CON = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die("<strong>ERROR CODE : </strong> COM - 04");
	mysqli_select_db($CON, DB_NAME) or die("<strong>ERROR CODE : </strong> COM - 04");
	return $CON;
}

// Logging SQL Queries and issues
function logSQl($f_name, $txt = "")
{
	/*$f_path = LOG_PATH.$f_name;
	$logfile = fopen($f_path, "a");// or die("Unable to open file!");
	fwrite($f_path, $txt);
	fclose($f_path);*/
}

// Redirecting function if required
function ForceOut($code = 0, $page = "index.php", $sess_destroy = "N")
{
	if ($sess_destroy == "Y")
		session_destroy();

	$page = empty($page) ? ADMIN_ADDRESS : ADMIN_ADDRESS . $page;

	header("location: $page?err=$code");
	exit;
}

function ForceOutCu($code = 0, $page = "index.php", $sess_destroy = "N")
{
	if ($sess_destroy == "Y")
		session_destroy();

	$page = empty($page) ? SITE_ADDRESS : SITE_ADDRESS . $page;

	header("location: $page?err=$code");
	exit;
}

// Increment the id value while inserting the inputs
function NextId($table_id, $table_name)
{
	if (!empty($table_id) && !empty($table_name)) {
		$q1 = "SELECT MAX($table_id) FROM $table_name";
		$r1 = sql_query($q1);
		list($disp) = sql_fetch_row($r1);
		$txt_id = $disp + 1;
		return $txt_id;
	}
}

// pop msgs
function AlertMsg($msg = "", $type = "info")
{
	$mode = "";
	$str = "";

	if ($type == "info") $mode = "alert-info";
	else if ($type == "success") $mode = "alert-success";
	else if ($type == "error") $mode = "alert-danger";
	else if ($type == "alert") $mode = "alert-warning";

	if (!empty($msg))
		$str = '<div class="alert mb-10 ' . $mode . ' alert-mg-b-0" role="alert">' . $msg . '</div>';


	return $str;
}

//to get name based on id
function get_dat_arr($id, $name, $table_name, $cond = "")
{
	$arr = array();
	$q = "SELECT $id,  $name FROM `$table_name` WHERE 1 $cond";
	$r = sql_query($q);
	if (sql_num_rows($r)) {
		while (list($id, $name) = sql_fetch_row($r)) {
			$arr[$id] = $name;
		}
	}
	return $arr;
}

//to get customer details based on id
function get_det_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `customer` WHERE id = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

// to get the address based on id
function get_add_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `customer_address` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

//to get orders of customer based on id
function get_order_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `orders` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

// to get the payment details of customer
function get_pay_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `customer_payment` WHERE 1 AND fkCustomerId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

//to get order items from order item table
function get_items_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `order_item` WHERE 1 AND fkOrderId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}
//to get order items from order item table
function get_status_arr($id)
{
	$arr = array();

	$q = "SELECT * FROM `order_status` WHERE 1 AND fkOrderId = $id";
	$r = sql_query($q);
	$arr = sql_get_data($r);

	return $arr;
}

//print array
function pr_arr($arr = array())
{
	echo '<pre/>';
	print_r($arr);
}

function getCount($table, $field = "COUNT(*)", $cond = "")
{
	$count = 0;

	if (!empty($table)) {
		$q = "SELECT $field FROM $table WHERE 1 $cond";
		$r = sql_query($q);
		if (sql_num_rows($r))
			list($count) = sql_fetch_row($r);
	}

	return $count;
}

function randomSparkline($num = 12)
{
	$sparkline_str = "";

	if (!empty($num) && is_numeric($num)) {
		for ($i = 1; $i <= $num; $i++) {
			$sparkline_str .= rand(1, 100) . ',';
		}

		$sparkline_str = substr($sparkline_str, 0, -1);
	}

	return $sparkline_str;
}
$sort_order = "";
function getDataFromTable($table_name, $field_str = "*", $cond = "", $query = "")
{
	$arr = array();
	$q = !empty($query) ? $query : "SELECT $field_str FROM $table_name WHERE 1 $cond";
	$r = sql_query($q);

	if (sql_num_rows($r))
		$arr = sql_get_data($r);

	return $arr;
}
function searchDataFromTable($table_name, $field_str = "*", $cond = "", $query = "")
{
	$arr = array();
	$q = !empty($query) ? $query : "SELECT $field_str FROM $table_name WHERE $cond";
	$r = sql_query($q);

	if (sql_num_rows($r))
		$arr = sql_get_data($r);

	return $arr;
}

function GetXArrFromYID($q, $mode = "1")
{
	$arr = array();
	$r = sql_query($q);

	if (sql_num_rows($r)) {
		if ($mode == "2")
			for ($i = 0; list($x) = sql_fetch_row($r); $i++)
				$arr[$i] = $x;
		else if ($mode == "3")
			for ($i = 0; list($x, $y) = sql_fetch_row($r); $i++)
				$arr[$x] = $y;
		else if ($mode == "4")
			while ($a = sql_fetch_assoc($r))
				$arr[$a['I']] = $a;
		else
			while (list($x) = sql_fetch_row($r))
				$arr[$x] = $x;
	}

	return $arr;
}

function GetXFromYID($q, $mode = "1")
{
	$ret = "";
	$r = sql_query($q);

	if (sql_num_rows($r)) {
		list($ret) = sql_fetch_row($r);
	}

	return $ret;
}

function updateProductStock($prod_id)
{
	$ret = false;

	if (!empty($prod_id) && is_numeric($prod_id)) {
		$q = "UPDATE product SET productQty = (SELECT SUM(newQty +qtyOnHand) from product_stock WHERE fkProductId = $prod_id) WHERE id = $prod_id ";
		$r = sql_query($q);

		if (sql_affected_rows($r))
			$ret = true;
	}

	return $ret;
}

function addProductEachtStock($prod_id, $new_qty)
{
	$ret = false;
	if (!empty($prod_id) && is_numeric($prod_id)) {
		$q = "INSERT INTO stock_request(fkProductId, requestDate,noOfItems) VALUES ($prod_id,NOW(),$new_qty)";
		$r = sql_query($q);

		if (sql_affected_rows($r))
			$ret = true;
	}

	return $ret;
}

function insertUserPreference($cust_id, $prod_id, $rating = '', $is_purchase = false)
{
	$existing_pref = GetXFromYID("SELECT id FROM user_preference WHERE fkCustId=$cust_id AND fkProductId=$prod_id");

	if (!$existing_pref) {
		$is_pref = $is_purchase ? 'TRUE' : 'FALSE';
		$q = "INSERT INTO user_preference (fkCustId, fkProductId, productRating, isPurchase, click_timestamp) 
		VALUES ($cust_id,$prod_id,'$rating',$is_pref,NOW())";
		$r = sql_query($q);
	}
}
function Array2String($arr = array())
{
	$str = "";

	if (!empty($arr)) {
		foreach ($arr as $_label => $_count) {
			if (is_numeric($_count) && $_count != 0) {
				$str .= $_label . ', ';
			}
		}
	}

	return substr($str, 0, -2);
}

function validateReference($table_name, $pk_fld, $pk_id)
{
	$c = 0;
	if (!empty($table_name) && !empty($pk_fld) && !empty($pk_id)) {
		$c = getCount($table_name, "COUNT(*)", " AND " . $pk_fld . ' = ' . $pk_id);
	}

	return $c;
}

function GetUrlName($title)
{
	$URL_CHAR_ARR = array("%", "/", ".", "#", "?", "*", "!", "@", "&", ":", "|", ";", "=", "<", ">", "^", "~", "'", "\"", ",", "-", "(", ")", "'", '"', '\\');
	$rurl = trim($title);
	$rurl = str_replace($URL_CHAR_ARR, '', $title);
	$rurl = str_replace('   ', ' ', $rurl);
	$rurl = str_replace('  ', ' ', $rurl);
	$rurl = str_replace(' ', '-', $rurl);
	$rurl = trim(strtolower($rurl));

	return $rurl;
}

function getProductCategory($cond = "")
{
	$arr = array();
	$q = "SELECT `id`, `title`, `image`, `description`, `status` FROM `category` WHERE 1 $cond";
	$r = sql_query($q);

	if (sql_num_rows($r))
		$arr = sql_get_data($r);

	return $arr;
}

function removeFromCart($pk_id)
{
	if (!empty($pk_id) && is_numeric($pk_id)) {
		sql_query("DELETE FROM customer_cart WHERE id = $pk_id");
	}
}

function site_seo($title = "", $keyword = "", $desc = "", $image = "")
{
	$str = "";
	$s_title = !empty($title) ? $title : "Groceries on Demand: Order Online, Save Time";
	$s_keyword = !empty($keyword) ? $keyword : "Grocery store, Supermarket, Fresh produce, Organic food, Local groceries, Online grocery shopping, Grocery delivery, Specialty foods, Bulk foods, Gourmet ingredients, Health food store, International foods, Farm-to-table, Gluten-free products, Vegan options, Natural supplements, Frozen foods, Dairy products";
	$s_desc = !empty($desc) ? $desc : "Shop for fresh groceries online at Easy Grocery. Enjoy convenient delivery, wide product selection, and exceptional quality for all your food needs";
	$s_image = !empty($image) ? $image : SITE_ADDRESS . "/img/site-logo-b.png";

	$str .= '<!-- Primary Meta Tags -->' . NEWLINE;
	$str .= '<meta name="title" content="' . $s_title . '">' . NEWLINE;
	$str .= '<meta name="description" content="' . $s_desc . '">' . NEWLINE;
	$str .= '<meta name="keywords" content="' . $s_keyword . '">' . NEWLINE;
	$str .= '<meta name="robots" content="index, follow">' . NEWLINE;
	$str .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">' . NEWLINE;
	$str .= '<meta name="language" content="English">' . NEWLINE;
	$str .= '<meta name="revisit-after" content="30 days">' . NEWLINE;

	$str .= '<!-- Open Graph / Facebook -->' . NEWLINE;
	$str .= '<meta property="og:type" content="website">' . NEWLINE;
	$str .= '<meta property="og:url" content="' . SITE_ADDRESS . '">' . NEWLINE;
	$str .= '<meta property="og:title" content="' . $s_title . '">' . NEWLINE;
	$str .= '<meta property="og:description" content="' . $s_desc . '">' . NEWLINE;
	$str .= '<meta property="og:image" content="' . $s_image . '">' . NEWLINE;

	$str .= '<!-- Twitter -->' . NEWLINE;
	$str .= '<meta property="twitter:card" content="summary_large_image">' . NEWLINE;
	$str .= '<meta property="twitter:url" content="' . SITE_ADDRESS . '">' . NEWLINE;
	$str .= '<meta property="twitter:title" content="' . $s_title . '">' . NEWLINE;
	$str .= '<meta property="twitter:description" content="' . $s_desc . '">' . NEWLINE;
	$str .= '<meta property="twitter:image" content="' . $s_image . '">' . NEWLINE;

	$str .= '<title>' . $s_title . '</title>' . NEWLINE;

	echo $str;
}

function encode_value($value)
{
	$key = 'ABCDEF1234'; // 10-digit alphanumeric key
	$encoded = strtoupper(substr(md5($value ^ $key), 0, 10)); // XOR, MD5, and substring
	return $encoded;
}

function decode_value($encoded)
{
	$key = 'ABCDEF1234'; // 10-digit alphanumeric key
	$decoded = md5($encoded ^ $key); // XOR and MD5
	$value = 0;
	$base = 16;
	$exp = 0;
	for ($i = strlen($decoded) - 1; $i >= 0; $i--) {
		$digit = hexdec($decoded[$i]);
		$value += $digit * pow($base, $exp);
		$exp++;
	}
	return $value;
}

function access_matrix($user_role, $filename)
{
	global $ACCESS_ARR;
	$USER_ROLES = GetXArrFromYID("SELECT id from user_role");
	if (!empty($user_role) && isset($USER_ROLES[$user_role]) && !empty($filename)) {
		$access_menu = isset($ACCESS_ARR[$user_role]) ? $ACCESS_ARR[$user_role] : array();
		if (in_array($filename, $access_menu)) {
			ForceOut("B");
			exit;
		}
	} else {
		ForceOut("A");
		exit;
	}
}

function getPersonalizedRecommendations($prod_id, $user_id)
{
	$q = "SELECT oi.fkProductId FROM orders o JOIN order_item oi ON o.id = oi.fkOrderId WHERE o.fkCustomerId = $user_id 
		  UNION 
		  SELECT fkProductId FROM user_preference WHERE fkCustId = $user_id";
	$r = sql_query($q);
	// Build array of user's product history  
	$user_products = array();

	if ($r) {
		while ($row = sql_fetch_assoc($r)) {
			$user_products[] = $row['fkProductId'];
		}
	}
	$prod_cats = getProductCategories($prod_id);

	// Get other products in those categories, excluding user's existing products
	$q = "SELECT p.id FROM product p JOIN category c ON p.categoryId = c.id WHERE c.id IN ($prod_cats) AND p.id 
	NOT IN (" . implode(",", $user_products) . ")";
	$r = sql_query($q);
	$recommendations = array();
	if ($r) {
		while ($row = sql_fetch_assoc($r)) {
			$recommendations[] = $row['id'];
		}
	}
	return $recommendations;
}
function getProductCategories($prod_id)
{
	$q = "SELECT c.id FROM category c JOIN product p ON c.id = p.categoryId WHERE p.id = $prod_id";
	$r = sql_query($q);

	$cats = array();

	if ($r) {
		while ($row = sql_fetch_assoc($r)) {
			$cats[] = $row['id'];
		}
	}

	return implode(",", $cats);
}
