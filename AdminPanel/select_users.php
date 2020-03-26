<?php
	$search = $_GET['search'];

	   $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');

	$result = mysqli_query($connect, "SELECT * FROM users_table WHERE name like ('%$search%') OR email like ('%$search%') OR dateRegistered like ('%$search%')");
	


                  echo "<table class='table table-striped table-responsive text-center'>";
                     echo "<tbody>";

                        	while ($row = mysqli_fetch_assoc($result)) 
                              {
                                echo "<tr>
                                        <td>" . $row['id']  . "</td> 
                                        <td>"  . $row['name']   . "</td>
                                        <td>"  . $row['email']   . "</td> 
                                        <td>"  . $row['dateRegistered']   . "</td> 
                                        <td>"  . $row['isEmailConfirmed']   . "</td> 
                                      </tr>";
                              }
                      
                     echo "</tbody>";
                  echo "</table>";
                  
                    ?>