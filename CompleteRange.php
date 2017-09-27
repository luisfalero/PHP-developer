<?php
class CompleteRange{
	private $valNegative = 'The value is not positive';
    private $valNotInt = 'The value is not integer';
    
	public function build($data){
		if($this->integer($data)){
			if($this->positive($data)){
				$valOne = min($data); 
				$valTwo = max($data); 
				$return = range($valOne, $valTwo);
			}else{
				$return = $this->valNegative;
			}				
		}else{
			$return = $this->valNotInt;
		}
		return $return;
	}
	public function integer($data){
		$return = true;
		foreach ($data as $element => $data) {
			if(!is_int($data)) {
                $i = (int) $element;
                $current = json_encode($data); 
                echo '- The value "'.$current.'" of position '.$i.' is not integer <br>';
                $return = false;
            }
		}
		return $return;
	}
	public function positive($data){
		$return = true;
		foreach ($data as $element => $data) {
            if($data<0){
                $i = (int) $element;
                $current = json_encode($data); 
                echo '- The value "'.$current.'" of position '.$i.' is not positive <br>';
                $return = false;
            } 
		}
		return $return;
	}
}
$completeRange = new CompleteRange();
#$return =  [10, 2, 'A', 5, 5.6];
#$return =  [-1, 2, -5, 5, 1];
$return =  [1, 2, 4, 5];
#$return =  [2, 4, 9];
#$return = [55, 58, 60] ;
echo '<h3>Entrada :" '.json_encode($return).'" Salida: "'.json_encode($completeRange->build($return)).'"</h3>';
?>