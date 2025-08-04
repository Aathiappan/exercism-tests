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

class Clock
{
    /**
     * This class implements PHP's magic method __toString().
     *
     * By implementing this method, the class adheres to the `Stringable` interface.
     * When an object of this class is used in string context (e.g., echo or string cast),
     * this method is automatically called.
     *
     * More on `Stringable`: https://www.php.net/manual/en/class.stringable.php
     *
     * @return string The string representation of the Clock object
     */
    private int $minutes = 0;
    public function __construct(int $hour,int $minutes = 0){
        $timeArr = $this->hourAndMinutes($minutes,$hour);
        $this->minutes = ($timeArr[0] * 60) + $timeArr[1];
    }
    public function __toString(): string
    {
        $timeArr = $this->hourAndMinutes($this->minutes);
        return str_pad((string)$timeArr[0],2,'0',STR_PAD_LEFT).':'.str_pad((string)$timeArr[1],2,'0',STR_PAD_LEFT);
    }
    public function add(int $minutes){
        $this->minutes += $minutes;
        return $this;
    }
    public function sub(int $minutes){
        $this->minutes -= $minutes;
        return $this;
    }
    private function hourAndMinutes(int $minutes, int $hour = 0):array{
        if($minutes > 59 || $minutes < -59){
            $hour += (($minutes - ($minutes % 60)) / 60);
            $minutes =  ($minutes % 60);
        }
        $hour = ($hour > 23 || $hour < -23) ? ($hour % 24) : $hour;
        if($hour < 0){
            $hour += 24;
        }
        if($minutes < 0){
            $hour = ($hour > 0) ? ($hour - 1) : 23;
            $minutes += 60;
        }
        return [$hour, $minutes];
    }
}
