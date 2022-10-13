<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=users", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();

$error = [];
$email = '';
$password = null;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $result = $pdo->prepare('SELECT * FROM reg_users WHERE email = ? AND password = ? ');
    $result->execute(array($email,$password));
    $user = $result->fetchAll(PDO::FETCH_ASSOC);
    $row = $result->rowCount();
    $fetch = $result->fetch();
    // echo "<pre>";
    // var_dump($user);
    // echo "</pre>";
    // echo $user[0]['user_type'];
    // exit;

    if ($row > 0) {
        if ($user[0]['user_type'] === 'admin') {
            $_SESSION['admin_name'] = $user[0]['name'];
            header('location:admin.php');

        } elseif ($user[0]['user_type'] === 'user') {
            $_SESSION['user_name'] = $user[0]['name'];
            header('location:user.php');
        }
        
    } else {
        $error[] = 'incorrect username or password!';
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
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/all.css">
</head>
<body>
    <section class="main-section login-section"></section>
    <div class="form-box">
        <img src="images/img_avatar2-png-9.png" class="avatar">
        <form action="" method="post">
        <h1>Login Here</h1>
        <?php 
        if (isset($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
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
        <button type="submit" name="submit" class="login-btn">LOGIN</button>
        <a href="#">Lost your password?</a><br>
        <a href="#">Don"t have an account</a>
        <a href="register.php">register now</a>
        </form>
    </div>
    
    

    
   <script src="index.js"></script>
</body>
</html>


<!-- if ($row > 0) {
        
        header('location:contact.php');
    } else {
        $error[] = 'incorrect username or password!';
    } -->