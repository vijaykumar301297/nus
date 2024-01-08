<?php
include_once 'security.php';
?>
<?php

    include 'dbconn.php';
    
    error_reporting(E_ERROR | E_PARSE);
   
    // $wherefiled = '';
     
        $state = $_POST['state'];
        $id = $_POST['id'];
        // echo $id;
        $client = $_POST['clientcompany'];
        $parent = $_POST['parentcompany'];
        
        // echo "Client = ".$client;
        // die();
        if($_POST['state']=='Archived') {
            $state = 'Archived';
        }
        if ($_POST['state']=='Cancelled') {
            $state = 'Cancelled';
        }
        if ($_POST['state']=='Re-Active'){
            $state = 'Active';
        }
        
        $user =  $_POST['user'];
        $date = $_POST['datevalue'];
        $description = $_POST['description'];

        $sqlOneQuery = "SELECT * FROM clientcompanydata";
        $resOneQuery = mysqli_query($conn,$sqlOneQuery);
        $rowCount = mysqli_num_rows($resOneQuery);
        // echo $rowCount;
        
        // echo $parent;
        $sqlclient = "SELECT * FROM parentcompanydata WHERE parentcompany ='".$parent."'; ";
        $clientres = mysqli_query($conn,$sqlclient);
        $clientrowcount = mysqli_num_rows($resOneQuery);

        $statearray=array();
        $contractarray = array();
        $clientIdsupply = array();
        $clientstate = array();

        while($row = mysqli_fetch_assoc($clientres)) {
            if($row['state']=='Archived' || $row['state']=='Cancelled'){
                if($rowCount >= 1) {
                    $a = $row['state'];
                    echo "<script>
                            alert('$parent has been in $a state !'); 
                            window.history.go(-2);
                    </script>";
                }
            }
 
            else {
              
                $sqlclient  = "SELECT * FROM clientcompanydata WHERE id = '".$id."';";
                $clientres = mysqli_query($conn,$sqlclient);

                while($row =  mysqli_fetch_assoc($clientres)){
                    $clientstate[] = $row['state'];
                }
                // echo $clientstate[1];

                $sql = "SELECT * FROM nus_supply_contract WHERE clientId ='".$id."'";
                $result = mysqli_query($conn, $sql);
                $rowcounted = mysqli_num_rows($result);
            

                    if($rowcounted>=1) {
                           
                        while($row =  mysqli_fetch_assoc($result)){
                            $contractarray[] = $row['contract_id'];
                            $statearray[] = $row['state']; 
                            $clientIdsupply[] = $row['clientId'];
                        }

                        //  print_r($clientIdsupply);
                        //  echo count($clientIdsupply);
                        
                                // echo 'hi';
                        for($i=0; $i<=count($clientIdsupply);$i++) {
                           
                               
                                // ACTIVE section
                                if($state === 'Active' && $statearray[$i]=== 'Active') {
                                    
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."', ns.state = '".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                                    
                                    $conn->query($sqljoin);
                                    
                                }

                                 if($state === 'Active' && $statearray[$i]=== 'Archived') {
                                    if($clientstate[0] === 'Cancelled') {
                                        $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                        SET c.state ='".$state."'
                                        WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                            
                                    $conn->query($sqljoin);
                                    }
                                    else {
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."', ns.state ='".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                                    
                                    $conn->query($sqljoin);
                                    }
                                }
                                 if($state === 'Active' && $statearray[$i]=== 'Cancelled') {
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."', ns.state = '". $statearray[$i]."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."'; "; 
                                   
                                    $conn->query($sqljoin);
                                }
                                //Active ends

                                // Archived section 
                                 if($state === 'Archived' && $statearray[$i]=== 'Active') {
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."', ns.state = '".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                                   
                                    $conn->query($sqljoin);
                                }
                                 

                                if($state==='Archived' && $statearray[$i] ==='Archived') {
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                                    
                                    $conn->query($sqljoin);
                                   
                                }


                                 if($state==='Archived' && $statearray[$i] ==='Cancelled') {
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."'; "; 
                                   
                                    $conn->query($sqljoin);
                                   
                                }

                               // Archived end 

                                //Cancelled start


                                 if($state==='Cancelled' && $statearray[$i] ==='Active') {
                                    $stateArc = 'Archived';
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."', ns.state = '".$stateArc."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."' ; "; 
                                    
                                    $conn->query($sqljoin);
                                   
                                }
                                if($state==='Cancelled' && $statearray[$i] ==='Archived') {
                                    
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."'; "; 
                                    
                                    $conn->query($sqljoin);
                                   
                                }
                                 if($state==='Cancelled' && $statearray[$i] ==='Cancelled') {
                                    $statear = 'Archived';
                                    $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                                                SET c.state ='".$state."'
                                                WHERE c.id =  '".$id."' AND ns.clientId='".$clientIdsupply[$i]."' AND ns.contract_id='".$contractarray[$i]."'; "; 
                                    
                                    $conn->query($sqljoin);
                                   
                                }

                           
                            }
                        }

                            
        
                        // $sqljoin = "UPDATE clientcompanydata c, nus_supply_contract ns
                        //     SET c.state ='".$state."', ns.state = '".$state."'
                        //     WHERE c.id =  '".$id."' AND ns.clientId='".$id."'; "; 

                        // $conn->query($sqljoin);
                
                

                   
                    if($rowcounted===0) {

                        // echo $state;

                        $sqljoin = "UPDATE clientcompanydata c 
                            SET c.state ='".$state."'
                            WHERE c.id =  '".$id."' "; 

                        $conn->query($sqljoin);

                    }
                }
                // echo "State = ".$state;
                $sql = "INSERT INTO clientarchieve(clientid, clientcompany, state, user, datevalue, description) 
                                VALUES( '".$id."', '".$client."','".$state."', '".$user."','".$date."', '".$description."')";    
                                // echo $sql;
                        $conn->query($sql); 
            }
        
        
        echo "<script>
                alert('$client has been modified successfully !'); 
                window.history.go(-2);
            </script>";
                    

        // }
         
                
?>  