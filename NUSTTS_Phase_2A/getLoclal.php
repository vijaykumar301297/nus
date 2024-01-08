<?php

include "dbconn.php";

ob_start(); //Start output buffer
echo "<script>";
echo "document.write(localStorage.getItem('hedgedConsumption'));";
echo "</script>";
$output = ob_get_contents(); //Grab output
ob_end_clean(); //Discard output buffer

echo $output;

$sqlQuery1 = "INSERT INTO demo_check (name) VALUES ('$output');";
mysqli_query($conn,$sqlQuery1);

?>
