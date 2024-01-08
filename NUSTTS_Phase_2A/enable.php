<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Enable user Details </title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link rel="stylesheet" href="css/client.css">
</head>
<?php 
include('dbconn.php');
session_start();
$editsingledata = array();
$getsupplydetails = "SELECT * FROM nususerdata WHERE id=".$_GET['id']."";
$result = $conn->query($getsupplydetails);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $editsingledata[] = $row;
    }
}
?>
<body>
    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="disableContainer">
                <h2>Enable user</h2>
                <div class="close-btn"onclick='window.history.go(-1);'>&times;</div>
                <hr color="#d2ddec">
                <form action="postenableuser.php" method="POST" class="moveForm">
                <label for="email">Email</label>
                <input autocomplete="off" type="text" name="emailId" value="<?=$editsingledata[0]['emailId']?>" class="email" id="email" placeholder="Enter email" onkeyup="isEmpty()" readonly required>
               
                    <hr color="#d2ddec">
                    <div class="one">
                        <button type="reset" class="cancelClass" onclick='window.history.go(-1);'>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <button type="submit" class="createClass">Confirm <img src="img/confirm.svg" alt="plus icon" width="14px"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    </div>

  
    </body>
</html>
        
        </body>
        </html>
        
 