<?php

function primeList($minValue, $maxValue){

	$numList = array_fill(1, $maxValue, true);
	
	for($i=2, $limit=sqrt($maxValue); $i<=$limit; $i++){
		for($j=$i*2; $j<=$maxValue; $j+=$i){
			$numList[$j] = false;
		}
	}
	
	$numList[1] = false;
	$primeList = array();
	
	foreach($numList as $num => $value){
		if($minValue <= $num && $value == true){
			$primeList[] = $num;
		}
	}

	return $primeList;
	
}

$fp = fopen('B-small.in', 'r');
$answer = fopen('B-answer.txt', 'w');
$counterLimit = trim(fgets($fp));
$counter = 1;

while($counterLimit >= $counter){
	
	$case = explode(' ', fgets($fp));
	$a =(int)$case[0];
	$b =(int)$case[1];
	$p =(int)$case[2];


	// $pから$b/2の範囲の素数を取得する。
	$primeNums = primeList($p, $b/2);
	
	$groupList = array();
	$independentNums = array();
	$belongedNums = array();
	
	// $a以上の$primeNumの倍数を一つの配列にして$groupListに格納する。
	foreach($primeNums as $primeNum){
		$group = array();
		for($i=$primeNum; $i<=$b; $i+=$primeNum){
			if($i>=$a){
				$group[] = $i;
			}
		}
		// 倍数の数が1個の場合は独立していると判断すれば良いから、グループとしない。
		if(count($group) >= 2){
			$groupList[] = $group;
			$belongedNums = array_merge($belongedNums, $group);
		}
	}
	
	// $belongedNumsから重複した値を削除する
	$belongedNums = array_unique($belongedNums);
	
	// $groupListにどのグループにも所属していない独立した数字を足し込む。
	for($i=$a; $i<=$b; $i++){
		if(in_array($i, $belongedNums) === false){
			$independentNums[] = $i;
		}
	}
	// ここまでで、
	// $independentNumsには独立した数の一覧、
	// $groupListにはグループに属する数のリストが格納されている。
	
	for($i=0, $limit=count($groupList); $i<$limit; $i++){
	
		if(array_key_exists($i, $groupList)){
	
			foreach($groupList[$i] as $num){
				for($j=$i+1; $j<$limit; $j++){
					if(array_key_exists($j, $groupList) && in_array($num, $groupList[$j])){
						$groupList[$i] = array_merge($groupList[$i], $groupList[$j]);
						unset($groupList[$j]);
					}
				}
			}
		}
	}

	$total = count($independentNums) + count($groupList);
	$result = "Case #{$counter}: " . $total . "\n";
	fwrite($answer, $result);
	
	$counter++;
}
