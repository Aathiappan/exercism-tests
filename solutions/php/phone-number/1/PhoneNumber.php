<?php
declare(strict_types=1);

class PhoneNumber
{
    private string $number;
	public function __construct(string $number){
		if(!preg_match('/^\+?[A-Za-z0-9 .\-()]*$/',$number)){
			throw new InvalidArgumentException('punctuations not permitted');
		}
		$number =  preg_replace('/[^a-zA-Z0-9]/','',$number);
		if(preg_match('/[a-zA-Z]/',$number)){
			throw new InvalidArgumentException('letters not permitted');
		}
		if(strlen($number) > 11 || strlen($number) < 10){
			throw new InvalidArgumentException();
		}else if(strlen($number) === 11){
            if($number[0] != 1){
				throw new InvalidArgumentException('11 digits must start with 1');
			}
			$number = substr($number,1);
		}
		$numberStrings = [0 => 'zero', 1 => 'one'];
		if($number[0] < 2){
			throw new InvalidArgumentException('area code cannot start with '.$numberStrings[$number[0]]);
		}
		if($number[3] < 2){
			throw new InvalidArgumentException('exchange code cannot start with '.$numberStrings[$number[3]]);
		}
        $this->number = $number;
	}
    public function number(): string
    {
		return $this->number;
    }
}
