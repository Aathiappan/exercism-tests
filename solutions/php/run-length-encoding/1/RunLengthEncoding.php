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

function encode(string $input): string
{
    $input = str_split($input);
    $prev_char = '';$char_cnt = 0;$textArr = '';
    foreach($input as $char){
        if($prev_char === $char){
            $char_cnt++;
        }else{
            $textArr .= ($prev_char !== '' && $char_cnt > 1) ? "$char_cnt".$prev_char : $prev_char;
            $prev_char = $char;
            $char_cnt = 1;
        }
    }
    $textArr .= ($prev_char !== '' && $char_cnt > 1) ? "$char_cnt".$prev_char : $prev_char;
    return $textArr;
}

function decode(string $input): string
{
    $input = str_split($input);
    $char_cnt = 0;$text = '';
    foreach($input as $char){
        if(intval($char) !== 0){
            $char_cnt = ($char_cnt > 0) ? ($char_cnt*10)+intval($char):intval($char);
        }else{
            $text .= ($char_cnt > 0) ? str_repeat($char,$char_cnt): $char;
            $char_cnt = 0;
        }
    }
    return $text;
}
