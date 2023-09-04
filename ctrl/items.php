<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Products";
//items = products
$edit_page = "item-edit.php";
//query 
$q = "SELECT * FROM `product`";
$r = sql_query($q);
$num_rows = sql_num_rows($r);
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $PAGE_TITLE; ?></title>
    <meta name="description" content="">
    <?php include "_header_links.php"; ?>
</head>

<body>
    <?php include "_header.php"; ?>
    <?php include "_menu.php"; ?>

    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $sess_info_str; ?>
                    <div class="data-table-list">
                        <div class="basic-tb-hd flex-space">
                            <h2>
                                <?php echo $PAGE_TITLE; ?>
                            </h2>
                            <?php if (!$is_support) { ?>
                                <a class="btn btn-info info-icon-notika waves-effect" href="<?php echo $edit_page; ?>">Add</a>
                            <?php } ?>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Product Price</th>
                                        <th>Sale Price</th>
                                        <th>Qty</th>
                                        <th>&nbsp;</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <?php if (!$is_support) { ?>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($num_rows > 0) {
                                        //displays the data from database table
                                        for ($i = 1; $o = sql_fetch_object($r); $i++) {
                                            $sr_no = $i . '.';
                                            $id = $o->id;
                                            $prod_name = $o->productName;
                                            $prod_price = $o->productPrice;
                                            $sale_price = $o->salePrice;
                                            $prod_qty = $o->productQty;
                                            $prod_img = !empty($o->productImg) ? CAT_IMG_PATH . $o->productImg : BLANK_IMAGE;
                                            $cat_desciption = $o->productDesc;
                                            $status = $o->status;

                                            $edit_link = $edit_page . "?m=R&id=" . $id;
                                            $del_link = $edit_page . "?m=D&id=" . $id;
                                    ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $prod_name; ?></td>
                                                <td><?php echo $prod_price; ?></td>
                                                <td><?php echo $sale_price; ?></td>
                                                <td><?php echo $prod_qty; ?></td>
                                                <td><img src="<?php echo $prod_img; ?>" alt="" width="50px" /></td>
                                                <td><?php echo $cat_desciption; ?></td>
                                                <td><?php echo isset($STATUS_ARR[$status]) ? $STATUS_ARR[$status] : "-"; ?></td>
                                                <?php if (!$is_support) { ?>
                                                    <td>
                                                        <a class="btn btn-warning notika-btn-success waves-effect" href="<?php echo $edit_link; ?>">
                                                            Edit
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <button onclick="ConfirmDelete('<?php echo $del_link; ?>', 'Product')" type="button" class="btn btn-danger danger-icon-notika waves-effect">Delete</button>
                                                    </td>
                                                <?php } ?>
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
    <!-- Data Table area End-->

    <!-- Start Footer area-->
    <?php include "_footer.php"; ?>
</body>

</html>