<?php
session_start();
include "connection.php";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email=$_POST['email'];
    $password=$_POST['password'];
    $result=mysqli_query($connection,"SELECT * FROM register WHERE email = '$email'");
  if(mysqli_num_rows($result)===0){
    $emailerror="email is not register";
  }
  else{
    $user=mysqli_fetch_assoc($result);
    if(!password_verify($password,$user['password'])){
    $passworderror="Incorrect Password";
  }
  else{
    $_SESSION['userid']=$user['id'];
    $_SESSION['name']=$user['username'];
    $_SESSION['email']=$user['email'];
    $_SESSION['Role']=$user['Role'] ;
    header("Location:home.php");

  }
if($user['Role']==='Admin')
    {
        header("Location:Admin/index.php");
    }     
    else{
        header("Location:website/index.php");
    }


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
                <h1 class="text-primary">LOGIN FORM</h1>
            </center>
            <div class="col-md-6">
                <?php  if(isset($emailerror)) echo "<p style='color:red' >$emailerror</p>"?>
                <label for="inputEmail4" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" id="inputEmail4">
            </div>

            <div class="col-md-6">
                <!-- <?php  if(isset($passworderror)) echo "<p style='color:red' >$passworderror</p>"?> -->
                <label for="inputPassword4" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="inputPassword4">
            </div>


            <div class="col-12">
                <button type="submit" class="btn btn-primary">LOGIN</button>
            </div>
        </form>
    </div>
</body>

</html>