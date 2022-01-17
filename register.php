<?php 
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
           $newUser = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$password')";
            echo $newUser."<br>";
            $conn->exec($newUser); 
            echo "New user added successfully";
        }
    }

    ?>

    <script>
        let form = document.getElementById('register_form');

            let name,email,password,repassword ;

            const name_regex = new RegExp(/^[a-zA-Z ]*$/);
            // const email_regex = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
            const pass_regex = new RegExp(/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/);
            

        form.addEventListener("change",(e)=>{
            switch(e.target.id){
                case 'name':
                    name=e.target.value;
                    break;
                case 'email':
                    email=e.target.value;
                    break;
                case 'password':
                    password=e.target.value;
                    break;
                case 'repassword':
                    repassword=e.target.value;
                    break;
                default:
                    alert('fix switch in register');
            }
        })

        form.addEventListener("submit",(e)=>{
            let valid = false;
            
            if(!name_regex.test(name))
                alert('Name contain special characters!!');
            else if(!pass_regex.test(password))
                alert('minimum 8, must contain at least one number and one character');
            else{
                if(password!==repassword)
                    alert('password doesn`t match');
                if(password===repassword && pass_regex.test(password) && pass_regex.test(repassword)) 
                    valid=true;
            }
            if(!valid)
                e.preventDefault();
        })
    </script>
</body>

</html>