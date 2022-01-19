<?php
session_start();
try {
  $sereverName = "localhost";
  $dbName = "store";
  $dbusername = "zaid";
  $dbpassword = "Zaid@123";
  $conn = new PDO("mysql:host=$sereverName;dbname=$dbName", $dbusername, $dbpassword);
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  // echo "connection successfully!<br>";
} catch (PDOException $e) {
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
  <!-- Favicon-->
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <!-- Bootstrap icons-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" type="text/css" />
  <!-- Google fonts-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css" />
  <!-- Core theme CSS (includes Bootstrap)-->
  <link href="css/styles.css" rel="stylesheet" />
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

  if (isset($_POST['email']) && isset($_POST['password'])) {
    if (strlen($_POST['email']) < 6 || strlen($_POST['password']) < 8)
      exit();
    $login = "SELECT name,email,is_admin FROM users WHERE email='{$_POST['email']}' AND password='{$_POST['password']}'";
    $data = $conn->query($login);
    $result = $data->fetch(PDO::FETCH_ASSOC);
    if ($data->rowCount() === 1) {
      $_SESSION['logged_in'] = $result;
      $date = "UPDATE users SET last_login='".date("Y-m-d")." ".date("H:i:s")."' WHERE email='{$_SESSION['logged_in']['email']}'";
      $conn->exec($date);
      if($_SESSION['logged_in']['is_admin']==='0'){
        echo "<script>window.location.href='./welcome.php'</script>";
      }
      else
        echo "<script>window.location.href='./admin2'</script>";
    } else
      echo "<script>alert('Invalid Login')</script>";
  }
  ?>

  <?php
  if (isset($_SESSION['logged_in']))
    echo "<a href='./logout.php'>Logout!!</a>";
  ?>

  <script>
    let form = document.getElementById('login_form');
    let email, password;
    form.addEventListener('change', (e) => {
      switch (e.target.id) {
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

    form.addEventListener('submit', (e) => {
      if (email.length < 6 || password.length < 8)
        e.preventDefault();
    })
  </script>
</body>

</html>