<?php

// Google Code Jam Japan 2011 予選問題A
// http://code.google.com/codejam/contest/889487/dashboard#s=p0

$fp = fopen('case-large.in', 'r');
$answer = fopen('answer-large.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$case = explode(' ', fgets($fp));
	$m = (int)$case[0];
	$c = (int)$case[1];
	$w = (int)$case[2];

	$cuts = array();

	for($i=0; $i<$c; $i++){
		$cuts[] = explode(' ', fgets($fp));
	}
	$cuts = array_reverse($cuts);

	foreach($cuts as $cut){
		if($cut[1] >= $w){
			$w = $cut[0] + $w - 1;
		}else{
			if($cut[0] + $cut[1] - 1 >= $w){
				$w = $w - $cut[1];
			}
		}
	}

	$result = "Case #" . $loopCounter . ": " . $w . "\n";
	echo $result;
	fwrite($answer, $result);
	
	$loopCounter++;
}
