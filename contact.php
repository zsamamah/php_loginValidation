<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Responsive Contact us form Using HTML and CSS</title>
	<link rel="stylesheet" href="./css/contact.css">
	<link rel="stylesheet" href="./css/styles.css">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
</head>
<body>
<nav class="navbar navbar-light bg-light static-top">
            <div class="container">
                <a class="navbar-brand" href="./index.php">Start Bootstrap</a>
                <div>
                    <a class="btn btn-primary" href="./login.php">Sign In</a>
                    <a class="btn btn-primary" href="./register.php">Sign Up</a>
                </div>
            </div>
        </nav>
<div class="wrapper">
  <div class="title">
    <h1>contact us form</h1>
  </div>
  <form class="contact-form" method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
    <div class="input-fields">
      <input type="text" name="name" class="input" placeholder="Name" required>
      <input type="text" name="email" class="input" placeholder="Email Address" required>
      <input type="text" name="phone" class="input" placeholder="Phone" required>
      <input type="text" name="subject" class="input" placeholder="Subject" required>
    </div>
    <div class="msg">
      <textarea name="msg" placeholder="Message"></textarea>
      <button type="submit" class="btn">send</button>
    </div>
</form>
</div>
<?php

if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['phone']) && isset($_POST['subject']) && isset($_POST['msg'])){
  try {
    $sereverName = "localhost";
    $dbName = "store";
    $dbusername = "zaid";
    $dbpassword = "Zaid@123";
    $conn = new PDO("mysql:host=$sereverName;dbname=$dbName", $dbusername, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO contact_form(name,email,phone,subject,msg) VALUES ('{$_POST['name']}','{$_POST['email']}','{$_POST['phone']}','{$_POST['subject']}','{$_POST['msg']}')";
    $conn->exec($sql);
    echo "<h1>Your message sent successfully!</h1>";
  } catch (PDOException $e) {
    echo "<br>" . $e->getMessage();
  }

}
else
  echo "<h1>No Form Submitted yet!</h1>"
?>
</body>
</html>