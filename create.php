<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=users", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();
if (!isset( $_SESSION['user_name'])) {
    header('location:register.php');
  }

$error = [];
$name = '';
$phone_no = null;
$email = '';
$website = '';
$facebook = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone_no = $_POST['phone_no'];
    $email =  $_POST['email'];
    $website = $_POST['website'];
    $facebook = $_POST['facebook'];
    $date = date('Y-m-d H:i:s');
   
    if (!$name) {
        $error[] = "Name is required";
    }
    if (!$email) {
        $error[] = "email is required";
    }

    if (!$phone_no) {
        $error[] = "phone number is required";
    }


    if (empty($error)) {
        $statement = $pdo->prepare('INSERT INTO ' .$_SESSION['user_name']. '(name, phone_no, email, website, facebook, create_date)
                VALUES(:name, :phone_no, :email, :website, :facebook, :create_date)');
        $statement->bindValue(":name", $name);
        $statement->bindValue(":phone_no", $phone_no);
        $statement->bindValue(":email", $email);
        $statement->bindValue(":website", $website);
        $statement->bindValue(":facebook", $facebook);
        $statement->bindValue(":create_date", $date);
        $statement->execute();
        header('location:contact.php');
    }

    
};

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
    <section class="section section-create">
    <div class="section-upper">
        <h1>hi <span><?php echo $_SESSION['user_name'] ?></span> </h1>
        <h2>welcome to Contact-X </h2>
    </div>

    <div class="form-box">
    <form  action="" method="post">
        <h1>ADD NEW CONTACTS</h1>
        <?php 
        if (!empty($error)) {
            foreach($error as $error) {
                echo '<span class="error-msg">'.$error.'</span>';
            }
        }
        ?>
        <div class="input-box">
            <p>Name</p>
            <input type="text" placeholder="Enter Name Name" required  name="name" value="<?php echo $name ?>">
        </div>
        <div class="input-box">
            <p>Phone Number</p>
            <input type="number" placeholder="Enter phone number" required  name="phone_no" value="<?php echo $phone_no ?>">
        </div>
        <div class="input-box">
            <p>ADRESS</p>
            <input type="text" placeholder="Enter email address" required  name="email" value="<?php echo $email ?>">
        </div>
        <div class="input-box">
            <p>website</p>
            <input type="text" placeholder="Enter website" required  name="website" value="<?php echo $website ?>">
        </div>
        <div class="input-box">
            <p>FACEBOOK</p>
            <input type="text" placeholder="Enter facebook name" required  name="facebook" value="<?php echo $facebook ?>">
        </div>
        <button class="btn btn-create" type="submit">
                <div class="hover"></div>
                <span>save</span>
         </button>
        </form>    
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