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
const ALPHAPET = [1 => 'a', 2 => 'b', 3 => 'c', 4 => 'd', 5 => 'e', 6 => 'f', 7 => 'g', 8 => 'h', 9 => 'i', 10 => 'j', 11 => 'k', 12 => 'l', 13 => 'm',
    14 => 'n', 15 => 'o', 16 => 'p', 17 => 'q', 18 => 'r', 19 => 's', 20 => 't', 21 => 'u', 22 => 'v', 23 => 'w', 24 => 'x', 25 => 'y', 26 => 'z' ];

function encode(string $text): string
{
    //global ALPHAPET;
    $text = preg_replace("/[^a-zA-Z0-9]/", "",strtolower($text));
    $text = str_split($text);
    $encoded = '';$cnt = 0;
    foreach($text as $char){
        if($cnt === 5){
            $cnt = 0;
            $encoded .= ' ';
        }
        if(in_array($char,ALPHAPET)){
            $index = array_search($char,ALPHAPET);
            $encoded .= ALPHAPET[27 - $index];
        }else{
            $encoded .= $char;
        }
        $cnt++;
    }
    return $encoded;
}

function decode(string $text): string
{
    $text = str_split(str_replace(' ','',$text));
    $decoded = '';
    foreach($text as $char){
        $index = array_search($char,ALPHAPET);
        if(in_array($char,ALPHAPET)){
            $decoded .= ALPHAPET[27 - $index];
        }else{
            $decoded .= $char;
        }
    }
    return $decoded;
}
