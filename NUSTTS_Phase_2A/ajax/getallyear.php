<?php
include '../dbconn.php';


$contract =   $_POST['cId'];
if(!empty($_POST['clientid'])) {
    $clientID = $_POST['clientid'];
}
if(empty($clientID)) {
    $contract_query = "SELECT allmonts FROM nus_supply_contract WHERE contract_id = '".$contract."'";
} else {
    $contract_query = "SELECT allmonts FROM nus_supply_contract WHERE contract_id = '".$contract."' AND clientId='".$clientID."'";
}
$contract_qry = mysqli_query($conn, $contract_query);
$contractyear = '';

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractyear = $contract_row['allmonts'];
}
$getallyears = explode(',', $contractyear);
$years = array();
foreach ($getallyears as $key => $value) {
	$exp_mnths = explode('-', $value);
	$years[] = $exp_mnths[0];
}
$unique_year = array_unique($years);
$printdata ='';
$printdata .='<p style="color:black;">Report Period</p>';
$printdata .='<div style="display: inline-block;">';
foreach ($unique_year as $key => $value) {
		$printdata .='<div class="cat action">
                         <label>
                            <input type="checkbox" value="'.$value.'" name="yearstype[]" class="contactType" 
                             ><span class="disabledbutton dis">'.$value.'</span>
                         </label>
                    </div>';
}
$printdata .='</div>';
echo $printdata;
?>
 