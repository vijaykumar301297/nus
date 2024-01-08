<?php
include "../../dbconn.php";

$getdatas = "SELECT * FROM nus_tradeperiods WHERE supplierId=".$_POST['supplierId']."";
$result = $conn->query($getdatas);

$periodType = '';
$numberofClicks = '';
$alldetails = array(
    'periodType' => array(),
    'numberOfClicks' => array()
);

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $periodType = $row['periodsId'];
	    $numberofClicks = $row['clicktracnches'];
        array_push($alldetails['periodType'], $periodType);
        array_push($alldetails['numberOfClicks'], $numberofClicks);
    }
}

echo json_encode($alldetails);

?>