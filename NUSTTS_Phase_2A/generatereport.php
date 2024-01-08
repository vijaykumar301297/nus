<?php
include('security.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Generate Report</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link rel="stylesheet" type="text/css" href="css/stylenew.css" />
    <style>
        body {
            background-color: #F9FBFD !important;
            line-height: normal !important;
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
        <div>

            <?php
            include('generatereports.php');
            ?>



            <?php
            include('hoverinclude/hoverreport.php');
            ?>
</body>

</html>