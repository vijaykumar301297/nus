<?php

    include 'dbconn.php';
    
    error_reporting(E_ERROR | E_PARSE);
     
        $state = $_POST['state'];
        $supplyid = $_POST['supplierId'];
        $clientid = $_POST['clientId'];
        // echo $clientid;
        // $client = $_POST['clientcompany'];
        if($_POST['state']=='Archived') {
            $state = 'Archived';
        }
        elseif ($_POST['state']=='Cancelled') {
            $state = 'Cancelled';
        }
        elseif ($_POST['state']=='Re-Active'){
            $state = 'Active';
        }
        // echo $state;
        $user =  $_POST['user'];

        $date = $_POST['datevalue'];
        $description = $_POST['description'];
        $contractnumber = base64_decode($_POST['contract_id']);
        
        
        
        $sqlclient = "SELECT * FROM clientcompanydata WHERE id ='".$clientid."'; ";
        $clientres = mysqli_query($conn,$sqlclient);
        // $clientrowcount = mysqli_num_rows($resOneQuery);
    
        while($row = mysqli_fetch_assoc($clientres)) {
            if($row['state']=='Archived' || $row['state']=='Cancelled'){
                $clientcompany = $row['clientcompany'];
                $a = $row['state'];
               
                echo "<script>
                        alert('$clientcompany has been in $a state !'); 
                        window.history.go(-2);
                    </script>";
            }
            else{
                $sqlOneQuery = "SELECT * FROM nus_supply_contract";
                $resOneQuery = mysqli_query($conn,$sqlOneQuery);
                $rowCount = mysqli_num_rows($resOneQuery);
            //    echo 'hello';
                if($rowCount >= 1) {

                    // $sqlarc = "SELECT * FROM nus_supply_archieve";
                    // $ressqlarc= mysqli_query($conn,$sqlarc);
                    // $rowCount1 = mysqli_num_rows($ressqlarc);
        
                   
                        $sql = "INSERT INTO nus_supply_archieve(clientId, supplierId ,state, user, datevalue, description) 
                            VALUES( '".$clientid."', '".$supplyid."','".$state."', '".$user."','".$date."', '".$description."')";    
                            // echo $sql;
                            $conn->query($sql); 
                    }
                    
        
        
                    $sqljoin = "UPDATE nus_supply_contract ns 
                                INNER JOIN nus_supply_archieve a on a.supplierId = ns.supplierId 
                                SET ns.state ='".$state."'
                                WHERE ns.supplierId =  '".$supplyid."'  AND ns.clientId='".$clientid."'"; 
        
                    $conn->query($sqljoin); 

                     echo "<script>
                    alert('$contractnumber has been modified successfully !'); 
                    window.history.go(-2);
                </script>";
                   
            }
        }
        

            // echo "<script>
            //         alert('$contractnumber has been modified successfully !'); 
            //         window.history.go(-2);
            //     </script>";
        
       
?>  