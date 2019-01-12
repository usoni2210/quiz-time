<?php
	session_start();
	if(isset($_SESSION["email"])){
		session_destroy();
	}
	
	include_once 'include/connection.php';
	$ref=@$_GET['q'];

	$email = $_POST['emailId'];
	$password = $_POST['pass'];
	
	$email = stripslashes($email);
	$email = addslashes($email);
	
	$password = stripslashes($password); 
	$password = addslashes($password);
	$password=md5($password); 
	
	$result = mysqli_query($con,"SELECT * FROM user WHERE email = '$email' and password = '$password'") or die('Error');
	$count = mysqli_num_rows($result);
	
	if($count==1){
		while($row = mysqli_fetch_array($result)) 
		{
			$name = $row['name'];
			$user_id = $row['id'];
		}
		
		$_SESSION["userId"] = $user_id;
		$_SESSION["name"] = $name;
		$_SESSION["email"] = $email;
		header("location:account.php?q=1");
	}
	else
		header("location:$ref?w=Wrong Username or Password");
?>