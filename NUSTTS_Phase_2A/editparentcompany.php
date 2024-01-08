<?php 
include 'security.php';
if($_SESSION['role'] != 'Admin') {
    echo "<script>alert('You don't have access to view this page!);location.href='index.php';</script>";
}
include 'dbconn.php';
// session_start();
	 $sql = "UPDATE parentcompanydata SET parentcompany ='".$_POST['parentcompany']."' WHERE id=".$_POST['parentid']."";
     $conn->query($sql);
     $_SESSION['updateparent'] = time();
     header('location:addcompany.php');
?>