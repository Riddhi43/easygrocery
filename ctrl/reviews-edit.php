<?php
include '../inc/ad.common.php';

$edit_page = "reviews-edit.php";
$del_page = $edit_page."?m=D&id=";
$reviews_display = "reviews.php";

if (isset($_POST["reviewId"]) && isset($_POST["status"])) {
    $reviewId = $_POST["reviewId"];
    $status = $_POST["status"];

    $q = "UPDATE product_ratings SET status='$status' WHERE id='$reviewId'";
    $r = sql_query($q);
    $_SESSION[AD_SESSION_ID]->success_info = "Status updated successfully";

    //header("location: " . $edit_page . "?m=R&id=" . $reviewId);
    exit;
}

// initiall value of m is ""
if(isset($_POST["m"]) && !empty($_POST['m'])) {
    $mode = $_POST["m"];
}
else if(isset($_GET["m"]) && !empty($_GET['m'])) {
    $mode =$_GET["m"];
}
else {
    $mode = "A";
}

//id
if(isset($_POST['id']) && is_numeric($_POST['id'])) {
    $txtid = $_POST['id'];
} 
else if(isset($_GET['id']) && is_numeric($_GET['id'])) {
    $txtid = $_GET['id'];
}
else {
    $mode = "A";
}

if($mode == 'A'){
    $txtid = 0;
    $prodId = "";
    $prod_price = "";
    $prod_desc = "";
    $status = "A";
}else if($mode == "D"){
    $q = "DELETE FROM product_ratings WHERE id=$txtid";
    $r = sql_query($q);
    
    $_SESSION[AD_SESSION_ID]->success_info = "Review successfully deleted"; 
    header("location: ".$reviews_display);
    exit;
}
