<?php
include "../../dbconn.php";
session_start();

if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') {
    $activeStatus = "AND state = 'Active'";
} else {
    $activeStatus = "";
}

if(empty($_SESSION['client'])) {
	$getdatas = "SELECT * FROM clientcompanydata WHERE parentcompany='".$_POST['parentId']."' ".$activeStatus."
	ORDER BY clientcompanydata.clientcompany ASC";
} else {
	$inp = $_SESSION['client'];
	$arr = explode(" ", 	trim($inp));
	$arrLength = count($arr);
	$x='';
	for($i = 0 ;$i<$arrLength; $i++){
	  $x = $arr[$i].",".$x;
	}
	$res =  trim($x, ",");
	// echo $res;
	$getdatas = "SELECT * FROM clientcompanydata WHERE id IN (".$res.") ".$activeStatus." ORDER BY clientcompanydata.clientcompany ASC;";
}

echo $getdatas;
$result = $conn->query($getdatas);

$printdata = '';
$printdata.='<option value="">Please Select clients</option>';
// $printdata.='<option value="">'.$getdatas.'</option>';
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $printdata.='<option value='.$row['id'].'>'.$row['clientcompany'].' - '.$row['country'].'</option>';
	}
}
echo $printdata;
?>