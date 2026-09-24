<?php
 include "connection.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $password=$_POST['password'];
    $cpassword=$_POST['cpassword'];
  if($password!==$cpassword){
   $passworderror= "password and conform password  does not match";
  }
  else{
    $hashedpassword=password_hash($password,PASSWORD_DEFAULT);
  }

   $check=mysqli_query($connection,"SELECT id FROM register  WHERE email='$email'");
   if(mysqli_num_rows($check)>0)
    {
     $emailerror="Email is already Exist in database";
    }
    else{
      $sql="INSERT INTO `register`( `username`, `email`, `password`, `confirmpassword`) 
      VALUES ('$name','$email','$hashedpassword','$hashedpassword')";
      mysqli_query($connection,$sql)   ;

     header("Location:home.php");
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>

    <div class="container">

        <form class="row g-3" method="POST">
            <center>
                <h1 class="text-primary">SIGNUP FORM</h1>
            </center>
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">Name</label>
                <input type="text" name="name" class="form-control" id="inputEmail4">
            </div>
            <div class="col-md-6">
                 <?php  if(isset($emailerror)) echo "<p style='color:red' >$emailerror</p>"?>
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>

            <div class="col-md-6">
                <?php  if(isset($passworderror)) echo "<p style='color:red' >$passworderror</p>"?>
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>
            <div class="col-md-6">
                <?php  if(isset($passworderror)) echo "<p style='color:red' >$passworderror</p>"?>
                <label for="inputPassword4" class="form-label">Confirm Password</label>
                <input type="password" name="cpassword" class="form-control" id="inputPassword4">
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary">REGISTER</button>
            </div>
        </form>
    </div>
</body>

</html>