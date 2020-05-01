<?php
    include_once 'include/connection.php';
    ob_start();

    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $college = $_POST['college'];
    $mob = $_POST['contact'];
    $password = $_POST['password'];

    $name = stripslashes($name);
    $name = addslashes($name);
    $name = ucwords(strtolower($name));

    $gender = stripslashes($gender);
    $gender = addslashes($gender);

    $email = stripslashes($email);
    $email = addslashes($email);

    $college = stripslashes($college);
    $college = addslashes($college);

    $mob = stripslashes($mob);
    $mob = addslashes($mob);

    $password = stripslashes($password);
    $password = addslashes($password);
    $password = md5($password);

    $q3 = mysqli_query($con,"INSERT INTO `user` (`id`, `name`, `email`, `password`, `mob`, `gender`, `college`) VALUES (NULL, '$name', '$email', '$password', '$mob', '$gender', '$college')");
	if($q3) {
		header("location:index.php?w=User Registered");
	}
	else {
		header("location:index.php?w=Email or Contact Number Already Registered!!!");
	}
?>