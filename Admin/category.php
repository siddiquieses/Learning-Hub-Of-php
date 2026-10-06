<?php
session_start();
include  '../connection.php';
if(!isset($_SESSION['userid'])|| $_SESSION['Role'] !== 'Admin')
{
  header("Location:../Login.php");
  exit();
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
 
  $cname=$_POST['name'];
  $description=$_POST['description'];

  $sql="INSERT INTO 
  `category`(`name`, `description`) 
  VALUES ('$cname','$description')";
   $run=mysqli_query($connection,$sql);
   
   header("Location:index.php");

  
}
?>