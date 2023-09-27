<?php
$sender="onlineproductsellingapp@gmail.com";
$receiver="dennis7napil@gmail.com";
$to = $receiver;
$subject = "Test2";
$txt = "Hello! This is an NEW email test for php";
$headers = "From: ".$sender;

mail($to,$subject,$txt,$headers);
?>