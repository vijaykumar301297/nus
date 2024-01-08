<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verification</title>
    <link rel="stylesheet" href="css/move.css">
    <style>
        .close-btn{
        position: absolute;
        right: 36%;
        top: 28%;
        cursor: pointer;
        }
        .mailentry {
            margin: 0 0 20px 0;
        }
    </style>
</head>
<body>
    <div class = "userform">
        <form action="postsubmit.php" class="post-form" method="POST">
            <header class="head">
                <a class="deleteuser">Verify Mail</a>
                <div class="close-btn" onclick='window.history.go(-1);'>&times;</div>
                <br/>
            </header>
            <br>
        <hr width="450px" color="whitegrey" >
            <br>
                <p>Please enter the mailid and click on submit button to verify</p>
                <label for="">EmailID</label>
                <br>
                <br>
                <input class ="mailentry" type="email" name="emailId">
                    <br>
                    <hr width="450px" color="whitegrey" >
                    <br>
                        <input class="btnSubmit" type="submit" value="submit" onclick=window.history.go(-1)/>
                        <!-- <input class="btn" type="submit" value="Yes, delete" onclick="msg()"/> -->
                    <br>
                    <br>
            </form>
        </div>
        </body>
        </html>
        
 