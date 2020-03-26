<?php

  require '/home/flexcvpl/public_html/PHPMailer-5.2.4/class.phpmailer.php';
  
  $msg = "";
  $token = "0123654789abcdeghijklmnopqrstuvwxyzAWSCBDGTYJMNJJB";
  $token = str_shuffle($token);
  $token = substr($token, 0, 5);

  if(isset($_POST['submit']))
  {
       $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

      $email    = $connect->real_escape_string($_POST['email']);

      if($email == "")
      {
          $msg = "Please enter your email..";
      }

      else
      {
          $sql = mysqli_query($connect, "SELECT email FROM users_table WHERE email='$email'");
          if($sql->num_rows > 0)
          {

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
              $mail->addAddress($_POST['email']);
              $mail->Subject = 'Click on the link to reset your password.';
              $mail->isHTML(true);
              $mail->Body = "
                  Please click on the link below to Reset your Password : <br><br>

                  <a href='www.flexcreo.com/resetPassword.php?email=$email&token=$token'>Click here to Reset</a>
              ";

              mysqli_query($connect, "UPDATE users_table SET token='$token' WHERE email='$email'");

              if($mail->send())
              {
                  $msg = "Reset link has been send to your email";
              }  
              else
              {
                  $msg = "Something wrong happened. Please try again.";
              }
          }
          else
          {
              $msg = "Invalid Email.";
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
  <link rel="stylesheet" href="css/forgotPassword.css">
  <title>FlexCreo - Users Panel</title>
</head>
<body>

   <!-- Header -->

   <header id="main-header" class="py-2 mb-4 text-white">
      <div class="container">
         <div class="row">
            <a href="index.php" class="nav-link text-white"><h4 class="text-center">Flex<strong style='color: #EB004E;'>Creo</strong></h4></a>
            <div class="col-md-2 ml-auto mt-2">
               <a href="register.php" class="btn btn-block" style="background-color: #fff; color: green;">
                  <i class="fa fa-user-o"></i> Signup
               </a>
            </div>
         </div>
      </div>
   </header>

   <!-- Project List -->

   <section id="projects">
      <div class="container">
         <div class="row">
            <div class="col">
               <div class="card col-md-6 mt-5 mb-3 ml-auto mr-auto">
                   <div class="card-block p-3">

                      <h4 class="text-center mb-5 mt-2">Reset Your Password</h4>  

                      <h5 class="text-danger ml-10"><?php 
                          if($msg != "") {
                              echo '*' . $msg . '<br><br>';
                          } 
                      ?></h5>  

                      <form action="" method="post">
                        <div class="form-group">
                           <label for="email" class="form-control-label">Email</label>
                           <input type="email" name="email" class="form-control shadow-none" id="email">
                        </div>

                        <button class="btn btn-block text-center mt-4 mb-4 col-md-12 shadow-none" id="reset-button" type="submit" name="submit">Send Reset Link</button>

                        <div class="col-md-12 mt-2">
                          <hr>
                        </div>

                        <div class="form-group">
                          <p class="text-center mt-4">Don't want to reset password?  
                            <a href="login.php" class="text-success">Login</a>
                          </p>
                        </div>

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
</body>
</html>
