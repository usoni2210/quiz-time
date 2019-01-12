<span id="countdown" class="timer"></span>
<script>
	var seconds = 70;
	
	function secondPassed() {
		var minutes = Math.round(seconds/60);
		var remainingSeconds = seconds % 60;
		if (remainingSeconds < 10) {
			remainingSeconds = "0" + remainingSeconds; 
		}
		document.getElementById('countdown').innerHTML = minutes + ":" + remainingSeconds;
		if (seconds == 0) {
			clearInterval(countdownTimer);
			document.getElementById('countdown').innerHTML = "Time Out";
		} else {    
			seconds--;
		}
	}
	
	var countdownTimer = setInterval('secondPassed()', 1000);
</script>