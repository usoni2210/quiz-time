<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>User Profile </title>
	</head>
	<body  style="background:#eee;">
		<?php 
			session_start();
			if(!(isset($_SESSION['email']))){
				header("location:index.php");
			} else if(isset($_SESSION['key'])) {
				header("location:dashboard.php?q=1");
			} else {
				include_once 'include/connection.php';
				include_once "include/topbar.php" ;
				$uid = $_SESSION['userId'];
				
				$res = mysqli_query($con, "SELECT * FROM user where id=$uid") or die("Error : User");
				$row = mysqli_fetch_assoc($res);
			}
		?>
		<div class="bg">
			<div class="container"><!--container start-->
				<div class="panel">
					<div class="table-responsive">
						<form action="update.php?q=updateProfile" method="post">
							<table class="table table-striped" style="font-size:20px;" >
								<tr align="center">
									<th colspan="2" style="font-size:32px;color:orange;text-align:center">
										USER PROFILE
									</th>
								</tr>
								<tr>
									<th>Name</th>
									<td>
										<input name="name" value="<?php echo $row['name'] ?>" class="form-control input-md" type="text" required="required">
									</td>
								</tr>
								<tr>
									<th>E-mail ID</th>
									<td>
										<input name="email" value="<?php echo $row['email'] ?>" class="form-control input-md" type="email" required="required" readonly>
										</td>
								</tr>
								<tr>
									<td><b>Contact No.</b></td>
									<td>
										<input name="contact" value="<?php echo $row['mob'] ?>" class="form-control input-md" type="number" required="required">
									</td>
								</tr>
								<tr>
									<td><b>Gender</b></td>
									<td>
										<select name="gender" class="form-control input-md" >
											<option value="Male" <?php if($row['gender'] == "Male") echo "Selected"; ?>>Male</option>
											<option value="Female" <?php if($row['gender'] == "Female") echo "Selected"; ?>>Female</option>		
										</select>
									</td>
								</tr>
								<tr>
									<td><b>College Name</b></td>
									<td>
										<input name="college" value="<?php echo $row['college'] ?>" class="form-control input-md" type="text" required="required">
									</td>
								</tr>
							</table>
							<div class="col-xs-6 text-center">
								<input type="submit" class="sub1 btn" value="Save" style="font-weight:bold;">
							</div>
							<div class="col-xs-6 text-center">
								<a href="account.php?q=1" class="sub1 btn"><b>Cancel</b></a>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		
		<!-- Footer Start -->
		<?php
			include_once("include/footer.php");
		?>
		<!-- Footer End -->
		
	</body>
</html>