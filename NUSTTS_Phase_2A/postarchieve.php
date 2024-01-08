
<?php
include_once 'security.php';
?>
<?php


    include 'dbconn.php';
    
    error_reporting(E_ERROR | E_PARSE);
     
    $state = $_POST['state'];
    $parent = $_POST['parentcompany'];
    if($_POST['state']=='Archived') {
        $state = 'Archived';
    }
    else if ($_POST['state']=='Cancelled') {
            $state = 'Cancelled';
    }
    elseif ($_POST['state']=='Re-Active'){
        $state = 'Active';
    }
    $user =  $_POST['user'];
    $date = $_POST['datevalue'];
    $description = $_POST['description'];

    // variable declaration from this page start
    $parentName = array();
    $parentState = array();
    
    $clientstate = array();
    $clientcompany = array();
    $clientid = array();

    $countsupply = array();

    $clientstateloop = array();
    $clientcompanyloop = array();
    $clientidloop = array();

    // end 
        
    $sqlparent = "SELECT * FROM parentcompanydata where parentcompany = '".$parent."';";
    $parentres = mysqli_query($conn, $sqlparent);
    
    $row = mysqli_fetch_assoc($parentres);
        $parentName = $row["parentcompany"];
        $parentState = $row['state']; 
    // }
    
    include 'includes/functions.php';
    
    $functions = new libFunc();
    $wherefiled = '';

    $sql = "SELECT * FROM parentcompanydata WHERE parentcompany ='".$parent."';";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $count = $functions->getcountclient($row['parentcompany']);
    }
    // Only parentcompnay no clientcompanies start
    if($count==0) {
       
        $sqljoin = "update parentcompanydata p
                    SET p.state = '".$state."'
                    where p.parentcompany= '".$parent."';";
        
        $conn->query($sqljoin);
                            
    }
    // Only parentcompnay no clientcompanies end

    // only for client and supply 
    if($count>=1) {

        $sql1 = "SELECT * FROM clientcompanydata WHERE parentcompany ='".$parent."';";
        $result1 = mysqli_query($conn, $sql1);
            
        while($row =  mysqli_fetch_assoc($result1)){
            $clientstate[] = $row['state']; 
            $clientcompany[] = $row['clientcompany'];
            $clientid[] = $row['id'];
        }

     
       
        for($i=0; $i<=count($clientid); $i++) {
           
           
            // checking client and supply id 
           
            $sqlsupply = "SELECT * FROM nus_supply_contract WHERE clientId ='".($clientid[$i])."' ;";
            $ressupply = mysqli_query($conn, $sqlsupply);
            $supplyrowcount = mysqli_num_rows($ressupply);
          
           // check rows for particular client id and then changing the state 
            if($supplyrowcount == 0 ) {
                
                if($state === 'Active' && $clientstate[$i]=== 'Active') {
                   
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c 
                                SET p.state ='".$state."', c.state ='".$state."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                    $conn->query($sqljoin);
                                
                }

                else if($state === 'Active' && $clientstate[$i]=== 'Archived') {
                    if(($parentState) === 'Cancelled') {       
                        $arch = 'Archived';
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                    SET p.state = '".$state."', c.state = '".$arch."'
                                    WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                    AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                        $conn->query($sqljoin);
                           
                    }
                    else {
                    //   echo "suicide";
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                    SET p.state = '".$state."', c.state = '".$state."'
                                    WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."'
                                    AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                        $conn->query($sqljoin);
                        // echo $sqljoin;
                           
                    }
                }

                else if($state === 'Active' && $clientstate[$i]=== 'Cancelled') {
                   
                    $statecance = 'Cancelled';
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."', c.state ='".$statecance."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."'  ; "; 
                    $conn->query($sqljoin);
                           
                }

                else if($state === 'Archived' && $clientstate[$i]=== 'Active') {
                   
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."', c.state ='".$state."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."'  ; "; 
                    $conn->query($sqljoin);
                           
                }            

                else if($state==='Archived' && $clientstate[$i] ==='Archived') {
                   
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."', c.state = '".$state."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                    $conn->query($sqljoin);
                                      
                }

                else if($state==='Archived' && $clientstate[$i] ==='Cancelled') {
                   
                    $arch = 'Cancelled';
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."', c.state = '".$arch."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."'  ; "; 
                    $conn->query($sqljoin);
                                        
                }

                else if($state==='Cancelled' && ($clientstate[$i]) ==='Active') {
                   
                    $statear = 'Archived';
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."', c.state = '".$statear."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."'
                                AND c.clientcompany ='".($clientcompany[$i])."'; ";  
                    $conn->query($sqljoin);
                                 
                }

                else if($state==='Cancelled' && ($clientstate[$i]) ==='Archived') {
                   
                    $arch = 'Archived';
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."'
                                 AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                    $conn->query($sqljoin);
                                         
                }

                else if($state==='Cancelled' && ($clientstate[$i]) ==='Cancelled') {
                   
                    $arch = 'Cancelled';
                    $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c
                                SET p.state = '".$state."'
                                WHERE p.parentcompany = '".$parent."' AND c.parentcompany =  '".$parent."' 
                                AND c.clientcompany ='".($clientcompany[$i])."' ; "; 
                    $conn->query($sqljoin);
                                  
                }
            }
       
         // check rows for particular client id and then changing the state end
        
        // check rows for particular supplycontract id and then changing the state 

            if($supplyrowcount >=1) {

                $sql1 = "SELECT * FROM clientcompanydata WHERE id ='".$clientid[$i]."';";

                $result1 = mysqli_query($conn, $sql1);
                    
                $row =  mysqli_fetch_assoc($result1);
                $clientstateloop = $row['state'];
                $clientcompanyloop = $row['clientcompany'];
                $clientidloop = $row['id'];
                
                $sqlsupply = "SELECT * FROM nus_supply_contract WHERE parentId ='".$parent."' AND clientId = '".($clientid[$i])."' ;";
                $ressupply = mysqli_query($conn, $sqlsupply);

               $supplycontractsupplierid = array();
               $supplycontractstate = array();

                while ($row = mysqli_fetch_array($ressupply)) {
                    $supplycontractstate[] = $row['state']; 
                    $supplycontractsupplierid[] = $row['supplierId'];
                }

                for($j=0;$j<count($supplycontractsupplierid); $j++) {

                    if($state === 'Active' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Active') {
                       
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state ='".$state."', ns.state ='".$state."'
                                    WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                                         
                            $conn->query($sqljoin);
                    }

                    else if($state === 'Active' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Archived') {
                       
                        $statearchive ='Archived';
                        $statecancel ='Cancelled'; 
                        
                        if($parentState === 'Cancelled') {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statearchive."', ns.state ='".$statearchive."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                        }
                        else {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state ='".$state."', ns.state ='".$state."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                        }
                    }

                    else if($state === 'Active' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Cancelled') {
                        
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';    

                        if($parentState === 'Cancelled') {   
                                                  
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statearchive."', ns.state ='".$statecancel."'
                                         WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                                                           
                            $conn->query($sqljoin);
                           
                        }
                        else {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state ='".$state."', ns.state ='".$statecancel."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                        }
                    }

                    else if($state === 'Active' && ($clientstateloop) === 'Cancelled' && ($supplycontractstate[$j]) ==='Cancelled') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';   

                        if($parentState === 'Cancelled') {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statecancel."', ns.state ='".$statecancel."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                             $conn->query($sqljoin);
                            
                        }

                        else {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statecancel."', ns.state ='".$statecancel."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                        }
                    } 

                    else if($state === 'Active' && ($clientstateloop) === 'Cancelled' && ($supplycontractstate[$j]) ==='Archived') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled'; 


                        if($parentState === 'Cancelled') { 
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."',c.state = '".$statecancel."', ns.state ='".$statearchive."'
                                         WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                          
                        }
                        else {
                           
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statecancel."', ns.state ='".$statearchive."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                        }
                    }   
                   
                    else if($state === 'Archived' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Active') {
                        
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state ='".$state."', ns.state ='".$state."'
                                    WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);            
                    }
                    
                    else if($state === 'Archived' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Archived') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';

                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state = '".$state."', ns.state = '".$statearchive."'
                                     WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);
                    }

                    else if($state === 'Archived' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Cancelled') {

                        $statearchive ='Archived';
                        $statecancel ='Cancelled'; 
                       
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state = '".$state."', ns.state = '".$statecancel."'
                                     WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);
                       
                    }

                    else if($state === 'Archived' && ($clientstateloop)==='Cancelled' && ($supplycontractstate[$j]) ==='Cancelled') {
                       
                        $statearchive ='Archived';
                        $statecancel ='Cancelled'; 
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."',  c.state = '".$statecancel."', ns.state = '".$statecancel."'
                                    WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);
                    }

                    else if($state === 'Archived' && ($clientstateloop) === 'Cancelled' && ($supplycontractstate[$j]) ==='Archived') {

                        $statearchive ='Archived';
                        $statecancel ='Cancelled'; 
                       
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."',  c.state = '".$statecancel."', ns.state = '".$statearchive."'
                                     WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);
                        
                    }
                       
                     
                    else if($state === 'Archived' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Archived') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';

                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state ='".$statearchive."',  ns.state = '".$statearchive."'
                                      WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                    }  
    
                    else if($state === 'Archived' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Cancelled') {
                       $statearchive ='Archived';
                       $statecancel ='Cancelled';

                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state ='".$statearchive."',  ns.state = '".$statecancel."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                        
                    } 

                    else if($state === 'Cancelled' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Active') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';

                       
                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state ='".$statearchive."', ns.state ='".$statearchive."'
                                    WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";      
                        $conn->query($sqljoin);
                           
                    }

                    else if($state === 'Cancelled' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Archived') {
                        $statearchive = 'Archived';
                       
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state ='".$statearchive."', ns.state ='".$statearchive."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                    }

                    else if($state === 'Cancelled' && ($clientstateloop) === 'Active' && ($supplycontractstate[$j]) ==='Cancelled') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';
                       
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."',  c.state ='".$statearchive."', ns.state ='".$statecancel."'
                                         WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                        }
                      

                    else if($state === 'Cancelled' && ($clientstateloop) === 'Cancelled' && ($supplycontractstate[$j]) ==='Cancelled') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';
                       
                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."',  c.state = '".$statecancel."', ns.state ='".$statecancel."'
                                         WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                           
                    }
                      
                    else if($state === 'Cancelled' && ($clientstateloop) === 'Cancelled' && ($supplycontractstate[$j]) ==='Archived') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';

                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."', c.state = '".$statecancel."', ns.state ='".$statearchive."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                               
                                
                    }   
                    else if($state === 'Cancelled' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Cancelled') {
                        $statearchive ='Archived';
                        $statecancel ='Cancelled';

                        $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                    SET p.state = '".$state."', c.state = '".$statearchive."', ns.state ='".$statecancel."'
                                    WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                        $conn->query($sqljoin);
                        
                    }  
                    else if($state === 'Cancelled' && ($clientstateloop) === 'Archived' && ($supplycontractstate[$j]) ==='Archived') {
                        {
                            $statearchive ='Archived';
                            $statecancel ='Cancelled';

                            $sqljoin = "UPDATE parentcompanydata p, clientcompanydata c, nus_supply_contract ns 
                                        SET p.state = '".$state."',c.state = '".$statearchive."', ns.state ='".$statearchive."'
                                        WHERE p.parentcompany = '".$parent."' AND c.id =  '".$clientid[$i]."' AND ns.supplierId ='".$supplycontractsupplierid[$j]."';";                    
                            $conn->query($sqljoin);
                       
                    }  
                }
                
            }
        }
    }
}

    $sql = "INSERT INTO parentarchieved(parentcompany,state, user, datevalue, description) 
    VALUES( '".$parent."','".$state."', '".$user."','".$date."', '".$description."')";    
    $conn->query($sql);

    echo "<script>
                alert('$parent has been modified successfully !'); 
                window.history.go(-2);
            </script>";
   
?>  