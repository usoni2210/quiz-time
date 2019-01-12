<?php
	include_once 'include/connection.php';
	$ref=@$_GET['q'];
	
	$email = $_POST['uname'];
	$password = $_POST['password'];

	$email = stripslashes($email);
	$email = addslashes($email);
	
	$password = stripslashes($password); 
	$password = addslashes($password);
	
	$result = mysqli_query($con,"SELECT email FROM admin WHERE email = '$email' and password = '$password'") or die('Error');
	
	$count=mysqli_num_rows($result);
	if($count==1){
		session_start();
		if(isset($_SESSION['email'])){
			session_destroy();
		}
		$_SESSION["name"] = 'Admin';
		$_SESSION["key"] = 'admin';
		$_SESSION["email"] = $email;
		header("location:dashboard.php?q=0");
	}
	else header("location:$ref?w=Warning : Access denied");
?>