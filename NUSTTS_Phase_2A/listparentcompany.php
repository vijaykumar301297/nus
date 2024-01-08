<?php
    include 'security.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Parent Company List</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <style>

        body {
            background-color: #F9FBFD !important;
            line-height: normal !important;
        }

        #DataTables_Table_0_wrapper {
            /* position: absolute; */
            width: 87%;
            margin: 80px 0 0 360px;
        }

       #myTable_wrapper {
            /* position: absolute; */
            width: 76%;
            margin: 178px 0 0 20%;
            /* left: 20%; */
            /* top:27%; */
        }
        #myTable_filter {
            position: absolute;
            /* bottom: 100%; */
            right: 4%;
            top: -60px;
        }

      
        table {
            border: 2px solid #CED4DA;
            border-radius: 6px;
            width: 76%;
            margin: 10px 300px;
        }
        /* table.dataTable thead > tr > th.sorting_asc::before {
            opacity: 1;
            position: absolute;
            left: 13%;
            color: black;
        }
        table.dataTable thead > tr > th.sorting::after {
            opacity: 1;
            position: absolute;
            left: 13%;
            color: black;
        } */
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
            color: black;
            font-size:14px;
        }
        .parentdatas{
            text-decoration: none;
        }
        .parent {
            text-align:left;
        }
        .views{
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
        .viewclient {
            color: #fff;
            padding:5px 10px;
            border-radius:25px;
        }
        .viewIcon {
            width: 24px;
            height:24px;
            /* background-color: #345DA6; */
        }

        
        .dropdown-menu {
            min-width: 140px;
        }

        .arch td {
            background-color:rgba(238, 237, 237, 0.9);;
            color: #345DA6;
            /* font-weight: 500; */
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
        label {
            color: black !important;
            font-size: 14px;
            font-weight: normal !important;
        }
        /* h5 {
            position: absolute;
            top: 12%;
            left: 20%;
            font-size: 14px;
            color: #345DA6;
            font-weight: 500;
        } */

      
        input[type=checkbox] {
            margin: 0;
        }
        #btn {
            background: #345DA6;
            color:white;
            padding:6px 40px;
            border-radius:10px;
            cursor: pointer;
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

        .companylist {
            margin: 40px 0 0 00px;
            font-weight: 600;
            font-size: 20px;
            color: #345DA6;
        }
        .heading {
            margin: 0 0 30px 0;
        }
        .clientfrs {
            font-size: 20px;
            font-weight: 600;
            color: #345DA6;
        }
        .state {
            margin-bottom: 20px;
        }
        /* span {
            width: 8%;
            text-align: center;
            font-weight: 500;
            padding: 10px 10px;
            background-color: rgba(238, 237, 237, 0.9);
            border: none;
            border-radius: 5px;
            margin-bottom: 10px;
            
        } */
        input[type="checkbox"] {
            vertical-align: middle;
            position: relative;
            bottom: 1px;
        }
     
        .filterheader {
            color: #345DA6;
            font-size: 14px;
            font-weight: 500;
        }
        .filter {
            display: flex;
            margin-left: -10px;
            margin-bottom: 20px;
            overflow-y:hidden !important;
        }
        h6 {
            font-size: 13px;
            font-weight: 500;
        }
    </style>
</head>
<body>
    
<div class="headerSection">
    <div class="headingstate">
        <div class="heading">
            <p class="companylist">List of all accounts in <strong>TTS</strong> system</p>
    </div>
    <div class="filterheader" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
        <h6>Filter By</h6>
    </div>
    <div class="formFilter" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                    <form action="" method="GET">
                        <div class="filter">
                    
                        <label for=""><input type="checkbox" value="Active" name="active" <?php echo empty($_GET['active'])?'':'checked'; ?>>&nbsp;Active</label>
                            
                            <label for=""><input type="checkbox" value="Archived" name="archive" <?php echo empty($_GET['archive'])?'':'checked'; ?>>&nbsp;Archived</label>
                            
                            <label for=""><input type="checkbox" value="Cancelled" name="cancel" <?php echo empty($_GET['cancel'])?'':'checked'; ?>>&nbsp;Cancelled</label>
                            <button class="btn" type="submit"><img src="img/reload_apply.svg" alt="reloadicon" width="20px"> Apply</button>
                        </div>
                    </form>
                </div>
            </div>
<table class="myTable" id ="myTable" >
		<thead class="tableheadings">
			
			<th class="parent">Parent Company</th>
            <?php  
                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
            ?>
            <?php } else{?>
            <th class="parent">Clients</th>
            <?php 
                }
            ?>
            <th>State</th>
            <th class="parent"></th>
            <th></th>
			
		</thead>
		<tbody>
        <?php
            include('dbconn.php');
            include 'includes/functions.php';
            $functions = new libFunc();
            $wherefiled = '';

            if($_SESSION['role'] == "NUS User") {
                $newstr = trim($_SESSION['parent']);
                $newVal = explode(" ",$newstr);
                $output = implode(",",$newVal);
                // echo $output;
                $wherefiled ="WHERE id IN ($output)";
            }

            if($_SESSION['role'] == 'Parent company') {
                // $wherefiled = "AND parentcompany ='".$_SESSION['parent']."'";
                echo "Parent = ".$_SESSION['parent'];
                $newstr = trim($_SESSION['parent']);
                $newVal = explode(" ",$newstr);
                $output = implode(",",$newVal);
                // echo $output;
                $wherefiled ="WHERE id IN ($output)";
                // echo 'Im Parent';
            }
            if($_SESSION['role'] == 'Client company') {
                // $wherefiled = "AND parentcompany ='".$_SESSION['parent']."'";
                // echo 'Im Client';
                $newstr = trim($_SESSION['parent']);
                $newVal = explode(" ",$newstr);
                $output = implode(",",$newVal);
                // echo $output;
                $wherefiled ="WHERE id IN ($output)";
            }
            // // echo $wherefiled;
            // // echo $wherefiled;
            // $sql = "SELECT * FROM parentcompanydata ".$wherefiled."";
            // $result = mysqli_query($conn, $sql);
            // // echo "<pre>";
            // // echo $sql;

            $active = empty($_GET['active'])? '': $_GET['active'];
            $cancel = empty($_GET['cancel'])? '': $_GET['cancel'];
            $archive = empty($_GET['archive'])? '': $_GET['archive'];
            // echo "<h1>".$_SESSION['role']."</h1>";
            if($active == '' && $cancel == '' && $archive == '' && $_SESSION['role'] != 'Parent company' && $_SESSION['role'] != 'Client company') {
                $sql = "SELECT * FROM parentcompanydata " . $wherefiled . "";
            } else if($_SESSION['role'] == 'NUS User'){
                $sql = "SELECT * FROM parentcompanydata " . $wherefiled . " AND state IN ('$active','$cancel','$archive');";
            } else if($_SESSION['role'] == 'Client company' || $_SESSION['role'] == 'Parent company') {
                $sql = "SELECT * FROM parentcompanydata " . $wherefiled . " AND state='Active';";
            } 
            else {
                $sql = "SELECT * FROM parentcompanydata WHERE 1 " . $wherefiled . " AND state IN ('$active','$cancel','$archive');";
            }

            // echo "<h1>".$sql."</h1>";

            $result = mysqli_query($conn, $sql);
            while($row = mysqli_fetch_assoc($result)) {
            ?>
                <?php
                    if ($row['state'] == 'Archived') {
                ?>

                        <tr class="arch">
                            <td><a href="clientcompany.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><?php echo $row['parentcompany']; ?></a></td>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){}
                                else{
                            ?>
                            <td><?= $functions->getcountclient($row['parentcompany']) ?></td>
                            <?php  
                                } 
                            ?>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            
                            <td id="valuee"><a href="statedetails.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                            <td><a class="views" href="clientcompany.php?id=<?php echo base64_encode($row['parentcompany']); ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                            <td>

                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                    
                                    <ul class="dropdown-menu" role="menu" >
                                    <?php
                                      if($_SESSION['role'] == 'Admin') {
                                    ?>
                                        <li>
                                            <a id="editing" href="archieve.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                        </li>
                                        <li>
                                            <a href="cancelled.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                        </li>
                                        <li>
                                            <a href="reactive.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving">Re-Activate</a>
                                        </li>
                                        <?php 
                                            }
                                          else {
                                            ?>
                                        <li>
                                            <a id="editing" href="archieve.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                        </li>
                                        <li>
                                            <a href="cancelled.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                        </li>
                                        <li>
                                            <a href="reactive.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                        </li>
                                        <?php 
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php
                     } else if ($row['state'] == 'Cancelled') {
                        ?>
                            <tr class="cancelled">
                                <td><a href="clientcompany.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><?php echo $row['parentcompany']; ?></a></td>
                                <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){}
                                else{
                            ?>
                            <td><?= $functions->getcountclient($row['parentcompany']) ?></td>
                            <?php  
                                } 
                            ?>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            
                            <td id="valuee"><a href="statedetails.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                                <td><a class="views" href="clientcompany.php?id=<?php echo  base64_encode($row['parentcompany']); ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                        <ul class="dropdown-menu" role="menu" >
                                        <?php
                                            if($_SESSION['role'] == 'Admin') {
                                        ?>
                                            <li>
                                                <a id="editing" href="archieve.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="cancelled.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <li>
                                                <a href="reactive.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving">Re-Activate</a>
                                            </li>
                                            <?php 
                                            }
                                          else {
                                            ?>
                                            <li>
                                                <a id="editing" href="archieve.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="cancelled.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <li>
                                                <a href="reactive.php?id=<?php echo  base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                            </li>
                                            <?php 
                                          }
                                          ?>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php
                        } else {
                            ?>
                                <tr>
                                    <td><a href="clientcompany.php?id=<?php echo  base64_encode($row['parentcompany']) ?>"><?php echo $row['parentcompany']; ?></a></td>
                                    <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){}
                                else{
                            ?>
                            <td><?= $functions->getcountclient($row['parentcompany']) ?></td>
                            <?php  
                                } 
                            ?>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            
                            <td id="valuee"><a href="statedetails.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                                    <td><a class="views" href="clientcompany.php?id=<?php echo base64_encode($row['parentcompany']) ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                                    <td>
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                            <ul class="dropdown-menu" role="menu" >
                                            <?php
                                                if($_SESSION['role'] == 'Admin') {
                                            ?>  
                                            
                                                <li>
                                                    <a id="editing" href="archieve.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>">Archive</a>
                                                </li>
                                                <li>
                                                    <a href="cancelled.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving"">Cancel</a>
                                                </li>
                                                <li>
                                                    <a href="reactive.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>

                                                <?php 
                                            }
                                          else {
                                            ?>

                                                <li>
                                                    <a id="editing" href="archieve.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                                </li>
                                                <li>
                                                    <a href="cancelled.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                                </li>
                                                <li>
                                                    <a href="reactive.php?id=<?php echo base64_encode($row['parentcompany']) ?>&ids=<?php echo $row['id']?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                                 }
                                            ?>
                                            </ul>
                                        </div>
                                    </td>
            
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
    </script>
     <?php
        include('hoverinclude/hoverhome.php');
    ?>
    </body>
</html>
