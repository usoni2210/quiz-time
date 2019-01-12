<?php
	function displayNormalTime($s){
		printf("%2d:%02d",$s/60,$s%60);
	}
	function getNormalTime($s){
		return sprintf("%2d:%02d",$s/60,$s%60);
	}
?>