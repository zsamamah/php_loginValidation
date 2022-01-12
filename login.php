<?php session_start() ?>
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
      $email_found=false;
      $true_pass=false;
      $index=null;
      if(isset($_SESSION['users'])){
        foreach($_SESSION['users'] as $key=>$val){
          if($val['email']===$_POST['email']){
            $email_found=true;
            if($val['password']===$_POST['password']){
              $true_pass=true;
              $index=$key;
            }
          }
        }
        if($email_found && $true_pass){
          echo "logged in as {$val['name']}!";
          $_SESSION['logged_in'] = $_SESSION['users'][$index];
          echo "<script>window.location.href='./welcome.php'</script>";
        }
        elseif($email_found && !$true_pass){
          echo "<script>alert('Wrong Password')</script>";
        }
        elseif(!$email_found){
          echo "<script>alert('Email Not Found!')</script>";
        }
      }
      else
        echo "<script>alert('Nobody Registered yet!!')</script>";
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