<?php

  //error_reporting(0);
  
  require 'PHPMailer-5.2.4/class.phpmailer.php';
  
  $msg = "";

  if(isset($_POST['submit']))
  {
      $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

      $name             = $connect->real_escape_string($_POST['name']);
      $email            = $connect->real_escape_string($_POST['email']);
      $password         = $connect->real_escape_string($_POST['password']);
      $cPassword        = $connect->real_escape_string($_POST['confirm-password']);
      
      if($name == "" || $email == "" || $password == "")
      {
          $msg = "All fields are compulsory to fill.";
      } 
      elseif ($password != $cPassword) 
      {
          $msg = "Both password fields must be same.";
      } 
      else
      { 
          $check = mysqli_query($connect, "SELECT id FROM users_table WHERE email = '$email' ");
          if($check->num_rows > 0)
          {
              $msg = "Email already exists..";
          }          
          else
          {
              $token = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPMNBVCZXALSKDJGF1234098675!$/()*';
              $token = str_shuffle($token);
              $token = substr($token, 0, 10);

              //$hashedpassword = sha1($password);

              mysqli_query($connect, "INSERT INTO users_table(name, email, password, isEmailConfirmed, token) VALUES('$name', '$email', '$password', '0', '$token') ");

              $mail = new PHPMailer; 

              $mail->IsSMTP();  
              $mail->Host = 'smtp.gmail.com';
              $mail->Port='587';
              $mail->SMTPAuth = true; 
              $mail->Username = 'info.flexcreo@gmail.com';
              $mail->Password = 'lakshya@ls';
              $mail->SMTPSecure = 'tls';
              $mail->From = 'info.flexcreo@gmail.com';
              $mail->FromName = 'FlexCreo';
              $mail->addAddress($_POST['email'], $_POST['name']);
              $mail->isHTML(true);
              $mail->Subject = 'Please verify your email.';
              $mail->Body = "
                  <h1>Thanks for creating your account.</h1>
                  <hr>
                  Please click on the link below to verify your email : <br><br>
                
                  <a href='confirm.php?email=$email&token=$token'>Click here to verify</a> ";

              if($mail->send())
              {
                  $msg = "You have been registered. Please verify your email !!";
              }  
              else
              {
                  $msg = "Something wrong happened. Please try again.";
              } 

              
          }  

      }
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
  <link rel="stylesheet" type="text/css" href="css/register.css">
  <title>FlexCreo - Users Panel</title>
</head>
<body>

   <!-- Header -->

   <header id="main-header" class="py-2 mb-4 text-white">
      <div class="container">
         <div class="row">
            <a href="index.php" class="nav-link text-white"><h4 class="text-center">Flex<strong style='color: #EB004E;'>Creo</strong></h4></a>
         </div>
      </div>
   </header>

   <!-- Project List -->

   <section id="projects">
      <div class="container">
        <div class="row">
            <div class="col">
               <div class="card col-md-8 mt-2 mb-3 ml-auto mr-auto"> 
                   <div class="card-block p-3">

                      <h4 class="text-center mb-5 mt-2">Signup</h4>      

                      <h5 class="text-danger ml-10"><?php 
                          if($msg != "") {
                              echo '*' . $msg . '<br><br>';
                          } 
                      ?></h5>                           
                       

                      <form action="register.php" method="post">

                          <div class="form-group">
                            <label for="name" class="form-control-label mt-3">Name</label>
                            <input type="text" name="name" class="form-control shadow-none" required="required" autocomplete="on">
                          </div>

                          <div class="form-group">
                            <label for="email" class="form-control-label">Email</label>
                            <input type="text" name="email" class="form-control shadow-none" required="required" autocomplete="on">
                          </div>

                          <div class="form-group">
                            <label for="password" class="form-control-label">Password</label>
                            <input type="password" name="password" class="form-control shadow-none" required="required" autocomplete="on">
                          </div>

                          <div class="form-group">
                            <label for="confirm-password" class="form-control-label">Confirm Password</label>
                            <input type="password" name="confirm-password" class="form-control shadow-none" required="required" autocomplete="on">
                          </div>

                          <div class="form-group">
                            <input type="checkbox" id="agree" name="agree"> I agree with <a href="privacy.php" target="_blank">Terms and Conditions</a>
                          </div>

                          <button class="btn btn-block text-center mt-4 shadow-none" type="submit" name="submit" id="signup" disabled="disabled">Sign up</button>

                          <p class="text-center mt-4">Already have account ? 
                            <a href="login.php" class="text-success">Login</a>
                          </p>

                      </form>
                  </div>    
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Footer -->

   <footer id="main-footer" style="background-color: #292b2c; margin-top: 3rem; color: #fff; text-align: center; padding: 1rem 1rem;">
      <div class="container">
         <div class="row">
            <div class="col">
               <p class="lead">Copyright 2018 &copy; FlexCreo</p>
            </div>
         </div>
      </div>
   </footer>

<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript">
    var checker = document.getElementById('agree');
    var sendbtn = document.getElementById('signup');
    checker.onchange = function() 
    {
        sendbtn.disabled = !this.checked;
    }
</script>
</body>
</html>
