<!DOCTYPE html>
<?php
include "./inc/cu.common.php";
$name = isset($_POST['f_name']) ? $_POST['f_name'] : '';
$email = isset($_POST['f_email']) ? $_POST['f_email'] : '';
$message = isset($_POST['f_message']) ? $_POST['f_message'] : '';
if (!empty($name) && !empty($email) && !empty($message)) {

    $nid = NextId("id", "customer_feedback");
    $q = "INSERT INTO customer_feedback(id, custName, custEmail, custMsg) VALUES ($nid, '$name', '$email', '$message')";
    $r = sql_query($q);
    if (sql_affected_rows($r)) {
        echo '<script>alert("Thank You..! Your Feedback is Valuable to Us"); location.replace(document.referrer);</script>';
    }
}

?>
<html>

<script type="text/javascript">
    $(document).ready(function() {
        lbl_info("<?php echo $thankYouMessage; ?>");
    });
</script>

</html>