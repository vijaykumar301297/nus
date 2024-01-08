<?php

    include 'dbconn.php';

        $emailid=$_POST["emailId"];

        $username =$_POST["username"];

        $sql_query1 = "SELECT username, emailId FROM nususerdata WHERE username = '".$username."'" ;
        $row_result = $conn->query($sql_query1);
        // echo $sql_query1;
        $rowcount = mysqli_num_rows($row_result);
        

        $sql_query2 = "SELECT username, emailId FROM nususerdata WHERE emailId='".$emailid."'" ;
        $row_result1 = $conn->query($sql_query2);
        // echo $sql_query2;
        $rowcount1 = mysqli_num_rows($row_result1);


        if ($rowcount >=1 && $rowcount1>=1) {
                echo "<script>
                        alert(' User details already exists'); 
                        window.history.go(-2);
                </script>";
        }

        else {
                $sql = "UPDATE nususerdata SET username='".$username."' WHERE emailId='".$emailid."'";
                $conn->query($sql);

                echo "<script>
                        alert(' User details edited succesfully'); 
                        window.history.go(-2);
                </script>";
        }


        

?>