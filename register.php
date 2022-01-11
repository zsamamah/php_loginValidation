<?php session_start() ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <title>Sign Up</title>
</head>

<body>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="register_form">
        <h1>SIGN UP</h1>
        <div class="icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="formcontainer">
            <div class="container">
                <label for="name"><strong>Full Name</strong></label>
                <input type="text" placeholder="Enter Username" name="name" id="name" minlength="5" maxlength="20" required>
                <label for="email"><strong>E-mail</strong></label>
                <input type="email" placeholder="Enter E-mail" id="email" name="email" required>
                <label for="password"><strong>Password</strong></label>
                <input type="password" placeholder="Enter Password" id="password" name="password" minlength="8" max="20" required>
                <label for="repassword"><strong>Re-Password</strong></label>
                <input type="password" placeholder="Repeat Password" id="repassword" name="repassword" minlength="8" max="20" required>
            </div>
            <button type="submit"><strong>SIGN UP</strong></button>
            <div class="container" style="background-color: #eee">
                <p><a href="./login.php">Already Have An Account?</a></p>
            </div>
        </form>

    <?php
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            echo "<script>alert('can`t use special characters in name')</script>";
            exit();
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('can`t use special characters in email')</script>";
            exit();
        } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
            echo "<script>alert('minimum 8, must contain at least one number and one character')</script>";
            exit();
        } elseif ($password !== $repassword) {
            echo "<script>alert('password doen`t match!')</script>";
            exit();
        } else {
            $_SESSION['user'] = array("name" => $name, "email" => $email, "password" => $password, "repassword" => $repassword);
            if (isset($_SESSION['users'])) {
                $found = false;
                foreach ($_SESSION['users'] as $key => $val) {
                    if ($_SESSION['users'][$key]['email'] === $email) {
                        $found = true;
                        break;
                    }
                }
                if ($found) {
                    echo "<script>alert('Email Found!')</script>";
                    exit();
                } else
                    array_push($_SESSION['users'], $_SESSION['user']);
            } else {
                $_SESSION['users'] = [];
                array_push($_SESSION['users'], $_SESSION['user']);
            }
        }
    }

    ?>


    <script src="./scripts/register.js"></script>
</body>

</html>