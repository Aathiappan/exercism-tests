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

function format(string $name, int $number): string
{
    $numberStr = sprintf('%02d', $number);
    $ordinal = $number.match(true){
        (substr($numberStr,-1) == '1' && substr($numberStr,-2) != '11') => 'st',
        (substr($numberStr,-1) == '2' && substr($numberStr,-2) != '12') => 'nd',
        (substr($numberStr,-1) == '3' && substr($numberStr,-2) != '13') => 'rd',
        default => 'th',
    };
    return "$name, you are the $ordinal customer we serve today. Thank you!";
}
