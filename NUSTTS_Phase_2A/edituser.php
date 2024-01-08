<?php
    include('security.php');
    if($_SESSION['role'] != 'Admin'){
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
    <!-- <title>Edit user Details</title> -->
    <link rel="stylesheet" href="css/client.css">
        <title>NUS TTS System | Edit user Details </title>
    <link rel="icon" href="img/social-square-n-blue.png">
    
</head>
<body>
<?php
include('dbconn.php');
$editsingledata = array();
$getsupplydetails = "SELECT * FROM nususerdata WHERE id=".$_GET['id']."";
$result = $conn->query($getsupplydetails);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $editsingledata[] = $row;
    }
}
?>
    
    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="editContainer">
                <h2>Edit user Details</h2>
                <div class="close-btn"onclick='window.history.go(-1);'>&times;</div>
                <hr color="#d2ddec">
                <form action="postedituser.php" method="POST" class="editAddForm">
                <label for="username">User Name</label>
                <input autocomplete="off" type="text" name="username" class="username" id="username" placeholder="Enter username" onkeyup="isEmpty()" value="<?=$editsingledata[0]['username']?>" required>
                <label for="email" class="emailId">Email</label>
                <input autocomplete="off" type="email" name="emailId" class="email" value="<?=$editsingledata[0]['emailId']?>" id="email" placeholder="Enter email" readonly onkeyup="isEmpty()" required>
                    <hr color="#d2ddec">
                    <div class="one">
                        <button type="reset" class="cancelClass" onclick='window.history.go(-1);'>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <button type="submit" class="createClass">Confirm <img src="img/confirm.svg" alt="plus icon" width="14px"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

  
        </body>
        </html>
        
 