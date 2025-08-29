<?php
declare(strict_types=1);
const OPERATIONS = ['plus','minus','multiplied','divided','raised','cubed'];
function calculate(string $input): int
{
    $words = preg_split('/([+-]?\d+(?:\.\d+)?|[a-zA-Z]+|[^\da-zA-Z\s]+)/', $input, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);
    $number = 0;
    $operation = '';
    foreach($words as $word){
        if(is_numeric($word)){
            if(!empty($operation)){
                $number = operation($operation,$number,($word + 0));
            }else{
                $number = $word + 0;
            }
        }else if(in_array($word,OPERATIONS)){
            if($word === 'cubed'){
                throw new \InvalidArgumentException('Invali operation');
            }
            $operation = $word;
        }
    }
    if(empty($number)){
        throw new \InvalidArgumentException('Invali input');
    }
    return $number;
}
function operation(string $operation = 'plus',int|float $a, int|float $b){
    switch($operation){
        case 'minus':
            return $a - $b;
        case 'multiplied':
            return $a * $b;
        case 'divided':
            return $a/$b;
        case 'raised':
            return $a ** $b;
        default:
            return $a + $b;
    }
}
