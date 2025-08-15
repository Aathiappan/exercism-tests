<?php
declare(strict_types=1);

function nucleotideCount(string $input): array
{
    if(!empty($input) && !preg_match("/^[acgt0-9]+$/i", $input)){
        throw new \Exception();
    }
	$input = str_split($input);
	$result = ['a' => 0,'c' => 0, 't' => 0, 'g' => 0];
	array_walk($input,function($item) use (&$result){
		$result[strtolower($item)]++;
	});
	return $result;
}
