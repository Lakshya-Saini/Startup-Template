<?php
	
	// title and category not getting   
  

    if(isset($_GET['title']) && isset($_GET['category']))
    {
    	$title    = $_GET['title'];
   	$category = $_GET['category'];

      session_start();
      
      $_SESSION['title']  = $title;
      $_SESSION['category']  = $category;

	   header('Location: cancel.php');
      exit(); 
	}   	

?>