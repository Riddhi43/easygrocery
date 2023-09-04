<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Customer Feedback";

$edit_page = "customer-feedback-edit.php";
//query 
$q = "SELECT * FROM `customer_feedback`"; //WHERE fkRoleId > 1";
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
                                        <th>Name</th>
                                        <th>Customer Email</th>
                                        <th>Customer Message</th>
                                        <th>Reply</th>
                                        <th>Action</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($num_rows > 0) {
                                        // displays the items
                                        for ($i = 1; $o = sql_fetch_object($r); $i++) {
                                            $sr_no = $i . '.';
                                            $id = $o->id;
                                            $name = $o->custName;
                                            $cust_email = $o->custEmail;
                                            $cust_msg = $o->custMsg;
                                            $reply = $o->adminReply;

                                            $edit_link = $edit_page . "?m=R&id=" . $id;

                                    ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $cust_email; ?></td>
                                                <td><?php echo $cust_msg; ?></td>
                                                <td><?php echo $reply; ?></td>
                                                <td>
                                                    <?php if ($reply === null || $reply === "") { ?>
                                                        <a class="btn btn-primary notika-btn-success waves-effect" href="<?php echo $edit_link; ?>">
                                                            Send Reply
                                                        </a>
                                                    <?php } else { ?>
                                                        <a class="btn btn-info notika-btn-info waves-effect" href="<?php echo $edit_link; ?>">
                                                            View
                                                        </a>
                                                    <?php } ?>
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
    <!-- Data Table area End-->


    <!-- Start Footer area-->
    <?php include "_footer.php"; ?>
</body>

</html>