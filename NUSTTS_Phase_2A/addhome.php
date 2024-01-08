

<?php
    include('security.php');

    // if($_SESSION['role'] != 'Admin' && $_SESSION['role'] != 'NUS Manager' && $_SESSION['role'] != 'NUS User') {
    //     //echo 'You have no acesss to view the page';
    //     echo "<script>alert('You have no access to view this page!');window.location.href='index.php';</script>";
    //     die();
    //   }

?>
<?php
// if($_SESSION['role'] == 'Client company'){
//     header("location:clientcompany.php?id=".$_SESSION['client']);
// }
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
        /* .companylist {
            margin: 40px 0 0 20%;
            font-weight: 600;
            font-size: 20px;
            color: #345DA6;
        } */

        /* .filter {
            position: absolute;
            top: 16%;
            left: 19.4%;
        }

        label, a {
            color:#345DA6;
        }
        #btn {
            background: #345DA6;
            color:white;
            font-size: 14px;
            padding:6px 40px;
            border-radius:10px;
            cursor: pointer;
        } */

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
    <div class="contentMove">
        <!-- <h1> Add Home Page</h1>
        <p>Continue to add from here</p> -->
       
        <!-- <h3>Parent Company</h3> -->

        <?php
		    include('listparentcompany.php');
	    ?>
    </div>
    
   <?php
        include('hoverinclude/hoverhome.php');
    ?>

</body>
</html>