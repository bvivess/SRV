<?php
	// speed in kmph
	$speed = 121;

	if($speed < 60) {
		echo "Safe driving speed";
	} elseif($speed > 60 && $speed < 100) {
		echo "be careful, you're going fast";
	} elseif($speed > 100 && $speed < 120) {
		echo "Too fast and you are burning extra fuel";
	} else {
		// when speed is greater than 120
		echo "Its dangerous and you will be fined";
	}
?>