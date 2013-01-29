<?php

// Google Code Jam 2011 練習問題C
// http://code.google.com/codejam/contest/1343486/dashboard#s=p2

$fp = fopen('C-large.in', 'r');
$answer = fopen('C-result.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$case = explode(' ', fgets($fp));
	$r = (int)$case[0];
	$k = (int)$case[1];
	$n = (int)$case[2];

	$groups = explode(' ', fgets($fp));

	$profit = 0;

	$groupPos = 0;	//　何番目のグループが乗ったかを保存

	for($i=0; $i<$r; $i++){

		$rider = 0;			//　ジェットコースターに何人乗ったかを格納

		if($groupPos === $n){
			$groupPos = 0;
		}

		$startPos = $groupPos;
		$rideCounter = 1;
		while(!($rideCounter>=2 && $startPos <= $groupPos) && ($groupPos < $n) && ($rider+$groups[$groupPos] <= $k)){
			$rider += $groups[$groupPos];
			$groupPos++;

			// 最初に乗ったグループは、グループリストの途中のグループで、一番最後のグループが乗車したら
			// 1回の乗車で全グループが乗れた場合は、グループリストの先頭グループを乗車させるのではなく、発車してほしい。
			// グループリストの途中からの
			if($groupPos ==$n && $startPos != 0){
				$groupPos = 0;
				$rideCounter++;
			}
		}
		$profit += $rider;
	}

	$result =  "Case #{$loopCounter}: " . $profit."\n";
	echo $result;
	fwrite($answer, $result);

	$loopCounter++;

}
