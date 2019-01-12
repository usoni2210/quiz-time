<?php
	include_once 'include/connection.php';
	session_start();
	$userId=$_SESSION['userId'];

	// Delete a Feedback
	if(isset($_SESSION['key']))
	{
		if(@$_GET['fdid'] && $_SESSION['key']=="admin")
		{
			$id=@$_GET['fdid'];
			mysqli_query($con,"DELETE FROM feedback WHERE id='$id' ") or die('Error');
			header("location:dashboard.php?q=3");
		}
	}

	// Delete a User
	if(isset($_SESSION['key']))
	{
		if(@$_GET['demail'] && $_SESSION['key']=='admin')
		{
			$demail=@$_GET['demail'];
			mysqli_query($con,"DELETE FROM rank WHERE user_id='$demail' ") or die('Error');
			mysqli_query($con,"DELETE FROM history WHERE user_id='$demail' ") or die('Error');
			mysqli_query($con,"DELETE FROM user WHERE id='$demail' ") or die('Error');
			header("location:dashboard.php?q=1");
		}
	}

	// Add Quiz
	if(isset($_SESSION['key']))
	{
		if(@$_GET['q']== 'addquiz' && $_SESSION['key']=='admin')
		{
			$name = $_POST['name'];
			$name= ucwords(strtolower($name));
			
			$total = $_POST['total'];
			$correct = $_POST['right'];
			$wrong = $_POST['wrong'];
			$time = $_POST['time'];
			$tag = $_POST['tag'];
			$desc = $_POST['desc'];
			
			$q3=mysqli_query($con,"INSERT INTO `quiz` (`id`, `title`, `correct`, `wrong`, `total`, `time`, `intro`, `tag`, `date`) VALUES (NULL, '$name', '$correct', '$wrong', '$total', '$time', '$tag', '$desc', now())");
			$id = mysqli_insert_id($con);
			
			header("location:dashboard.php?q=4&step=2&eid=$id&n=$total");
		}
	}

	// Add Question
	if(isset($_SESSION['key'])){
		if(@$_GET['q']== 'addqns' && $_SESSION['key']=='admin') {
			$n=@$_GET['n'];
			$eid=@$_GET['eid'];
			$ch=@$_GET['ch'];

			for($i=1;$i<=$n;$i++)
			{
				$qns=$_POST['qns'.$i];
				$q3=mysqli_query($con,"INSERT INTO `questions` (`qid`, `qns`, `choice`, `sn`, `eid`) VALUES (NULL, '$qns', '$ch', '$i', '$eid')");
				$qid = mysqli_insert_id($con);
								
				$a = $_POST[$i.'1'];
				$b = $_POST[$i.'2'];
				$c = $_POST[$i.'3'];
				$d = $_POST[$i.'4'];
				
				$qa = mysqli_query($con,"INSERT INTO `options` (`optionid`, `option`, `qid`) VALUES (NULL, '$a', '$qid')") or die('Error 61');
				$oaid = mysqli_insert_id($con);
				
				$qb = mysqli_query($con,"INSERT INTO `options` (`optionid`, `option`, `qid`) VALUES (NULL, '$b', '$qid')") or die('Error 62');
				$obid = mysqli_insert_id($con);
				
				$qc = mysqli_query($con,"INSERT INTO `options` (`optionid`, `option`, `qid`) VALUES (NULL, '$c', '$qid')") or die('Error 63');
				$ocid = mysqli_insert_id($con);
				
				$qd = mysqli_query($con,"INSERT INTO `options` (`optionid`, `option`, `qid`) VALUES (NULL, '$d', '$qid')") or die('Error 64');
				$odid = mysqli_insert_id($con);
				
				$ans = $_POST['ans'.$i];
				
				switch($ans)
					{
						case 'a':
						$ansid=$oaid;
						break;
						case 'b':
						$ansid=$obid;
						break;
						case 'c':
						$ansid=$ocid;
						break;
						case 'd':
						$ansid=$odid;
						break;
						default:
						$ansid=$oaid;
					}


				$qans=mysqli_query($con,"INSERT INTO answer VALUES  ('$qid','$ansid')");

			}
			header("location:dashboard.php?q=0");
		}
	}

	// Delete a Quiz
	if(isset($_SESSION['key']))
	{
		if(@$_GET['q']== 'rmquiz' && $_SESSION['key']=='admin')
		{
			$eid=@$_GET['eid'];
			$result = mysqli_query($con,"SELECT * FROM questions WHERE eid='$eid' ") or die('Error');
			while($row = mysqli_fetch_array($result)) {
				$qid = $row['qid'];
				mysqli_query($con,"DELETE FROM options WHERE qid='$qid'") or die('Error');
				mysqli_query($con,"DELETE FROM answer WHERE qid='$qid' ") or die('Error');
			}
			mysqli_query($con,"DELETE FROM questions WHERE eid='$eid' ") or die('Error');
			mysqli_query($con,"DELETE FROM quiz WHERE id='$eid' ") or die('Error');
			mysqli_query($con,"DELETE FROM history WHERE eid='$eid' ") or die('Error');

			header("location:dashboard.php?q=5");
		}
	}

	// Quiz Start
	if(@$_GET['q']=='quiz' && @$_GET['step']== 2) {
		$eid = @$_GET['eid'];
		$sn = @$_GET['n'];
		$total = @$_GET['t'];
		$ans = $_POST['ans'];
		$qid = @$_GET['qid'];
		$m = @$_REQUEST['m'];
			
		$q=mysqli_query($con,"SELECT * FROM answer WHERE qid='$qid'" );
		while($row=mysqli_fetch_array($q)){
			$ansid=$row['ansid'];
		}
		if($ans == $ansid)
		{
			$q = mysqli_query($con,"SELECT * FROM quiz WHERE id='$eid' ");
			while($row = mysqli_fetch_array($q)) {
				$correct=$row['correct'];
			}
			
			if($sn == 1){
				mysqli_query($con,"INSERT INTO `history` (`user_id`, `eid`, `score`, `level`, `correct`, `wrong`, `date`) VALUES ('$userId', '$eid', '0', '0', '0', '0', CURRENT_TIMESTAMP)") or die("Error $userId ");
			}
			
			$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND user_id='$userId' ")or die('Error115');
			while($row=mysqli_fetch_array($q) ){
				$s=$row['score'];
				$r=$row['correct'];
			}
			
			$r++;
			$s=$s+$correct;
			$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`correct`=$r, date= NOW()  WHERE  user_id = '$userId' AND eid = '$eid'")or die('Error124');
		} else {
			$q=mysqli_query($con,"SELECT * FROM quiz WHERE id='$eid' " )or die('Error129');

			while($row=mysqli_fetch_array($q)) {
				$wrong=$row['wrong'];
			}
			
			if($sn == 1){
				$q=mysqli_query($con,"INSERT INTO history VALUES('$userId','$eid' ,'0','0','0','0',NOW() )")or die('Error137');
			}
			$q=mysqli_query($con,"SELECT * FROM history WHERE eid='$eid' AND user_id='$userId' " )or die('Error139');
			while($row=mysqli_fetch_array($q) ){
				$s=$row['score'];
				$w=$row['wrong'];
			}
			
			$w++;
			$s=$s-$wrong;
			$q=mysqli_query($con,"UPDATE `history` SET `score`=$s,`level`=$sn,`wrong`=$w, date=NOW() WHERE  user_id = '$userId' AND eid = '$eid'") or die('Error147');
		}
		
		if($sn!=$total && $m>0){
			$sn++;
			header("location:account.php?q=quiz&step=2&eid=$eid&n=$sn&t=$total&m=$m")or die('Error152');
		} else {
			$q=mysqli_query($con,"SELECT * FROM rank WHERE user_id='$userId'" )or die('Error161');
			if(mysqli_num_rows($q) > 0){
				while($row=mysqli_fetch_array($q) ) {
					$sum = $row['score'];
				}
				$sum += $s;
				mysqli_query($con,"UPDATE `rank` SET `score`=$sum ,`time`=CURRENT_TIMESTAMP WHERE user_id= '$userId'")or die('Error174');
			} else {
				mysqli_query($con, "INSERT INTO `rank` (`user_id`, `score`, `time`) VALUES ('$userId', '$s', CURRENT_TIMESTAMP)");
			}
			
			if($m==0)
				header("location:account.php?q=result&eid=$eid&w=Time Out");
			else
				header("location:account.php?q=result&eid=$eid");
		}
	}

	// Restart Quiz
	if(@$_GET['q']=='quizre' && @$_GET['step']==25 )
	{
		$eid = @$_GET['eid'];
		$n = @$_GET['n'];
		$t = @$_GET['t'];
		$m = @$_GET['m'];
		
		$q=mysqli_query($con,"SELECT score FROM history WHERE eid='$eid' AND user_id='$userId'" )or die('Error156');
		while($row=mysqli_fetch_array($q) ){
			$s=$row['score'];
		}
	
		$q=mysqli_query($con,"DELETE FROM `history` WHERE eid='$eid' AND user_id='$userId' " )or die('Error184');
		
		$q=mysqli_query($con,"SELECT * FROM rank WHERE user_id='$userId'" )or die('Error161');
		while($row=mysqli_fetch_array($q) ){
			$sum = $row['score'];
		}
		
		$sum=$sum-$s;
		$q=mysqli_query($con,"UPDATE `rank` SET `score`=$sum ,time=NOW() WHERE user_id= '$userId'")or die('Error174');
		
		header("location:account.php?q=quiz&step=2&eid=$eid&n=1&t=$t&m=$m");
	}
	
	// Update User Profile
	if($_GET['q']=="updateProfile"){
		if(isset($_REQUEST['name']) &&
			isset($_REQUEST['contact']) &&
			isset($_REQUEST['gender']) &&
			isset($_REQUEST['college']))
			{
				echo $name = $_REQUEST['name'];
				echo $num = $_REQUEST['contact'];
				echo $gen = $_REQUEST['gender'];
				echo 	$clg = $_REQUEST['college'];
				
				mysqli_query($con,"UPDATE `user` SET `name` = '$name',  `mob` = '$num', `gender` = '$gen', `college` = '$clg' WHERE `user`.`id` = '$userId'");
				if(mysqli_affected_rows($con) > 0){
					header("location:account.php?q=1&w=Profile Update Successfully");
				}else{
					header("location:account.php?q=1&w=".mysqli_error($con)."");
				}
			}
		//header("location:account.php?q=1&w=Thank you");
	}

?>



