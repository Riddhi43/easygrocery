<?php
include "./inc/cu.common.php";
$msg = "";
if (isset($_REQUEST['email_submit'])) {
    $email = $_POST['email'];
    $q = "SELECT * FROM customer WHERE custEmail='$email'";
    $r = sql_query($q);
    $res = sql_num_rows($r);
    if ($res) {
        header("Location: passwordreset.php?email=" . urlencode($email));
        exit();
    } else {
        $msg = "This Email is not registered";
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
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <?php include "_header.php"; ?>

    <div class="container-fluied my-3">
        <div id="LBL_INFO" class="text-center"></div>
        <h2 class="text-center">Email Check</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-xl-4">
                <form action="" method="post">
                    <div class="form-outline mb-3">
                        <input type="email" id="email" placeholder="Enter your register Email" class="form-control" name="email" autocomplete="off" required="required">
                    </div>
                    <div class="col-lg-12 text-center">
                        <button type="submit" class="site-btn" id="email_submit" name="email_submit">Submit</button>
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