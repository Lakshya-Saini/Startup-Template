<?php
  session_start();

  $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

  $results_per_page = 15;

   $result = mysqli_query($connect, "SELECT * FROM users_table");
   $number_of_results = mysqli_num_rows($result);

   $number_of_pages = ceil($number_of_results/$results_per_page);

   if(!isset($_GET['page']))
	   $page = 1;
   else
	   $page = $_GET['page'];

   //determine sql starting limit number for results on displaying page.

   $this_page_first_result = ($page-1)*$results_per_page;

   $result1 = mysqli_query($connect, "SELECT * FROM users_table LIMIT " . $this_page_first_result . ',' . $results_per_page);

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
  <link rel="stylesheet" href="css/style.css">
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

   <header id="main-header" class="bg-primary py-2 text-white">
      <div class="container">
         <div class="row">
            <div class="col-md-6">
               <h1>
                  <i class="fa fa-user"></i> Users
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
            <div class="col-md-5 ml-auto">
               <div class="input-group">
                 <input type="text" name="search" id="search" onkeyup="SearchField();" class="form-control shadow-none" placeholder="Search User..">
                 <span class="input-group-btn">
                   <button class="btn btn-primary shadow-none">Search</button>
                 </span>
               </div>
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
                  <div class="card-header">
                     <h4>All Users</h4>
                  </div>
                  <table class="table table-responsive table-striped">
                     <thead class="thead-inverse">
                        <tr>
                          <th>S No.</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Date Registered</th>
                          <th>Email Confirmed</th>
                        </tr>
                     </thead>

                     <tbody id="display">
                        
                        <?php
                        
	                        while ($row = mysqli_fetch_assoc($result1)) 
	                        {
	                            echo "<tr>
	                                  	<td>" . $row['id']  . "</td> 
	                                  	<td>"  . $row['name']   . "</td>
	                                  	<td>"  . $row['email']   . "</td> 
	                                  	<td>"  . $row['dateRegistered']   . "</td> 
	                                  	<td>"  . $row['isEmailConfirmed']   . "</td> 
	                                  </tr>";
	                        } 
                        ?>
                        
                     </tbody>
                  </table>
                  <nav class="ml-4">
                      <ul class="pagination">
                        <li class="page-item disabled"><a href="#" class="page-link">Previous</a></li>  
                        <?php
                        	for ($page = 1; $page <= $number_of_pages ; $page++) 
							{ 
								echo '<li class="page-item"><a href="users.php?page=' . $page . '" class="page-link">' . $page . ' ' . '</a></li>';
							}
                        ?> 
                        <li class="page-item "><a href="#" class="page-link">Next</a></li>  
                      </ul>
                  </nav>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- Footer -->

   <footer id="main-footer" class="text-center text-white bg-inverse mt-5 p-4">
      <div class="container">
         <div class="row">
            <div class="col">
               <p class="lead">Copyright 2018 &copy; FlexCreo</p>
            </div>
         </div>
      </div>
   </footer>

   <script type="text/javascript">
      
      function SearchField() {
          xmlhttp = new XMLHttpRequest();
          xmlhttp.open("GET", "select_users.php?search="+document.getElementById('search').value, false);
          xmlhttp.send(null);

          document.getElementById('display').innerHTML=xmlhttp.responseText;
      }

   </script>

<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
