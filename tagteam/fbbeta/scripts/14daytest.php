<?php
	include ("connect.php");
	$t = time();
	$i = 0;
	$seconds = 0;
	while ($i < 15)
		{
		$seconds = $seconds + 86400;
		$fourteenDate[$i] = $t + $seconds;
		$fourteenDays[$i] = date("F jS, Y", $fourteenDate[$i]);
		$fourteenValue[$i] = date("Y-m-d", $fourteenDate[$i]);
		echo $fourteenDays[$i] . " | " . $fourteenValue[$i] . "<br />";
		$i = $i + 1;		
		}	
?>