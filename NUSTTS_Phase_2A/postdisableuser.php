<?php

    include 'dbconn.php';

        $emailid=$_POST["emailId"];
        $verifyuserstatus = 'Inactive';

        $sql = "UPDATE nususerdata SET active ='".$verifyuserstatus."' WHERE emailId='".$emailid."'";
        $conn->query($sql);
        
echo "<script>
        alert('User deactivated!'); 
        window.history.go(-2);
</script>";
?>