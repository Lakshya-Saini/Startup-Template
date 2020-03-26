<?php
    session_start();

    require __DIR__ . "/includes/AuthVerification.php";

    $email = $_SESSION['email'];

    $msg = "";
    
    $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

    if(isset($_POST['delete']))
    {
        mysqli_query($connect, "DELETE FROM user WHERE email = '$email'");

        header("Location: login.php");
        exit();
    } 

    if(isset($_POST['save']))
    {
        $currentPassword = $connect->real_escape_string($_POST['currentPassword']); 
        $newPassword     = $connect->real_escape_string($_POST['newPassword']);
        $confirmPassword = $connect->real_escape_string($_POST['confirmPassword']);

        $sql = mysqli_query($connect, "SELECT password FROM user WHERE email='$email'");
        if($sql->num_rows > 0)
        {
            $data = $sql->fetch_array();
            if(sha1($currentPassword) == $data['password'])
            { 
                if($newPassword != $confirmPassword)
                {
                    $msg = 'Confirm Password again !!';
                }
                else
                {
                    $hashedpassword = sha1($newPassword);
                    
                    mysqli_query($connect, "UPDATE user SET password = '$hashedpassword' WHERE email='$email'");

                    if(isset($_COOKIE['password']))
                    {
                        setcookie('password', '');
                    }  
                    header('Location: login.php');

                }  
            }
            else
            {
                $msg = 'Current Password is wrong.';
            }  
        }
        else
        {
            $msg = 'Email does not exists.';
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
  <link rel="stylesheet" href="css/settings.css">
  <title>FlexCreo - User Panel</title>
</head>
<body>
   <nav class="navbar navbar-toggleable-md navbar-inverse p-0" style='background-color: #292b2c;'>
      <div class="container">
         <a href="index.php" class="navbar-brand text-white">Flex<strong style='color: #EB004E;'>Creo</strong></a>
         <div class='right-side'>
            <a href="settings.php" class="d-inline mr-4" style='text-decoration:none; color: #ddd;'>
                <i class="fa fa-gear"></i> Settings
            </a>
            <a href="logout.php" class="d-inline logout" style='text-decoration:none; color: #ddd;'>
                <i class="fa fa-user-times"></i> Logout
            </a>
         </div>
      </div>                     
   </nav>

   <!-- Header -->

   <header id="main-header" class="py-2 text-white">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <h1>
                  <i class="fa fa-gear"></i> Settings
               </h1>
            </div>
         </div>
      </div>
   </header>

   <!-- Section -->

   <section id="sections" class="py-4 mb-4 bg-faded">
      <div class="container">
         <div class="row">
            <div class="col-md-3 mr-auto">
               <a href="dashboard.php" class="btn btn-block shadow-none" style='color: #007bff; background-color: #fff; border: 1px solid #007bff;'>
                  <i class="fa fa-arrow-left"></i> Back to Dashboard
               </a>
            </div> 

            <div class="col-md-3">
              <form action="settings.php" method="post">
                  <button class="btn btn-danger btn-block shadow-none" name="delete" type="submit">
                      <i class="fa fa-remove"></i> Delete Account
                  </button>
             </form>
            </div>
         </div>
      </div>
   </section>

   <!-- Project List -->

   <section id="projects">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-block p-3">
                <form action="settings.php" method="post">

                  <h3 class="d-inline mb-3"><i class="fa fa-key"></i> Change Password</h3>

                  <h5 class="text-danger d-inline" style="float: right"><?php 
                      if($msg != "") {
                          echo '*' . $msg . '<br><br>';
                      } 
                  ?></h5>

                  <div class="form-group">
                    <label for="curr-password" class="form-control-label mt-3">Current Password</label>
                      <input type="password" name="currentPassword" class="form-control shadow-none">
                   </div>

                  <div class="form-group">
                    <label for="new-password" class="form-control-label">New Password</label>
                    <input type="password" name="newPassword" class="form-control shadow-none">
                  </div>

                  <div class="form-group">
                    <label for="confirm-password" class="form-control-label">Confirm Password</label>
                    <input type="password" name="confirmPassword" class="form-control shadow-none">
                  </div>

                  <button type="submit" name="save" class="btn shadow-none" id="save">Save Changes</button>

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
