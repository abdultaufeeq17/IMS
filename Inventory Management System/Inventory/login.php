<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
        <link rel="stylesheet" href="css/login-style.css">
        <script src="https://kit.fontawesome.com/d8306965cb.js" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <form method="POST" action="login.php" id="login-form" autocomplete="off">
            <h3>Login Here</h3>
            <input type="text" name="username" id="username" required="_required"placeholder="Username"/>
            <input type="password" name="password" id="password" required="_required" placeholder="Password"/>
            <?php  if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>
            </div>
            <?php  endif ?>
            <input type="submit" name="submit" id="submit" value="Log in"/>
            
            <div class="social">
                <div class="go"><i class="fab fa-google fa-lg"></i> <br> Google</div>
                <div class="fb"><i class="fab fa-facebook fa-lg"></i> <br> Facebook</div>
                <div class="tw"><i class="fab fa-twitter fa-lg"></i> <br> Twitter</div>
            </div>
            <div>
                <a href="register.php">Or Create an account</a>
            </div>
        </form>
    </body>
</html>