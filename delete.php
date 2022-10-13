<?php 
$pdo = new PDO("mysql:host=localhost;port=3306; dbname=users",'root', '');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
session_start();
if (!isset( $_SESSION['user_name'])) {
    header('location:register.php');
  }


$id = $_POST['id'] ?? null;

if (!$id) {
    header('location:contact.php');
    exit;
}

$statement = $pdo->prepare('DELETE FROM ' .$_SESSION["user_name"].'  WHERE id = :id');
$statement->bindValue(':id', $id);
$statement->execute();
header("location:contact.php");



?>