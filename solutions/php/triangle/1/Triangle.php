<?php
declare(strict_types=1);

class Triangle
{
    public int|float $a;
    public int|float $b;
    public int|float $c;
    public function __construct(int|float $a, int|float $b, int|float $c)
    {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
    }

    public function kind(): string
    {
        $this->checkSideIsZero();
        $this->checkTriangleInequality();
        $result = 'scalene';
        if($this->a === $this->b && $this->b === $this->c){
            $result = 'equilateral';
        }else if($this->a === $this->b || $this->b === $this->c || $this->c === $this->a){
            $result = 'isosceles';
        }
        return $result;
    }

    private function checkSideIsZero():void{
        if($this->a === 0 || $this->b === 0 || $this->c === 0){
            throw new \Exception('Illegal size.');
        }
    }

    private function checkTriangleInequality():void{
        if((($this->a + $this->b) < $this->c) || (($this->b + $this->c) < $this->a) || (($this->c + $this->a) < $this->b)){
            throw new \Exception('Triangle inequality.');
        }
    }
}
