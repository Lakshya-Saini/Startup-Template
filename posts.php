<?php

    error_reporting(0);

    session_start();

    require __DIR__ . "/includes/AuthVerification.php";

    $email = $_SESSION['email'];

     $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

    $results_per_page = 5;

    $result = mysqli_query($connect, "SELECT * FROM uploads WHERE email='$email'");
    $number_of_results = mysqli_num_rows($result);

    $number_of_pages = ceil($number_of_results/$results_per_page);

    if(!isset($_GET['page']))
  	 $page = 1;
    else
  	 $page = $_GET['page'];


    $page_next = $page + 1;
    $page_previous = $page - 1;

    //determine sql starting limit number for results on displaying page.

    $this_page_first_result = ($page > 1) ? ($page-1)*$results_per_page : 0;

    $result1 = mysqli_query($connect, "SELECT * FROM uploads WHERE email='$email' LIMIT " . $this_page_first_result . ',' . $results_per_page);
    $query_results = mysqli_num_rows($result1);

    if($page > $number_of_pages)
    {
        header('Location: posts.php?page=' . $number_of_pages);
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
  <link rel="stylesheet" href="css/posts.css">
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
                  <i class="fa fa-pencil"></i> Projects
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
                 <input type="text" name="search" id="search" onkeyup="SearchField();" class="form-control shadow-none" placeholder="Search from Title or Category">
                 <span class="input-group-btn">
                   <button class="btn shadow-none" id="search-button">Search</button>
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
                     <h4>All Projects</h4>
                  </div>
                  <table class="table table-hover table-responsive table-bordered text-justify-all">

                    <?php
                        if($query_results > 0)
                        {

                          echo '<thead class="thead-inverse">
                                  <tr>
                                     <th class="text-center">Id</th>
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

                          while($row = mysqli_fetch_assoc($result1))
                            {

                              $title = $row['title'];
                              $category = $row['category'];

                          ?> <tbody id="display"> <?php

          								echo "<tr class='text-center'>
          								          <td>"  . $row['id']   . "</td>
          								          <td>"  . $row['title']   . "</td>
          								          <td>"  . $row['category']   . "</td>
                                    <td class='dd desc'>"  . $row['description']   . "</td>
          								          <td>"  . $row['attachment']   . "</td>
          								          <td>"  . $row['dateUploaded']   . "</td>
          								          <td class='text-success'>"  . $row['status']   . "</td>
          								          <td>"  . $row['amount']   . "</td>
          								          <td>" . " <a href='reason.php?title=$title&category=$category' class='btn btn-danger py-1'>
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
                  <div class="col-md-12">
                    <hr>
                  </div>
                  <nav class="ml-4">
                      <ul class="pagination">

                      <?php if($page > 1) { ?>  
	                       
                         <li class="page-item"><a href="<?php  echo 'posts.php?page=' . $page_previous ?>" class="page-link">Previous</a></li>  							
	                    
                      <?php } ?>   

                        <?php
                        	for ($page = 1; $page <= $number_of_pages ; $page++) 
            							{ 
            								echo '<li class="page-item"><a href="posts.php?page=' . $page . '" class="page-link">' . $page . ' ' . '</a></li>';
            							}
                        ?>

                      <?php if($page >= 1) { ?>  
                          
                          <li class="page-item "><a href="<?php  echo 'posts.php?page=' . $page_next ?>" class="page-link">Next</a></li>

                      <?php } ?>    
                            
                      </ul>
                  </nav>
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

   <script type="text/javascript">

      function SearchField() {
          xmlhttp = new XMLHttpRequest();
          xmlhttp.open("GET", "select_posts.php?email=<?php echo $email; ?>&search="+document.getElementById('search').value, false);
          xmlhttp.send(null);

          document.getElementById('display').innerHTML=xmlhttp.responseText;
      }

   </script>

<script src="js/jquery.min.js"></script>
<script src="js/tether.min.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
