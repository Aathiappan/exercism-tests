<?php

class ProgramWindow
{
    public $x,$y,$width,$height;
    public function __construct(){
        $this->x = 0;
        $this->y = 0;
        $this->width = 800;
        $this->height = 600;
    }
    public function resize(object $sizes){
        $this->width = $sizes->width;
        $this->height = $sizes->height;
    }
    public function move(object $position){
        $this->x = $position->x ;
        $this->y = $position->y;
    }
}
