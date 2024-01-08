<?php

include 'dbconn.php';
session_start();

$emailid = $_POST["emailId"];

$role = $_POST["role"];

// $_SESSION['role'] = $role;

$sqlVerify1 = "SELECT * FROM nususerdata WHERE emailId = '" . $emailid . "'";
$resVerify1 = mysqli_query($conn, $sqlVerify1);
$row = mysqli_fetch_assoc($resVerify1);
$rowCount = mysqli_num_rows($resVerify1);

// echo "<h1>".$row['parentcompany']."</h1>123";

if ($_SESSION['username'] == $emailid) {
        $_SESSION['role'] = $role;
}


//code infusing start
if (empty($_POST["parentcompany"])) {
        $a = '';
} else {
        // $r = $_POST["parentcompany"];
        $a = $_POST["parentcompany"];
        // print_r($a);
        $parent = '';
        foreach ($a as $p) {
                $parent .= "$p ";
        }
        $a  = $parent;
        // echo "A = ".$a;
}
// print_r($r);


if (empty($_POST["bussinessunit"])) {
        $e = '';
} else {
        $e = $_POST["bussinessunit"];
        // $e = $_POST["bussinessunit"];
        $client = '';
        foreach ($e as $p) {
                $client .= "$p ";
        }
        $e  = $client;
}


if ($role == 'Admin' || $role == 'NUS Manager') {
        $sql = "UPDATE nususerdata SET role='" . $role . "', parentcompany='" . $a . "', bussinessunit ='" . $e . "' WHERE emailId='" . $emailid . "'";
        $conn->query($sql);
} else if ($role == 'NUS User') {
        $sql = "UPDATE nususerdata SET role='" . $role . "', parentcompany='" . $a . "', bussinessunit ='" . $e . "' WHERE emailId='" . $emailid . "'";
        $conn->query($sql);
        
        $_SESSION['parents'] = $a;
        $inp1 = $_SESSION['parents'];
        $arr1 = explode(" ",trim($inp1));
        $arrLength1 = count($arr1);
        $x1 = '';
        for ($i = 0; $i < $arrLength1; $i++) {
                $x1 = $arr1[$i] . "," . $x1;
        }
        $res1 =  trim($x1, ",");
        $_SESSION['parent'] = $res1;

        // echo "<h1>".$row['parentcompany']."</h1>";
        // die();
        
} else if ($role == 'Parent company') {
        $sql = "UPDATE nususerdata SET role='" . $role . "', parentcompany='" . $a . "', bussinessunit ='" . $e . "' WHERE emailId='" . $emailid . "'";
        $conn->query($sql);
} else {
        // $r = $_POST["parentcompany"];

        $sql = "UPDATE nususerdata SET role='" . $role . "', parentcompany='" . $a . "', bussinessunit ='" . $e . "' WHERE emailId='" . $emailid . "'";
        // echo $sql;
        $conn->query($sql);
        
}

//code infusing end
echo "<script>
        alert('User details edited succesfully!'); 
        window.history.go(-2);
</script>";
?>