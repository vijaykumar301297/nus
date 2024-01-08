<?php
include "../../dbconn.php";
session_start();
$deletedata = "DELETE FROM nus_supply_contract WHERE supplierId = ".$_POST['supplierid']."";
$conn->query($deletedata);

if($_POST['contracttype'] != 'fixed'){
	 $delsql = "DELETE FROM nus_tradeperiods WHERE supplierId=".$_GET['supplierid']."";
    $conn->query($delsql);
}
$_SESSION['deleted'] = time();

?>