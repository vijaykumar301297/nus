<?php

include "dbconn.php";

$emailid = $_POST["emailId"];

$verified = 'Confirmed';

$sql = "UPDATE nususerdata SET accountstatus='".$verified."' WHERE emailId='".$emailid."'";
$conn->query($sql);

echo "<script>
        alert('Email verified succesfully'); 
        window.history.go(-2);
</script>";

// header('location: homepagecopy.php');


// function popupData() {
//     echo '<script type="text/javascript">alert("Thanks for registring...!");window.location="savedata.php";</script>';
// }

?>