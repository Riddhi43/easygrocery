<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Customer Feedback Edit";

$edit_page = "customer-feedback-edit.php";
$feedback_display = "customer-feedback.php";

// initial value of mode is ""
if (isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
} else if (isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode = $_GET["m"];
} else {
    $mode = "A";
}

// id
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $txtid = $_POST['id'];
} else if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $txtid = $_GET['id'];
} else {
    $txtid = 0; // Reset txtid to 0 if no valid id is provided
}

if ($mode == 'A') {
    $custname = "";
    $custemail = "";
    $custmsg = "";
    $reply = "";

    $form_mode = 'C';
} else if ($mode == 'C') {
    // insert
    $txtid = NextId("id", "customer_feedback");
    $custname = $_POST["cust_name"];
    $custemail = $_POST["cust_email"];
    $custmsg = $_POST["custmsg"];
    $reply = $_POST["admin_reply"];

    $q = "INSERT INTO customer_feedback(id, custName, custEmail, custMsg, adminReply) VALUES ('$txtid', '$custname', '$custemail', '$custmsg', '$reply')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Reply sent successfully";
} else if ($mode == "R") {
    // edit
    $q = "SELECT * FROM customer_feedback WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);
    $id = $o->id;
    $custname = $o->custName;
    $custemail = $o->custEmail;
    $custmsg = $o->custMsg;
    $reply = $o->adminReply;

    $form_mode = "U";
} else if ($mode == "U") {
    // update
    $custname = $_POST["cust_name"];
    $custemail = $_POST["cust_email"];
    $custmsg = $_POST["custmsg"];
    $reply = $_POST["admin_reply"];

    $q = "UPDATE customer_feedback SET custName='$custname', custEmail='$custemail', custMsg='$custmsg', adminReply='$reply' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Reply updated successfully";
}

if ($mode == 'C' || $mode == 'U') {
    $q1 = "UPDATE customer_feedback SET adminReply='$reply' WHERE id='$txtid'";
    $r1 = sql_query($q1);
    header("location: " . $edit_page . "?m=R&id=" . $txtid);
    exit;
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
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <?php echo $sess_info_str; ?>
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
                                        <div class="nk-int-st">
                                            <input type="text" name="cust_name" value="<?php echo $custname; ?>" class="form-control" placeholder="Customer Name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="cust_email" value="<?php echo $custemail; ?>" class="form-control" placeholder="Customer Email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                                    <div class="">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <label class="lable-style">Customer Message</label>
                                            </div>
                                        </div>
                                        <textarea name="custmsg" class="html-editor">
                                        <?php echo $custmsg; ?>
                                    </textarea>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                                    <div class="">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <label class="lable-style">Write to customer</label>
                                            </div>
                                        </div>
                                        <textarea name="admin_reply" class="html-editor">
                                        <?php echo $reply; ?>
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15 flex-space-end">
                                <div>
                                    <a href="<?php echo $feedback_display; ?>" class="btn btn-warning warning-icon-notika waves-effect">
                                        Back
                                    </a>
                                    <?php if ($reply === '') { ?>
                                        <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                            Send
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Start Footer area-->
    <?php include "_footer.php"; ?>
</body>

</html>