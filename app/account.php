<?php
    session_start();
    if(!(isset($_SESSION['email']))) {
      header("location:index.php");
    } else if(isset($_SESSION['key'])) {
      header("location:dashboard.php?q=0");
    }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
	
		<title>Quiz Time</title>
	
        <!--alert message-->
		<?php
			if(@$_GET['w']) {
				echo'<script>alert("'.@$_GET['w'].'");</script>';
			}
		?>
		<!--alert message end-->
    </head>
	<body>
		<?php
            require 'include/connection.php';
            $uid = @$_SESSION['userId'];
            $name = $_SESSION['name'];
            $email = $_SESSION['email'];
            include_once "include/topbar.php";
		?>
		<div class="bg">
			<!--navigation menu-->
			<nav class="navbar navbar-default title1">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="#"><b></b></a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="navbar-collapse-1">
                        <ul class="nav navbar-nav">
                            <li <?php if(@$_GET['q']==1) echo'class="active"'; ?>><a href="account.php?q=1"><span class="glyphicon glyphicon-home" aria-hidden="true"></span>&nbsp;Home<span class="sr-only">(current)</span></a></li>
                            <li <?php if(@$_GET['q']==2) echo'class="active"'; ?>><a href="account.php?q=2"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span>&nbsp;History</a></li>
                            <li <?php if(@$_GET['q']==3) echo'class="active"'; ?>><a href="account.php?q=3"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span>&nbsp;Ranking</a></li>
                        </ul>
                        <form class="navbar-form navbar-left" method="get">
                            <div class="form-group">
								<input type="hidden" name="q" value="1"/>
                                <input name="tag" type="text" class="form-control" placeholder="Searching Tag..." required="required">
                            </div>
                            <button type="submit" class="btn btn-default">
                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;Search
                            </button>
                        </form>
                    </div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav><!--navigation menu closed-->

			<div class="container"><!--container start-->
				<div class="row">
					<div class="col-md-12">
						<!--home start-->
						<?php 
							if(@$_GET['q']==1) {
								require_once 'include/Time.php';
								
								if(isset($_GET['tag']) && !empty(trim($_GET['tag']))){
									$arr = explode(' ', $_GET['tag']);
									$query = "SELECT * FROM quiz ";
									for($i=0; $i<count($arr); $i++){
										if($i==0)
											$query .= " WHERE tag LIKE '%".$arr[$i]."%' ";
										else
											$query .= " OR tag LIKE '%".$arr[$i]."%' ";
									}
									$query .= "ORDER BY date DESC";
								} else{ 
									$query = "SELECT * FROM quiz ORDER BY date DESC";
								}
								
								$result = mysqli_query($con, $query) or die('Error Tag');
								echo  '
									<div class="panel">
										<div class="table-responsive">
											<table class="table table-striped title1">
												<tr align="center">
													<td><b>S.N.</b></td>
													<td><b>Topic</b></td>
													<td><b>Total question</b></td>
													<td><b>Marks</b></td>
													<td><b>Time limit</b></td>
													<td></td>
												</tr>';
												$c=1;
												while($row = mysqli_fetch_array($result)) {
													$title = $row['title'];
													$total = $row['total'];
													$desc = $row['intro'];
													$correct = $row['correct'];
													$time = $row['time'];
													$t = getNormalTime($row['time']);
													$eid = $row['id'];
													
													$q12=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND user_id='$uid'" )or die('Error98');
													$rowcount=mysqli_num_rows($q12);	
													if($rowcount == 0) {
														echo '
															<tr align="center">
																<td>'.$c++.'</td>
																<td title="'.$desc.'">'.$title.'</td>
																<td>'.$total.'</td>
																<td>'.$correct*$total.'</td>
																<td>'.$t.'&nbsp;min</td>
																<td>
																	<b><a href="account.php?q=quiz&step=2&eid='.$eid.'&n=1&t='.$total.'&m='.$time.'" class="pull-right btn sub1" style="margin:0px;background:#99cc32">
																		<span class="glyphicon glyphicon-new-window" aria-hidden="true"></span>&nbsp;
																		<span class="title1"><b>Start</b></span>
																	</a></b>
																</td>
															</tr>';
													} else 	{
														echo '
															<tr style="color:#99cc32" align="center">
																<td>'.$c++.'</td>
																<td title="'.$desc.'">
																	'.$title.'&nbsp;
																	<span title="This quiz is already solve by you" class="glyphicon glyphicon-ok" aria-hidden="true"></span>
																</td>
																<td>'.$total.'</td>
																<td>'.$correct*$total.'</td>
																<td>'.$t.'&nbsp;min</td>
																<td>
																	<b><a href="update.php?q=quizre&step=25&eid='.$eid.'&n=1&t='.$total.'&m='.$time.'" class="pull-right btn sub1" style="margin:0px;background:red">
																		<span class="glyphicon glyphicon-repeat" aria-hidden="true"></span>&nbsp;<span class="title1"><b>Restart</b></span>
																	</a></b>
																</td>
															</tr>';
													}
												}
												$c=0;
												echo '
											</table>
										</div>
									</div>';
							}
						?><!--home closed-->
						
						<!-- Quiz Start : Show Questions -->
						<?php
							if(@$_GET['q']== 'quiz' && @$_GET['step']== 2) {
								$eid=@$_GET['eid'];
								$sn=@$_GET['n'];
								$total=@$_GET['t'];
								$m = @$_GET['m'];
								
								$qry = mysqli_query($con,"Select * from quiz where id='$eid'");
								$res = mysqli_fetch_assoc($qry);
								$tm = $res['time'];
								$title = $res['title'];
													
								$q=mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' AND sn='$sn'" );
								echo '<div class="panel" style="margin:5%">';
								echo '
										<div class="well well-sm">
											<div class="row">
												<div class="col-xs-10 text-center"><b>'.$title.'</b></div>
												<div id="timer" class="col-xs-2 text-center">'.$m.'</div>
											</div>
										</div>';
								while($row=mysqli_fetch_array($q) )
								{
									$qns=$row['qns'];
									$qid=$row['qid'];
									echo '<b>Q '.$sn.' : '.$qns.'</b><br>';
								}
								$q=mysqli_query($con,"SELECT * FROM options WHERE qid='$qid' " );
								echo '<form action="update.php?q=quiz&step=2&eid='.$eid.'&n='.$sn.'&t='.$total.'&qid='.$qid.'" method="POST"  class="form-horizontal">
								<br />';

								while($row=mysqli_fetch_array($q) )
								{
									$option=$row['option'];
									$optionid=$row['optionid'];
									echo'<input type="radio" name="ans" value="'.$optionid.'">'.$option.'<br /><br />';
								}
								echo'<br />
									<input type="hidden" name="m" id="time" />
									<button type="submit" class="btn btn-primary">
										<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
										&nbsp;Submit
									</button></form></div>';
							}
						?><!-- Show Question End -->
						
						<!--Quiz End : Result Display-->
						<?php
							if(@$_GET['q']== 'result' && @$_GET['eid']) {
								$eid=@$_GET['eid'];
								$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND user_id='$uid' " )or die('Error157');
								
								echo  '<div class="panel">
											<center>
												<h1 class="title" style="color:#660033">Result</h1>
											<center><br />
											<table class="table table-striped title1" style="font-size:20px;font-weight:900;">';

								while($row=mysqli_fetch_array($q) ){
									$s=$row['score'];
									$w=$row['wrong'];
									$r=$row['correct'];
									$qa=$row['level'];
									
									echo '
										<tr style="color:#66CCFF">
											<td>Total Questions</td>
											<td>'.$qa.'</td>
										</tr>
										<tr style="color:#99cc32">
											<td>
												right Answer&nbsp;
												<span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span>
											</td>
											<td>'.$r.'</td>
										</tr> 
										<tr style="color:red">
											<td>
												Wrong Answer&nbsp;
												<span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
											</td>
											<td>'.$w.'</td>
										</tr>
										<tr style="color:#66CCFF">
											<td>
												Score&nbsp;
												<span class="glyphicon glyphicon-star" aria-hidden="true"></span>
											</td>
											<td>'.$s.'</td>
										</tr>';
								}
								
								$q=mysqli_query($con,"SELECT * FROM rank WHERE user_id='$uid' " )or die('Error157');
								while($row=mysqli_fetch_array($q)) {
									$s=$row['score'];
									echo '
										<tr style="color:#990000">
											<td>
												Overall Score&nbsp;
												<span class="glyphicon glyphicon-stats" aria-hidden="true"></span>
											</td>
											<td>'.$s.'</td>
										</tr>';
								}
								echo '</table></div>';

							}
						?><!--Quiz Result Display End-->
						
						<!-- History Start -->
						<?php
							if(@$_GET['q']== 2) 
							{
								$q=mysqli_query($con,"SELECT * FROM history WHERE user_id='$uid' ORDER BY date DESC") or die('Error197');
								echo  '<div class="panel title">
										<div class="table-responsive">
											<table class="table table-striped title1" >
												<tr style="color:red" align="center">
													<td><b>S.N.</b></td>
													<td><b>Quiz</b></td>
													<td><b>Question Solved</b></td>
													<td><b>Right</b></td>
													<td><b>Wrong<b></td>
													<td><b>Score</b></td>
												</tr>';
									$c=0;
									while($row=mysqli_fetch_array($q) )
									{
										$eid = $row['eid'];
										$s = $row['score'];
										$w = $row['wrong'];
										$r = $row['correct'];
										$qa = $row['level'];
										
										$q2=mysqli_query($con,"SELECT title FROM quiz WHERE id='$eid' " )or die('Error208');
										while($row=mysqli_fetch_array($q2) ){
											$title=$row['title'];
										}
										
										echo '<tr align="center">
													<td>'.++$c.'</td>
													<td>'.$title.'</td>
													<td>'.$qa.'</td>
													<td>'.$r.'</td>
													<td>'.$w.'</td>
													<td>'.$s.'</td>
												</tr>';
									}
									echo'	</table>
										</div>
									</div>';
							}
						?>

						<!-- Ranking Start -->
						<?php
							if(@$_GET['q'] == 3) {
								$q=mysqli_query($con,"SELECT * FROM rank ORDER BY score DESC ") or die('Error223');
								echo  '<div class="panel title">
										<div class="table-responsive">
											<table class="table table-striped title1" >
												<tr style="color:red" align="center">
													<td><b>Rank</b></td>
													<td><b>Name</b></td>
													<td><b>Gender</b></td>
													<td><b>College</b></td>
													<td><b>Score</b></td>
												</tr>';
										$c=0;
										while($row=mysqli_fetch_array($q)){
											$id=$row['user_id'];
											$s=$row['score'];
											
											$q1=mysqli_query($con,"SELECT * FROM user WHERE id='$id'") or die('Error231');
											
											while($row=mysqli_fetch_array($q1)) {
												$name = $row['name'];
												$gender = $row['gender'];
												$college = $row['college'];
											}
										$c++;
										echo '<tr align="center">
												<td><b>'.$c.'</b></td>
												<td>'.$name.'</td>
												<td>'.$gender.'</td>
												<td>'.$college.'</td>
												<td>'.$s.'</td>
											</td>';
											if($c==10)
												break;
										}
										echo '</table></div></div>';
							}
						?>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer Start -->
		<?php
			include_once("include/footer.php");
		?>
		<!-- Footer End -->
		
		<!-- Count Down -->
		<script type="text/javascript" language="JavaScript">
            let sec = parseInt(document.getElementById("timer").innerHTML);

            function setTimer() {
				var minutes = Math.floor(sec/60);
				var seconds = sec%60;
				
				if(seconds <= 9){
					seconds = "0" + seconds;
				}
				document.getElementById("timer").innerHTML = minutes + ":" + seconds;
				
				if (sec === 0) {
					clearInterval(x);
					document.getElementById("timer").innerHTML = "Time Out";
				}else{
					sec--;
				}
				document.getElementById("time").value = sec;
			}
			setTimer();
            let x = setInterval("setTimer()", 1000);
        </script>
	</body>
</html>
