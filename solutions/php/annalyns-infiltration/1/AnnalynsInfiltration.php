<?php

class AnnalynsInfiltration
{
    public function canFastAttack($is_knight_awake)
    {
        //throw new \BadFunctionCallException("Implement the function");
        return !$is_knight_awake;
    }

    public function canSpy(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        //throw new \BadFunctionCallException("Implement the function");
        return $is_knight_awake || $is_archer_awake || $is_prisoner_awake;
    }

    public function canSignal(
        $is_archer_awake,
        $is_prisoner_awake
    ) {
        //throw new \BadFunctionCallException("Implement the function");
        return !$is_archer_awake && $is_prisoner_awake;
    }

    public function canLiberate(
        $is_knight_awake,
        $is_archer_awake,
        $is_prisoner_awake,
        $is_dog_present
    ) {
        //throw new \BadFunctionCallException("Implement the function");
        if(!$is_archer_awake && $is_dog_present){
            return true;
        }else if(!$is_archer_awake && !$is_knight_awake && $is_prisoner_awake){
            return true;
        }else{
            return false;
        }
    }
}
