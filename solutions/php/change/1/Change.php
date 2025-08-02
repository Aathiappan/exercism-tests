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
$flag = false;
function findFewestCoins(array $coins, int $amount): array
{
    if(!array_all($coins,'checkValueIsNaturalNumber')){
        throw new InvalidArgumentException('Invalid coins.');
    }else if(!checkValueIsWholeNumber($amount)){
        throw new InvalidArgumentException('Cannot make change for negative value');
    }else{
        if($amount === 0){
            return [];
        }else if($coins[0] > $amount){
            throw new InvalidArgumentException('No coins small enough to make change');
        }else{
            if(in_array($amount,$coins)){
                return [$amount];
            }else{
                $possibleCombination = findCombinationWithRepetitionIterative($coins,$amount);
                if(empty($possibleCombination)){
                    
                        throw new InvalidArgumentException('No combination can add up to target');
                    
                }
                return $possibleCombination;
            }
        }
    }
}
function checkValueIsNaturalNumber(int $value):bool{
    return $value > 0;
}
function checkValueIsWholeNumber(int $value):bool{
    return $value >= 0;
}
function findCombinationWithRepetitionIterative(array $coins, int $amount): array
{
    $shortestCombination = [];

    // Simulate the recursion stack using an array of arrays
    // Each element in the stack will represent a state:
    // [currentAmount, currentCombination, coinStartIndex]
    $stack = [[$amount, [], 0]];
	//[$currentAmount, $currentCombination, $coinIndex] = $stack[0];
    while (!empty($stack)) {
        [$currentAmount, $currentCombination, $coinIndex] = array_pop($stack);// Pop the last state
		//var_dump($stack);
        if ($currentAmount === 0) {
            sort($currentCombination);
            // Check if this is the first combination or a shorter one
            if (empty($shortestCombination) || count($shortestCombination) > count($currentCombination)) {
                $shortestCombination = $currentCombination;
            }
			var_dump($stack);
            break; // Move to the next state on the stack
        }

        if ($currentAmount < 0) {
            continue; // Move to the next state on the stack
        }

        // Iterate through coins from the current coinIndex
        for ($i = $coinIndex; $i < count($coins); $i++) {
            $num = $coins[$i];
            $newCombination = $currentCombination;
            $newCombination[] = $num;
            // Push the new state onto the stack to simulate the recursive call
            array_push($stack, [$currentAmount - $num, $newCombination, $i]);
        }
		
    }

    return $shortestCombination;
}