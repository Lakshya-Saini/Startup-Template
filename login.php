<?php
  
  $msg = "";

  if(isset($_POST['submit']))
  {
       $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

      $email  = $connect->real_escape_string($_POST['email']);
      $password  = $connect->real_escape_string($_POST['password']);

      if($email == "" || $password == "")
      {
          $msg = "All fields are compulsory to fill.";
      } 
      else
      {
          $sql = mysqli_query($connect, "SELECT id, name, password, isEmailConfirmed FROM users_table WHERE email='$email'");
          if($sql->num_rows > 0)
          {
              $data = $sql->fetch_array();
              $name = $data['name'];
              if($_POST['password'] == $data['password'])
              {
                //if($data['isEmailConfirmed'] == 0)
                //{
                    //$msg = "Please verify your Email";
                //}
                //else
                //{
                    if(!empty($_POST['remember']))
                    {
                        setcookie('email', $email, time() + (365 * 24 * 60 * 60));
                        setcookie('password', $password, time() + (365 * 24 * 60 * 60));
                    } 
                    else
                    {
                        if(isset($_COOKIE['email']) or isset($_COOKIE['password']))
                        {
                            setcookie('email', '');
                            setcookie('password', '');
                        }  
                    }  
                    session_start();
                    $_SESSION['name'] = $name;
                    $_SESSION['email'] = $email;
                    header('Location: dashboard.php');
                    exit();
                //}
              }
              else
              {
                  $msg = "Invalid Password.";
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
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="css/login.css">
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
               <div class="card col-md-6 mt-1 mb-3 ml-auto mr-auto">
                   <div class="card-block p-3">

                      <h4 class="text-center mb-5 mt-2">Login</h4>  

                      <h5 class="text-danger ml-10"><?php 
                          if($msg != "") {
                              echo '*' . $msg . '<br><br>';
                          } 
                      ?></h5>  

                      <form action="login.php" method="post">
                        <div class="form-group">
                           <label for="email" class="form-control-label">Email</label>
                           <input type="email" name="email" class="form-control shadow-none" id="email" value="<?php if(isset($_COOKIE['email'])) { echo $_COOKIE['email']; } ?>">
                        </div>

                        <div class="form-group">
                           <label for="password" class="form-control-label">Password</label>
                           <input type="password" name="password" class="form-control col-md-112 d-inline shadow-none" id="password" value="<?php if(isset($_COOKIE['password'])) { echo $_COOKIE['password']; } ?>">
                        </div>

                        <div class="form-group">
                            <input type="checkbox" name="remember" <?php if(isset($_COOKIE['email'])) { ?> checked <?php } ?> > Remember Me
                        </div>

                        <button class="btn btn-block text-center mt-4 shadow-none" id="login" type="submit" name="submit">Login</button>

                        <p class="text-center mt-4"> 
                          <a href="forgotPassword.php" class="text-muted  mb-3">Forgot Password ?</a>
                        </p>

                        <div class="col-md-12">
                          <hr>
                        </div>

                        <p class="text-center mt-4">New to FlexCreo ? 
                          <a href="register.php" class="text-success">Sign up</a>
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
</body>
</html>
