<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Product Reviews";

$edit_page = "reviews-edit.php";

$q = "SELECT * FROM `product_ratings`";
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
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>ProductID</th>
                                        <th>Customer Name</th>
                                        <!-- <th>Customer Email</th> -->
                                        <th>Ratings</th>
                                        <th>Reviews</th>
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
                                            $prod_Id = $o->fkProductId;
                                            $cust_Id = $o->fkCustomerID;
                                            $ratings = $o->ratings;
                                            $review = $o->review;;
                                            $status = $o->status;

                                            // Fetch customer information from customer table 
                                            $customer_query = "SELECT custName, custEmail FROM customer WHERE id = '$cust_Id'";
                                            $customer_result = sql_query($customer_query);
                                            $customer_info = sql_fetch_object($customer_result);
                                            $customer_name = $customer_info->custName;
                                            // $customer_email = $customer_info->custEmail;

                                            $edit_link = $edit_page . "?m=R&id=" . $id;
                                            $del_link = $edit_page . "?m=D&id=" . $id;
                                    ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $prod_Id; ?></td>
                                                <td><?php echo $customer_name ?></td>
                                                <!-- <td><?php echo $customer_email ?></td> -->
                                                <td><?php echo $ratings; ?></td>
                                                <td><?php echo $review; ?></td>
                                                <td><?php echo isset($STATUS_ARR[$status]) ? $STATUS_ARR[$status] : "-"; ?></td>
                                                <?php if (!$is_support) { ?>

                                                    <td>
                                                    <td>
                                                        <?php if ($status == 'A') { // Active 
                                                        ?>
                                                            <button onclick="ChangeStatus('<?php echo $id; ?>', 'I')" type="button" class="btn btn-warning danger-icon-notika waves-effect">Deactivate</button>
                                                        <?php } else if ($status == 'I') { // Inactive 
                                                        ?>
                                                            <button onclick="ChangeStatus('<?php echo $id; ?>', 'A')" type="button" class="btn btn-success success-icon-notika waves-effect">Activate</button>
                                                        <?php } ?>
                                                    </td>
                                                    <td>
                                                        <?php if (!$is_support) { ?>
                                                            <button onclick="ConfirmDelete('<?php echo $del_link; ?>', 'Product review')" type="button" class="btn btn-danger danger-icon-notika waves-effect">Delete</button>
                                                        <?php } ?>
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
<script>
    // JavaScript function to handle the status change
    function ChangeStatus(reviewId, status) {
        if (confirm("Are you sure you want to change the status?")) {
            $.ajax({
                url: "reviews-edit.php",
                type: "POST",
                data: {
                    reviewId: reviewId,
                    status: status
                },
                success: function(response) {
                    location.reload();
                },
                error: function(xhr, status, error) {
                    alert('An error occurred while updating the status.');
                }
            });
        }
    }
</script>

</html>