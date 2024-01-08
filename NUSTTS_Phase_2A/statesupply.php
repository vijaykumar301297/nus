<?php
include_once 'security.php';
?>
<?php

include ('dbconn.php');
$sql = "select * from nus_supply_archieve where supplierId = '".$_GET['id']."'";
	$result = $conn->query($sql);
        $row = array();
        if ($result->num_rows > 0) {
            while($client_row = $result->fetch_assoc()) {
                $row[] = $client_row;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Client</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    
    <link
      rel="stylesheet"
      href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <style> 
        body {
            background-color: #f9fbfd;
            font-family: 'Roboto', sans-serif;
        }
        h3 {
            color: #345DA6;
            margin: 10px 0 0 10%;
            font-weight: 400;
            font-size: 20px;
            text-align: center;
        }

        button {
            position: absolute;
            top: 2%;
            right: 10%;
            background-color: #345da6;
            padding: 8px 25px;
            text-decoration: none;
            color: white;
            margin: 0 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .dataTables_length {
            margin-bottom: 12px;
        }
        .row {
            /* width: 70%; */
            /* text-align: center; */
            position: absolute;
            top: 10%;
            left: 15%;
            right: 0;
            width: 70%;
        }

        table {
            border: 2px solid #CED4DA;
            border-radius: 6px;
            margin: 10px auto;
        }
        table thead th {
            width: 10px;
            height: 30px;
        }

        button img {
            width: 15px;
            height: 15px;
            position:absolute;
            left:10px;
            top:61%;
            margin-top:-11px;
        }

        table td {
            color: #345DA6;
            width: 10px;
            height: 30px;
            font-weight: 500;
            background-color: #FFFFFF;
            font-size: 13px;
            border-bottom: 1px solid #CED4DA;
        }
    </style>
</head>
<body>
    <div class="container">

        <div>
    
            <h3>List of state changes made in <strong><?php echo base64_decode($_GET['contractname']);?></strong> </h3>
            <button onclick="history.back()"><img src="img/back_svg_icon.svg" alt="back img" >&nbsp;Back</button>
        </div>
        
        <div class="row">

            <table class="myTable">
                <thead style="height:10px;">	
                    <!-- <th class="stateheading">Parent Company</th> -->
                    <th class="stateheading">Date</th>
                    <th class="stateheading">Type</th>
                    <th class="stateheading">User</th>
                    <th class="stateheading">Description</th>
		        </thead>
                    <?php
                        if(!empty($row))
                        foreach($row as $rows)
                        {
                        ?>
                        <tr class="rowdata">
                            <!-- <td><?php //echo $rows['parentcompany']; ?></td>        -->
                            <td><?php echo date("d-M-Y",strtotime($rows['datevalue'])); ?></td>
                            <?php
                                if ($rows['state'] == 'Archived' ||  $rows['state'] == 'Cancelled') {
                            ?>
                                <td><?php echo $rows['state']; ?></td> 
                            <?php
                            } else { ?>
                                <td><?php echo 'Re-activated' ?></td> 
                            <?php
                            }?>
                            <td><?php echo $rows['user']; ?></td>
                            <td><?php echo $rows['description']; ?></td>
                        </tr>
                    <?php } ?>
          
                </table>        
        </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function () {
        $(".myTable").DataTable();
    });
</script>
</html>