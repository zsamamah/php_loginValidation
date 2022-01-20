<?php
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
    <title>Sign Up</title>
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
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" id="register_form">
        <h1>SIGN UP</h1>
        <div class="icon">
            <i class="fas fa-user-circle"></i>
        </div>
        <div class="formcontainer">
            <div class="container">
                <label for="fname"><strong>First Name</strong></label>
                <input type="text" placeholder="Enter First name" name="fname" id="fname" minlength="5" maxlength="20" required>
                <label for="sname"><strong>Second Name</strong></label>
                <input type="text" placeholder="Enter First name" name="sname" id="sname" minlength="5" maxlength="20" required>
                <label for="tname"><strong>Third Name</strong></label>
                <input type="text" placeholder="Enter First name" name="tname" id="tname" minlength="5" maxlength="20" required>
                <label for="lname"><strong>Last Name</strong></label>
                <input type="text" placeholder="Enter First name" name="lname" id="lname" minlength="5" maxlength="20" required>
                <label for="birth"><strong>Date Of Birth</strong></label>
                <input type="date" name="birth" id="birth" min="1900-01-01" required>
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

    if (isset($_POST['fname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])) {
        $fname = $_POST['fname'];
        $sname = $_POST['sname'];
        $tname = $_POST['tname'];
        $lname = $_POST['lname'];
        $birth = $_POST['birth'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repassword = $_POST['repassword'];

        $today = date("Y-m-d");
        $diff = date_diff(date_create($birth), date_create($today));
        $diff = $diff->format('%y');

        if (!preg_match("/^[A-Za-z]{3,}$/i", $fname)) {
            echo "<script>alert('can`t use special characters in name')</script>";
            exit();
        } elseif (!preg_match("/^[A-Za-z]{3,}$/i", $sname)) {
            echo "<script>alert('can`t use special characters in name')</script>";
            exit();
        } elseif (!preg_match("/^[A-Za-z]{3,}$/i", $tname)) {
            echo "<script>alert('can`t use special characters in name')</script>";
            exit();
        } elseif (!preg_match("/^[A-Za-z]{3,}$/i", $lname)) {
            echo "<script>alert('can`t use special characters in name')</script>";
            exit();
        } elseif(!preg_match("/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/i",$birth)){
            echo "<script>alert('Invalid Birth!')</script>";
        }elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('can`t use special characters in email')</script>";
            exit();
        } elseif (!preg_match("/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/", $password)) {
            echo "<script>alert('minimum 8, must contain at least one number and one character')</script>";
            exit();
        } elseif ($diff<16){
            echo "<script>alert('You must be longer than 16 to register!')</script>";
            exit();
        } elseif ($password !== $repassword) {
            echo "<script>alert('password doen`t match!')</script>";
            exit();
        } else {
            $date = date("Y-m-d");
            $newUser = "INSERT INTO users (name,sname,tname,lname,email,password,date_created,birth) VALUES ('$fname','$sname','$tname','$lname','$email','$password','$date','$birth')";
            // echo $newUser . "<br>";
            $conn->exec($newUser);
            echo "<script>alert('User Created Successfully!)</script>";
            echo "<script>window.location.href='./login.php';</script>";
        }
    }

    ?>

    <script>
        let form = document.getElementById('register_form');

        let fname, sname, tname, lname, birth, email, password, repassword;

        const name_regex = new RegExp(/^[A-Za-z]{3,}$/i);
        // const email_regex = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
        const pass_regex = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/);
        const date_regex = new RegExp(/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])$/i);

        let todayDate = () => {
            let today_date = new Date();
            today_date = today_date.toISOString().split("T")[0];
            return today_date;
        }
        form.birth.max = todayDate();

        function getAge(dateString) {
            var today = new Date();
            var birthDate = new Date(dateString);
            var age = today.getFullYear() - birthDate.getFullYear();
            var m = today.getMonth() - birthDate.getMonth();
            if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }
            return age;
        }

        form.addEventListener("change", (e) => {
            switch (e.target.id) {
                case 'fname':
                    fname = e.target.value;
                    break;
                case 'sname':
                    sname = e.target.value;
                    break;
                case 'tname':
                    tname = e.target.value;
                    break;
                case 'lname':
                    lname = e.target.value;
                    break;
                case 'birth':
                    birth = e.target.value;
                    break;
                case 'email':
                    email = e.target.value;
                    break;
                case 'password':
                    password = e.target.value;
                    break;
                case 'repassword':
                    repassword = e.target.value;
                    break;
                default:
                    alert('fix switch in register');
            }
        })

        form.addEventListener("submit", (e) => {
            let valid = false;

            if (!name_regex.test(fname))
                alert('First name contain special characters or spaces!!');
            else if (!name_regex.test(sname))
                alert('Second name contain special characters or spaces!!');
            else if (!name_regex.test(tname))
                alert('Third name contain special characters or spaces!!');
            else if (!name_regex.test(lname))
                alert('Last name contain special characters or spaces!!');
            else if (!date_regex.test(birth))
                alert('Invalid Birth Date!!');
            else if(getAge(birth)<16)
                alert('You must be older than 16 to register !')
            else if (!pass_regex.test(password))
                alert('minimum 8, must contain at least one number and one character');
            else {
                if (password !== repassword)
                    alert('password doesn`t match');
                if (password === repassword && pass_regex.test(password) && pass_regex.test(repassword))
                    valid = true;
            }
            if (!valid)
                e.preventDefault();
        })
    </script>
</body>

</html>