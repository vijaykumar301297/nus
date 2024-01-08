<?php


// echo "Hello";
session_start();
include('dbconn.php');


if(isset($_POST['username']) && isset($_POST['password'])) {

    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = strip_tags($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $password = validate($_POST['password']);

    if(empty($username)) {
        header("Location: signin.php?error=Username is required");
        exit();


    } else if(empty($password)) {
        header("Location: signin.php?error=Password is required");
        exit();
    } else {
        // echo "Validate Input";
        $sql = "SELECT * FROM nususerdata where emailId = '$username' AND accountstatus='Confirmed' AND active='Active'  ;";
        $result = mysqli_query($conn, $sql);

        $rowCount = mysqli_num_rows($result);

        if($rowCount === 1) {
            $row = mysqli_fetch_assoc($result);
            // print_r($row);

            $dbhp = $row['password'];

             if(password_verify($password, $dbhp)) {

            // if($row['emailId']===$username && $row['password'] === $password) {
                // echo "Successfully logged in...!";

                $_SESSION['username'] = $row['emailId'];
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $role = $row['role'];
                // $_SESSION['parent'] = $row['parentcompany'];
                $_SESSION['parents'] = $row['parentcompany'];
                $inp1 = $_SESSION['parents'];
                $arr1 = explode(" ", 	trim($inp1));
                $arrLength1 = count($arr1);
                $x1='';
                for($i = 0 ;$i<$arrLength1; $i++){
                $x1 = $arr1[$i].",".$x1;
                }
                $res1 =  trim($x1, ",");
                $_SESSION['parent'] = $res1;
                $_SESSION['clients'] = $row['bussinessunit'];
                $inp = $_SESSION['clients'];
                $arr = explode(" ", 	trim($inp));
                $arrLength = count($arr);
                $x='';
                for($i = 0 ;$i<$arrLength; $i++){
                $x = $arr[$i].",".$x;
                }
                $res =  trim($x, ",");
                $_SESSION['client'] = $res;

                header("Location: index.php");
                exit();

            } else {
                header("Location: signin.php?error=Incorrect Username or Password has been entered or Account not confirmed yet...!");
                exit();
            }
        } else if($rowCount === 0) {


            // Add everything here...!"

            $sql1 = "SELECT * FROM nususerdata where binary username = '$username' AND accountstatus='Confirmed' AND active='Active'";
            $result1 = mysqli_query($conn, $sql1);

            $rowCount1 = mysqli_num_rows($result1);

            if($rowCount1 === 1) {
                $row = mysqli_fetch_assoc($result1);
                $dbhp = $row['password'];

             if(password_verify($password, $dbhp)) {

            // if($row['emailId']===$username && $row['password'] === $password) {
                // echo "Successfully logged in...!";

                $_SESSION['username'] = $row['emailId'];
                $_SESSION['user'] = $row['username'];
                $_SESSION['id'] = $row['id'];
                $_SESSION['role'] = $row['role'];
                $role = $row['role'];
                $_SESSION['parents'] = $row['parentcompany'];
                $inp1 = $_SESSION['parents'];
                $arr1 = explode(" ", 	trim($inp1));
                $arrLength1 = count($arr1);
                $x1='';
                for($i = 0 ;$i<$arrLength1; $i++){
                $x1 = $arr1[$i].",".$x1;
                }
                $res1 =  trim($x1, ",");
                $_SESSION['parent'] = $res1;

                $_SESSION['clients'] = $row['bussinessunit'];
                $inp = $_SESSION['clients'];
                $arr = explode(" ", 	trim($inp));
                $arrLength = count($arr);
                $x='';
                for($i = 0 ;$i<$arrLength; $i++){
                $x = $arr[$i].",".$x;
                }
                $res =  trim($x, ",");
                $_SESSION['client'] = $res;

                header("Location: index.php");
                exit();

            } else {
                header("Location: signin.php?error=Incorrect Username or Password has been entered or Account not confirmed yet...!");
                exit();
            }
            } else {
                header("Location: signin.php?error=Incorrect Username or Password has been entered or Account not confirmed yet...!");
                exit();
            }
        }
    }
} 

else {
    header("Location: signin.php");
    exit();
}




?>