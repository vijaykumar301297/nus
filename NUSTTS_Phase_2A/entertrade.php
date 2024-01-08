<?php
    include('security.php');

    if($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'NUS Manager') {
        //echo 'You have no acesss to view the page';
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
    <title>NUS TTS System | Enter Trade</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <script src="js/function.js"></script>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <div class="main">
        <div class="menu">

            <?php
                include('sidebar.php');
            ?>
        </div>
    <div>
    <div class="contentMove">
    <?php
		    include('entertradedesign.php');
            // echo "Hi";
	    ?>
    </div>

    <?php
        include('hoverinclude/hovertrade.php');
    ?>
</body>
</html>