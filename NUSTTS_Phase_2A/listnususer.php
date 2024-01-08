<?php
include 'security.php';
include('dbconn.php');
$sql = "select * from nususerdata where role=\"NUS user\" AND active=\"Active\"";
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
    while ($nususer_row = $result->fetch_assoc()) {
        $row[] = $nususer_row;
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
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <style>
        table {
            border: 2px solid #CED4DA;
            border-radius: 6px;
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

        .disableIcon {
            margin: 0 5px 1.5px 5px;
        }

        .disable {
            padding: 7px 18px 7px 13px;
            border-radius: 8px;
        }

        .list_user {
            background-color: #345DA6 !important;
            border: 1px solid #345DA6 !important;
        }
    </style>
</head>

<body>
    <form action="" method="POST">
        <table class="myTable">
            <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Account Status</th>
                    <th>Parent Company</th>
                    <th></th>

                </tr>
            </thead>
            <tbody>
                <?php
                if (!empty($row))
                    foreach ($row as $rows) {
                ?>
                    <tr>
                        <td><input type="checkbox" class="list_user_mang" name="selectData[]" value=<?= $rows['id'] ?>></td>
                        <td><?php echo $rows['username']; ?></td>
                        <td><?php echo $rows['emailId']; ?></td>
                        <?php
                        if ($rows['accountstatus'] == 'Confirmed') {
                        ?>
                            <td><span style="background: #DCFFF0; color: #026A3E; padding: 5px 15px; border-radius: 3px; font-weight: 500;"><?php echo $rows['accountstatus']; ?></span></td>
                        <?php
                        } else { ?>
                            <td><span style="background: #FFF4BD; color: #665600; padding: 5px 15px; border-radius: 3px; font-weight: 500;"><?php echo $rows['accountstatus']; ?></span></td>
                        <?php
                        } ?>
                        <td>
                            <?php
                            // echo $rows['parentcompany'];
                            if (empty($rows['parentcompany'])) {
                                echo '';
                            } else {
                                $newstr = trim($rows['parentcompany']);
                                $newVal = explode(" ", $newstr);
                                $output = implode(",", $newVal);
                                $sqlQueryOnee = "SELECT * FROM parentcompanydata WHERE id IN ($output);";
                                $resultOneQuery = mysqli_query($conn, $sqlQueryOnee);
                                $finalRes = '';
                                while ($rowOneQuery = mysqli_fetch_assoc($resultOneQuery)) {
                                    $finalRes = $rowOneQuery['parentcompany'] . ", " . $finalRes;
                                }
                                $resVal = trim($finalRes);
                                echo trim($resVal, ",");
                            }
                            ?>
                        </td>
                        <td class="threedot">
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                <ul class="dropdown-menu" role="menu">

                                    <li>
                                        <a id="editing" href="edituser.php?id=<?= $rows['id'] ?>">Edit Details</a>
                                    </li>
                                    <li>
                                        <a href="move.php?id=<?= $rows['id'] ?>" id="moving">Move User</a>
                                    </li>
                                    <li>
                                        <a href="disable.php?id=<?= $rows['id'] ?>" id="moving">Disable User</a>
                                    </li>

                                </ul>
                            </div>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <button type="submit" name="disableuser" class="btn-warning list_user disable"><img class="disableIcon" src="img/Disable_icon.svg" alt="">Disable User</button>
    </form>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('.list_user').hide();
        $(".myTable").DataTable();
    });
</script>

<?php
if (isset($_POST['disableuser'])) {
    foreach ($_POST['selectData'] as $check) {
        $sql = "UPDATE nususerdata SET active='Inactive' WHERE id = " . $check . "";
        $conn->query($sql);
        echo '<script>alert("Users Disabled");window.location = window.location.href.split("#")[0];</script>';
    }
}
?>
<script>
    document.querySelector('table').onclick = ({
        target
    }) => {
        if (!target.classList.contains('click')) return
        document.querySelectorAll('.dropouts.active').forEach(
            (d) => d !== target.parentElement && d.classList.remove('active')
        )
        target.parentElement.classList.toggle('active')
    }
    $('.list_user_mang').each(function() {
        $(this).on('click', function() {
            var lengths = $('.list_user_mang:checkbox:checked').length;
            if (lengths >= 1) {
                $('.list_user').show();
            } else {
                $('.list_user').hide();
            }
        });
    });
</script>

</html>