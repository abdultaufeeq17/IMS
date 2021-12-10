<?php include('server.php') ?>
<!DOCTYPE html>
<html>
    <head>
        <title>User Registration</title>
        <link rel="stylesheet" href="css/register-style.css">
        <script src="https://kit.fontawesome.com/d8306965cb.js" crossorigin="anonymous"></script>
        <link href='https://fonts.googleapis.com/css?family=Product+Sans' rel='stylesheet' type='text/css'>
    </head> 
    <body>
        <form method="POST" id="register-form" action="register.php" autocomplete="off">
            <h3>Sign Up</h3>
            <div class="inputContainer">
                <i class="fas fa-user"></i>
                <input class="Field" type="text" name="first_name" id="first_name" required="_required" placeholder="First Name"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-user"></i><i class="fas fa-user"></i>
                <input class="Field" type="text" name="last_name" id="last_name" required="_required" placeholder="Last Name"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-user"></i>
                <input class="Field" type="text" name="username" id="username" required="_required" placeholder="username"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-envelope"></i>
                <input class="Field" type="email" name="email" id="email" required="_required" placeholder="Your Email"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-phone"></i>
                <input class="Field" type="mobile" name="mobile" id="mobile"required="_required" placeholder="Your Mobile Number"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-key"></i>
                <input class="Field" type="password" name="password_1" id="password_1"required="_required" placeholder="Password"/>
            </div>
            <div class="inputContainer">
                <i class="fas fa-key"></i>
                <input class="Field" type="password" name="password_2" id="password_2"required="_required" placeholder="Confirm your password"/>
            </div>
            <?php  if (count($errors) > 0) : ?>
                <div class="error">
                    <?php foreach ($errors as $error) : ?>
                        <p><?php echo $error ?></p>
                    <?php endforeach ?>
                </div>
            <?php  endif ?>
            <div class="inputContainer">
                <input type="submit" name="reg_user" id="reg_user" class="form-submit" value="Register"/>
            </div> 
            <div>
                <a href="login.php">I am already user</a>
            </div>
        </form>
    </body>
</html>