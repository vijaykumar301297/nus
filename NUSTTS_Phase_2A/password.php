<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Password Reset</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="signiContainer">
        <form action="passwordreset.php" method="post" class="signinForm">
            <img src="img/nus-logo-2020.svg" alt="NUS Consulting Group Logo">
            <h2>Password reset</h2>
            <h5>Enter your email to get a password reset link.</h5>
            <?php if (isset($_GET['error'])) {?>
                <p class="error"><?php echo $_GET['error']; ?></p>
                <?php }?>
            <label>Email address</label>
            <input type="email" name="username" placeholder="name@address.com" required>
            <input type="submit" value="Reset password" class="signinButton">
            <!-- <button type="submit">Sign in</button> -->
            <p class="colorDontSignin">Remember your password? <a href="signin.php" class="pagerefColor">Log in</a></p>
        </form>
    </div>
</body>
</html>