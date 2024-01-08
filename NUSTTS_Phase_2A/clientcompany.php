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
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/style.css" />
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
            top: -70px;
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
            color: black;
            font-size: 14px;
        }

        .parentdatas {
            text-decoration: none;
        }

        .parent {
            text-align: left;
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
            padding: 5px 10px;
            border-radius: 25px;
        }

        table.dataTable thead>tr>th.sorting_asc::before,
        table.dataTable thead>tr>th.sorting_desc::after {
            opacity: 1;
        }

        td {
            background: white;
        }

        .viewIcon {
            width: 24px;
            height: 24px;
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
            background-color: rgba(238, 237, 237, 0.9);
            ;
            color: #345DA6;
            font-weight: normal;
        }

        .arch td>a {
            color: #345DA6;
            /* font-weight: 300; */
        }

        .cancelled td {
            background-color: rgba(238, 237, 237, 0.9);
            ;
            color: red;
            /* font-weight: 500; */
        }

        .cancelled td>a {
            color: red;
            /* font-weight: 500; */
            border-bottom: red;
        }

        input[type="checkbox"] {
            margin: 0;
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
            margin: 0 0;
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
            margin: 0 0 45px 0;
        }

        .clientfrs {
            font-size: 20px;
            font-weight: 600;
            color: #345DA6;
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
            overflow-y: hidden !important;
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
        $parentcompany = mysqli_query($conn, "SELECT * From parentcompanydata where parentcompany ='" . base64_decode($_GET['id']) . "' ");
        while ($parentcompanydata = mysqli_fetch_array($parentcompany)) {
            if ($parentcompanydata['state'] == 'Archived') {
                echo "<span class=stateValues style=color:#345DA6;>" . $parentcompanydata['state'] . "</span>";
            } else if ($parentcompanydata['state'] == 'Cancelled') {
                echo "<span class=stateValues style= color:Red;>" . $parentcompanydata['state'] . "</span>";
            } else {
                echo "<span class=stateValues style= color:black;>" . $parentcompanydata['state'] . "</span>";
            }
        }
        ?>
    </div>
    <div class="headerSection">
        <div class="headingstate">
            <div class="heading">
                <p><a href="addhome.php" class="clientfrs"><?php echo base64_decode($_GET['id']); ?></a></p>
            </div>



            <div class="filterheader" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                <h6>Filter By</h6>
            </div>
            <div class="formFilter" <?php if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') echo "style=display:none;"; ?>>
                <form action="" method="GET">
                    <div class="filter">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <label for=""><input type="checkbox" value="Active" name="active" <?php echo empty($_GET['active']) ? '' : 'checked'; ?>>&nbsp;Active</label>

                        <label for=""><input type="checkbox" value="Archived" name="archive" <?php echo empty($_GET['archive']) ? '' : 'checked'; ?>>&nbsp;Archived</label>

                        <label for=""><input type="checkbox" value="Cancelled" name="cancel" <?php echo empty($_GET['cancel']) ? '' : 'checked'; ?>>&nbsp;Cancelled</label>
                        <button class="btn" type="submit"><img src="img/reload_apply.svg" alt="reloadicon" width="22px"> Apply</button>
                    </div>
                </form>
            </div>
        </div>











        <table class="myTable" id="myTable">
            <thead class="tableheadings" style="height:40px">
                <!-- <tr> -->
                <th class="parent">Client Company</th>
                <th class="parent">Country</th>
                <th class="parent">State</th>
                <th class="parent"></th>
                <th></th>
                <!-- </tr> -->
            </thead>
            <tbody>
                <?php
                include('dbconn.php');


                if ($_SESSION['role'] == 'Client company') {
                    // $res = $_SESSION['client'];
                    // echo "<script>var myres='$res'.split(',');alert(myres[0]);</script>";
                    $newstr = trim($_SESSION['client']);
                    $newVal = explode(" ", $newstr);
                    $output = implode(",", $newVal);
                    // echo $output;
                    $user = "id IN ($output)";
                    // echo '<h1>'.$_SESSION['client'].'</h1>';
                    // echo '<h1>Im Client</h1>';
                } else {
                    $user = "parentcompany ='" . base64_decode($_GET['id']) . "'";
                }

                // if($_SESSION['role'] == 'Client company') {
                //     $sql = "SELECT * FROM clientcompanydata WHERE ".$user."";
                // } else {
                //     $sql = "SELECT * FROM clientcompanydata WHERE 1 ".$user."";
                // }

                $active = empty($_GET['active']) ? '' : $_GET['active'];
                $cancel = empty($_GET['cancel']) ? '' : $_GET['cancel'];
                $archive = empty($_GET['archive']) ? '' : $_GET['archive'];

                // echo "<h1>".$_SESSION['role']."</h1>";
                if ($active == '' && $cancel == '' && $archive == '' && $_SESSION['role'] != 'Parent company' && $_SESSION['role'] != 'Client company') {
                    $sql = "SELECT * FROM clientcompanydata WHERE " . $user . "";
                } else if ($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company') {
                    $sql = "SELECT * FROM clientcompanydata WHERE " . $user . "  AND state = 'Active';";
                } else {
                    $sql = "SELECT * FROM clientcompanydata WHERE " . $user . "  AND state IN ('$active','$cancel','$archive');";
                }


                // echo "SQL Query = ".$sql;

                // echo '<h1>'.$sql.'</h1>';
                $result = mysqli_query($conn, $sql);

                $parentcompany = mysqli_query($conn, "SELECT * From parentcompanydata where parentcompany ='" . base64_decode($_GET['id']) . "' ");
                $rowsstate = mysqli_fetch_array($parentcompany);

                while ($row = mysqli_fetch_assoc($result)) {
                ?>

                    <?php
                    if ($row['state'] == 'Archived') {
                    ?>
                        <tr class="arch">
                            <!-- <td><a href=""><a></td> -->
                            <td><a href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['clientcompany']; ?></a></td>
                            <td><a><?php echo $row['country']; ?></a></td>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            <td id="valuee"><a href="stateclient.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                            <td><a class="viewclient" href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php
                                        if ($_SESSION['role'] == 'Admin') {
                                        ?>
                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving">Re-Activate</a>
                                                </li>
                                            <?php }
                                            ?>
                                        <?php
                                        } else {
                                        ?>
                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            }
                                            ?>
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
                            <!-- <td><a href=""><a></td> -->
                            <td><a href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['clientcompany']; ?></a></td>
                            <td><a><?php echo $row['country']; ?></a></td>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            <td id="valuee"><a href="stateclient.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                            <td><a class="viewclient" href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu" role="menu" <?php if ($_SESSION['role'] != 'Admin') echo  "style=color:lightgrey; pointer-events: none;" ?>>
                                        <?php
                                        if ($_SESSION['role'] == 'Admin') {
                                        ?>
                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving">Re-Activate</a>
                                                </li>
                                            <?php }
                                            ?>
                                        <?php } else {
                                        ?>
                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>
                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php }
                                            ?>
                                        <?php }
                                        ?>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    <?php
                    } else {
                    ?>
                        <tr style="height:40px">
                            <!-- <td><a href=""><a></td> -->
                            <td><a href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['clientcompany']; ?></a></td>
                            <td><a><?php echo $row['country']; ?></a></td>
                            <?php  
                                if($_SESSION['role'] == 'Parent company' || $_SESSION['role'] == 'Client company'){
                            ?>
                            <td id="valuee"><span style="color:black; font-size:14px;"><?php echo $row['state'] ?></span></td>
                            <?php  
                                }else{ 
                            ?>
                            <td id="valuee"><a href="stateclient.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><?php echo $row['state'] ?></a></td>
                            <?php 
                                }
                            ?>
                            <td><a class="viewclient" href="listsupplycontract.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>"><img src="img/views3.svg" alt="" class="viewIcon"></a></td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i></button>
                                    <ul class="dropdown-menu" role="menu">
                                        <?php
                                        if ($_SESSION['role'] == 'Admin') {
                                        ?>
                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving">Cancel</a>
                                            </li>

                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            }
                                            ?>
                                        <?php } else {
                                        ?>

                                            <li>
                                                <a id="editing" href="clientarchieve.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" style="color: lightgray; pointer-events: none;">Archive</a>
                                            </li>
                                            <li>
                                                <a href="clientcancel.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Cancel</a>
                                            </li>

                                            <?php
                                            if ($rowsstate['state'] == 'Archived' || $rowsstate['state'] == 'Cancelled') {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            } else {
                                            ?>
                                                <li>
                                                    <a href="clientreactive.php?id=<?= $row['id'] ?>&clinet=<?= base64_encode($row['clientcompany']) ?>&parent=<?= base64_encode($row['parentcompany']) ?>" id="moving" style="color: lightgray; pointer-events: none;">Re-Activate</a>
                                                </li>
                                            <?php
                                            }
                                            ?>

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js">
    </script>
    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>

    <?php
    include('hoverinclude/hoverhome.php');
    ?>
</body>

</html>