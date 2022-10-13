<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=users", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();

$error = [];
$name = '';
$email = '';
$password = null;
$cpassword = null;
$user_type = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $username =  $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $user_type = $_POST['user_type'];

    $result = $pdo->prepare('SELECT * FROM reg_users');
    $result->execute();
    $users = $result->fetchAll(PDO::FETCH_ASSOC);


    if (!$name) {
        $error[] = "Name is required";
    }
    if (!$email) {
        $error[] = "Name is required";
    }

    if ($password != $cpassword) {
        $error[] = 'password not matched!';
    }

    foreach ($users as $user) {
        if ($user['email'] === $email) {
            $error[] = 'user already exist!';
        }
    }

    if (empty($error)) {
        $statement = $pdo->prepare('INSERT INTO reg_users(name, email, password, cpassword, user_type)
                VALUES(:name, :email, :password, :cpassword, :user_type)');
        $statement->bindValue(":name", $name);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":password", $password);
        $statement->bindValue(":cpassword", $cpassword);
        $statement->bindValue(":user_type", $user_type);
        $statement->execute();
        $create = $pdo->prepare('CREATE TABLE ' .$username. ' (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            phone_no VARCHAR(30) NOT NULL,
            email VARCHAR(50),
            website VARCHAR(80),
            facebook VARCHAR(50),
            create_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
            )');

        $create->execute();
        header('location:index.php');
    }

    
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>loginform</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <!-- <link rel="stylesheet" href="css/all.css"> -->
</head>
<body>
        <section class="main-section register-section">
        <div class="form-box">
        <img src="images/img_avatar2-png-9.png" class="avatar">

        
        <form  action="" method="post">
        <h1>register now</h1>
        <?php 
        if (!empty($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
        <div class="input-box">
            <p>Name</p>
            <i class="fa fa-envelope"></i>
            <input type="text" placeholder="Enter Your Name" required id="name" name="name" value="<?php echo $name ?>">
        </div>
        <div class="input-box">
            <p>Email</p>
            <i class="fa fa-envelope"></i>
            <input type="email" placeholder="Enter Email Id" required id="email" name="email" value="<?php echo $email ?>">
        </div>
        <div class="input-box">
            <p>Password</p>
            <i class="fa fa-key"></i>
            <input type="password" placeholder="Enter Password" id="myInput" required name="password" value="<?php echo $password ?>">
            <span class="eye" onclick="myFunction()">
                <i id="hide1"class="fa fa-eye"></i>
                <i id="hide2"class="fa fa-eye-slash"></i>
            </span>
        </div>
        <div class="input-box">
            <p>Password</p>
            <i class="fa fa-key"></i>
            <input type="password" placeholder="confirm your Password" id="myInput" required name="cpassword" value="<?php echo $cpassword ?>">
            <span class="eye" onclick="myFunction()">
                <i id="hide1"class="fa fa-eye"></i>
                <i id="hide2"class="fa fa-eye-slash"></i>
            </span>
        </div>
        <div class="input-box">
            <p>User Type</p>
            <i class="fa fa-envelope"></i>
            <select  name="user_type">
                <option value="user">user</option>
                <option value="admin">admin</option>
            </select>
        </div>
        
        <button type="submit" name="submit" class="login-btn">Register</button>
        <a href="#">Lost your password?</a><br>
        <a href="#">have an account</a>
        <a href="index.php">login here</a>
        </form>
    </div>
        </section>
    <script src="index.js"></script>
</body>
</html>


<!-- $pdo->prepare('CREATE TABLE MyGuests (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    firstname VARCHAR(30) NOT NULL,
    lastname VARCHAR(30) NOT NULL,
    email VARCHAR(50),
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )'); -->