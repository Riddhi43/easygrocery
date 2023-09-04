<?php
include '../inc/ad.common.php';
session_destroy();
header("location: index.php");
exit;
?>