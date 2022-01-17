<?php 
session_start();
try{
  $sereverName = "localhost";
  $dbName="store";
  $dbusername = "zaid";
  $dbpassword = "Zaid@123";
  $conn = new PDO("mysql:host=$sereverName;dbname=$dbName",$dbusername,$dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
  // echo "connection successfully!<br>";
}catch(PDOException $e) {
  echo "<br>" . $e->getMessage();
}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php
    if(isset($_SESSION['logged_in']))
        echo $_SESSION['logged_in']['name'];
    else
        echo "Login Please !"
      ?></title>
</head>
<body>
<?php 
if(isset($_SESSION['logged_in'])){
    echo "<h1>Welcome {$_SESSION['logged_in']['name']}</h1>";
    echo "<p>Your email is: {$_SESSION['logged_in']['email']}</p>";
    echo "<a href='./logout.php'>Logout Now!</a>";
}
else
echo "You are not logged in !";
 ?>

</body>
</html>