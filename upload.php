<?php

   error_reporting(0);
   session_start();

   require __DIR__ . "/includes/AuthVerification.php";

     $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

   $msg = "";
   $email = $_SESSION['email'];
   $title = $_SESSION['title'];
   $category = $_SESSION['category'];
   $description = $_SESSION['description'];
   $status = "Developing";

   if(!isset($title) || !isset($category))
   {
      header('Location: addProject.php');
      exit();
   } 
   else  
   {   
      if(isset($_POST['add']))
      {

         $file_name = $_FILES['file']['name'];
         $file_size = $_FILES['file']['size'];
         $location = $_FILES['file']['tmp_name'];
         $path = "file/".$file_name;


         $rev = strrev($file_name);
         $split = str_split($rev);

         $i=2;

         if($split[$i] == '.'){ $pos = $i; }
         elseif($split[$i+1] == '.'){ $pos = $i+1; }
         elseif($split[$i+2] == '.'){ $pos = $i+2; }
         elseif($split[$i+3] == '.'){ $pos = $i+3; }
         elseif($split[$i+4] == '.'){ $pos = $i+4; }
         else{ $pos = $i+5; }

         $extension = '';

         while($pos > 0)
         {
            $extension = $extension . '' . $split[$pos-1];
            $pos = $pos-1;
         }   

         $new_extension = $extension;

         if(filesize($_FILES['file']['tmp_name']))
         {   
            if($new_extension == 'zip') 
            {
               if($file_size < 26214400)
               {
                  mysqli_query($connect, "INSERT INTO uploads(email, title, category, description, attachment, status, amount) VALUES('$email', '$title', '$category', '$description', '$file_name', '$status', '0')");

                  if(move_uploaded_file($location, $path))
                  {
                     $msg = 'Project Uploaded successfully' . '<br>' . 'Redirecting to dashboard...';
                     header( "refresh:3;url=dashboard.php" );
                  }
                  else
                  {
                     $msg = "Project Not Uploaded.";
                  }
               }
               else
               {
                  $msg = 'File limit exceeded.';
               }   
            }
            else
            {
               $msg = 'File extension is not allowed.';
            }
         }
         else
         {
            $msg = "Please upload a file.";
         }   
      }

      if(isset($_POST['skip']))
      {
         mysqli_query($connect, "INSERT INTO uploads(email, title, category, description, attachment, status, amount) VALUES('$email', '$title', '$category', '$description', 'No Attachment', '$status', '0')");
         header('Location: dashboard.php');
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
  <link rel="stylesheet" href="css/upload.css">
  <title>FlexCreo - Users Panel</title>
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
                  <i class="fa fa-plus-circle"></i> Add Project
               </h1>
            </div>
         </div>
      </div>
   </header>

   <!-- Section -->

   <section id="sections" class="py-4 mb-4 bg-faded">
      <div class="container">
         <div class="row">
            <div class="col-md-3">
               <a href="addProject.php" class="btn btn-block shadow-none" style='color: #007bff; background-color: #fff; border: 1px solid #007bff;'>
                  <i class="fa fa-arrow-left"></i> Back
               </a>
            </div>
         </div>
      </div>
   </section>

   <!-- Project List -->

   <section id="projects">
      <div class="container">
         <div class="row">
            <div class="col-md-9 ml-auto mr-auto">
            	<h3 class="text-inverse text-center mb-4">
            		Step 2/2
            	</h3>
               <div class="file-upload-box">
                  <form action="upload.php" method="post" enctype="multipart/form-data">

                  	<h5 class='text-center' style="color: #EB004E;">
                     	<?php 
                        		if($msg != '') 
                        		{
                           		echo '*' . $msg . '<br><br>';
                        		}	 
                     	?>
                  	</h5> 

                     <div class="form-group">
                        <label for="file" class="upload-text">Upload Attachments (if any)</label>
                        <input type="file" name="file" id="file" class="form-control-file file-button shadow-none mb-2">
                        <small class="form-text text-muted">Note: Please upload .zip files only (Limit: 20Mb)</small>
                     </div>

                     <div class="buttons">
                        <button class="btn shadow-none" id="skip" name="skip" type="submit">Skip</button>
                        <button class="btn shadow-none" id="add" name="add" type="submit">Add Attachment</button>
                     </div>

                  </form> 
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
