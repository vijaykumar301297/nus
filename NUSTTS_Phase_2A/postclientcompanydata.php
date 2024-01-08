<?php include 'dbconn.php'?>
<?php
session_start();


$state = $_POST['state'];
// echo $state;
$states = "Active";

     $sqlQuery1 = "SELECT * FROM clientcompanydata WHERE parentcompany='".$_POST['parentcompany']."' AND clientcompany='".$_POST['clientcompany']."' 
     AND country='".$_POST['country']."';";
     $result1 = mysqli_query($conn,$sqlQuery1);
     if(mysqli_num_rows($result1) === 1) {
          echo "<script>";
          echo "alert('Client Company with that details already exists!');";
          echo "window.location='addcompany.php';";
          echo "</script>";
     } else {
        $sql = "SELECT * FROM parentcompanydata WHERE parentcompany = '".$_POST['parentcompany']."';";
        $res = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_array($res)){
             if($row['state']<>'Active') {
                  $parent = $row['parentcompany'];
                  $statevalue = $row['state'];
                  echo "<script>";
                  echo "alert('$parent Company is in $statevalue state!');";
                  echo "window.location='addcompany.php';";
                  echo "</script>";
             }

             else {
                $sql = "INSERT INTO clientcompanydata (parentcompany, clientcompany, country) VALUES ('".$_POST['parentcompany']."', '".$_POST['clientcompany']."','".$_POST['country']."')";
                $conn->query($sql);
                $_SESSION['createdclient'] = time();
                header('location:addcompany.php');
            }
            
        }

     }
?>