<?php
include "../../dbconn.php";

$getdatas = '';

if($_POST['commodityVal'] == 'electricity'){
	$getdatas = "SELECT * FROM nus_electricity_index ORDER BY country ASC, indexlist ASC;";
}else if ($_POST['commodityVal'] == 'natural gas') {
	$getdatas = "SELECT * FROM nus_naturalgas_index ORDER BY country ASC, indexlist ASC;";
}
$result = $conn->query($getdatas);
// $printData = '<select class="chosen-select indexType form-control" name="indexed"><option value="Financial Hedging / International">Financial Hedging / International</option>';
$printData = '<select class="chosen-select indexType form-control" name="indexed">';


if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    // $printData .='<option value="'.$row['indexlist'].'">'.$row['indexlist'].'</option>';
	    $printData .='<option value="'.trim($row['indexlist']) .' / '.trim($row['country']).'">'.trim($row['indexlist']) .' / '.trim($row['country']).'</option>';
	}
}
$printData .='</select>';
echo $printData;
?>