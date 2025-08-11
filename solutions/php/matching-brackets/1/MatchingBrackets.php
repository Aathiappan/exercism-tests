<?php
declare(strict_types=1);

function brackets_match(string $input): bool
{
   if(empty($input)){
		return true;
	}
	if(isClosingBracket($input[0])){
		return false;
	}
	$brackets = [];
	$current = 0;
	foreach(str_split($input) as $item){
		if(isBracket($item)){
			if(isClosingBracket($item)){
				if(end($brackets) === openBracket($item)){
					reset($brackets);
					array_pop($brackets);
					$current--;
				}else{
					return false;
				}
			}else{
				$brackets[] = $item;
				$current++;
			}
		}
	}
	
	return empty($brackets);
}

function isClosingBracket(string $char):bool{
	return $char === '}' || $char === ']' || $char === ')';
}

function isBracket(string $char):bool{
	$brackets = ['(','[','{',')',']','}'];
	return in_array($char, $brackets);
}
function openBracket(string $char):string{
	return ($char === ')') ? '(' : (($char === ']') ? '[' : '{');
}