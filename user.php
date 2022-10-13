<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=users", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
if (!isset( $_SESSION['user_name'])) {
  header('location:register.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact management</title>
    <link rel="stylesheet" href="app.css">
</head>
<body>
<div id="overlay"></div>

<div id="mobile-menu" class="mobile-main-menu">
<ul>
        <li><a href="user.php">Home</a></li>
       


        <li class = "mobile-only"><a href="contact.php">Contacts</a></li>
        <li class = "mobile-only"><a href="create.php">create</a></li>
        <li class = "mobile-only"><a href="#contact-us">contact us</a></li>

        <li><a href="index.php">login</a></li>
        <li><a href="register.php">register</a></li>
        <li><a href="logout.php">Logout</a></li>
        
    </ul>
</div>
    <div class="container section-animate">
    <div class="main-header">
    <div class="logo">
         <img src="images/logo.png" alt="">
     </div>
        <nav class="main-navbar">
            <div class="nav-item">
                <ul>
                    <li><a href="user.php">Home</a></li>
                    <li><a href="contact.php">Contacts</a></li>
                    <li><a href="create.php">Create</a></li>
                    <li><a href="#contact-us">contact us</a></li>
                </ul>
            </div>
            
    
        </nav>
    </div>
    <!-- hamburger menu -->
    <button id="menu-btn" class="hamburger" type="button">
        <span class="hamburger-top"></span>
        <span class="hamburger-middle"></span>
        <span class="hamburger-bottom"></span>
    </button>
    </div>
    <section class="section">
    <div class="section-upper">
    <h1>hi <span><?php echo $_SESSION['user_name'] ?></span> </h1>
    <h2>welcome to Contact-X </h2>
    </div>
        <div class="section-inner">
            <h4>Store and manage all your valuable business contacts in a secure cloud environment</h4>
            <h2> organize contacts with ease</h2>
            <a class="btn" href="create.php">
                <div class="hover"></div>
                <span>get started</span>
            </a>
        </div>
    </section>
    
<footer id="contact-us">
    <ul>
        <li>ContactsX &copy; 2022</li>
        <li><a href="#">Twitter</a></li>
        <li><a href="#">YouTube</a></li>
        <li><a href="#">Instagram</a></li>
        <li><a href="#">Flickr</a></li>
        <li><a href="#">LinkedIn</a></li>
        <li><a href="#">Privacy</a></li>
        <li><a href="#"Suppliers></a></li>
    </ul>
</footer>


    <script src="index.js"></script>
</body>
</html>