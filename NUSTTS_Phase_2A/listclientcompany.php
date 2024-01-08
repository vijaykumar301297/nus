<?php
include 'security.php';
include ('dbconn.php');
$sql = "select * from clientcompanydata";
	$result = $conn->query($sql);
            	//declare array to store the data of database
        $row = array();
            
        if ($result->num_rows > 0) {
                  // output data of each row
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
    <style>
        /* #DataTables_Table_1_wrapper {
            position: absolute;
            width: 76%;
            margin: 150px 0 0 300px;
        }
         */
        #DataTables_Table_1_wrapper{
            position: absolute;
            width: 80%; 
            margin: 75px 0 0 0;
            left: 25%;
        }
        table {
            border: 2px solid #CED4DA;
            border-radius: 6px;
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
    </style>
</head>
<body>

    <table class="myTable">
    <thead>
			<tr>		
            <th>Client Company</th>
            <th>Parent Company</th>
			<th>Country</th>
            <th>State</th>
            <th></th>

			<!-- </tr> -->
		</thead>
		<!-- <tbody> -->
			<?php
                if(!empty($row))
                foreach($row as $rows)
                {
                ?>
                 <?php
                    if ($rows['state'] == 'Archived') {
                ?>
                    <tr  class ="arch" >       
                        <td><?php echo $rows['clientcompany']; ?></td>
                        <td><?php echo $rows['parentcompany']; ?></td>    
                        <td><?php echo $rows['country']; ?></td>
                        <td><?php echo $rows['state']; ?></td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="editing" href="clientedit.php?id=<?=$rows['id']?>" style="color: lightgray; pointer-events: none;">Edit Client</a>
                            </li>
                            
                        </ul>

                    </div>
                    </td>
                    </tr>

            <?php
                } else if ($rows['state'] == 'Cancelled') {
            ?>

                <tr  class ="cancelled">       
                        <td><?php echo $rows['clientcompany']; ?></td>
                        <td><?php echo $rows['parentcompany']; ?></td>    
                        <td><?php echo $rows['country']; ?></td>
                        <td><?php echo $rows['state']; ?></td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="editing" href="clientedit.php?id=<?=$rows['id']?>" style="color: lightgray; pointer-events: none;">Edit Client</a>
                            </li>
                            
                        </ul>

                    </div>
                    </td>
                    </tr>
            <?php
                } else {
            ?>

                    <tr >       
                        <td><?php echo $rows['clientcompany']; ?></td>
                        <td><?php echo $rows['parentcompany']; ?></td>    
                        <td><?php echo $rows['country']; ?></td>
                        <td><?php echo $rows['state']; ?></td>
                        <td>
                        <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="editing" href="clientedit.php?id=<?=$rows['id']?>">Edit Client</a>
                            </li>
                            
                        </ul>

                    </div>
                    </td>
                    </tr>
            <?php
                }
            ?>

			<?php } ?>
		<!-- </tbody> -->
    </table>
</body>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".myTable").DataTable();
        });
    </script>
</html>