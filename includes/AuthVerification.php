<?php
	function verifyAuth()
	{
		if(!isset($_SESSION['email']))
   		{
      		header('Location: login.php');
      		die();
   		}
	}

	verifyAuth();