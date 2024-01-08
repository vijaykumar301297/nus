<?php
include '../dbconn.php';


$contract =   $_POST['contract'];
$contract_query = "SELECT allmonts, commodityName FROM nus_supply_contract WHERE contract_id = '".$contract."' AND clientId = '".$_POST['clientid']."'";
$contract_qry = mysqli_query($conn, $contract_query);
$contractId = '';
$commodity = '';

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractId = $contract_row['allmonts'];
  $commodity = $contract_row['commodityName'];
}

$getyearconsum = explode(',', $contractId);
$months = array();
$allmonths = ['Jan','Feb','Mar','Apr','May','Jun','July','Aug','Sep','Oct','Nov','Dec'];
foreach ($getyearconsum as $key => $value) {
	$toarray = explode('-', $value);
	if($toarray[0]==$_POST['yearselected']){
		$months[] = $allmonths[$toarray[1]-1];
	}
	
}
$printdata ='';
$style ='';
$valus ='';
if($commodity !='electricity' && $commodity != 'natural gas'){
  $style = 'style="display:none"';
  $valus ='value="0.00"';
}
foreach ($months as $key => $valuemonth) {
  $classname = '';
  if($key==0){
    $classname ='strike';
  }
  
	$printdata .='<div class="row marf">
                <div class="col-md-4 month">
                  <p>'.$valuemonth.'</p>
                </div>
                <div class="col-md-4">
                  <div class="input-group">
                    <input class="form-control left-border-none mwhpercentage basload basloadl'.$classname.'" id="tradevalue" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" type="text" name="basload'.$valuemonth.$_POST['yearselected'].'" >
                  </div>
                </div>
                
                <div class="col-md-4">
                  <div '.$style.'>
                  <div class="input-group">
                    <input class="form-control left-border-none mwhpercentage effective effectivel'.$classname.'" id="tradevalue" onkeypress="return CheckNumeric()" onkeyup="FormatCurrency(this)" placeholder="0.00" type="text" '.$valus.' name="effective'.$valuemonth.$_POST['yearselected'].'" >
                  </div>
                </div>
                </div>
              </div>';
}
$combinedarray = array('rowval'=>$printdata,'months'=>implode(',', $months));
echo json_encode($combinedarray);
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
 