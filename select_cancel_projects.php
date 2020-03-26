<?php

	$search = $_GET['search'];
  $email  = $_GET['email'];

	 $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

	$result = mysqli_query($connect, "SELECT * FROM reason WHERE title like ('%$search%') OR category like ('%$search%')");
  $qr = mysqli_num_rows($result);
	
  echo "<table class='table table-striped table-responsive table-bordered text-center col-md-12'>";
    echo "<tbody>";
      if($qr > 0)
      {
        while ($row = mysqli_fetch_assoc($result)) 
        {
          if($row['email'] == $email){
            echo "<tr class='text-center'>
                    <td>"  . $row['id']   . "</td>
                    <td>"  . $row['title']   . "</td>
                    <td>"  . $row['category']   . "</td>
                    <td class='dd'>"  . $row['reason']   . "</td>
                    <td>"  . $row['review']   . "</td>
                    <td>"  . $row['dateCancelled']   . "</td>
                  </tr>";
          }
        }
      }
      else
      {
        echo "<style> thead{ border: none; opacity: 0; } </style>";
        echo "<h5 class='text-center mt-3'> No Project Matched. </h5>";
      }      
                      
    echo "</tbody>";
  echo "</table>";
                  
?>