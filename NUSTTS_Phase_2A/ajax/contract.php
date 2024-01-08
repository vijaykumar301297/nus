<?php
include '../dbconn.php';


$contract =   $_POST['country_data'];

// echo $country_id;

// $contract_query = "SELECT * FROM nus_supply_contract WHERE clientId = $contract AND contractType='indexed';";
$contract_query = "SELECT * FROM nus_supply_contract WHERE clientId = $contract AND contractType='indexed' ANd contractTermtoDate>CURDATE() AND state='Active' ORDER BY contract_id ASC;";
$contract_qry = mysqli_query($conn, $contract_query);
// $output="";
$output = '<option value="">Select Contract</option>';


// print_r($state_qry);
while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	
    $output .= '<option value="' . $contract_row['clientId'] . '">' . $contract_row['contract_id'] . '</option>';
}
echo $output;
 