<?php
// $NO_REDIRECT = 1;
include '../inc/ad.common.php';
$PAGE_TITLE = "Users";

$edit_page = "user-edit.php";

$q = "SELECT u.*, ul.title FROM `user` u JOIN user_role ul ON u.fkRoleId=ul.id WHERE u.fkRoleId > 1";
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
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Start Header Top Area -->
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
                            <a class="btn btn-info info-icon-notika waves-effect" href="<?php echo $edit_page; ?>">Add</a>
                        </div>
                        <div class="table-responsive">
                            <table id="data-table-basic" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Last Login</th>
                                        <th>Status</th>
                                        <th>&nbsp;</th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($num_rows > 0) {
                                        // retrives data from database
                                        for ($i = 1; $o = sql_fetch_object($r); $i++) {
                                            $sr_no = $i . '.';
                                            $id = $o->id;
                                            $name = $o->name;
                                            $user_name = $o->username;
                                            $role = $o->fkRoleId;
                                            $title = $o->title;
                                            $last_login = $o->lastLogin;
                                            $status = $o->status;

                                            $edit_link = $edit_page . "?m=R&id=" . $id;
                                            $del_link = $edit_page . "?m=D&id=" . $id;
                                    ?>
                                            <tr>
                                                <td><?php echo $sr_no; ?></td>
                                                <td><?php echo $name; ?></td>
                                                <td><?php echo $user_name; ?></td>
                                                <td><?php echo $title; ?></td>
                                                <td><?php echo $last_login; ?></td>
                                                <td><?php echo isset($STATUS_ARR[$status]) ? $STATUS_ARR[$status] : "-"; ?></td>
                                                <td>
                                                    <a class="btn btn-warning notika-btn-success waves-effect" href="<?php echo $edit_link; ?>">Edit
                                                    </a>
                                                </td>
                                                <td>
                                                    <button onclick="ConfirmDelete('<?php echo $del_link; ?>', 'User')" type="button" class="btn btn-danger danger-icon-notika waves-effect">Delete</button>
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