<?php

  $msg = "";

  session_start();

  $email = $_SESSION['email'];
  $token = $_SESSION['token'];
  
  if(!isset($_SESSION['email']) || !isset($_SESSION['token']))
  {
      header('Location: forgotPassword.php');
      exit();
  }

  $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

  $data = mysqli_query($connect, "SELECT id from user WHERE email='$email' AND token='$token'");

  if($data->num_rows > 0)
  {
    if(isset($_POST['reset']))
    {
        $newPassword = $connect->real_escape_string($_POST['np']);
        $cPassword = $connect->real_escape_string($_POST['cp']);

        if($newPassword != $cPassword)
        {
            $msg = "Both Password fields must be same.";
        }
        else
        {
            $hashedpassword = sha1($newPassword);
            mysqli_query($connect, "UPDATE user SET password='$hashedpassword' WHERE email='$email' AND token='$token'");
            mysqli_query($connect, "UPDATE user SET token='' WHERE email='$email'");

            if(isset($_COOKIE['password']))
            {
                setcookie('password', '');
            }  

            header('Location: login.php');
        }  
    }
  }
  else
  { 
      header('Location: forgotPassword.php');
      exit();
  } 

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-icon" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="/home/flexcvpl/public_html/css/bootstrap.css">
  <title>FlexCreo - Users Panel</title>
</head>
<body>
   <nav class="navbar navbar-toggleable-sm navbar-inverse p-0" style='background-color: #292b2c;'>
      <div class="container">
           <a href="index.php" class="navbar-brand text-white">Flex<strong style='color: #EB004E;'>Creo</strong></a>
      </div>                     
   </nav>


   <section id="sections" class="py-4 mb-4 bg-faded">
      <div class="container">
         <div class="row">
            <div class="col-md-3  mx-auto">
               <a href="login.php" class="btn btn-block shadow-none" style='color: #fff; background-color: #292b2c;'>
                  <i class="fa fa-arrow-left"></i> Back to Login
               </a>
            </div>
         </div>
      </div>
   </section>


   <section id="projects">
      <div class="container">
        <div class="row">
          <div class="col-md-9 ml-auto mr-auto">
            <div class="card">
              <div class="card-block p-3">
                <form action="reset.php" method="post">

                  <h3 class="text-center mb-4 mt-2">Reset Password</h3>

                  <h5 class="text-danger ml-10"> <?php 
                          if($msg != "") {
                              echo '*' . $msg . '<br><br>';
                          } 
                  ?></h5> 

                 <div class="form-group">
                    <label for="new-password" class="form-control-label">New Password</label>
                    <input type="password" name="np" class="form-control shadow-none">
                  </div>

                  <div class="form-group">
                    <label for="confirm-password" class="form-control-label">Confirm Password</label>
                    <input type="password" name="cp" class="form-control shadow-none">
                  </div>

                  <button class="btn btn-info shadow-none" type="submit" name="reset">Save Changes</button>

                </form>
              </div>  
            </div>
        </div>
      </div>
    </div>
  </section>

<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html> 