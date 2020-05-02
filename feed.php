<?php
	include_once 'include/connection.php';
	$ref=@$_GET['q'];
	
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];

  date_default_timezone_set("Asia/Calcutta");
	$date=date("Y-m-d");
	$time=date("h:i:sa");
	
	$qry = "INSERT INTO `feedback` (`id`, `name`, `email`, `subject`, `feedback`, `date`, `time`) VALUES (NULL, '$name', '$email', '$subject', '$message', '$date', '$time')";
	$res=mysqli_query($con,$qry)or die ("Error");
	
	header("location:$ref?w=Thank you for your valuable feedback");
?>