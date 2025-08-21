<?php

declare(strict_types=1);

function sieve(int $number): array
{
    if($number < 1){
		throw new \Exception('Negative number not supported');
	}else if($number === 1){
		return [];
	}
    $result = range(2,$number,1);
	$dividents = range(2,(int) ceil(sqrt($number)),1);
	foreach($dividents as $divident){
		foreach($result as $key => $value){
			if($value === $divident){
				continue;
			}
			if(($value % $divident) === 0){
				unset($result[$key]);
			}
		}
	}
	return array_values($result);
}
