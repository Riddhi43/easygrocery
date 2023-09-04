<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Customer's Information";

$edit_page = "customer-edit.php";
$customer_display = "customer.php";
$order_page = "order-edit.php";

// stores the id of the selected customer
$txtid = $_GET['id'];

// function call to get details of the customer
$cust_details = get_det_arr($txtid);

// function call to get address of the customer
$cust_add = get_add_arr($txtid);

// function to get all the orders of the customer
$cust_order = get_order_arr($txtid);
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
    <!-- Start Header Top Area -->
    <?php include "_header.php"; ?>
    <?php include "_menu.php"; ?>

    <!-- Data Table area Start-->
    <div class="data-table-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="data-table-list">
                        <div class="basic-tb-hd flex-space">
                            <h2>
                                <?php echo $PAGE_TITLE; ?>
                            </h2>
                        </div>
                        <div class="">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12">
                                    <div class="contact-inner">
                                        <div class="contact-hd widget-ctn-hd">
                                            <h2>Personal Details</h2>
                                        </div>
                                        <div class="contact-dt">
                                            <ul class="contact-list widget-contact-list">
                                                <?php
                                                //pr_arr($cust_details);
                                                foreach ($cust_details as $arr_ind => $arr_blck) {
                                                ?>
                                                    <li><b>Name:</b> <?php echo $arr_blck->custName; ?></li>
                                                    <li><b>Phone Number:</b> <?php echo $arr_blck->custNumber; ?></li>
                                                    <li><b>Email:</b> <?php echo $arr_blck->custEmail; ?></li>
                                                <?php
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <div class="contact-inner">
                                        <div class="contact-hd widget-ctn-hd">
                                            <h2>Addresses</h2>
                                        </div>
                                        <div class="contact-dt">
                                            <ul class="contact-list widget-contact-list">
                                                <?php
                                                //pr_arr($cust_add);
                                                foreach ($cust_add as $arr_ind => $arr_blck) {
                                                    echo '<li>';
                                                    echo "<b>$arr_blck->title: </b>" . $arr_blck->address;
                                                    echo '</li>';
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="invoice-sp">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order Type</th>
                                                    <th>Order Date</th>
                                                    <th>Payment method</th>
                                                    <th>Shipping Address</th>
                                                    <th>Total Amount</th>
                                                    <th>&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                //pr_arr($cust_order);
                                                $i = 1;
                                                foreach ($cust_order as $arr_ind => $arr_blck) {
                                                    $order_edit_link = $order_page . "?m=R&id=" . $arr_blck->id;
                                                ?>
                                                    <tr>
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $arr_blck->orderType; ?></td>
                                                        <td><?php echo $arr_blck->orderDate; ?></td>
                                                        <td><?php echo $arr_blck->paymentMethod; ?></td>
                                                        <td><?php echo $arr_blck->shippingAddress; ?></td>
                                                        <td><?php echo $arr_blck->totalAmount; ?></td>
                                                        <td>
                                                            <a class="btn btn-primary notika-btn-primary waves-effect" href="<?php echo $order_edit_link; ?>">
                                                                View Order
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $i++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15 flex-space-end">
                                <div>
                                    <a href="<?php echo $customer_display; ?>" class="btn btn-warning warning-icon-notika waves-effect">
                                        Back
                                    </a>
                                </div>
                            </div>
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