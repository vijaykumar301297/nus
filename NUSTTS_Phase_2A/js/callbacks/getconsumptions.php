<?php
include "../../dbconn.php";

$selectsupplyid = "SELECT consumptionmonth FROM nus_supply_contract WHERE supplierId =".$_POST['suplierid']."";
$result = $conn->query($selectsupplyid);
$consumption = 0;
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $consumption = $row['consumptionmonth'];
	}
}
$tradconsumption = explode('|',$consumption);
if($_POST['type'] == 'Calendar Quarterly'){
	$q1 = ['Jan','Feb','Mar'];
	$q2 = ['Apr','May','Jun'];
	$q3 = ['July','Aug','Sep'];
	$q4 = ['Oct','Nov','Dec'];
	$totalvalconsumption = array();
	
	foreach ($tradconsumption as $key => $value) {
		$keyval = explode('-',$value);

		if($_POST['quarterval'] == 'q1'){
			if(in_array($keyval[0],$q1) && $keyval[1] == $_POST['year']){
				$totalvalconsumption[] = $keyval[2];
			}
		}
		if($_POST['quarterval'] == 'q2'){
			if(in_array($keyval[0],$q2) && $keyval[1] == $_POST['year']){
				$totalvalconsumption[] = $keyval[2];
			}
		}
		if($_POST['quarterval'] == 'q3'){
			if(in_array($keyval[0],$q3) && $keyval[1] == $_POST['year']){
				$totalvalconsumption[] = $keyval[2];
			}
		}
		if($_POST['quarterval'] == 'q4'){
			if(in_array($keyval[0],$q4) && $keyval[1] == $_POST['year']){
				$totalvalconsumption[] = $keyval[2];
			}
		}
	}
	echo $totalconsu = array_sum($totalvalconsumption);
}else if($_POST['type'] == 'Calendar Monthly'){
	$months = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
	$totalvalconsumption = array();
	foreach ($tradconsumption as $key => $value) {
		$keyval = explode('-',$value);
		if($_POST['quarterval'] == $keyval[0] && $keyval[1] == $_POST['year']){
			$totalvalconsumption[] = $keyval[2];
		}
	}
	echo $totalconsu = array_sum($totalvalconsumption);
}else if($_POST['type'] == 'Season'){
	$totalvalconsumption = array();
	$q2= ['Oct','Nov','Dec'];
	$q1 = ['Jan', 'Feb', 'Mar'];
    $q8 = ['Apr','May','Jun','July','Aug','Sep'];
	foreach ($tradconsumption as $key => $value) {
		$keyval = explode('-',$value);
		if($_POST['quarterval'] == 'apr-sep'){
			if($_POST['year'] == $keyval[1] && in_array($keyval[0], $q8)){
				$totalvalconsumption[] = $keyval[2];
			}
		}
		if($_POST['quarterval'] == 'oct-mar'){
			if(((in_array($keyval[0], $q2)) && $_POST['year']-1 ==$keyval[1] ) || ( (in_array($keyval[0], $q1)) && ($_POST['year'] ==$keyval[1] ))){
				$totalvalconsumption[] = $keyval[2];
			}
		}
	}
	echo $totalconsu = array_sum($totalvalconsumption);
}
// echo $consumption;
// $deletedata = "DELETE FROM nus_supply_contract WHERE supplierId = ".$_POST['supplierid']."";
// $conn->query($deletedata);

// if($_POST['contracttype'] != 'fixed'){
// 	 $delsql = "DELETE FROM nus_tradeperiods WHERE supplierId=".$_GET['supplierid']."";
//     $conn->query($delsql);
// }
// $_SESSION['deleted'] = time();

?>