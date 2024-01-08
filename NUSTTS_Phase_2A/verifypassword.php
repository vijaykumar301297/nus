<?php

include('dbconn.php');

$username = $_POST['username'];
$newpass = $_POST['newpassword'];
$cnfpass = $_POST['cnfpassword'];

$passresetChoice = $_POST['passreset'];


$count1 = strlen($newpass);
$count2 = strlen($cnfpass);

if ($count1 >= 8 && $count2 >= 8) {


    $result = strcmp($newpass, $cnfpass);

    $sql = "SELECT username, created_time, accountstatus FROM nususerdata WHERE binary username = '".$username."';";
    $query_result = mysqli_query($conn, $sql);

    $total_row = mysqli_num_rows($query_result);

    $final_row = mysqli_fetch_assoc($query_result);

    date_default_timezone_set('Asia/Kolkata');
    
    $from = strtotime($final_row['created_time']);
    $today = time();
    
    $difference = $today - $from;
    $date_diff = floor($difference / 86400);
   
    // if($final_row['accountstatus'] != 'Confirmed') {

    if ($date_diff < 6) {

        if ($result == 0 && $total_row == 1) {
            // print_r($query_result);

            $hashpass = password_hash($newpass, PASSWORD_ARGON2I);
            if($passresetChoice == 'no') {
                $update_query = "UPDATE nususerdata SET password='$hashpass', accountstatus='Confirmed' WHERE username = '".$username."';";
            } else {
               $update_query = "UPDATE nususerdata SET password='$hashpass' WHERE username = '".$username."';";
            }
            $query_result = mysqli_query($conn, $update_query);

            echo "<script>alert('Password updated successfully!'); location.href='signin.php';</script>";
           
        } else {
            echo "<script>alert('Passwords entered do not match!'); window.history.back();</script>";
            // header("Location: confirmlogin.php?error= Incorrect Username has been entered!!");
        }
    } else {
        // echo "<script>alert('Password updated successfully!'); location.href='signin.php';</script>";
        echo "<script>alert('Link is expired try to contact Admin!'); window.history.back();</script>";
    }
    // } else {
    //     echo "<script>alert('For Password reset try to contact Admin!'); window.history.back();</script>";
    // }
} else {
    // echo "Coming here";
       echo "<script>alert('Password length should be at least 8 characters!!'); window.history.back();</script>";

    // header('Location: confirmlogin.php?error= Password length should be more than 8 characters!!');
}
