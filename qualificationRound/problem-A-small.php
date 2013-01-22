<?php
	
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

$n = 4;
$k = 47;

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

	echo $i . ' : ';
	for($j=0; $j<$n; $j++){
		echo $snappers[$j]->printStatus();
	}

	if($snappers[$n-1]->powerStatus == true && $snappers[$n-1]->status == true){
		echo "◉\n";
	}else{
		echo "◯\n";
	}

}
