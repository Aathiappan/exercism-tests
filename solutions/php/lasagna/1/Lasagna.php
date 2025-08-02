<?php

class Lasagna
{
    
    public function expectedCookTime()
    {
        // Implement the expectedCookTime method
        $cookingTime = 40;
        return $cookingTime;
    }

    public function remainingCookTime($elapsed_minutes)
    {
        $cookingTime = 40;
        // Implement the remainingCookTime method
        if($elapsed_minutes < $cookingTime){
            return ($cookingTime - $elapsed_minutes);
        }else{
            return 0;
        }
    }

    public function totalPreparationTime($layers_to_prep)
    {
        $prepareOneLayer = 2;
        // Implement the totalPreparationTime method
        return ($prepareOneLayer * $layers_to_prep);
    }

    public function totalElapsedTime($layers_to_prep, $elapsed_minutes)
    {
        $prepareOneLayer = 2;
        // Implement the totalElapsedTime method
        return (($prepareOneLayer * $layers_to_prep) + $elapsed_minutes);
    }

    public function alarm()
    {
        // Implement the alarm method
        return "Ding!";
    }
}
