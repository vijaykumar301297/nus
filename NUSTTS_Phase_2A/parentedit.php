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
    <link rel="stylesheet" href="css/client.css">
    <title>NUS TTS System | Edit Parent Details </title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <style>
        .editContainer {
            height: 220px;
        }
    </style>
</head>
<body>
<?php
include('dbconn.php');
$editsingledata = array();
$getsupplydetails = "SELECT * FROM parentcompanydata WHERE id=".$_GET['id']."";
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
                <h2>Edit Parent</h2>
                <div class="close-btn"onclick='window.history.go(-1);'>&times;</div>
                <hr color="#d2ddec">
                <form action="postparentedit.php" method="POST" class="editAddForm">
                <label for="username">Parent Company name</label>
                <input autocomplete="off" type="text" name="parentcompany" class="username" id="username" placeholder="Enter username" onkeyup="isEmpty()" value="<?=$editsingledata[0]['parentcompany']?>" required>
                <input type="hidden" name="id" value="<?=$editsingledata[0]['id']?>">
                <input  type="hidden" name="state" value="<?=$editsingledata[0]['state']?>">

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
        
 