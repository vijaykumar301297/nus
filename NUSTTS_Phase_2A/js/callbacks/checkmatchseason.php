<?php
include "../../dbconn.php";

$contract_query = "SELECT season FROM nus_season WHERE yeartrade = '".$_POST['year']."' AND supplierId='".$_POST['suplierid']."' AND tradeId='".$_POST['tranchid']."'" ;
$contract_qry = mysqli_query($conn, $contract_query);
$contractId = array();

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractId[] = $contract_row['season'];
}
echo implode(',', $contractId);

?>