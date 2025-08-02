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

class RobotSimulator
{
    private $robotPos = [0,0,0];//{x,y,angle}
    /**
                 N(90 deg)
                 |
                 |
    W(180 deg)---|---E(0 deg)
                 |
                 |
                 S(270 deg)
    */
    private $dirAngle = ['east'=>0,'north'=>90,'west'=>180,'south'=>270];
    private $rotate = ['L' => 90 , 'R' => -90];
    /** @param int[] $position */
    public function __construct(array $position, string $direction)
    {
        //throw new \BadMethodCallException(sprintf('Implement the %s method', __FUNCTION__));
        $this->robotPos = [$position[0],$position[1],$this->dirAngle[$direction]];
    }

    public function instructions(string $instructions): void
    {
        //throw new \BadMethodCallException(sprintf('Implement the %s method', __FUNCTION__));
        if(strlen($instructions) === 1){
            if($instructions != 'A'){
                $this->robotPos[2] = $this->getAngle($this->robotPos[2],$instructions);
            }else{
                $this->setMovement();
            }
        }else if($instructions !== ''){
            $instructArr = str_split($instructions);
            foreach($instructArr as $dir){
                if($dir != 'A'){
                    $this->robotPos[2] = $this->getAngle($this->robotPos[2],$dir);
                }else{
                    $this->setMovement();
                }
            }
        }
    }

    /** @return int[] */
    public function getPosition(): array
    {
        //throw new \BadMethodCallException(sprintf('Implement the %s method', __FUNCTION__));
        var_dump($this->robotPos);
        return [$this->robotPos[0],$this->robotPos[1]];
    }

    public function getDirection(): string
    {
        //throw new \BadMethodCallException(sprintf('Implement the %s method', __FUNCTION__));
        return array_search($this->robotPos[2],$this->dirAngle);
    }
    private function getAngle(int $initial,string $direction):int{
        $res = $initial + $this->rotate[$direction];
        if($res === 0 || $res === 360){
            return 0;    
        }else if($res > 0){
            if($res < 360){
                return $res;   
            }else if(($res/360) > 1){
                $times = (int)($res/360);
                return ($res - ($times * 360));
            }
        }else if($res < 0){
             return (360 + $res);
        }
    }
    private function setMovement():void{
        $ang = $this->robotPos[2];
        if($ang == 0){
            $this->robotPos[0] += 1;
        }else if($ang == 180){
            $this->robotPos[0] -= 1;
        }else if($ang == 90){
            $this->robotPos[1] += 1;
        }else if($ang == 270){
            $this->robotPos[1] -= 1;
        }
        
    }
}
