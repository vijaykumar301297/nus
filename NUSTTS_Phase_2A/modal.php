<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modal</title>
    <link rel="stylesheet" href="css/move.css">
    
</head>
<body>
    <div class = "userform">
        <form action="">
            <header class="head">
                <a class="deleteuser">Are you sure you want to delete this user?</a>
                <input class="close" type="button" value="X"/>
                <br/>
            </header>
            <br>
        <hr width="450px" color="whitegrey" >
            <br>
                <p>They will loose access to the system and will be signed out.
                    you cannot undo this action</p>
                    <br>
                    <hr width="450px" color="whitegrey" >
                    <br>
                        <input class="btnSubmit" type="submit" value="No, don't delete" onclick="msg()"/>
                        <input class="btn" type="submit" value="Yes, delete" onclick="msg()"/>
                    <br>
            </form>
        </div>
        </body>
        </html>
        
 