<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" />
    <title>Login</title>
    <link rel="stylesheet" href="style.css<?php time()?>" />
</head>

<body>
    <?php
    require 'dbconnect1.php';
    session_start();
    // When form submitted, check and create user session.
    if (isset($_POST['username'])) {
        $username = stripslashes($_REQUEST['username']);    // stripslashes removes backslashes
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        // Check user exists in the database
        $query    = "SELECT * FROM maaser WHERE username='$username'
                    AND password='" . md5($password) . "'";
        $result = mysqli_query($conn, $query) or die("Something went wrong...");
        $rows = mysqli_num_rows($result);
        if ($rows == 1) {
            $_SESSION['username'] = $username;
            $_SESSION["success"] = "Welcome! You logged in!";
            // Redirect to user index page
            header("Location: index.php");
        } else {
            echo "<div class='form'>
                <h3>Incorrect Username/Password.</h3><br/>
                <p class='link'>Click here to <a href='login.php'>log in</a> again.</p>
                </div>";
        }
    } else {
    ?>
        <form class="form" method="post" name="login">
            <h1 class="login-title">Login</h1>
            <input type="text" class="login-input" name="username" placeholder="Username" autofocus="true" />
            <input type="password" class="login-input" name="password" placeholder="Password" />
            <button type="submit" value="Login" name="login_user">Submit</button>
            <p class="link"><a href="registration.php">New Registration</a></p>
        </form>
    <?php
    }
    ?>
</body>

</html>