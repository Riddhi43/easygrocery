<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Customers";

$edit_page = "customer-edit.php";
//query 
$q = "SELECT * FROM `customer`"; //WHERE fkRoleId > 1";
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
                                        <th>Username</th>
                                        <th>Customer No.</th>
                                        <th>Customer Email</th>
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
                                            $user_name = $o->userName;
                                            $cust_no = $o->custNumber;
                                            $cust_email = $o->custEmail;

                                            $edit_link = $edit_page . "?id=" . $id;

                                    ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $user_name; ?></td>
                                                <td><?php echo $cust_no; ?></td>
                                                <td><?php echo $cust_email; ?></td>
                                                <td>
                                                    <a class="btn btn-warning notika-btn-success waves-effect" href="<?php echo $edit_link; ?>">
                                                        View
                                                    </a>
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