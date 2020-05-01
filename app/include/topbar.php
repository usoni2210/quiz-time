<link rel="stylesheet" href="css/bootstrap.min.css"/>
<link rel="stylesheet" href="css/bootstrap-theme.min.css"/>    

<script src="js/jquery.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js"  type="text/javascript"></script>
<script src="js/CountDown.js"  type="text/javascript"></script>

<link rel="stylesheet" href="css/main.css">
<link rel="stylesheet" href="css/font.css">


<div class="header">
	<div class="row">    
		<div class="col-xs-7" style="margin-top:8px">
			<a href="index.php" style="text-decoration:none;">
				<span class="logo">Quiz Time</span>
			</a>
		</div>
		<div class="col-xs-5" style="margin-top:5px">
			<?php
				if(!isset($_SESSION['email']))
					echo "	<a href='' class='pull-right btn sub1' data-toggle='modal' data-target='#userLogin'	>
								<span class='glyphicon glyphicon-log-in' aria-hidden='true'></span>&nbsp;
								<span class='title1'><b>Login</b></span>
							</a>";
				else
					echo '<span class="pull-right title1">
								<span class="log1">
									<a href="profile.php" style="text-decoration:none; color:orange;">
									    <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
										Hello, '.strtok($_SESSION['name']," ").'
									</a>
								</span>&nbsp;&nbsp;
								
								<a href="logout.php?q=index.php" class="sub1 btn">
									<span class="glyphicon glyphicon-log-out" aria-hidden="true"></span>&nbsp;
									<span class="title1"><b>Signout</b></span>
								</a>
							</span>'
			?>
		</div>
	</div>
</div>

<!-- Model for User Login-->
<div class="modal fade" id="userLogin">
	<div class="modal-dialog">
		<div class="modal-content title1">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title title">
					<span style="color:orange">Log In</span>
				</h4>
			</div>
			<div class="modal-body">
				<form class="form-horizontal" action="login.php?q=index.php" method="POST">
					<fieldset>
						<!-- Text input-->
						<div class="form-group">
							<label class="col-md-3 control-label" for="emailId"></label>
							<div class="col-md-6">
								<input type="email" id="emailId" name="emailId" placeholder="Email ID" class="form-control input-md" required="required">
							</div>
						</div>

					    <!-- Password input-->
                        <div class="form-group">
                            <label class="col-md-3 control-label" for="password"></label>
                            <div class="col-md-6">
                                <input id="pass" name="pass" placeholder="Password" class="form-control input-md" type="password" pattern="(?=.*\d)(?=.*[a-zA-Z]).{4,}" title="Must be alphnumeric and Length 4 to 10" required="required">
                            </div>
                        </div>

						<div class="modal-footer">
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							<button type="submit" class="btn btn-primary">Log in</button>
						</div>
					</fieldset>
				</form>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->