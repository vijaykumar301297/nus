

<?php

include 'security.php';

include 'dbconn.php';

// $sql = "select * from parentcompanydata;";
// 	$result = ($conn->query($sql));
// 	//declare array to store the data of database
// 	$row = [];

// 	if ($result->num_rows > 0)
// 	{
// 		// fetch all data from db into array
// 		$row = $result->fetch_all(MYSQLI_ASSOC);
// 	}


                $sql = "select * from parentcompanydata";
	            $result = $conn->query($sql);
            	//declare array to store the data of database
            	$row = array();
            
            	if ($result->num_rows > 0) {
                    // output data of each row
                    while($parent_row = $result->fetch_assoc()) {
                      $row[] = $parent_row;
                    }
                  }
                // print_r($row);
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
      href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"
    />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
       body {
            background-color: #F9FBFD !important;
            line-height: normal !important;
        }
        /*.main {*/
        /*    width: 100%;*/
        /*    height: 100%;*/
        /*    transform: translate(-50%,-50%);*/
        /*    position: absolute;*/
        /*    top: 50%;*/
        /*    left: 50%;*/
        /*    font-size: 1.5rem;*/

        /*}*/

        #DataTables_Table_0_wrapper {
            position: absolute;
            width: 80%;
            margin: 75px 0 0 0px;
            left: 25%;
        }
/* 
        #DataTables_Table_1_wrapper{
            position: absolute;
            width: 70%; 
            margin: 40px 0 0 0;
        } */
      
        table {
            border: 2px solid #D2DDEC;
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
            color: #6E84A3;
            background: #F9FBFD;
        }
        table.myTable thead th {
	        border-bottom: 1px solid #D2DDEC !important;
        }
        table td {
            color: #12263F;
            font-size: 13px;
            border-bottom: 1px solid #D2DDEC;
        }
        table.dataTable.no-footer {
            /* border-bottom: 2px solid #D2DDEC !important; */
            border-bottom: none !important;
        }
        table.dataTable thead > tr > th.sorting_asc::before, 
        table.dataTable thead > tr > th.sorting_desc::after {
            opacity: 1;
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
<div class="main">
<table class="myTable" >
		<thead class="tableheadings" style="height:10px">
			 <tr> 
			<th >Parent Company</th>
            <th>State</th>
            <th></th>
			 </tr> 
		</thead>
		 <tbody> 
        <?php
                if(!empty($row))
                foreach($row as $rows)
                {
                ?>

                
            <?php
                if ($rows['state'] == 'Archived') {
            ?>
			<tr class ="arch" style="height:10px">

            <td style="height:10px"><?php echo $rows['parentcompany']; ?></td> 
            <td style="height:10px"><?php echo $rows['state']; ?></td> 
            <td>
                <div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                     <ul class="dropdown-menu" role="menu">
                        <li>
                            <a id="editing" href="parentedit.php?id=<?=$rows['id']?>" style="color: lightgray; pointer-events: none;">Edit Parent</a>
                        </li>
                       
                    </ul>

                  </div>
                </td>
			</tr>

            <?php
                } else if ($rows['state'] == 'Cancelled') {
            ?>
                <tr  class ="cancelled"style="height:10px;">

                <td style="height:10px"><?php echo $rows['parentcompany']; ?></td> 
                <td style="height:10px"><?php echo $rows['state']; ?></td> 
                <td>
                    <div class="btn-group">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a id="editing" href="parentedit.php?id=<?=$rows['id']?>" style="color: lightgray; pointer-events: none;">Edit Parent</a>
                            </li>
                        
                        </ul>

                    </div>
                    </td>
                </tr>

            <?php
                } else {
            ?>
                <tr style="height:10px; color: black;">

                    <td style="height:10px"><?php echo $rows['parentcompany']; ?></td> 
                    <td style="height:10px"><?php echo $rows['state']; ?></td> 
                    <td>
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a id="editing" href="parentedit.php?id=<?=$rows['id']?>">Edit Parent</a>
                                </li>
                            
                            </ul>

                        </div>
                        </td>
                    </tr>
            <?php
                }
            ?>

			<?php } ?>

            
		 </tbody> 
	</table>
</div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $(".myTable").DataTable();
        });
    </script>
    </body>
</html>


