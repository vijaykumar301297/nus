<?php

$sername = "localhost";
$user = "nustradetrack_admin";
$pass = "NUStradetrack@839";
$dbname = "nustradetrack_nusnew";

$conn = mysqli_connect($sername, $user, $pass, $dbname);

if(!$conn) {
    echo "Connection Failed...!";
    die();
}

?>