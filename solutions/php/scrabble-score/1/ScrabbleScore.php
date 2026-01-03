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

function score(string $word): int
{
    return array_reduce(str_split($word),function($sum, $item){
        return $sum + scrabble(strtoupper($item));
    }, 0);
}

function scrabble($char){
    return match(true){
        in_array($char, ['A', 'E', 'I', 'O', 'U', 'L', 'N', 'R', 'S', 'T']) => 1,
        in_array($char, ['D', 'G']) => 2,
        in_array($char, ['B', 'C', 'M', 'P']) => 3,
        in_array($char, ['F', 'H', 'V', 'W', 'Y']) => 4,
        in_array($char, ['K']) => 5,
        in_array($char, ['J', 'X']) => 8,
        in_array($char, ['Q', 'Z']) => 10,
        default => 0
    };
}
