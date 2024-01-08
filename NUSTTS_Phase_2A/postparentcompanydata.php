<?php include 'dbconn.php'?>
<?php
session_start();

     $sqlQuery1 = "SELECT * FROM parentcompanydata WHERE parentcompany = '".$_POST['parentcompany']."';";
     $result1 = mysqli_query($conn,$sqlQuery1);

     if(mysqli_num_rows($result1) === 1) {
          echo "<script>";
          echo "alert('Parent Company with that name already exists!');";
          echo "window.location='addcompany.php';";
          echo "</script>";
          // $_SESSION['errorclick'] = time();
          // header('location:addcompany.php');
     } else {
          $sql = "INSERT INTO parentcompanydata (parentcompany) VALUES ('".$_POST['parentcompany']."')";
          $conn->query($sql);
          $_SESSION['createdparent'] = time();
          header('location:addcompany.php');
     }
?>