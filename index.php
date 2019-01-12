
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Quiz Time </title>
		
		<?php 
			session_start();
			if(isset($_SESSION['email']) && isset($_SESSION['key']))
				header("location:dashboard.php?q=0");
			else if(isset($_SESSION['email']))
				header("location:account.php?q=1");
			if(@$_GET['w'])
				echo'<script>alert("'.@$_GET['w'].'");</script>';
		?>	
	</head>
	<body>
		<?php include_once "include/topbar.php"; ?>
		
		<div class="bg1">
			<div class="row" >
				<div class="col-md-7"></div>
				<div class="col-md-4 panel">
					<!-- sign in form begins -->  
					<form class="form-horizontal" name="form" action="Register.php?q=index.php" method="POST" onSubmit="checkPassword();">
						<fieldset>

                            <!-- Name-->
							<div class="form-group">
								<label class="col-md-12 control-label" for="name"></label>  
								<div class="col-md-12">
									<input name="name" placeholder="Name" class="form-control input-md" type="text" required="required">
								</div>
							</div>

                            <!-- Email ID -->
							<div class="form-group">
								  <label class="col-md-12 control-label title1" for="email"></label>
								<div class="col-md-12">
									<input type="email" name="email" placeholder="Email ID" class="form-control input-md" required="required">
								</div>
							</div>
									
							<!-- Password Input -->
                            <div class="form-group" >
                                <label class="col-md-12 control-label" for="password"></label>
                                <div class="col-md-12">
                                    <input name="password" placeholder="Type Password" class="form-control input-md" type="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{4,}" title="Must be alphanumeric and Length is more then 4" required="required" >
								</div>
							</div>
				
	                        <!-- Contact Number -->
							<div class="form-group">
								<label class="col-md-12 control-label" for="mob"></label>  
								<div class="col-md-12">
									<input type="number" name="contact" placeholder="Contact Number" class="form-control input-md" required="required">
								</div>
							</div>
							
                            <!-- Gender -->
							<div class="form-group">
								<label class="col-md-12 control-label" for="gender"></label>
								<div class="col-md-12">
									<select name="gender" class="form-control input-md" >
										<option value="Male" selected> --- Select One --- </option>
										<option value="Male">Male</option>
										<option value="Female">Female</option>
									</select>
								</div>
							</div>

							<!-- College Name -->
							<div class="form-group">
								<label class="col-md-12 control-label" for="name"></label>  
								<div class="col-md-12">
									<input name="college" placeholder="College Name" class="form-control input-md" type="text" required="required">
								</div>
							</div>
									
							<!-- Register Button -->
                            <div class="form-group">
                                <label class="col-md-12 control-label" for=""></label>
								<div class="col-md-3"></div>
                                <div class="col-md-6">
                                    <input  type="submit" class="sub" value="Register" class="btn"/>
                                </div>
                            </div>
						</fieldset>
					</form>
				</div>
			</div>
		</div><!--container end-->
		
		<?php include_once("include/footer.php"); ?>
	</body>
</html>
