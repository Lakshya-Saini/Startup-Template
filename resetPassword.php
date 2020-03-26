<?php
  
  if(isset($_GET['email']) && isset($_GET['token']))
  {
      $email = $_GET['email'];
      $token = $_GET['token'];

      session_start();
      $_SESSION['email'] = $email;
      $_SESSION['token'] = $token;

      header('Location: reset.php');
      exit();
  }

?>       