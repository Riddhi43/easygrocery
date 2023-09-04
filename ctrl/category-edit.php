<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Category Edit";

$edit_page = "category-edit.php";
$del_page = $edit_page . "?m=D&id=";
$category_display = "category.php";

// initiall value of m is ""
if (isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
} else if (isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode = $_GET["m"];
} else {
    $mode = "A";
}

//id
if (isset($_POST['id']) && is_numeric($_POST['id'])) {
    $txtid = $_POST['id'];
} else if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $txtid = $_GET['id'];
} else {
    $mode = "A";
}

if ($mode == 'A') {
    $txtid = 0;
    $cat_title = "";
    $cat_img = "img/blank-img.png";
    $cat_desciption = "";
    $status = "A";

    $form_mode = 'C';
} else if ($mode == 'C') {
    //insert
    $txtid = NextId("id", "category");
    $cat_title = $_POST["cat_title"];
    $cat_desciption = $_POST["cat_desciption"];
    $status = $_POST["active"];

    $q = "INSERT INTO category(id, title, description, status) values ('$txtid', '$cat_title', '$cat_desciption', '$status')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "New category created successfully";
} else if ($mode == "R") {
    //edit
    $q = "SELECT * FROM category WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $cat_title = $o->title;
    $cat_img = (!empty($o->image)) ? CAT_IMG_PATH . $o->image : "img/blank-img.png";
    $cat_desciption = $o->description;
    $status = $o->status;

    $form_mode = "U";
} else if ($mode == "U") {
    //update
    $txtid = $_POST["id"];
    $cat_title = $_POST["cat_title"];
    $cat_desciption = $_POST["cat_desciption"];
    $status = $_POST["active"];

    $q = "UPDATE category SET title='$cat_title', description='$cat_desciption', status='$status' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Category successfully updated";
} else if ($mode == "D") {
    $ref_arr = [];
    $ref_arr["Product"] = validateReference("product", "categoryId", $txtid);

    if (!array_sum($ref_arr)) {
        $q = "DELETE FROM category WHERE id=$txtid";
        $r = sql_query($q);
        $_SESSION[AD_SESSION_ID]->success_info = "Category successfully deleted";
    } else {
        $dep = Array2String($ref_arr);
        $_SESSION[AD_SESSION_ID]->alert_info = "Could not delete category due to existing dependencies of " . $dep;
    }

    header("location: " . $category_display);
    exit;
}

if ($mode == 'C' || $mode == 'U') {
    // for image create and update
    if (is_uploaded_file($_FILES["cat_img"]["tmp_name"])) {
        $uploaded_pic = $_FILES["cat_img"]["name"];
        $name = basename($_FILES['cat_img']['name']);
        $file_type = $_FILES['cat_img']['type'];
        $size = $_FILES['cat_img']['size'];
        $extension = substr($name, strrpos($name, '.') + 1);

        $q = "SELECT image, title FROM category WHERE id='$txtid'";
        $r = sql_query($q);

        list($img, $title) = sql_fetch_row($r);
        //check if the img exist 
        if (!empty($img)) {
            $image = CAT_IMG_UPLOAD . $img;

            if (file_exists($image)) {
                unlink($image);
            }
        }

        $renamed_img = $title . '.' . $extension;
        $setdir = opendir(CAT_IMG_UPLOAD);
        copy($_FILES["cat_img"]["tmp_name"], CAT_IMG_UPLOAD . $renamed_img);
        closedir($setdir);

        $q1 = "UPDATE category SET image='$renamed_img' WHERE id='$txtid'";
        $r1 = sql_query($q1);
    }
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
                                <div class="col-lg-12 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="cat_title" value="<?php echo $cat_title; ?>" class="form-control" placeholder="Category Title" required>
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
                                                <label class="lable-style">Category Description</label>
                                            </div>
                                        </div>
                                        <textarea name="cat_desciption" class="html-editor">
                                        <?php echo $cat_desciption; ?>
                                    </textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-file-image-o" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <label class="lable-style">Upload Image</label>
                                            </div>
                                        </div>
                                        <div class="m-12">
                                            <div class="uploaded-img">
                                                <img src="<?php echo $cat_img; ?>" alt="" />
                                            </div>
                                            <input type="file" name="cat_img" value="" class="" placeholder="Category Image">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group">
                                        <div class="radio-area">
                                            <div class="">
                                                <b>Status:</b>
                                            </div>
                                            <div class="fm-checkbox">
                                                <label>
                                                    <input type="radio" <?php echo ($status == "A") ? "checked" : ""; ?> value="A" name="active" class="i-checks">
                                                    <i></i>
                                                    Active
                                                </label>
                                            </div>

                                            <div class="fm-checkbox">
                                                <label>
                                                    <input type="radio" <?php echo ($status == "I") ? "checked" : ""; ?> value="I" name="active" class="i-checks">
                                                    <i></i>
                                                    Inactive
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-example-int mg-t-15 flex-space-end">
                                <div>
                                    <a href="<?php echo $category_display; ?>" class="btn btn-warning warning-icon-notika waves-effect">
                                        Back
                                    </a>
                                    <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                        Save
                                    </button>
                                    <button onclick="ConfirmDelete('<?php echo $del_page . $txtid; ?>', 'Category')" type="button" class="btn btn-danger danger-icon-notika waves-effect">
                                        Delete
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