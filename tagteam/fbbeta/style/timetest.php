<?php 
	$hourstamp = strtotime("00:00:00");	
	$hour = date("H", $hourstamp);
	$i = 0;
	$seconds = -900;
	while ($i < 96)
		{
		$seconds = $seconds + 900;
		$hourMark[$i] = $t + $seconds;
		$hourChoice[$i] = date("H:i:s", $hourMark[$i]);
		echo $hourChoice[$i] . "<br />";
		$i = $i + 1;		
		}	
?>