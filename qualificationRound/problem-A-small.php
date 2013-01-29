<?php

// Google Code Jam 2011 練習問題A
// http://code.google.com/codejam/contest/1343486/dashboard#s=p0
	
class Snapper{

	public $powerStatus = false;
	public $status = false;

	public function toggleStatus(){
		if($this->status == true){
				$this->status = false;
			}else{
				$this->status = true;
			}
	}

	public function printStatus(){
		$result = '[';

		if($this->powerStatus == true){
			$result .= '1';
		}else{
			$result .= '0';
		}

		if($this->status == true){
			$result .= '○';
		}else{
			$result .= '×';
		}

		return $result . ']-';
	}

}
echo "start\n";
$fp = fopen('A-large.in', 'r');
$answer = fopen('A-result.txt', 'w');
$limit = trim(fgets($fp));
$counter = 1;
while($limit >= $counter){
	$case = explode(' ', fgets($fp));
	
	$n = (int)$case[0];
	$k = (int)$case[1];
	
	$snappers = array();
	
	for($i=0; $i<$n; $i++){
		$snappers[] = new Snapper;
	}
	
	$snappers[0]->powerStatus = true;
	
	for($i=1; $i<=$k; $i++){
	
		for($j=0; $j<$n; $j++){
			if($snappers[$j]->powerStatus == true){
				$snappers[$j]->toggleStatus();
			}
		}
	
		for($j=1; $j<$n; $j++){
			if($snappers[$j-1]->powerStatus == true && $snappers[$j-1]->status == true){
				$snappers[$j]->powerStatus = true;
			}else{
				$snappers[$j]->powerStatus = false;
			}
		}

/*
		echo $i . ' : ';
		for($j=0; $j<$n; $j++){
			echo $snappers[$j]->printStatus();
		}
*/	

	}

	$result = "Case #{$counter}: ";
	$result .= ($snappers[$n-1]->powerStatus == true && $snappers[$n-1]->status == true) ? "ON\n" : "OFF\n";
	echo $result;
	fwrite($answer, $result);

	$counter++;

}
fclose($fp);
fclose($answer);
