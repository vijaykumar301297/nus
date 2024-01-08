<?php

include 'security.php';
include ('dbconn.php');
    $sql = "select * from nususerdata where role=\"NUS manager\" AND active=\"Active\"";
//     $result = ($conn->query($sql));
// 	//declare array to store the data of database
// 	$row = [];

// 	if ($result->num_rows > 0)
// 	{
// 		// fetch all data from db into array
// 		$row = $result->fetch_all(MYSQLI_ASSOC);
// 	}

            $result = $conn->query($sql);
            	//declare array to store the data of database
            	$row = array();
            
            	if ($result->num_rows > 0) {
                  // output data of each row
                  while($manager_row = $result->fetch_assoc()) {
                    $row[] = $manager_row;
                  }
                }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS Consulting Group | Client Company List</title>
    <link
      rel="stylesheet"
      href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css"
    />
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>


    /* 
    #DataTables_Table_1_wrapper{
        position: absolute;
        width: 70%; 
        margin: 40px 0 0 0;
    } */

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

    .disableIcon {
       margin: 0 5px 1.5px 5px;
        }
    
        .disable {
            padding: 7px 18px 7px 13px; 
            border-radius:8px;
        }
        .list_manager{
            background-color: #345DA6!important;
            border: 1px solid #345DA6!important;
        }
</style>


    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="css/admin.css">
</head>

<body>
    <form action="" method="POST">
    <table class="myTable">
        <thead class="admintab">
			<tr class="adminactive">
                <th></th>
				<th>USERNAME</th>
				<th>EMAIL</th>
				<th>ACCOUNT STATUS</th>
				<th class="a"></th>
			</tr>
		</thead>
		
        <tbody class="admindatas">
			<?php
                if(!empty($row))
                    foreach($row as $rows)
                {
            ?>
			<tr> 
            <td><input type="checkbox" class="listmanager" name="selectData[]" value=<?=$rows['id']?>></td> 
            <td><?php echo $rows['username']; ?></td>
				<td><?php echo $rows['emailId']; ?></td>
                <?php
                    if($rows['accountstatus'] == 'Confirmed') {
                ?>
				<td><span style="background: #DCFFF0; color: #026A3E; padding: 5px 15px; border-radius: 3px; font-weight: 500;"><?php echo $rows['accountstatus'];?></span></td>
                <?php
                    } else { ?>
                    				<td><span style="background: #FFF4BD; color: #665600; padding: 5px 15px; border-radius: 3px; font-weight: 500;"><?php echo $rows['accountstatus'];?></span></td>
                    <?php
                    }?>
				<td class="admindot">
					<div class="btn-group">
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                     <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                    <ul class="dropdown-menu" role="menu">

                            <li>
                                <a id="editing" href="edituser.php?id=<?=$rows['id']?>">Edit Details</a>
                            </li>
                            <li>
                                <a href="move.php?id=<?=$rows['id']?>" id="moving">Move User</a>
                            </li>
                            <li>
                                <a href="disable.php?id=<?=$rows['id']?>" id="moving">Disable User</a>
                            </li>
                         
                    </ul>
                  </div>
				</td>
			</tr>
			<?php 
            } 
            
            ?>
		</tbody>
	</table>
     <button type="submit" name="disableuser" class=" btn-warning list_manager disable" ><img class= "disableIcon" src="img/Disable_icon.svg" alt="">Disable User</button>
 </form>
 <?php
if(isset($_POST['disableuser'])){
   foreach($_POST['selectData'] as $check) {
        $sql = "UPDATE nususerdata SET active='Inactive' WHERE id = ".$check."";
        $conn->query($sql);
        echo '<script>alert("Users Deactivated");window.location = window.location.href.split("#")[0];</script>';
   }
}
?>
<!-- <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><a class="paginate_button previous disabled" aria-controls="DataTables_Table_0" data-dt-idx="0" tabindex="-1" id="DataTables_Table_0_previous">Previous</a><span><a class="paginate_button current" aria-controls="DataTables_Table_0" data-dt-idx="1" tabindex="0">1</a><a class="paginate_button " aria-controls="DataTables_Table_0" data-dt-idx="2" tabindex="0">2</a></span><a class="paginate_button next" aria-controls="DataTables_Table_0" data-dt-idx="3" tabindex="0" id="DataTables_Table_0_next">Next</a></div> -->


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.list_manager').hide();
            $(".myTable").DataTable();
        });

    </script>

        
<script>
    $('.listmanager').each(function(){
        $(this).on('click',function(){
        var lengths = $('.listmanager:checkbox:checked').length;      
        if(lengths >=1 ){
            $('.list_manager').show();
        }else{
            $('.list_manager').hide();
        }
        });
    });
    document.querySelector('table').onclick = ({
    target
    }) => {
        if (!target.classList.contains('a')) return
        document.querySelectorAll('.ad.active').forEach(
        (d) => d !== target.parentElement && d.classList.remove('active')
    )
        target.parentElement.classList.toggle('active')
    }
</script>

</body>
</html>