<?php
session_start();
if(!isset($_SESSION["success"])){
    header('location: login.php');
}
?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maaser Calculator</title>
</head>
<body>
<?php
        if(isset($_SESSION['success'])): ?>
        <div>
            <h3>
                <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                ?>
            </h3>
        </div>
        <?php endif ?>
        <!-- if the user logs in print information about the user  -->
        <?php if(isset($_SESSION['username'])): ?>
            <h3>Welcome <strong> <?php echo $_SESSION['username']; ?> </strong></h3><br>
            <p></p>
            <p><a href="logout.php">Logout</a></p>
        <?php endif ?>
    </body>
</body>
</html>