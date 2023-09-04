<?php
include "cu.common.php";

$code = 0;
$message = "";
$response = array();
$req_mode = isset($_POST['mode']) ? $_POST['mode'] : "";

if ($req_mode == "ADD_TO_WISHLIST") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$prod_id = isset($_POST['pid']) ? $_POST['pid'] : "";

	if (!empty($cust_id) && is_numeric($cust_id) && !empty($prod_id) && is_numeric($prod_id)) {
		$exists = GetXFromYID("SELECT count(*) from customer_wishlist WHERE fkCustomerId = $cust_id and fkProductId = $prod_id");

		if (!$exists) {
			$nid = NextId("id", "customer_wishlist");
			$q = "INSERT INTO customer_wishlist(id, fkCustomerId, fkProductId) VALUES ($nid, $cust_id, $prod_id)";
			$r = sql_query($q);

			if (sql_affected_rows($r)) {
				$code = 1;
				$message = "New Item added to wishlist";

				$_SESSION[CU_SESSION_ID]->cust_wishlist = getCount("customer_wishlist", "COUNT(*)", "and fkCustomerId = " . $cust_id);
			}
		} else {
			$code = 0;
			$message = "Item already in wishlist!";
		}
	} else {
		$code = 1;
		$message = "You are not logged in.";
	}
} else if ($req_mode == "ADD_TO_CART") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$prod_id = isset($_POST['pid']) ? $_POST['pid'] : "";
	$qty = isset($_POST['qty']) ? $_POST['qty'] : 1;

	if (!empty($cust_id) && is_numeric($cust_id) && !empty($prod_id) && is_numeric($prod_id)) {
		$exists = GetXFromYID("SELECT count(*) from customer_cart WHERE fkCustomerId = $cust_id and fkProductId = $prod_id");

		if (!$exists) {
			$nid = NextId("id", "customer_cart");
			$q = "INSERT INTO customer_cart(id, fkCustomerId, fkProductId, qty) VALUES ($nid, $cust_id, $prod_id, $qty)";
			$r = sql_query($q);

			if (sql_affected_rows($r)) {
				$code = 1;
				$message = "New Item added to cart";

				// Store data for recommendations
				insertUserPreference($cust_id, $prod_id, '');
			}
		} else {
			$q = "UPDATE customer_cart SET qty = (qty+1) WHERE fkCustomerId = $cust_id and fkProductId = $prod_id";
			$r = sql_query($q);
		}

		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
	} else {
		$code = 1;
		$message = "Your are not logged in.";
	}
} else if ($req_mode == "VALIDATE_CUSTOMER") {
	$username = isset($_POST["username"]) ? $_POST["username"] : "";

	if (!empty($username)) {
		$exists = GetXFromYID("SELECT count(*) from customer WHERE userName = '$username' ");
		$code = ($exists == 0) ? 1 : 0;
		$message = ($exists == 0) ? "Valid username" : "Username already taken, choose another username!";
	}
} else if ($req_mode == "CHECKOUT_CART") {
	$err = 0;
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if (is_numeric($cust_id) && !empty($cust_id)) {
		$q = "SELECT c.id, c.fkProductId, p.productName, c.qty, p.productPrice, p.salePrice FROM customer_cart c left join product p on c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id";
		$r = sql_query($q);

		if (sql_num_rows($r)) {
			while (list($id, $prod_id, $prod_name, $qty, $prod_price) = sql_fetch_row($r)) {
				if (empty($prod_id) || !is_numeric($prod_id)) {
					removeFromCart($id);
					$err++;
				}
				if (empty($qty) || !is_numeric($qty)) {
					removeFromCart($id);
					$err++;
				}
				if (empty($prod_price) || !is_numeric($prod_price)) {
					removeFromCart($id);
					$err++;
				}
				if (empty($prod_name)) {
					removeFromCart($id);
					$err++;
				}

				$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
				$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
			}

			if ($err > 0) {
				$code = 0;
				$message = "Invalid products have been removed from the cart! Click proceed to checkout.";
			} else if ($err == 0) {
				$code = 1;
			}
		}
	}
} else if ($req_mode == "REMOVE_FROM_CART") {
	$id = isset($_POST['id']) ? $_POST['id'] : "";
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if (!empty($id) && is_numeric($id)) {
		removeFromCart($id);
		$code = "1";
		$message = "Item removed from cart";

		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
	}
} else if ($req_mode == "MOVE_TO_CART") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";

	if (!empty($cust_id) && is_numeric($cust_id)) {
		$q = "INSERT INTO customer_cart(fkCustomerId, fkProductId, qty) SELECT $cust_id, fkProductId, '1' FROM customer_wishlist WHERE fkCustomerId = $cust_id";
		$r = sql_query($q);

		if (sql_affected_rows($r)) {
			$code = "1";
			$message = "Items moved to cart!";

			//store data for recommendations
			$q = "INSERT INTO user_preference (fkCustId, fkProductId,productRating,isPurchase,click_timestamp) SELECT $cust_id, fkProductId,'',FALSE,NOW() FROM customer_wishlist WHERE fkCustomerId = $cust_id";
			$r = sql_query($q);

			// delete after moving
			sql_query("DELETE FROM customer_wishlist WHERE fkCustomerId = $cust_id");
		} else {
			$code = "0";
			$message = "Items could not be moved to cart!";
		}

		$_SESSION[CU_SESSION_ID]->cust_wishlist = getCount("customer_wishlist", "COUNT(*)", "and fkCustomerId = " . $cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
	}
} else if ($req_mode == "PLACE_ORDER") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$couponId = isset($_POST['couponId']) ? $_POST['couponId'] : '';
	$coupon_code = isset($_POST['coupon_code']) ? $_POST['coupon_code'] : "";
	$couponValue = isset($_POST['couponValue']) ? $_POST['couponValue'] : "";
	$total_amount = isset($_POST['TOTAL_AMT']) ? $_POST['TOTAL_AMT'] : "";
	$address_id = isset($_POST['address_id']) ? $_POST['address_id'] : "";
	$payment_method = isset($_POST['payment_method']) ? $_POST['payment_method'] : "";

	echo $couponId;
	echo $coupon_code;

	if (!empty($cust_id) && is_numeric($cust_id) && !empty($address_id) && !empty($payment_method)) {
		$nid = NextId("id", "orders");
		if (empty($couponId)) {
			$couponId = 'NULL';
			$coupon_code = '';
			$couponValue = 0;
		}
		// Calculate final price after applying the coupon
		$final_price = $total_amount - $couponValue;

		$q = "INSERT INTO orders (id,fkCustomerId, orderType, orderDate, fkCouponId, couponCode, couponValue, totalAmount, shippingAddress, paymentMethod, status) 
            VALUES ($nid, $sess_cust_id, 'ORD', NOW(), '$couponId', '$coupon_code', '$couponValue', $final_price, (SELECT address FROM customer_address WHERE id = $address_id), '$payment_method', 'A')";
		$r = sql_query($q);

		if (sql_affected_rows($r)) {
			$code = "1";
			$message = "Order placed successfully!!";

			//insert data into order_items table
			$q = "INSERT INTO order_item (fkOrderId, fkProductId, unitPrice, itemQuantity, totalPrice)
        	SELECT o.id, cc.fkProductId, IFNULL(p.salePrice, p.productPrice), cc.qty, IFNULL(p.salePrice, p.productPrice) * cc.qty FROM orders o JOIN product p JOIN customer_cart cc ON cc.fkProductId = p.id WHERE o.id = $nid";
			$r = sql_query($q);

			// Store data for recommendations
			$order_items = GetXFromYID("SELECT fkProductId FROM order_item WHERE fkOrderId=$nid");

			if (is_array($order_items)) {
				foreach ($order_items as $prod_id) {
					insertUserPreference($cust_id, $prod_id, '', true);
				}
			}

			//delete data from cart table
			$q = "DELETE FROM customer_cart WHERE fkCustomerId = $cust_id";
			sql_query($q);
			$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
			$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
		} else {
			$code = "0";
			$message = "Failed to place the order!";
		}
	} else {
		$code = "0";
		$message = "Please select the payment method!";
	}
} else if ($req_mode == "POST_REVIEW") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$productId = isset($_POST['pid']) ? $_POST['pid'] : '';
	$rating = isset($_POST['rating']) ? $_POST['rating'] : '';
	$review = isset($_POST['review']) ? $_POST['review'] : '';

	if (!empty($cust_id) && is_numeric($cust_id)) {
		$nid = NextId("id", "product_ratings");
		$rating = isset($_POST['rating']) ? $_POST['rating'] : '';
		$q = "INSERT INTO product_ratings(id,fkProductId , fkCustomerID , ratings,review,status)VALUES ($nid,$productId, $cust_id,$rating ,'$review','A') ";
		$r = sql_query($q);

		if (sql_affected_rows($r)) {
			$code = "1";
			$message = "Thank you for your review!";

			// Store data for recommendations
			insertUserPreference($cust_id, $productId, $rating);
		} else {
			$code = "0";
			$message = "Something went wrong!";
		}
	}
} else if ($req_mode == "UPDATE_CART_QUANTITY") {
	$cust_id = isset($_POST['cid']) ? $_POST['cid'] : "";
	$cart_id = $_POST['cart_id'];
	$prod_id = $_POST['prod_id'];
	$new_quantity = $_POST['new_quantity'];

	$q = "UPDATE customer_cart SET qty = $new_quantity WHERE id = $cart_id AND fkProductId=$prod_id";
	$r = sql_query($q);

	if (sql_affected_rows($r)) {
		$code = "1";
		$_SESSION[CU_SESSION_ID]->cust_cart = getCount("customer_cart", "COUNT(*)", "and fkCustomerId = " . $cust_id);
		$_SESSION[CU_SESSION_ID]->cust_cart_total = GetXFromYID("SELECT SUM(IFNULL(p.salePrice, p.productPrice) * c.qty) AS totalCartValue FROM customer_cart c LEFT JOIN product p ON c.fkProductId = p.id WHERE c.fkCustomerId = $cust_id");
	} else {
		$code = "0";
		$message = "Error updating quantity.";
	}
}
$response = array("code" => $code, "message" => $message);
echo json_encode($response);
