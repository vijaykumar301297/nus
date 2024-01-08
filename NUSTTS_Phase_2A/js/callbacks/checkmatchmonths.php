<?php
include "../../dbconn.php";

$contract_query = "SELECT month FROM nus_calendermonth WHERE year = '".$_POST['year']."' AND supplierId='".$_POST['suplierid']."' AND TradeId='".$_POST['tranchid']."'" ;
$contract_qry = mysqli_query($conn, $contract_query);
$contractId = array();

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractId[] = $contract_row['month'];
}
echo implode(',', $contractId);

?>