<?php
include "../../dbconn.php";

$getdatas = "SELECT * FROM clientcompanydata WHERE parentcompany='".$_POST['parentId']."' and state='Active'
ORDER BY clientcompanydata.clientcompany ASC;";
$result = $conn->query($getdatas);

$printdata = '';
$printdata.='<option value="">Please Select client</option>';
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
	    $printdata.='<option value='.$row['id'].'>'.$row['clientcompany'].' - '.$row['country'].'</option>';
	}
}
echo $printdata;
?>