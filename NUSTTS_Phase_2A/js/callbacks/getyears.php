<?php
include '../../dbconn.php';

$type = $_POST['type'];
$sql = '';
if($type == 'Calendar Yearly'){
	$sql = "SELECT calenderyear as years FROM nus_calenderyear WHERE supplierid=".$_POST['suplierid']." AND tradeId = ".$_POST['tranchid']."";
}
if($type == 'Calendar Monthly'){
	$sql = "SELECT year as years FROM nus_calendermonth WHERE supplierId=".$_POST['suplierid']." AND TradeId = ".$_POST['tranchid']."";
}
if($type == 'Calendar Quarterly'){
	$sql = "SELECT yearoftrade as years FROM nus_calenderquarter WHERE supplierid=".$_POST['suplierid']." AND tradeid = ".$_POST['tranchid']."";
}
if($type == 'Season'){
	$sql = "SELECT yeartrade as years FROM nus_season WHERE supplierId=".$_POST['suplierid']." AND tradeId = ".$_POST['tranchid']."";
}
$contract_qry = mysqli_query($conn, $sql);
$arrayofyear = [];
while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$arrayofyear[] = $contract_row['years'];
}
$arryunique = array_unique($arrayofyear);
$printdata ='';
foreach ($arryunique as $key => $value) {
	$printdata .='<option value='.$value.'>'.$value.'</option>';
}
echo $printdata;


// $contract =   $_POST['contractId'];
// $contract_query = "SELECT * FROM nus_supply_contract WHERE contract_id = '".$contract."'";
// $contract_qry = mysqli_query($conn, $contract_query);
// $contractId = array();

// while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
// 	$contractId[] = $contract_row;
// }

// $nustrde_query = "SELECT * FROM nus_tradeperiods WHERE supplierId =".$contractId[0]['supplierId']."";
// $nustrde_query = $conn->query($nustrde_query);
// $contractTrade = array();

// while ($row = $nustrde_query->fetch_assoc()) {
// 	$contractTrade[] = $row;
// }
// $contractterm = $contractId[0]['contractTermfromDate'].','.$contractId[0]['contractTermtoDate'];
// $arrayval = array("contractTrade"=>json_encode($contractTrade),"supId"=>$contractId[0]['supplierId'],"contractterm"=>$contractterm,"consummptionamt"=>numberreturn($contractId[0]['totalAnualConsumption']));
// echo json_encode($arrayval);
// function numberreturn($value){
// 	$toremovecomma = intval(preg_replace('/[^\d. ]/', '', $value));
// 	return $toremovecomma;
// }
?>
 