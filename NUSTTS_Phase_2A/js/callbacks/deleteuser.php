<?php
include "../../dbconn.php";
session_start();
$deletedata = "DELETE FROM nususerdata WHERE id = ".$_POST['userid']."";
$conn->query($deletedata);
$_SESSION['deleted'] = time();

?>