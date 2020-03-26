<?php
   session_start();

   $msg = "";

   require __DIR__ . "/includes/AuthVerification.php";

   $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

   $email = $_SESSION['email'];
   
   $sql = "SELECT * FROM users_table";
   $result = mysqli_query($connect, $sql);
   $queryResults = mysqli_num_rows($result);   

   $sql1 = "SELECT * FROM uploads WHERE status='Developing'";
   $result1 = mysqli_query($connect, $sql1);
   $queryResults1 = mysqli_num_rows($result1);

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="shortcut icon" href="images/favicon.png" type="image/x-generic" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js">
  <link rel="stylesheet" href="css/dashboard.css">
  <title>FlexCreo - Users Panel</title>

  <!-- Style for Preloader -->

   <style type="text/css">
      .no-js #loader { display: none;  }
      .js #loader { display: block; position: absolute; left: 100px; top: 0; }
      .se-pre-con {
         position: fixed;
         left: 0px;
         top: 0px;
         width: 100%;
         height: 100%;
         z-index: 9999;
         background: url(images/Preloader_2.gif) center no-repeat #fff;
      }
    </style>

  <!-- Script for Preloader -->

   <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
   <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
   <script type="text/javascript">
      $(window).load(function() {
         $(".se-pre-con").animate({opacity: 1},500,function(){
            $(".se-pre-con").fadeOut("slow");
         });
      });
   </script>
</head>
<body>
   <!-- Preloader -->
   <div class="se-pre-con"></div>

   <nav class="navbar navbar-toggleable-md navbar-inverse p-0" style='background-color: #292b2c;'>
      <div class="container">
         <a href="../index.php" class="navbar-brand text-white">Flex<strong style='color: #EB004E;'>Creo</strong></a>
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
                  <i class="fa fa-book"></i> Dashboard
               </h1>
            </div>
         </div>
      </div>
   </header>

   <!-- Section -->

   <section id="sections" class="py-4 mb-4 bg-faded">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <a href="posts.php" class="btn btn-block shadow-none" id="view-projects">
                  <i class="fa fa-eye"></i> View all Projects
               </a>
            </div>

            <div class="col-md-4">
               <a href="cancelProjects.php" class="btn btn-block shadow-none" id="cancel-projects">
                  <i class="fa fa-remove"></i> Cancelled Projects
               </a>
            </div>
            
            <div class="col-md-4">
               <a href="users.php" class="btn btn-block shadow-none" id="add">
                  <i class="fa fa-eye"></i> View Users
               </a>
            </div>
         </div>
      </div>
   </section>

   <!-- Project List -->

   <section id="projects">
      <div class="container mb-3">
         <div class="row">

            <div class="col-md-6">
               <div class="card mb-3 text-center text-white mt-3" id="pending">
                  <div class="card-block py-2">
                     <h3>Pending Projects</h3>
                     <h1 class="display-4"><i class="fa fa-pencil"></i><?php echo $queryResults1; ?></h1>
                  </div>
               </div>
            </div>
               
            <div class="col-md-6">
               <div class="card mb-3 text-center text-white mt-3 bg-danger" id="total">
                  <div class="card-block py-2">
                     <h3>Users</h3>
                     <h1 class="display-4"><i class="fa fa-pencil"></i><?php echo $queryResults; ?></h1>
                  </div>
               </div>
            </div>

            <div class="col">
               <div class="card">
                  <div class="card-header">
                     <h4>Latest Projects</h4>

                     <h5 class='text-danger'>
                        <?php 
                           if($msg != '') {
                              echo '*' . $msg . '<br><br>';
                           } 
                        ?>
                     </h5> 
                  </div>
                  <table class="table table-hover table-bordered table-responsive text-center">

                     <?php

                        if($queryResults1 > 0)
                        {

                           echo '<thead class="thead-inverse">
                                    <tr id="table-heading">
                                       <th class="text-center">SNo.</th>
                                       <th class="text-center">Title</th>
                                       <th class="text-center">Category</th>
                                       <th class="text-center desc">Description</th>
                                       <th class="text-center">Attachment</th>
                                       <th class="text-center">Date Posted</th>
                                       <th class="text-center">Status</th>
                                       <th class="text-center">Amount</th>
                                      <th class="text-center"></th>
                                    </tr>
                                 </thead>';

                           while ($row1 = mysqli_fetch_assoc($result1)) 
                           {

                              $title = $row1['title'];
                              $category = $row1['category'];     

                              ?> <tbody> <?php

                              echo "<tr>
                                       <td>"  . $row1['id']   . "</td>
                                       <td>"  . $row1['title']   . "</td>
                                       <td>"  . $row1['category']   . "</td>
                                       <td class='desc'>"  . $row1['description']   . "</td>
                                       <td>"  . $row1['attachment']   . "</td>
                                       <td>"  . $row1['dateUploaded']   . "</td>
                                       <td class='text-success'>"  . $row1['status']   . "</td>
                                       <td>"  . $row1['amount']   . "</td>
                                       <td>" . "<a href='reason.php?title=$title&category=$category' class='btn btn-danger py-1 shadow-none'>
                                                   <i class='fa fa-angle-double-right'></i> Cancel 
                                                </a> " . 
                                       "</td>
                                    </tr>";
                           }
                        }
                        else
                        {
                           echo "<h5 class='text-center mt-3'> No Projects yet. </h5>";
                        }   
                     ?>
                     </tbody>
                  </table>
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