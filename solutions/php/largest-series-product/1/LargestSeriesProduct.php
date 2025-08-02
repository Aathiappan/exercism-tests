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

class Series
{
    private $numberStr = '';
    public function __construct(string $input)
    {
        if(preg_match('/\D/',$input)){
            throw new InvalidArgumentException("input must be integer only");
        }else{
            $this->numberStr = $input;
        }
    }

    public function largestProduct(int $span): int
    {
        if($this->numberStr != '' && $span > 0 && strlen($this->numberStr) >= $span){
            $possible = (strlen($this->numberStr) - ($span - 1));
            $numbers = array_map('intval',str_split($this->numberStr));
            $val = 0;
            for($i = 0;$i < $possible;$i++){
                $temp_val = $this->recursiveProduct($numbers,$i,$span);
                if($temp_val > $val){
                    $val = $temp_val;
                }
            }
            return $val;
            
        }else if($span === 0){
            return 1;
        }else if($span === -1){
            throw new InvalidArgumentException("span must be non negative whole number.");
        }else if($this->numberStr === '' && $span > 0){
            throw new InvalidArgumentException("if input empty span must be 0");
        }else if(strlen($this->numberStr) < $span){
            throw new InvalidArgumentException("input length must be bigger than span.");
        }
    }
    private function recursiveProduct( array $numbers, int $i, int $span):int {
        if($span  < 1){
            return 1;
        }
        return $numbers[$i] * $this->recursiveProduct($numbers,$i+1,$span-1);
    }
}
