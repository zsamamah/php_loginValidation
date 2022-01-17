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
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="./css/login.css">
  <title>Sign In</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="login_form">
      <h1>SIGN IN</h1>
      <div class="icon">
        <i class="fas fa-user-circle"></i>
      </div>
      <div class="formcontainer">
        <div class="container">
          <label for="email"><strong>E-mail</strong></label>
          <input type="text" placeholder="Enter E-mail" id="email" name="email" required>
          <label for="password"><strong>Password</strong></label>
          <input type="password" placeholder="Enter Password" id="password" name="password" minlength="8" maxlength="20" required>
        </div>
        <button type="submit"><strong>SIGN IN</strong></button>
        <div class="container" style="background-color: #eee">
          <p><a href="./register.php">Don`t Have An Account?</a></p>
        </div>
    </form>
    <?php

    if(isset($_POST['email']) && isset($_POST['password'])){
      if(strlen($_POST['email'])<6 || strlen($_POST['password'])<8)
        exit();
      $login = "SELECT name,email FROM users WHERE email='{$_POST['email']}' AND password='{$_POST['password']}'";
      $data = $conn->query($login);
      $result = $data->fetch(PDO::FETCH_ASSOC);
      // echo "<pre>";
      // print_r($result);
      // echo "</pre>";
      if($data->rowCount()===1){
        $_SESSION['logged_in'] = $result;
      echo "<script>window.location.href='./welcome.php'</script>";
      }
      else
        echo "<script>alert('Invalid Login')</script>";
    }
    ?>

  <?php
  if(isset($_SESSION['logged_in']))
  echo "<a href='./logout.php'>Logout!!</a>";

  ?>

  <script>
    let form = document.getElementById('login_form');
    let email,password;
    form.addEventListener('change',(e)=>{
      switch(e.target.id){
        case 'email':
          email = e.target.value;
          break;
        case 'password':
          password = e.target.password;
          break;
        default:
          alert('fix switch in login');
      }
    })

    form.addEventListener('submit',(e)=>{
      if(email.length<6 || password.length<8)
        e.preventDefault();
    })

  </script>
</body>

</html>