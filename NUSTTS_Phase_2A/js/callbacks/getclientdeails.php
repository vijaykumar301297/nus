<?php
include "../../dbconn.php";

$getdatas = "SELECT nc.clientcompany, nc.country FROM clientcompanydata nc WHERE nc.id=".$_POST['clientId']."";
$result = $conn->query($getdatas);
$clientname = '';
$clientCountry = '';
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $clientname = $row['clientcompany'];
	    $clientCountry = $row['country'];
	}
}
$alldetails = array("clientname"=> $clientname, "clientcountry"=>$clientCountry);
echo json_encode($alldetails);
?>