<?php

    include 'dbconn.php';

        $parentcompany = $_POST["parentcompany"];
        $clientcompany =$_POST["clientcompany"];
        $country =$_POST['country'];
        $state = $_POST['state'];
        $stateval = 'Active';
        $id = $_POST['id'];

        $sqlQuery1 = "SELECT * FROM clientcompanydata WHERE parentcompany='".$parentcompany."' AND
        clientcompany='".$clientcompany."' AND country='".$country."' AND state ='".$stateval."';";
        $result1 = mysqli_query($conn,$sqlQuery1);

        if(mysqli_num_rows($result1) === 1) {
            echo "<script>";
            echo "alert('Client Company with that details already exists!');";
            echo "window.location='addcompany.php';";
            echo "</script>";
        } else {
                if($state <>'Active'){
                    echo "<script>";
                        echo "alert('Client Company is in $state state');";
                        echo "window.location='addcompany.php';";
                    echo "</script>";
                }
                else {
                    $sql = "UPDATE clientcompanydata SET parentcompany='".$parentcompany."',
                    clientcompany='".$clientcompany."', country='".$country."'  WHERE id = '".$id."'";
                    $conn->query($sql);
                }
                echo "<script>
                        alert(' Client details edited succesfully'); 
                        window.history.go(-2);
                </script>";
        }
?>
