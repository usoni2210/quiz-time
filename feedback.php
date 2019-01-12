<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Quiz Time || FEEDBACK </title>
	
		
	<?php 
		if(@$_GET['w']){
			echo'<script>alert("'.@$_GET['w'].'");</script>';
		}
	?>
	
	</head>

	<body>
		<?php
			session_start();
			include_once "include/topbar.php";
			
		?>
		
		<div class="bg1">
			<div class="row">
				<div class="col-md-3"></div>
				<div class="col-md-6 panel" style="background-image:url(image/feedback-bg.jpg);">
					<h2 align="center" style="font-family:'typo',serif; color:#000066">FEEDBACK/REPORT A PROBLEM</h2>
					<div style="font-size:15px">
						<?php 
							if(@$_GET['q'])
								echo '<span style="font-size:18px;">
										<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>&nbsp;'
										.@$_GET['q'].
									'</span>';
							else {
								echo 'You can send us your feedback through e-mail on the following e-mail id :
										<a href="mailto:usoni2210@gmail.com" style="color:#000000">Umesh Soni</a>
										<br><br>
											
										<p>Or you can directly submit your feedback by filling the enteries below:-</p><br>
							
										<form role="form"  method="post" action="feed.php?q=feedback.php">
											<div style="font-size:18px;">
												<div class="row">
													<!-- Name -->
													<div class="col-md-3">
														<b>Name :</b>
													</div>
													<div class="col-md-9">
														<div class="form-group">
															<input id="name" name="name" placeholder="Your Name" class="form-control input-md" type="text">
														</div>
													</div>
												</div><!--End of row-->
												
												<div class="row">
													<!-- Subject -->
													<div class="col-md-3">
														<b>Subject :</b>
													</div>
													<div class="col-md-9">
														<div class="form-group">
															<input id="subject" name="subject" placeholder="Purpose/Subject" class="form-control input-md" type="text">
														</div>
													</div>
												</div><!--End of row-->
												
												<div class="row">
													<div class="col-md-3">
														<b>E-Mail address:</b>
													</div>
													<div class="col-md-9">
														<div class="form-group">
															<input id="email" name="email" placeholder="Enter your email-id" class="form-control input-md" type="email">    
														</div>
													</div>
												</div><!--End of row-->
												
												<div class="row">
													<div class="col-md-3">
														<b>Message</b>
													</div>
													<div class="col-md-9">
														<div class="form-group"> 
															<textarea rows="5" cols="8" name="message" class="form-control" placeholder="Write feedback here..."></textarea>
														</div>
													</div>
												</div>
												<div class="form-group" align="center">
													<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
												</div>
											</div>
										</form>';
							}
						?>
					</div>
				</div><!--col-md-6 end-->
				<div class="col-md-3"></div>
			</div>
		</div>

		<?php
			include_once("include/footer.php");
		?>
	</body>
</html>
