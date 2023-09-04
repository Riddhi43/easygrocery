<?php
include "./inc/cu.common.php";
$email = $_GET['email'];
$msg = "";
if (isset($_REQUEST['pwdrest'])) {
    $pwd = md5($_REQUEST['pwd']);
    $cpwd = md5($_REQUEST['cpwd']);
    if ($pwd == $cpwd) {
        $q = "UPDATE customer SET password='$pwd' WHERE custEmail='$email' ";
        $r = sql_query($q);
        if (sql_affected_rows($r)) {
            header("Location: password_success.php");
            exit;
        } else {
            $msg = "Error while updating password.";
        }
    } else {
        $msg = "New Password and Confirm Password do not match";
    }
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php
    site_seo();
    include "_header_links.php";
    ?>
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "_header.php"; ?>

    <div class="container-fluied my-3">
        <div id="LBL_INFO" class="text-center"></div>
        <h2 class="text-center">Reset Password</h2>
        <div class=" row d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-3">
                        <input type="password" class="form-control" id="pwd" placeholder="New Password" name="pwd" autocomplete="off" required="required">
                    </div>
                    <div class="form-outline mb-3">
                        <input type="password" class="form-control" id="cpwd" placeholder="Confirm Password" name="cpwd" autocomplete="off" required="required">
                    </div>
                    <div class="col-lg-12 text-center">
                        <input type="submit" id="pwdrest" name="pwdrest" value="Reset Password" class="site-btn" />
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "_footer.php"; ?>
    <script type="text/javascript">
        $(document).ready(function() {
            lbl_info("<?php echo $msg; ?>");
        });
    </script>
</body>

</html>