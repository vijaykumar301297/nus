<?php

include 'dbconn.php';

$sql = "SELECT * FROM nususerdata WHERE emailId = 'admin1@nusconsulting.com';";
$res = $conn->query($sql);

$row = mysqli_fetch_assoc($res);

print_r($row);

date_default_timezone_set('Asia/Kolkata');
$from = strtotime('2023-07-1');
$today = time();
$difference = $from - $today;
echo floor($difference / 86400);  // (60 * 60 * 24)


?>