<?php

$fp = fopen('C-small.in', 'r');
$answer = fopen('C-answer.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$n = trim(fgets($fp));

	$pow = 0;
	while(pow(2, $pow+1)-1 <= $n){
		$pow++;
	}

	$result =  $pow +  substr_count(decbin($n-(pow(2, $pow)-1)), '1');

	echo "Case #" . $loopCounter . ": " . $result . "\n";

	$loopCounter++;
}
