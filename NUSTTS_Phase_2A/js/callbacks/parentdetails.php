<?php
include "../../dbconn.php";
session_start();

if(empty($_SESSION['client'])) {
	$getdatas = "SELECT * FROM clientcompanydata WHERE parentcompany='".$_POST['parentId']."' and state='Active'
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
	$getdatas = "SELECT * FROM clientcompanydata WHERE id IN (".$res.") ORDER BY clientcompanydata.clientcompany ASC;";
}


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