<?php
    include('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Parent Company List</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link
      rel="stylesheet"
      href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"
    />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet"/>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <style>
       
       #DataTables_Table_0_wrapper {
            /* position: absolute; */
            width: 87%;
            margin: 80px 0 0 360px;
        }

       #myTable_wrapper {
            /* position: absolute; */
            width: 76%;
            margin: 160px 0 0 20%;
            /* left: 20%; */
            /* top: 28%; */
        }

      
        #myTable_filter {
            position: absolute;
            /* bottom: 105%; */
            right: 4%;
            top: -62px;
        }
        table {
            border: 2px solid #D2DDEC;
            border-radius: 6px;
            width: 76%;
            margin: 10px 300px;
            /* height: 70vh; */
        }
       
        table th {
            color: #343a40;
            background: #F9FBFD;
        }
        table.myTable thead th {
	        border-bottom: 1px solid #CED4DA !important;
        }
        table td {
            color: #12263F;
            font-size: 13px;
            border-bottom: 1px solid #CED4DA;
        }
        table.dataTable.no-footer {
            /* border-bottom: 2px solid #D2DDEC !important; */
            border-bottom: none !important;
        }

        table tbody td a {
            color: black ;
            font-size: 14px;
        }

        .parentdatas{
            text-decoration: none;
        }
        .parent {
            text-align:left;
        }
        /* .clientfrs {
            margin: 0px 0 0 19.4%;
            position: relative;
            top: 0%;
            font-weight: 600;
            font-size: 20px;
            color:#345DA6;
        } */
        .viewclient {
            color: #fff;
            padding:5px 10px;
            border-radius:25px;
        }

        table.dataTable thead > tr > th.sorting_asc::before, 
        table.dataTable thead > tr > th.sorting_desc::after {
            opacity: 1;
        }
        td {
            background: white;
        }
        .viewIcon {
            width: 24px;
            height:24px;
            /* background-color: #345DA6; */
        }

        /* .filter {
            position: absolute; 
            top: 25%;
            left: 19.4%;
            display: flex;
        } */
        label {
            color: black !important;
            font-size: 14px;
            font-weight: normal !important;
        }
        
        .arch td {
            background-color:rgba(238, 237, 237, 0.9);;
            color: #345DA6;
            font-weight: normal;
        }

        .arch td > a {
            color: #345DA6;
            /* font-weight: 300; */
        }

        .cancelled td {
            background-color: rgba(238, 237, 237, 0.9);;
            color: red;
            /* font-weight: 500; */
        }

        .cancelled td > a {
            color: red;
            /* font-weight: 500; */
            border-bottom: red;
        }

        input[type="checkbox"] {
            margin:0;
        }
        /* h5 {
            position: absolute;
            top: 21%;
            left: 20%;
            color: #345DA6;
            font-size:14px;
            font-weight: 500;
        } */
        .dropdown-menu {
            min-width: 110px !important;
        }
        p {
            margin:0 0;
        }
       
        .headerSection {
            position: absolute;
            top: 4%;
            /* left: 20%; */
            font-size: 14px;
            width: 100%;
            height: 100%;
           
            display: block;
        }
        .headingstate {
            position: absolute;
            left: 20%;
            display: block;
            overflow: hidden;
        }
        .heading {
            margin: 0 0 50px 0;
        }
        .clientfrs {
            font-size: 20px;
            font-weight: 600;
            color: grey;
        }

        .clientss, .clientss:hover {
           
            text-decoration: none;
           
            font-weight: 600;
            font-size: 20px;
            color: #345DA6;
            text-decoration: none;
        }
        /* .state {
            margin-bottom: 20px;
        } */
        .stateValues {
            position: absolute;
            right: 8%;
            top: 5%;
            background: #EEEEEE;
            padding: 5px 10px;
            font-weight: 500;
            letter-spacing: 0.5px;
            border-radius: 4px;
        }
     
        .filterheader {
            color: #345DA6;
            font-size: 14px;
            font-weight: 500;
        }
        .filter {
            display: flex;
            margin-left: -10px;
            overflow-y:hidden !important;
        }
        h6 {
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body style="line-height: normal;">
<div class="main">
        <div class="menu">

            <?php
                include('sidebar.php');
            ?>
        </div>
    </div>
    <div class="states">
            <?php 
                
                $clientstate = mysqli_query($conn, "SELECT * From clientcompanydata where clientcompany ='".base64_decode($_GET['clinet'])."' ");  
                while($row = mysqli_fetch_array($clientstate))
                {
                    if($row['state']=='Archived') {
                        echo "<span class = stateValues style=color:#345DA6;>".$row['state']."</span>"; 
                    }
                    else if($row['state'] == 'Cancelled') {
                        echo "<span class = stateValues style= color:Red;>".$row['state']."</span>"; 
                    }
                    else {
                        echo "<span class = stateValues style= color:black;>".$row['state']."</span>"; 
                    }                            
                }
                    ?>
            </div>
    <div class="headerSection">
            <div class="headingstate">
                <div class="heading">
                    <p><a href="clientcompany.php?id=<?=($_GET['parent']);?>" class="clientfrs" ><?=base64_decode($_GET['parent']);?> > </a>
                    <a href="" class="clientss"><?=base64_decode($_GET['clinet']);?></a></p>
                </div>
            

            <div class="filterheader" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                <h6>Filter By</h6>
            </div>
            <div class="formFilter" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                <form action="" method="GET">
                    <div class="filter">
                        <input type = "hidden" name="id" value="<?php echo $_GET['id'];?>">
                        <input type = "hidden" name="clinet" value="<?php echo $_GET['clinet'];?>">
                        <input type = "hidden" name="parent" value="<?php echo $_GET['parent'];?>">
                        <label for=""><input type="checkbox" value="Active" name="active" <?php echo empty($_GET['active'])?'':'checked'; ?>>&nbsp;Active</label>
                        
                        <label for=""><input type="checkbox" value="Archived" name="archive" <?php echo empty($_GET['archive'])?'':'checked'; ?>>&nbsp;Archived</label>
                        
                        <label for=""><input type="checkbox" value="Cancelled" name="cancel" <?php echo empty($_GET['cancel'])?'':'checked'; ?>>&nbsp;Cancelled</label>
                        <button class="btn" type="submit"><img src="img/reload_apply.svg" alt="reloadicon" width="22px"> Apply</button>
                        </div>
                    </form>
                </div>
            </div>
            
            
            <div class="padmd0">
                <?php
              if(isset($_SESSION['deleted'])&&((time() - $_SESSION['deleted']) < 2)) {
                
                echo '<script> toastr.error("Deleted", "New Supply contract ");</script>';
                if((time() - $_SESSION['deleted']) > 2){
                    unset($_SESSION['deleted']);
                }
              } 
              
             ?> 
             
            

    <table class="myTable" id="myTable">
        <thead class="">
            <!-- <tr> -->
            <th class="">Country</th>
            <th class="">Commodity</th>
            <th class="">Contract Name</th>
            <th class="">Supplier Name</th>
            
            <th class="">Contract Start</th>
            <th class="">Contract End</th>
            <th class="">Status</th>
           
            <th class="">Contract Type</th>
            <th class="">Annual Consumption</th>
            <th class="">State</th>
            <th class=""></th>
            <!-- <th class=""></th> -->
            <!-- <th class=""></th> -->
            <!-- </tr> -->
        </thead>
        <tbody>
        <?php
                include('dbconn.php');

    include 'includes/functions.php';
    $functions = new libFunc();
      
                $user = $_GET['id'];

                $active = empty($_GET['active'])? '': $_GET['active'];
                $cancel = empty($_GET['cancel'])? '': $_GET['cancel'];
                $archive = empty($_GET['archive'])? '': $_GET['archive'];
    
                if ($active == '' && $cancel == '' && $archive == '' && $_SESSION['role'] != 'Parent company' && $_SESSION['role'] != 'Client company') {
                    $sql = "SELECT * FROM nus_supply_contract WHERE clientId='$user' ORDER BY supplierId DESC";
                }
                else if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') {
                    $sql = "SELECT * FROM nus_supply_contract WHERE clientId='$user' AND state = 'Active' ORDER BY supplierId DESC";
                }
                else {
                    $sql = "SELECT * FROM nus_supply_contract WHERE clientId='$user' AND state IN ('$active','$cancel','$archive') ORDER BY supplierId DESC";
                }


                // $sql = "SELECT * FROM nus_supply_contract WHERE clientId='$user' ORDER BY supplierId DESC";
                $result = mysqli_query($conn,$sql);

                $clientstate = mysqli_query($conn, "SELECT * From clientcompanydata where clientcompany ='".base64_decode($_GET['clinet'])."' ");  
                $rows = mysqli_fetch_array($clientstate);

                while($row = mysqli_fetch_assoc($result)) {
                   
                    
                ?>

                
                <?php
                    if ($row['state'] == 'Archived') {
                    ?>
                        <tr class="arch">       
                    
                            <?php
                            $prve = 'preview';
                            if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager'){
                                $prve ='edit';
                            }
                            ?>
                            <td><?= $row['countryName']; ?></td>
                            <td><?= $row['commodityName']; ?></td>
                            <td><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>"><?= $row['contract_id']; ?></a></td>
                            <td ><?= $row['supplyName'];?></td>
                            
                            
                            <td><?= date('d-M-Y',strtotime($row['contractTermfromDate'])); ?></td>
                            <td><?= date('d-M-Y',strtotime($row['contractTermtoDate'])) ?></td>
                            <td><?php 
                            
                            $expire = strtotime($row['contractTermtoDate']);
                            $today = strtotime("today midnight");
                            if($today >= $expire){
                                echo "<span style='background: #ffe9dc; color: #eb2808;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Expired</span>";
                            } else {
                                echo "<span style='background: #DCFFF0; color: #026A3E;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Live</span>";
                            }
                            ?></td>
                  
                            <td><?= $row['contractType']; ?></td>
                            <td><?=$row['totalAnualConsumption'];?></td>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            <td id="valuee"><a href="statesupply.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>&client=<?=base64_encode($_GET['clinet'])?>&parent=<?=base64_encode($_GET['parent'])?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                            <td><div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #345DA6;">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu" role="menu">
                            <?php 
                                if($rows['state']=='Archived' || $rows['state']=='Cancelled') {
                            ?>

                            <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>">View</a></li>
                            <?php
                                if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                                ?>
                            
                            <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit" style="color: lightgray; pointer-events: none;" >Edit</a></li>
                            <li>
                                <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" style="color: lightgray; pointer-events: none;">Archive</a>
                            </li>
                            <li>
                                <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                            </li>
                            <li>
                                <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;" >Re-Activate</a>
                            </li>
                                <?php 
                                    }
                                ?>
                            <?php
                             }  else {
                            ?>
                             <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>">View</a></li>
                            <?php
                                if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                                ?>
                            
                            <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit" style="color: lightgray; pointer-events: none;" >Edit</a></li>
                            <li>
                                <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" style="color: lightgray; pointer-events: none;">Archive</a>
                            </li>
                            <li>
                                <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                            </li>
                            <li>
                                <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" >Re-Activate</a>
                            </li>
                            <?php }
                            ?>
                            <?php
                            }

                            ?>
                        </ul>
                  </div></td>
                </tr>
                <?php
                } else if ($row['state'] == 'Cancelled') {
                ?>
                    <tr class="cancelled">       
                    
                    <?php
                    $prve = 'preview';
                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager'){
                        $prve ='edit';
                    }
                    ?>
                    <td><?= $row['countryName']; ?></td>
                    <td><?= $row['commodityName']; ?></td>
                    <td><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>"><?= $row['contract_id']; ?></a></td>
                    <td><?= $row['supplyName'];?></td>
                    
                    
                    <td><?= date('d-M-Y',strtotime($row['contractTermfromDate'])); ?></td>
                    <td><?= date('d-M-Y',strtotime($row['contractTermtoDate'])) ?></td>
                    <td><?php 
                    
                    $expire = strtotime($row['contractTermtoDate']);
                    $today = strtotime("today midnight");
                    if($today >= $expire){
                        echo "<span style='background: #ffe9dc; color: #eb2808;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Expired</span>";
                    } else {
                        echo "<span style='background: #DCFFF0; color: #026A3E;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Live</span>";
                    }
                    ?></td>
          
                    <td><?= $row['contractType']; ?></td>
                    <td><?=$row['totalAnualConsumption'];?></td>
                    <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                    ?>
                    <td id="valuee"><a href="statesupply.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>&client=<?=base64_encode($_GET['clinet'])?>&parent=<?=base64_encode($_GET['parent'])?>"><?php echo $row['state'] ?></a></td>
                    <?php 
                        } 
                    ?>
                    <td><div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #345DA6;">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu" role="menu">

                    <?php 
                        if($rows['state']=='Archived' || $rows['state']=='Cancelled') {
                    ?>

                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>">View</a></li>
                    <?php
                        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                        ?>
                    
                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit"  style="color: lightgray; pointer-events: none;">Edit</a></li>

                    <li>
                        <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" style="color: lightgray; pointer-events: none;">Archive</a>
                    </li>
                    <li>
                        <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                    </li>
                    <li>
                        <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving"  style="color: lightgray; pointer-events: none;" >Re-Activate</a>
                    </li>
                        <?php 
                            }
                        ?>
                    <?php
                        }  else {
                    ?>

                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>">View</a></li>
                    <?php
                        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                        ?>
                    
                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit"  style="color: lightgray; pointer-events: none;">Edit</a></li>

                    <li>
                        <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" style="color: lightgray; pointer-events: none;">Archive</a>
                    </li>
                    <li>
                        <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                    </li>
                    <li>
                        <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" >Re-Activate</a>
                    </li>
                        <?php
                            }
                        ?>
                    <?php 
                        }
                    ?>
                </ul>
          </div></td>
        </tr>

            <?php
                } else {
                ?>
                    <tr>       
                    
                    <?php
                    $prve = 'preview';
                    if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager'){
                        $prve ='edit';
                    }
                    ?>
                    <td><?= $row['countryName']; ?></td>
                    <td><?= $row['commodityName']; ?></td>
                    <td><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>"><?= $row['contract_id']; ?></a></td>
                    <td style="color: #345DA6;"><?= $row['supplyName'];?></td>
                    
                    
                    <td><?= date('d-M-Y',strtotime($row['contractTermfromDate'])); ?></td>
                    <td><?= date('d-M-Y',strtotime($row['contractTermtoDate'])) ?></td>
                    <td><?php 
                    
                    $expire = strtotime($row['contractTermtoDate']);
                    $today = strtotime("today midnight");
                    if($today >= $expire){
                        echo "<span style='background: #ffe9dc; color: #eb2808;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Expired</span>";
                    } else {
                        echo "<span style='background: #DCFFF0; color: #026A3E;padding: 5px 15px;border-radius: 3px;font-weight: 500;'>Live</span>";
                    }
                    ?></td>
          
                    <td><?= $row['contractType']; ?></td>
                    <td><?=$row['totalAnualConsumption'];?></td>
                    <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                    ?>
                    <td id="valuee"><a href="statesupply.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>&client=<?=base64_encode($_GET['clinet'])?>&parent=<?=base64_encode($_GET['parent'])?>"><?php echo $row['state'] ?></a></td>
                    <?php 
                        } 
                    ?>
                    <td><div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="background: #345DA6;">
                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu" role="menu">


                    <?php 
                        if($rows['state']=='Archived' || $rows['state']=='Cancelled') {
                    ?>
                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>"  style="color: lightgray; pointer-events: none;">View</a></li>
                    <?php
                        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                        ?>
                    
                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit"  style="color: lightgray; pointer-events: none;">Edit</a></li>

                    <li>
                        <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" style="color: lightgray; pointer-events: none;" >Archive</a>
                    </li>
                    <li>
                        <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                    </li>
                    <li>
                        <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                    </li>
                        <?php 
                            }
                        ?>
                    <?php
                        }  else {
                    ?> <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=preview&role=<?=base64_encode('role')?>">View</a></li>
                    <?php
                        if($_SESSION['role'] == 'Admin' || $_SESSION['role'] == 'NUS Manager') {
                        ?>
                    
                    <li><a href="supplycontractpreview.php?info=<?=$user?>&id=<?=$row['supplierId']?>&type=edit">Edit</a></li>

                    <li>
                        <a id="editing" href="supplyarchieve.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" >Archive</a>
                    </li>
                    <li>
                        <a href="supplycancel.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" >Cancel</a>
                    </li>
                    <li>
                        <a href="supplyreactive.php?info=<?=$user?>&id=<?=$row['supplierId']?>&contractname=<?=base64_encode($row['contract_id'])?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                    </li>
                        <?php 
                            }
                        ?>
                    <?php
                        }
                    ?>

                </ul>
          </div></td>
        </tr>
             <?php
                }
                ?>
            <?php
            }
            ?>
            
                
        </tbody>
    </table>

</div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready( function () {
         $('#myTable').DataTable();
        } );
        // function deletecontract(id, cType){
            // let text = "Are want to Archive this contract";
            // alert(text);
            // if (confirm(text) === true) {

            //      $.ajax({
            //       type:'POST',
            //       url: 'js/callbacks/deletesupplycontract.php',
            //       data:{
            //         'supplierid':id,
            //         'contracttype':cType
                  
            //       },
            //       success: function(data){
            //       window.location.href = window.location.href;
            //       }
            //     });
               
            // } 
        // }
    </script>
    <?php
        include('hoverinclude/hoverhome.php');
    ?>
    </body>
</html>
