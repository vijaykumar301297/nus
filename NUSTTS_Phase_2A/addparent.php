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
    <title>NUS TTS System | Create Parent</title>
    <link rel="icon" href="img/social-square-n-blue.png">
    <link rel="stylesheet" href="css/client.css">
</head>
<body>
    <section class="sec1Container">
        <div class="sec1Wrapper">
            <div class="parentContainer">
                <h2>New Parent Entity</h2>
                <div class="close-btn" onclick='window.history.go(-1);'>&times;</div>
                <hr color="#d2ddec">
                <form action="postparentcompanydata.php" method="POST" class="parentAddForm">
                    <label for="pCompany">Parent entity name</label>
                    <input type="text" name="parentcompany" id="pCompany" placeholder="Enter the name of the parent entity" required>
                    <hr color="#d2ddec">
                    <div class="one">
                        <button type="reset" class="cancelClass" onclick='window.history.go(-1);'>Cancel <img src="img/cancel-svgrepo-com.svg" alt="cancel icon" width="14px"></button>
                        <button type="submit" class="createClass">Create Parent <img src="img/plus-white.svg" alt="plus icon" width="14px"></button>
                    </div>
                </form>
            </div>
        </div>
    </section>
<script>
    function togglepopUp() {
        document.getElementById("popup-1").classList.toggle("active");
    }

    const submitButton = document.getElementById("enable_button");
    const input = document.getElementById("parententityname");
    input.addEventListener("keyup", (e) => {
            
    const value = e.currentTarget.value;
        if(value === "") {
            submitButton.disabled = true;
        } 
        else {
            submitButton.disabled = false;
            }
        });
</script>
</body>
</html>