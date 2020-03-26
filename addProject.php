<?php

   session_start();

   require __DIR__ . "/includes/AuthVerification.php";

   $msg = "";

   if(isset($_POST['next']))
   {
		 $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

		$email       = $_SESSION['email'];
		$title       = $connect->real_escape_string($_POST['title']);
		$category    = $connect->real_escape_string($_POST['category']);
		$description = $connect->real_escape_string($_POST['description']);	

		if($title == '' || $category == '' || $description == '')
		{
			$msg = 'All fields are required.';
		}
		else	
		{	
			$_SESSION['title'] = $title;
			$_SESSION['category'] = $category;
			$_SESSION['description'] = $description;

			//mysqli_query($connect, "INSERT INTO project(email, title, category, description, attachment, status, amount) VALUES('$email', '$title', '$category', '$description', '$file', '$status', '0')");
			header('Location: upload.php');
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
  <link rel="stylesheet" href="css/addProject.css">
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
               <a href="dashboard.php" class="btn btn-block shadow-none" style='color: #007bff; background-color: #fff; border: 1px solid #007bff;'>
                  <i class="fa fa-arrow-left"></i> Dashboard
               </a>
            </div>
         </div>
      </div>
   </section>

   <!-- Project List -->

   <section id="projects">
      <div class="container mb-4">
         <div class="row">
            <div class="col-md-9 ml-auto mr-auto">
            	<h3 class="text-inverse text-center mb-4">
            		Step 1/2
            	</h3>
               <div class="card">
                  <div class="card-block p-3">
                     
                     <form action="addProject.php" method="post" enctype="multipart/form-data">

                     	<h5 class='text-danger'>
                        	<?php 
                           		if($msg != '') 
                           		{
                              		echo '*' . $msg . '<br><br>';
                           		}	 
                        	?>
                     	</h5> 

                        <div class="form-group">
                              <label for="title" class="form-control-label">Title</label>
                           <input type="text" id="title" name="title" class="form-control shadow-none" placeholder="eg. Name of your website">
                        </div>

                        <div class="form-group">
                           <label for="category" class="form-control-label">Category</label>
                        <input type="text" id="category" name="category" class="form-control shadow-none" placeholder="eg. E-Commerce, Hotel, Startup etc...">

                        </div>

                         <div class="form-group">
                           <label for="description">Description</label>
                           <textarea name="description" id="description" class="form-control shadow-none" placeholder="Details on project and your requirements..." style="max-height: 300px; min-height: 120px;"></textarea>
                        </div>

                        <button class="btn shadow-none" id="next" name="next" type="submit">Next</button>

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
