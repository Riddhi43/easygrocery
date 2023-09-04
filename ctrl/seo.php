<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "SEO";

$edit_page = "seo.php";
// initiall value of m is ""
if (isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
} else if (isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode = $_GET["m"];
} else {
    $mode = "R";
}

if ($mode == "R") {
    //edit
    $q = "SELECT * FROM site_seo";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $seo_title = $o->title;
    $seo_keyword = $o->keyword;
    $seo_desc = $o->description;

    $form_mode = "U";
} else if ($mode == "U") {
    //update
    $txtid = 1;
    $seo_title = $_POST["seo_title"];
    $seo_keyword = $_POST["seo_keyword"];
    $seo_desc = $_POST["seo_desc"];

    $q = "UPDATE site_seo SET title='$seo_title', keyword='$seo_keyword', description='$seo_desc' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "SEO successfully updated";
    header("location: " . $edit_page);
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
                    <div class="form-element-list">
                        <div class="basic-tb-hd">
                            <h2><?php echo $PAGE_TITLE; ?></h2>
                            <?php echo $sess_info_str; ?>
                        </div>
                        <form action="<?php echo $edit_page; ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="m" value="<?php echo $form_mode; ?>">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="seo_title" value="<?php echo $seo_title; ?>" class="form-control" placeholder="Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="seo_keyword" value="<?php echo $seo_keyword; ?>" class="form-control" placeholder="Keywords" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                                    <div class="">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <label class="lable-style">Description</label>
                                            </div>
                                        </div>
                                        <textarea name="seo_desc" class="html-editor">
                                        <?php echo $seo_desc; ?>
                                    </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15 flex-space-end">
                                <div>
                                    <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                        Save
                                    </button>
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