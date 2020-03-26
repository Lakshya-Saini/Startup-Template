<?php

  $search = $_GET['search'];
  $email  = $_GET['email'];

	$connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

	$result = mysqli_query($connect, "SELECT * FROM uploads WHERE title like ('%$search%') OR category like ('%$search%')");
  $query_results = mysqli_num_rows($result);
	
  echo "<table class='table table-hover table-responsive table-bordered text-justify-all'>";
    echo "<tbody>";
        if($query_results > 0)
        {  
            while ($row1 = mysqli_fetch_assoc($result)) 
            {
                if($row1['email'] == $email){
                  echo "<tr class='text-center'>
                        <td>"  . $row1['id']   . "</td>
                        <td>"  . $row1['title']   . "</td>
                        <td>"  . $row1['category']   . "</td>
                        <td>"  . $row1['description']   . "</td>
                        <td>"  . $row1['attachment']   . "</td>
                        <td>"  . $row1['dateUploaded']   . "</td>
                        <td class='text-success'>"  . $row1['status']   . "</td>
                        <td>"  . $row1['amount']   . "</td>
                        <td>" . " <a href='reason.php' class='btn btn-danger py-1'>
                                      <i class='fa fa-angle-double-right'></i> Cancel
                                  </a> " . 
                        "</td>
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