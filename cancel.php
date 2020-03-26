<?php
   
     $msg = "";

     session_start();

     require __DIR__ . "/includes/AuthVerification.php";

      $title    = $_SESSION['title'];
      $category = $_SESSION['category'];

      if(isset($_POST['save']))
      {
             $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

            $email    = $_SESSION['email'];
            $reason   = $_POST['optradio'];
            $review   = $connect->real_escape_string($_POST['review']);

            if($review != "")
            {
               mysqli_query($connect, "INSERT INTO reason(email, title, category, reason, review) VALUES('$email', '$title', '$category', '$reason', '$review') ");
            
               mysqli_query($connect, "DELETE FROM uploads WHERE email='$email' AND title='$title' AND category='$category'");
            
               header('Location: dashboard.php');
            }
            else
            {
               $msg = "Please give your review..";
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
  <link rel="stylesheet" href="css/cancel.css">
  <title>FlexCreo - Admin Panel</title>
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
                  <i class="fa fa-question-circle-o"></i> Oops What Happened !!
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
            <div class="col-md-3 ml-auto">
               <h5 class="text-danger ml-10"><?php 
                     if($msg != "") {
                        echo '*' . $msg . '<br><br>';
                     } 
               ?></h5> 
            </div>
         </div>
      </div>
   </section>

   <!-- Project List -->

   <section id="projects">
      <div class="container mb-4">
         <div class="row">
            <div class="col">
               <div class="card">
                     <div class="card-block p-3">
                        <form action="cancel.php" method="post">

                           <h3>Reason For Cancelling Project ?</h3>

                           <div class="radio py-1 mt-3">
                              <h6><input type="radio" name="optradio" value="Services are not good." checked> Services are not good.</h6>
                           </div>

                           <div class="radio py-1">
                              <h6><input type="radio" name="optradio" value="Required values are not fulfilled."> Required values are not fulfilled.</h6>
                           </div>

                           <div class="radio py-1">   
                              <h6><input type="radio" name="optradio" value="Project took too long to complete."> Project took too long to complete.</h6>
                           </div>

                           <div class="radio py-1">   
                              <h6><input type="radio" name="optradio" value="Not Interested in Project."> Not Interested in Project.</h6>
                           </div>

                           <div class="radio py-1">   
                              <h6><input type="radio" name="optradio" value="Site is untrustworthy."> Site is untrustworthy.</h6>
                           </div>

                           <div class="radio py-1">   
                              <h6><input type="radio" name="optradio" value="Any other ..."> Any other ...</h6>
                           </div>   

                           <div class="form-group py-2">
                              <textarea id="description" name="review" class="form-control py-2 shadow-none" placeholder="Your Review Here... "></textarea>
                           </div>

                           <div class="form-group col-md-3">
                              <button type="submit" id="submit" name="save" class="btn btn-block  shadow-none">
                                 <i class="fa fa-check"></i> Save Changes
                              </button>
                           </div>

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
