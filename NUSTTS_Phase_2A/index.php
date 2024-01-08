<?php
    include('security.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Home</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <style>
        .mainContainer {
            position:absolute;
            top: 50%;
            left: 55%;
            transform: translate(-50%, -50%);
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="menu">

            <?php
                include('sidebar.php');

            ?>
        </div>
        <div class="mainContainer">
            
            <span class="bodyWelcome chColorOne">Welcome<strong> <?php echo $_SESSION['user']; ?>,</strong></span>
            <span class="bodyWelcome chColorTwo">to NUS Consulting Group's TTS (Trade Tracking System)</span></span>
            <!-- <h1>NUS FRS System</h1> -->
            <span class="bodySent chColorTwo">portal which will allow you to access, view, and generate</span>
            <p class="chColorTwo">position reports relating to your energy supply contracts.</p>
            <br>
            <span class="indexDisclaimer chColorTwo">To return to this Home screen at any time <br> simply click on the NUS Consulting Group logo.</span>
        </div>
    </div>
</body>
</html>