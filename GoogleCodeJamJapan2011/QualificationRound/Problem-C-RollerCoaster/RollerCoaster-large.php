<?php

// Google Code Jam 2011 練習問題C
// http://code.google.com/codejam/contest/1343486/dashboard#s=p2

$fp = fopen('case-large.in', 'r');
$answer = fopen('answer-large.txt', 'w');
$loopLimit = trim(fgets($fp));
$loopCounter = 1;

while($loopLimit >= $loopCounter){

	$case = explode(' ', fgets($fp));
	$r = (int)$case[0];	// 1日のコースターの発車回数
	$k = (int)$case[1];	// コースターの定員数
	$n = (int)$case[2];	// グループの数

	$groupNums = explode(' ', fgets($fp));
	$groups = array();

	// それぞれのグループについて、
	// ・そのグループは何人か
	// ・そのグループが先頭で乗った場合、コースターに何人乗り込めるか
	// ・そのグループが先頭で乗った場合、次はどのグループが先頭になるか
	// を格納する。
	
	foreach($groupNums as $i => $groupNum){

		$group = array();
		$group[] = (int)$groupNum;

		$rodeGroupNum = 0;	// コースターに乗ったグループの数
		$riderNum = 0;			// コースターに乗った人の数
		$groupPos = $i;			// 次に乗るグループの番号

		while($rodeGroupNum < $n && $riderNum + $groupNums[$groupPos] <= $k){
			$riderNum += $groupNums[$groupPos];
			$groupPos++;
			$rodeGroupNum++;
			if($groupPos >= $n){
				$groupPos = 0;
			}
		}

		$group[] = $riderNum;
		$group[] = $groupPos;

		$groups[] = $group;
	}

	// ジェットコースターをr回発車させて金額を計算する。

	$groupPos = 0;
	$profit = 0;

	for($i=0; $i<$r; $i++){
		$profit += $groups[$groupPos][1];
		$groupPos = $groups[$groupPos][2];
	}

	$result = 'Case #' . $loopCounter . ': ' .  $profit . "\n";
	echo $result;
	fwrite($answer, $result);

	$loopCounter++;

}
