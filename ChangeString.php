<?php
class ChangeString{
    private $alphabet = array('a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'ñ', 'o', 'p', 'q', 'r',
    's', 't', 'u', 'v', 'w', 'x', 'y', 'z');

    public function build($data){		
        $length = strlen($data);
        $count = count($this->alphabet);
        $return = '';
        for ($i=0; $i <$length ; $i++) { 
            $lower = strtolower($data[$i]);
            $current = $data[$i];			
            $search = in_array($lower, $this->alphabet);
            if($search){
                $position = array_search($lower, $this->alphabet);
                $positionNext = $position+1; 
                $value = ($positionNext == $count) ? $this->alphabet[0] : $this->alphabet[$positionNext];
                $value = (ctype_upper($current)) ? strtoupper($value) : $value;
                $return .= $value;
            }else{
                $return .= $data[$i];
            }
        }
        return $return;
    }
}

$changeString = new ChangeString();
$return = '123 abcd*3';
#$return = '**Casa 52';
#$return = '**Casa 52Z';
echo '<h3>Entrada :"'.$return.'" Salida: "'.$changeString->build($return).'"</h3>';
?>