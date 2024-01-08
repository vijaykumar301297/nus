
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NUS TTS System | Sign-in</title>
    <link rel="icon" href="img/social-square-n-blue.png" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style type="text/css">
.user{
    padding: 8px;
    margin-top: 8px;
    margin-bottom: 8px;
    margin-left: 5px;
    border:4px;
    border-radius: 2px solid rgb(202, 31, 31);
}

.userprofile{
    margin-left: 25px;
    /* margin-top: 2px; */
}
.signinButton{
    padding: 6px;
}
.center {
    width: 1200px;
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
            <section class="sectionContainerOne">
                <article class="secArticleOne">
                <p class="secArtiP">Welcome to <span class="spanBreak"></span> NUS Consulting Group’s<span class="spanBreak"></span> <strong>Trade Tracking System (TTS)</strong> designed to provide dynamic position reports for flexible energy supply contracts.</p>
                </article>
                <article class="secArticleTwo">
                    <form action="login.php" method="post">
                        <p class="secLogin">Please enter your login credentials</p>
                        <?php if (isset($_GET['error'])) {?>
                            <p class="error"><?php echo $_GET['error']; ?></p>
                        <?php }?>
                        <pre><img class="userprofile" src="img/user.svg" alt="Username Logo" width="18x"> <input type="text" name="username" placeholder="Username" class="user" required/></pre>
                        <pre><img class="userprofile" src="img/lock-key.svg" alt="Password Logo" width="18px"> <input type="password" name="password" placeholder="Password" class="user" required/></pre>
                        <input type="submit" class="signinButton" value="Sign in" />
                        <pre><a  class = "forgot" href="passwordreset.php">Forgot Password?</a></pre>

                    </form>
                </article>
            </section>
            </div>
            <footer>
                <ul>
                    <li><a href="">NUS Consulting Group</a></li>
                    <li><a href="">Terms of Use</a></li>
                    <li><a href="">Privacy</a></li>
                </ul>
                <a href="https://www.qualesce.com/" target="_blank" style="position: absolute; right: 10%; bottom: 5px;"><img src="img/poweredby_center.svg" alt="Powered by Qualesce qLabs logo"></a>
            </footer>
        </div>
    </div>
</body>
</html>