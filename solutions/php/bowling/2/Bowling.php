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

class Game
{
    private $rollPoints = []; 
    public function score(): int
    {
        if(count($this->rollPoints) === 0){
            throw new Exception('Unstarted game cannot be scored.');
        }
        $score = 0;
        $previousPoint = null;
        $frameCount = 0;
        $is_spare = false;
        $strike_cnt = 0;
        foreach($this->rollPoints as $key => $point){
            if($point > 10){
                throw new Exception('A roll cannot score more than 10 points.');
            }
            if($frameCount < 20){
                if($point === 10){
                    $score += $point;
                    $frameCount += 2;
                    if(isset($this->rollPoints[$key+1]) && isset($this->rollPoints[$key+2])){
                        if(($this->rollPoints[$key+1] + $this->rollPoints[$key+2]) > 10 && $this->rollPoints[$key+1] !== 10){
                            throw new Exception('Two bonus rolls after strike in the last frame cannot score more than 10 points');
                        }
                        $score += $this->rollPoints[$key+1];
                        $score += $this->rollPoints[$key+2];
                    }else{
                        throw new Exception('Bonus for a strike in the last frame must be rolled before score can be calculated.');
                    }
                    if($frameCount === 20){
                        $strike_cnt = 2;
                    }
                }else if($previousPoint !== null){
                    if(($previousPoint + $point) > 10){
                        throw new Exception('Two rolls in a frame cannot score more than 10 points.');
                    }
                    if(($previousPoint + $point) === 10){
                        if(isset($this->rollPoints[$key+1])){
                            $score += $this->rollPoints[$key+1];
                            if($frameCount === 19){
                                $is_spare = true;
                            }
                        }else{
                            throw new Exception('Bonus for a spare in the last frame must be rolled before score can be calculated.');
                        }
                    }
                    $score += $point;
                    $frameCount++;
                    $previousPoint = null;
                }else{
                    $previousPoint = $point;
                    $score += $point;
                    $frameCount++;
                }
            }else{
                if($is_spare === true){
                    $is_spare = false;
                }else if($strike_cnt > 0){
                    $strike_cnt--;
                }else{
                    throw new Exception('cannot roll after bonus rolls for strike');
                }
            }
        }
        if($frameCount !== 20){
            throw new Exception('An incomplete game cannot be scored.');
        }
        return $score;
    }

    public function roll(int $pins): void
    {
        if($pins === -1){
            throw new Exception('Rolls cannot score negative points');
        }
        $this->rollPoints[] = $pins;
    }
}
