<?php
class Position{
    public $x,$y;
    public function __construct(int $m,int $l){
        $this->x = $l;
        $this->y = $m;
    }
}