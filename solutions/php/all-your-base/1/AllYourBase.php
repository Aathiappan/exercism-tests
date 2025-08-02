<?php

/*
 * By adding type hints and enabling strict type checking, code can become
 * easier to read, self-documenting and reduce the number of potential bugs.
 * By default, type declarations are non-strict, which means they will attempt
 * to change the original type to match the type specified by the
 * type-declaration.
 *
 * In other words, if you pass a string to a function requiring a float,
 * it will attempt to convert the string value to a float.
 *
 * To enable strict mode, a single declare directive must be placed at the top
 * of the file.
 * This means that the strictness of typing is configured on a per-file basis.
 * This directive not only affects the type declarations of parameters, but also
 * a function's return type.
 *
 * For more info review the Concept on strict type checking in the PHP track
 * <link>.
 *
 * To disable strict typing, comment out the directive below.
 */

declare(strict_types=1);

function rebase(int $fromBase, array $digits, int $toBase): array
{
    if($fromBase < 2 && $toBase < 2){
		throw new InvalidArgumentException();
	}else if($fromBase < 2){
        throw new InvalidArgumentException('input base must be >= 2');
    }else if($toBase < 2){
		throw new InvalidArgumentException('output base must be >= 2');
	}
	$is_valid_digit = true;
	array_walk($digits,function($item, $key) use($fromBase,&$is_valid_digit){
		$is_valid_digit = ($is_valid_digit && $item >= 0 && $item < $fromBase);
	});
	if(count($digits) > 0 && !$is_valid_digit){
		throw new InvalidArgumentException('all digits must satisfy 0 <= d < input base');
	}
    $converted = [];
    $base10 = ($fromBase === 10) ? true : false;
	$base10 = (count($digits) === 0) ? 0 : $base10;
    if(!$base10){
        for($i = 0; $i < count($digits); $i++){
            $base10 += ($digits[$i] * pow($fromBase, (count($digits) - $i - 1)));
        }
		
    }else{
        $base10 = (int) implode('',$digits);
    }
    while($base10 > 1){
        $remaining = ($base10 % $toBase);
        array_push($converted, $remaining);
        $base10 = (int) ($base10 / $toBase);
    }
    if($base10 >= 1){
        array_push($converted,$base10);
    }else if(empty($converted)){
		array_push($converted,$base10);
	}
    return array_reverse($converted);
}

