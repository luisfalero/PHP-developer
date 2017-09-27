<?php
class ClearPar{
	private $valFirst = '(';
	private $valLatest = ')';
	private $length;
	
	public function build($data){
		$this->length = strlen($data);
		$return = '';
		if($this->parenthesis($data)){
			for ($i=0; $i < $this->length ; $i++) { 
				$valOne = $data[$i];
				$valTwo = (($i+1) == $this->length) ? '' : $data[$i+1];
				if($valOne == $this->valFirst && $valTwo == $this->valLatest){
					$return .= $valOne.$valTwo;
				}
			}
		}else{
			$return = 'Value is not parenthesis';
		}
		return $return;
	}
	public function parenthesis($data){
		$return = true;
		for ($i=0; $i < $this->length ; $i++) {
			$current = $data[$i]; 
			if($current != $this->valFirst && $current != $this->valLatest){
				echo '- The value "'.$current.'" of position '.$i.' is not a parenthesis <br>';
				$return = false;
			}
		}
		return $return;
	}
}

$clearPar = new ClearPar();
$return =  '()A)5)(*';
#$return =  '()())()';
#$return =  '()(()';
#$return =  ')(';
#$return =  '((()';
echo '<h3>Entrada :"'.$return.'" Salida: "'.$clearPar->build($return).'"</h3>';
?>