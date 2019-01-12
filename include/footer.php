<div class="row footer">
	<div class="col-md-3 box">
		<a href="#" data-toggle="modal" data-target="#aboutUs">About us</a>
	</div>
	<div class="col-md-3 box">
		<a href="#" data-toggle="modal" data-target="#adminLogin">Admin Login</a>
	</div>
	<div class="col-md-3 box">
		<a href="#" data-toggle="modal" data-target="#developer">Developers</a>
	</div>
	<div class="col-md-3 box">
		<a href="feedback.php">Feedback</a>
	</div>
</div>

		
<!-- Modal For Developers-->
<div class="modal fade title1" id="developer">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title" style="font-family:'typo',serif">
					<span style="color:orange">Developer</span></h4>
			</div>  
			<div class="modal-body">
				<div class="row">
					<div class="col-md-10">
						<span style="font-family:'typo',serif; font-size:18px">Umesh Soni</span><br>
						<span style="font-family:'typo',serif; font-size:18px">9782981198</span><br>
						<a href="mailto:usoni2210@gmail.com" style="font-family:'typo',serif; font-size:18px; color:#202020;">
							usoni2210@gmail.com
						</a><br>
						<a href="http://www.maism.org/" style="font-family:'typo',serif; font-size:18px; color:#202020;">
							Maharishi Arvind College
						</a>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<!--Modal for admin login-->
<div class="modal fade" id="adminLogin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title">
					<span style="color:orange;font-family:'typo',serif ">Admin Login</span>
				</h4>
			</div>
			<div class="modal-body title1">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6">
						<form role="form" method="post" action="admin.php?q=index.php">
							<div class="form-group">
								<input type="text" name="uname" maxlength="20" placeholder="Admin ID" class="form-control"/> 
							</div>
							<div class="form-group">
								<input type="password" name="password" maxlength="15" placeholder="Password" class="form-control"/>
							</div>
							<div class="form-group" align="center">
								<input type="submit" name="login" value="Login" class="btn btn-primary" />
							</div>
						</form>
					</div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<!-- Modal For About us-->
<div class="modal fade title1" id="aboutUs">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">
					<span aria-hidden="true">&times;</span>
					<span class="sr-only">Close</span>
				</button>
				<h4 class="modal-title title">
					<span style="color:orange">About us</span>
				</h4>
			</div>  
			<div class="modal-body">
				<div class="row">
					<div class="col-md-10">
						<span style="font-family:'typo',serif; font-size:18px">
							<p>Write the text for about us</p>
						</span>
					</div>
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->