<?php

	function redirect(){
		header('Location: register.php');
		exit();
	}

	if(!isset($_GET['email']) || !isset($_GET['token'])){
		redirect();
	}
	else{
		 $connect = mysqli_connect('localhost', 'root', 'lakshya', 'lakshya');
		
		$email = $connect->real_escape_string($_GET['email']);
		$token = $connect->real_escape_string($_GET['token']);

		$sql = mysqli_query($connect, "SELECT id FROM users_table WHERE email='$email' AND token='$token' AND isEmailConfirmed='0' ");

		if($sql->num_rows > 0){
			mysqli_query($connect, "UPDATE users_table SET isEmailConfirmed=1, token='' WHERE email='$email' ");
			header('Location: login.php');
		}
		else{
			redirect();
		}
	}