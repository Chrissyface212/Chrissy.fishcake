
    <p>Thanks for shopping</p>

<?php
$mailAddress = $_REQUEST['email'];
$to = "$mailAddress";
$subject = "invoice";
$txt = "Thanks for shopping";
$headers = "From: Student@uts.com";
mail($to,$subject,$txt,$headers);
?>


