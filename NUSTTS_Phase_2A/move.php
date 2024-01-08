<?php
include('security.php');
if ($_SESSION['role'] != 'Admin') {
    echo "<script>alert('You have no access to view this page!');window.location.href='index.php';</script>";
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Move users </title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://phpcoder.tech/multiselect/js/jquery.multiselect.js"></script>
    <link rel="stylesheet" href="https://phpcoder.tech/multiselect/css/jquery.multiselect.css">
    <link rel="stylesheet" href="css/client.css">
</head>

<body>
    <?php
    include('dbconn.php');
    // session_start();
    $editsingledata = array();
    $getsupplydetails = "SELECT * FROM nususerdata WHERE id=" . $_GET['id'] . "";
    $result = $conn->query($getsupplydetails);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $editsingledata[] = $row;
        }
    }
    ?>

    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="moveContainer">
                <h2>Move user</h2>
                <div class="close-btn" onclick='window.history.go(-1);'>&times;</div>
                <hr color="#d2ddec">
                <form action="postmoveuser.php" method="POST" class="moveForm">
                    <label for="email">Email</label>
                    <input autocomplete="off" type="text" name="emailId" value="<?= $editsingledata[0]['emailId'] ?>" class="email" id="email" placeholder="Enter email" onkeyup="isEmpty()" readonly>
                    <label for="" class="role">Role</label>
                    <select name="role" id="roleSelected" required onchange="callMe();">
                        <option disabled selected>Select a role</option>
                        <option value="Admin" <?php
                                                if ($editsingledata[0]['role'] == 'Admin') {
                                                    echo 'selected';
                                                }
                                                ?>>Admin</option>
                        <option value="NUS Manager" <?php
                                                    if ($editsingledata[0]['role'] == 'NUS Manager') {
                                                        echo 'selected';
                                                    }
                                                    ?>>NUS Manager</option>
                        <option value="NUS User" <?php
                                                    if ($editsingledata[0]['role'] == 'NUS User') {
                                                        echo 'selected';
                                                    }
                                                    ?>>NUS User</option>
                        <option value="Parent company" disabled <?php
                                                                if ($editsingledata[0]['role'] == 'Parent company') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Parent User</option>
                        <option value="Client company" disabled <?php
                                                                if ($editsingledata[0]['role'] == 'Client company') {
                                                                    echo 'selected';
                                                                }
                                                                ?>>Client User</option>
                    </select>
                    <div class="nususer" id="nususer" style="display: none;">
                        <label for="" class="">Parent Company</label>
                        <select name="parentcompany[]" id="nususerselection" multiple>
                            <?php
                            $sqlQuery = "SELECT * FROM parentcompanydata;";
                            $resSql = mysqli_query($conn, $sqlQuery);
                            while ($resRow = mysqli_fetch_assoc($resSql)) {
                            ?>
                                <option value="<?= $resRow['id']; ?>"><?= $resRow['parentcompany']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <hr color="#d2ddec">
                    <div class="one">
                        <button type="reset" class="cancelClass" onclick='window.history.go(-1);'>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <button type="submit" class="createClass" onclick="validate();">Confirm <img src="img/confirm.svg" alt="plus icon" width="14px"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

</body>
<script>
    jQuery('#nususerselection').multiselect({
        columns: 1,
        placeholder: 'Select one or more parent company',
        search: true
    });

    function callMe() {
        res = $('#roleSelected').val();
        div1 = document.getElementById('nususer');
        if (res == "NUS User") {
            div1.style.display = 'block';
            $('#nususerselection').attr('required', true);
        } else {
            div1.style.display = 'none';
            $('#nususerselection').attr('required', false);
        }
    }

    res = $('#roleSelected').val();
    div1 = document.getElementById('nususer');
    if (res == "NUS User") {
        div1.style.display = 'block';
        $('#nususerselection').attr('required', true);
    }

    function validate() {
        res = $('#roleSelected').val();
        console.log("Res = "+res);
        if (res === 'NUS User') {
            document.getElementById('nususerselection').value == ''?alert('Please select parent company!'):console.log('ok');
        }
    }

</script>

</html>