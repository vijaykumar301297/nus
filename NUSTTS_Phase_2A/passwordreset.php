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
<style type="text/css">
.user{
    padding: 8px;
    margin-top: 8px;
    margin-bottom: 8px;
}
.signinButton{
    padding: 6px;
}
.center {
    width: 900px;
    height: 500px;
    transform: translate(-50%,-50%);
    position: absolute;
    top: 50%;
    left: 50%;
    font-size: 1rem;
}
</style>
<body>
    <div class="container">
        <div class="wrapper">
            <header>
                <img src="img/nus-logo-full@svg.svg" alt="NUS Consulting Group logo">
            </header>
            <div class="center">
            <section class="sectionContainerTwo">
                <article class="secArticleOne">
                <p class="secArtiPr">Welcome to <span class="spanBreak"></span> NUS Consulting Group’s<span class="spanBreak"></span> <strong>Trade Tracking System (TTS)</strong> designed to provide dynamic position reports for flexible energy supply contracts.</p>
                </article>
                <article class="secArticleTwo">
                    <form action="resetpassword.php" method="post">
                    <p class="resetpassword">Please enter your mail-ID </p>
                    <p class="reset">to reset the password</p>
                    <?php if(isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error'];?></p>
                    <?php }?>
                    <!-- <pre><img class = "userlogo" src="img/user.svg" alt="Username Logo" width="18x"><input class = "fullname" type="text" name="fullname" placeholder="Full Name" required></pre> -->

                    <pre><img   class = "maillogo" src="img/mail-icon.svg" alt="Password Logo" width="18px"><input  class = "mail" type="email" name="emailId" placeholder="name@address.com" required></pre>
         
                <!--<pre><img  class = "newpasswordlogo" src="img/lock-key.svg" alt="Password Logo" width="18px"><input class = "passwordtext" type="password" name="newpassword" placeholder="New password" required></pre>-->
              
                <!--<pre><img  class = "passwordlogo" src="img/lock-key.svg" alt="Password Logo" width="18px"><input class = "confirmpasswordtext" type="password" name="confirmpassword" placeholder="Confirm password" required></pre>-->
                
                <input class= "resetsignin" type="submit" value="Send Mail Link!" class="signinButton" id="">
                <p class="siginpage">Remember your password? <strong><a href="signin.php">Sign in</a></strong></p>
                <br>
                <br>
                <!-- <button type="submit">Sign in</button> -->
                <!-- <p class="colorDontSignin">Already have an account? <a href="index.php" target="_blank" class="pagerefColor">Sign in.</a></p> -->
                </form>
            </article>
        </section>
    </div>
</div>
        <footer>
                <ul>
                    <li><a href="">NUS Consulting Group</a></li>
                    <li><a href="">Terms of Use</a></li>
                    <li><a href="">Privacy</a></li>
                </ul>
                <a href="https://www.qualesce.com/" target="_blank" style="position: absolute; right: 10%; bottom: 5px;"><img src="img/poweredby_center.svg" alt="Powered by Qualesce qLabs logo"></a>
            </footer>
</body>
</html>