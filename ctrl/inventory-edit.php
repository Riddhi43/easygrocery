<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Inventory Edit";
$INVENTORY_TITLE = "Product Inventory";

$edit_page = "inventory-edit.php";
$del_page = $edit_page . "?m=D&id=";
$item_display = "inventory.php";

// initiall value of m is ""
if (isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
} else if (isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode = $_GET["m"];
} else {
    $mode = "A";
}

//id
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $txtid = $_POST['id'];
} else if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $txtid = $_GET['id'];
} else {
    $mode = "A";
}

if ($mode == 'A') {
    $txtid = 0;
    $prod_id = "";
    $vendor_id = "";
    $qty_on_hand = "";
    $new_qty = "";
    $total_qty = "";
    $date_of_pruch = "";
    $prod_name = "";
    $vendor_name = "";
    $status = "A";

    $form_mode = 'C';
} else if ($mode == 'C') {
    //insert
    $txtid = NextId("id", "product_stock");
    $prod_id = $_POST["prod_id"];
    $vendor_id = $_POST["vendor_id"];
    $qty_on_hand = $_POST["qty_on_hand"];
    $total_qty = $qty_on_hand;

    $q = "INSERT INTO product_stock(id,fkProductId,fkVendorId , qtyOnHand, newQty, totalQty, dateOfPruch, status) values ('$txtid', '$prod_id', '$vendor_id',$qty_on_hand,0,$total_qty,NOW(),'A')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "stock added successfully";
} else if ($mode == "R") {
    //edit
    $q = "SELECT ps.*, p.productName, v.vendorName FROM product_stock ps JOIN product p ON ps.fkProductId = p.id JOIN vendor v ON ps.fkVendorId = v.id WHERE ps.id = '$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $prod_id = $o->fkProductId;
    $vendor_id = $o->fkVendorId;
    $qty_on_hand = $o->qtyOnHand;
    $new_Qty = $o->newQty;
    $total_qty = $o->totalQty;
    $date_of_purch = $o->dateOfPruch;
    $status = $o->status;
    $prod_name = $o->productName;
    $vendor_name = $o->vendorName;

    $form_mode = "U";
    $od_form_mode = 'ADD_STOCK';
}

// STOCK MODES
if ($mode == 'ADD_STOCK') {
    $fk_vendor_id = $_POST["vendor_id"];
    $new_qty = $_POST["new_qty"];
    $date_of_pruch = $_POST["date_of_pruch"];
    $qty_on_hand = $_POST["qty_on_hand"];

    $q = "SELECT * FROM product_stock WHERE fkProductId = '$txtid'";
    $r = sql_query($q);

    if (sql_num_rows($r) > 0) {
        $existing_product = sql_fetch_object($r);
        $existing_new_qty = $existing_product->newQty;

        // Add the new quantity to the existing newQty value
        $new_qty1 = $existing_new_qty + $new_qty;
        $total_qty = intval($qty_on_hand) + intval($new_qty1);
        if (sql_num_rows($r) > 0) {
            // Update the existing product stock
            $q = "UPDATE product_stock SET fkVendorId = '$fk_vendor_id', qtyOnHand = '$qty_on_hand', newQty = '$new_qty1', totalQty = '$total_qty', dateOfPruch = '$date_of_pruch', status = 'A' WHERE fkProductId = '$txtid'";
            $r = sql_query($q);

            if (sql_affected_rows($r)) {
                $_SESSION[AD_SESSION_ID]->success_info = "Stock successfully Updated";
                updateProductStock($txtid);
                addProductEachtStock($txtid, $new_qty);
            } else {
                $_SESSION[AD_SESSION_ID]->alert_info = "Unable to update stock";
            }
        } else {
            $q = "INSERT INTO product_stock(fkProductId, fkVendorId, qtyOnHand, newQty, totalQty, dateOfPruch, status) VALUES ('$txtid', '$fk_vendor_id', '$qty_on_hand', '$new_qty', '$total_qty', '$date_of_pruch', 'A')";
            $r = sql_query($q);

            if (sql_affected_rows($r)) {
                $_SESSION[AD_SESSION_ID]->success_info = "Stock successfully Inserted";
                updateProductStock($txtid);
            } else {
                $_SESSION[AD_SESSION_ID]->alert_info = "Unable to insert stock";
            }
        }
    }
    header("location: $edit_page?m=R&id=$txtid");
    exit;
} else if ($mode == 'DELETE_STOCK') {
    $prod_id = $_GET['id'];
    $psid = $_GET['psid'];
    $new_qty = $_GET['qty'];
    if (isset($prod_id, $psid, $new_qty)) {
        // Update the product stock
        $q = "UPDATE product_stock SET newQty = newQty - $new_qty, totalQty = qtyOnHand + newQty WHERE fkProductId = $prod_id";
        $r = sql_query($q);

        // Delete the stock request
        $q = "DELETE FROM stock_request WHERE id = $psid";
        $r = sql_query($q);

        $_SESSION[AD_SESSION_ID]->success_info = "Inventory successfully deleted";
        updateProductStock($txtid);
        header("location: $edit_page?m=R&id=$txtid");
        exit;
    } else {
        // Handle missing or invalid GET parameters
        $_SESSION[AD_SESSION_ID]->error_info = "Invalid request parameters.";
        header("location: $edit_page?m=R&id=$txtid");
        exit;
    }
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $PAGE_TITLE ?></title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>

<body>
    <!-- Start Header Top Area -->
    <?php include "_header.php"; ?>
    <?php include "_menu.php"; ?>

    <!-- Form Element area Start-->
    <div class="form-element-area">
        <div class="container">
            <?php echo $sess_info_str; ?>
            <div class="row">
                <div class="<?php echo ($mode == "R") ? "col-lg-8 col-md-8" : "col-lg-12 col-md-12" ?> col-sm-12 col-xs-12">
                    <div class="form-element-list">
                        <div class="basic-tb-hd">
                            <h2><?php echo $PAGE_TITLE; ?></h2>
                        </div>
                        <form action="<?php echo $edit_page; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="m" value="<?php echo $form_mode; ?>">
                            <input type="hidden" name="id" value="<?php echo $txtid; ?>">
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <!-- <div class="nk-int-st">
                                            <input type="text" name="prod_name" value="<?php echo $prod_name; ?>" class="form-control" placeholder="Product Name" required>
                                        </div> -->
                                        <div class="nk-int-st">
                                            <select name="prod_id" class="form-control select-form-control">
                                                <?php
                                                $q2 = "SELECT id, productName FROM product ";
                                                $r2 = sql_query($q2);
                                                $num_rows = sql_num_rows($r2);
                                                if ($num_rows > 0) {
                                                    while ($row = sql_fetch_assoc($r2)) {
                                                        $selected = ($row['id'] == $category) ? "selected" : "";
                                                ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['productName']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <select name="vendor_id" class="form-control select-form-control">
                                                <?php
                                                $q2 = "SELECT id, vendorName FROM vendor ";
                                                $r2 = sql_query($q2);
                                                $num_rows = sql_num_rows($r2);
                                                if ($num_rows > 0) {
                                                    while ($row = sql_fetch_assoc($r2)) {
                                                        $selected = ($row['id'] == $category) ? "selected" : "";
                                                ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['vendorName']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="qty_on_hand" value="<?php echo $qty_on_hand; ?>" class="form-control" placeholder="Available Quantity" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-sp">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Total Quantity</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?php echo $total_qty; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                    <div class="form-example-int mg-t-15 flex-space-end">
                        <div>
                            <a href="<?php echo $item_display; ?>" class="btn btn-warning warning-icon-notika waves-effect">Back
                            </a>
                            <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                Save
                            </button>
                        </div>
                    </div>
                    </form>
                </div>

                <?php
                // Stock can be added only when Product exists
                if ($mode == 'R' && !empty($txtid)) {
                ?>
                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="form-element-list">
                            <div class="basic-tb-hd">
                                <h2><?php echo $INVENTORY_TITLE; ?></h2>
                                <p>Add new Inventory</p>
                            </div>
                            <form action="<?php echo $edit_page; ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="m" value="<?php echo $od_form_mode; ?>">
                                <input type="hidden" name="id" value="<?php echo $txtid; ?>">
                                <input type="hidden" name="prod_id" value="<?php echo $prod_id; ?>">
                                <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>">
                                <input type="hidden" name="qty_on_hand" value="<?php echo $qty_on_hand; ?>">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-calendar-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="date" name="date_of_pruch" value="<?php echo TODAY; ?>" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-circle" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="number" min="1" name="new_qty" value="" class="form-control" placeholder=" Quantity" required>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Date -->
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-example-int mg-t-15 flex-space-end">
                                        <div>
                                            <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                                Add Stock
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="">
                                        <div class="">
                                            <table id="" class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>DOP</th>
                                                        <th>Qty Added</th>
                                                        <th>&nbsp;</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $q3 = "SELECT * FROM `stock_request` WHERE fkProductId = $txtid";
                                                    $r3 = sql_query($q3);
                                                    $num_rows = sql_num_rows($r3);
                                                    if ($num_rows > 0) {
                                                        for ($i = 1; $o = sql_fetch_object($r3); $i++) {
                                                            $id = $o->id;
                                                            $fk_prod_id = $o->fkProductId;
                                                            $date_of_pruch = $o->requestDate;
                                                            $no_of_items = $o->noOfItems;

                                                            $del_link = $edit_page . "?m=DELETE_STOCK&id=" . $fk_prod_id . "&psid=" . $id . "&qty=" . $no_of_items;
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $date_of_pruch; ?></td>
                                                                <td><?php echo $no_of_items = $o->noOfItems;; ?></td>
                                                                <td>
                                                                    <button onclick="ConfirmDelete('<?php echo $del_link; ?>', 'inventory')" type="button" class="btn btn-danger danger-icon-notika waves-effect">
                                                                        Delete
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    </div>
</body>
<!-- Start Footer area-->
<?php include "_footer.php"; ?>
</body>

</html>