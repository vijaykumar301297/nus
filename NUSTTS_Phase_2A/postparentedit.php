<?php

    include 'dbconn.php';
    
    error_reporting(E_ERROR | E_PARSE);

        $parentcompany = $_POST["parentcompany"];
        $id = $_POST['id'];
        $state = $_POST['state'];

        $sqlQuery1 = "SELECT * FROM parentcompanydata WHERE parentcompany='".$parentcompany."';";
        $res11 = mysqli_query($conn,$sqlQuery1);

        if(mysqli_num_rows($res11) === 1) {
                echo "<script>";
                echo "alert('Parent Company with that name already exists!');";
                echo "window.location='addcompany.php';";
                echo "</script>";
        } else {
                if($state <> 'Active'){
                    echo "<script>";
                    echo "alert('$parentcompany Company is in $state state!');";
                    echo "window.location='addcompany.php';";
                    echo "</script>";
                }
                else {
                    $sql1 = "SELECT parentcompany FROM parentcompanydata WHERE id = '".$id."'";
                    $res1 = mysqli_query($conn,$sql1);
                
                    $result1 = mysqli_fetch_assoc($res1);
                
                        // echo "<pre>";
                        // print_r($result1);
                    $client = $result1['parentcompany'];
                
                        
                    $sql = "UPDATE parentcompanydata SET parentcompany='".$parentcompany."' WHERE id = '".$id."'";
                    $conn->query($sql);
                
                    $sql2 = "SELECT parentcompany FROM parentcompanydata WHERE id = '".$id."'";
                    $res2 = mysqli_query($conn,$sql2);
                    $result2 = mysqli_fetch_assoc($res2);
                
                        // echo "<pre>";
                        // echo $result2['parentcompany'];
                
                    $clientsql = "SELECT * FROM clientcompanydata WHERE parentcompany = '".$client."'";
                    $clientRes1 = mysqli_query($conn,$clientsql);
                
                    $clientR = mysqli_fetch_assoc($clientRes1);
                        // echo "<pre>";
                        // echo "Here";
                        // echo $clientR['parentcompany'];
                        // print_r($clientR);
                
                    if($client == $clientR['parentcompany']) {
                                // echo "Matches";
                        $clientsql = "UPDATE clientcompanydata SET parentcompany='".$parentcompany."' WHERE parentcompany = '".$client."'";
                        $parentsql1 = "UPDATE nus_supply_contract SET parentId='".$parentcompany."' WHERE parentId = '".$client."'";
                        mysqli_query($conn,$clientsql);
                        mysqli_query($conn,$parentsql1);

                    }
                
                    $parentsql = "SELECT * FROM nus_supply_contract WHERE parentId = '".$client."'";
                    $parentRes1 = mysqli_query($conn,$parentsql);
                
                    $parentR = mysqli_fetch_assoc($parentRes1);
                
                    if($client == $parentR['parentId']) {
                                // echo "Matches";
                        $parentsql1 = "UPDATE nus_supply_contract SET parentId='".$parentcompany."' WHERE parentId = '".$client."'";
                        mysqli_query($conn,$parentsql1);
                    }
                }

       

        echo "<script>
                alert('Parent details edited succesfully!'); 
                window.history.go(-2);
        </script>";
}
?>
