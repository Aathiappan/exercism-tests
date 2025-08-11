<?php

declare(strict_types=1);

function transform(array $input): array
{
   $transformed = [];
	foreach($input as $point => $letters){
		foreach($letters as $letter){
			$transformed[strtolower($letter)] = $point;
		}
	}
	ksort($transformed);
	return $transformed;
}
