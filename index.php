<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>
<body>
    <a href="./login.php">login</a>
    <a href="./register.php">register</a>
    <a href='logout.php'>remove all</a>

    <?php 
    if(isset($_SESSION['users'])){
        echo "<pre>";
    print_r($_SESSION['users']);
    echo "</pre>";
    foreach($_SESSION['users'] as $key=>$val){
        echo "<p>".$_SESSION['users'][$key]['email']."</p>";
    }
    }

    ?>
</body>
</html>