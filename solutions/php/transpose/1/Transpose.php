<?php

declare(strict_types=1);

function transpose(array $input): array
{
    if($input === ['']){
		return [''];
	}
	$input = array_map('str_split',$input);
	$maxRow = 0;
	array_walk($input,function($item) use(&$maxRow){
		if($maxRow < count($item)) $maxRow = count($item);
	});
	$result = [];
	for($i = 0; $i < count($input); $i++){
		for($j = 0; $j < $maxRow; $j++){
			$result[$j][$i] = isset($input[$i][$j]) ? $input[$i][$j] : ' ';
		}
	}
	$result = array_map('implode',$result);
	$result[$maxRow -1] = rtrim($result[$maxRow -1]);
	return $result;
}
