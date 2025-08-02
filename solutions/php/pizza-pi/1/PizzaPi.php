<?php

class PizzaPi
{
    public function calculateDoughRequirement($pizza,$person)
    {
        //throw new \BadFunctionCallException("Implement the function");
        return ($pizza * (($person * 20) + 200));
    }

    public function calculateSauceRequirement($pizza,$sauceml)
    {
        //throw new \BadFunctionCallException("Implement the function");
        $cans = ($pizza * $sauceml)/500;
        return ceil($cans);
    }

    public function calculateCheeseCubeCoverage($cheesedim, $cheeseth, $pizzasize)
    {
        //throw new \BadFunctionCallException("Implement the function");
        $pizza = ($cheesedim ** 3)/($cheeseth * 3.14 * $pizzasize);
        return floor($pizza);
    }

    public function calculateLeftOverSlices($pizza,$friends)
    {
        //throw new \BadFunctionCallException("Implement the function");
        return (($pizza * 8) % $friends);
    }
}
