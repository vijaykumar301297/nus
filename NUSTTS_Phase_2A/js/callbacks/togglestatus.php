<?php
include "../../dbconn.php";

$userstatus = 'A';
if($_POST['status'] == 'A'){
	$userstatus ='U';
}
$sql = "UPDATE nususerdata SET userstatus='".$userstatus."' WHERE id = '".$_POST['userid']."'";
$conn->query($sql);
?>