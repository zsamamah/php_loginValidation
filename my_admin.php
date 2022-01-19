<?php
session_start();
if($_SESSION['logged_in']['is_admin']==='0')
    header("Location: ./index.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Title -->
    <title>Admin</title>
    <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>
<body>
    <h1>Hello Admin</h1>
    <?php
    echo "<a href='./logout.php'>Logout Now!</a>";
    ?>
</body>
</html>