<?php
include '../inc/ad.common.php';
$PAGE_TITLE = "Product Edit";

$edit_page = "item-edit.php";
$del_page = $edit_page . "?m=D&id=";
$item_display = "items.php";

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
//  PRODUCT MODES
if ($mode == 'A') {
    $txtid = 0;
    $prod_name = "";
    $prod_price = "";
    $category = "";
    $sale_price = "";
    $prod_qty = "";
    $prod_img = BLANK_IMAGE;
    $prod_desc = "";
    $prod_more_desc = "";
    $status = "A";

    $form_mode = 'C';
} else if ($mode == 'C') {
    //insert
    $txtid = NextId("id", "product");
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $category = $_POST["fk_category_id"];
    $sale_price = ($_POST["sale_price"] === "" || $_POST["sale_price"] === "0") ? NULL :  $_POST["sale_price"];
    $prod_desc = $_POST["prod_desc"];
    $prod_more_desc = $_POST["prod_more_desc"];
    echo $prod_more_desc;
    $status = $_POST["active"];

    $q = "INSERT INTO product(id,categoryId productName,productPrice, salePrice, productDesc, status, productMoreDesc) values ('$txtid', '$category','$prod_name', '$prod_price', $sale_price, '$prod_desc', '$status', '$prod_more_desc')";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "New product created successfully";
} else if ($mode == "R") {
    //edit
    $q = "SELECT * FROM product WHERE id='$txtid'";
    $r = sql_query($q);
    $o = sql_fetch_object($r);

    $id = $o->id;
    $prod_name = $o->productName;
    $prod_price = $o->productPrice;
    $sale_price = $o->salePrice;
    $category = $o->categoryId;
    $prod_img = !empty($o->productImg) ? PROD_IMG_PATH . $o->productImg : BLANK_IMAGE;
    $prod_desc = $o->productDesc;
    $prod_more_desc = $o->productMoreDesc;
    $status = $o->status;

    $form_mode = "U";
} else if ($mode == "U") {
    //update
    $txtid = $_POST["id"];
    $category = $_POST["fk_category_id"];
    $prod_name = $_POST["prod_name"];
    $prod_price = $_POST["prod_price"];
    $sale_price = ($_POST["sale_price"] === "" || $_POST["sale_price"] === "0") ? NULL :  $_POST["sale_price"];
    $prod_desc = $_POST["prod_desc"];
    $prod_desc = $_POST["prod_desc"];
    $prod_more_desc = $_POST["prod_more_desc"];
    $status = $_POST["active"];

    $q = "UPDATE product SET categoryId='$category',productName='$prod_name', productPrice='$prod_price', salePrice='$sale_price', productDesc='$prod_desc', status='$status', productMoreDesc='$prod_more_desc' WHERE id='$txtid'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Product successfully Updated";
} else if ($mode == "D") {
    $q = "DELETE FROM product WHERE id=$txtid";
    $r = sql_query($q);

    $_SESSION[AD_SESSION_ID]->success_info = "Product successfully deleted";
    header("location: " . $item_display);
    exit;
}

if ($mode == 'C' || $mode == 'U') {
    if (is_uploaded_file($_FILES["prod_img"]["tmp_name"])) {
        $uploaded_pic = $_FILES["prod_img"]["name"];
        $name = basename($_FILES['prod_img']['name']);
        $file_type = $_FILES['prod_img']['type'];
        $size = $_FILES['prod_img']['size'];
        $extension = substr($name, strrpos($name, '.') + 1);

        $q = "SELECT productImg, productName FROM product WHERE id='$txtid'";
        $r = sql_query($q);

        list($img, $name) = sql_fetch_row($r);
        //check if the img exists 
        if (!empty($img)) {
            $image = PROD_IMG_UPLOAD . $img;

            if (file_exists($image)) {
                unlink($image);
            }
        }
        // renaming the image with extension
        $renamed_img = $name . '.' . $extension;
        $setdir = opendir(PROD_IMG_UPLOAD);
        copy($_FILES["prod_img"]["tmp_name"], PROD_IMG_UPLOAD . $renamed_img);
        closedir($setdir);

        $q1 = "UPDATE product SET productImg='$renamed_img' WHERE id='$txtid'";
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
            <?php echo $sess_info_str; ?>
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                            <input type="text" name="prod_name" value="<?php echo $prod_name; ?>" class="form-control" placeholder="Product Title" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="prod_price" value="<?php echo $prod_price ?>" class="form-control" placeholder="Product Price" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="form-group ic-cmp-int">
                                        <div class="form-ic-cmp">
                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                        </div>
                                        <div class="nk-int-st">
                                            <input type="text" name="sale_price" value="<?php echo $sale_price; ?>" class="form-control" placeholder="Sale Price">
                                        </div>
                                    </div>
                                </div>
                                <div class="">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="form-group ic-cmp-int">
                                            <div class="form-ic-cmp">
                                                <i class="fa fa-file-text" aria-hidden="true"></i>
                                            </div>
                                            <div class="nk-int-st">
                                                <input type="text" name="prod_desc" value="<?php echo $prod_desc; ?>" class="form-control" placeholder="Product Description" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                        <div class="nk-int-st">
                                            <select name="fk_category_id" class="form-control select-form-control">
                                                <?php
                                                $q2 = "SELECT id, title FROM category ";
                                                $r2 = sql_query($q2);
                                                $num_rows = sql_num_rows($r2);
                                                if ($num_rows > 0) {
                                                    while ($row = sql_fetch_assoc($r2)) {
                                                        $selected = ($row['id'] == $category) ? "selected" : "";
                                                ?>
                                                        <option <?php echo $selected; ?> value="<?php echo $row['id']; ?>">
                                                            <?php echo $row['title']; ?>
                                                        </option>
                                                <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="">
                                <div class="form-group ic-cmp-int">
                                    <div class="form-ic-cmp">
                                        <i class="fa fa-file-text" aria-hidden="true"></i>
                                    </div>
                                    <div class="nk-int-st">
                                        <label class="lable-style">Product Meta Description</label>
                                    </div>
                                </div>
                                <textarea name="prod_more_desc" class="html-editor">
                                        <?php echo $prod_more_desc; ?>
                                    </textarea>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-8">
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
                                                <img src="<?php echo $prod_img; ?>" alt="" />
                                            </div>
                                            <input type="file" name="prod_img" value="" class="" placeholder="Product Image">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">

                                    <div class="form-group">
                                        <div class="radio-area">
                                            <div class="">
                                                Status:
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
                                    <a href="<?php echo $item_display; ?>" class="btn btn-warning warning-icon-notika waves-effect">Back
                                    </a>
                                    <button type="submit" name="submit_btn" class="btn btn-success notika-btn-success waves-effect">
                                        Save
                                    </button>
                                    <button onclick="ConfirmDelete('<?php echo $del_page . $txtid; ?>', 'Product')" type="button" class="btn btn-danger danger-icon-notika waves-effect">
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