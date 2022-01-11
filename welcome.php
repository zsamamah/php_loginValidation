<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $_SESSION['logged_in']['name']?></title>
</head>
<body>
    <h1>
        <?php 
        echo "Welcome {$_SESSION['logged_in']['name']}";        
        ?>
    </h1>
    <p>
        <?php 
        echo "Email: {$_SESSION['logged_in']['email']}";        
        ?>
    </p>
    <p>
        <a href="./logout.php">Logout!</a>
    </p>
</body>
</html>