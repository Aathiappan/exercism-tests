<?php
declare(strict_types=1);
function vlq_encode(array $input): array
{
    $input = array_map('decbin',$input);
	$result = [];
	foreach($input as $bin){
		if(strlen($bin) <= 7){
			$result[] = bindec($bin);
		}else{
            $bin32arr = splitFromRight($bin);
			while(count($bin32arr) > 1){
				$bin7 = '1' . str_pad(array_shift($bin32arr),7,'0',STR_PAD_LEFT);
				$result[] = bindec($bin7);
			}
			$result[] = bindec(str_pad(current($bin32arr),8,'0',STR_PAD_LEFT));
		}
	}
    return $result;
}
function vlq_decode(array $input):array{
    $input = array_map('decbin',$input);
    $result = [];
    $stack = '';
    foreach($input as $value){
        if(strlen($value) === 8 ){
            $stack .= substr($value,1,7);
        }else{
            $stack .= str_pad($value,7,'0',STR_PAD_RIGHT);
        }
        if(str_starts_with($value,'0') || strlen($value) === 7){
            $result[] = bindec($stack);
            $stack = '';
        }
    }
    if($result == []){
        throw new InvalidArgumentException();
    }
    if(array_any($result,function($item){
        return is_float($item);
    })){
        throw new OverflowException();
    }
    return $result;
}
function splitFromRight($string) {
    $reversed = strrev($string); 
    $chunks = str_split($reversed, 7); 
    $chunks = array_map('strrev', $chunks); 
    return array_reverse($chunks);
}