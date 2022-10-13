<?php
$pdo = new PDO("mysql:host=localhost;port=3306;dbname=users", 'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

session_start();
if (!isset( $_SESSION['user_name'])) {
  header('location:register.php');
}


$search  = $_GET['search'] ?? '';

if ($search) {
    $statement = $pdo->prepare('SELECT * FROM ' .$_SESSION["user_name"]. ' WHERE name LIKE :name ORDER BY name');
    $statement->bindValue(':name', "%$search%");
} else {
    $statement = $pdo->prepare('SELECT * FROM ' .$_SESSION["user_name"]. ' ORDER BY name');
}

$statement->execute();
$contact = $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact management</title>
    <!-- fontwesome cdn -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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



    <div>
    <div class="section-upper">
        <h1>hi <span><?php echo $_SESSION['user_name'] ?></span> </h1>
        <h2>welcome to Contact-X </h2>
    </div>

    
    </div>
    <section class="section section-contacts">

    <?php if ($contact) {?>
    <div class="section-table">
    <div class="searchBox">
         <form class="example" action="contact.php">
            <input type="text" placeholder="Search for contacts" name="search" value="<?php echo $search ?>">
            <button type="submit"><i class="fa fa-search"></i></button>
        </form>
    </div>

        <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>PHONE NO.</th>
            <th>ADDRESS</th>
            <th>WEBSITE</th>
            <th>FACEBOOK</th>
            <th>CREATE DATE</th>
            <th>ACTION</th>
        </tr>
        </thead>
        <tbody>
            <?php foreach ($contact as $i => $contact) : ?>
                <tr>
                    <td><?php echo $i + 1 ?></td>
                    <td><?php echo $contact['name']?></td>
                    <td><?php echo $contact['phone_no']?></td>
                    <td><?php echo $contact['email']?></td>
                    <td><?php echo $contact['website']?></td>
                    <td><?php echo $contact['facebook']?></td>
                    <td><?php echo $contact['create_date']?></td>
                    <td>
                        <div class="action">
                       
                        <form action="delete.php" method="post" >
                            <input type="hidden" name="id" value="<?php echo $contact['id'] ?>">
                        <button class="btn-action" type="submit">
                            <div class="hover"></div>
                            <span>delete</span>
                        </button>
                        </form>
                        <a href="update.php?id=<?php echo $contact['id'] ?>" class="btn-action" type="submit">
                            <div class="hover"></div>
                            <span>update</span>
                        </a>
                        </div>
                    
                       
                    </td>
                  
                </tr>
            <?php endforeach ?>
        
        </tbody>

    </table>

    </div>

    <?php } else { ?>
        
        <div class="section-inner-contacts section-inner">
                    <h4>all your valuable business contacts <br> will be displayed here</h4>
                    <h2> contact-x</h2>
                    <a class="btn" href="create.php">
                        <div class="hover"></div>
                        <span>get started</span>
                    </a>
        </div>

        <?php } ?>
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