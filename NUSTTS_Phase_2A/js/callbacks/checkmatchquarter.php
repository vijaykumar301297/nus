<?php
include "../../dbconn.php";

$contract_query = "SELECT quarters FROM nus_calenderquarter WHERE yearoftrade = '".$_POST['year']."' AND supplierid='".$_POST['suplierid']."' AND tradeid='".$_POST['tranchid']."'" ;
$contract_qry = mysqli_query($conn, $contract_query);
$contractId = array();

while ($contract_row = mysqli_fetch_assoc($contract_qry)) {
	$contractId[] = $contract_row['quarters'];
}
echo implode(',', $contractId);

?>