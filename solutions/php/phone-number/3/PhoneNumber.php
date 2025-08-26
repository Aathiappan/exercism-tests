<?php
declare(strict_types=1);

class PhoneNumber
{
    private string $number;
    const NUMBERSTRING = [0 => 'zero', 1 => 'one'];
	public function __construct(string $number){
        $this->validateCharacters($number);
		$number =  preg_replace('/[^0-9]/','',$number);
        $this->validateStrLength($number);
        $this->validateAreaCode($number);
        $this->validateExchangeCode($number);
        $this->number = $number;
	}
    public function number(): string
    {
		return $this->number;
    }
    private function validateCharacters(string $number):void{
        if(!preg_match('/^\\+?[a-z\\d .()-]*$/i',$number)){
			throw new InvalidArgumentException('punctuations not permitted');
		}
		if(preg_match('/[a-zA-Z]/',$number)){
			throw new InvalidArgumentException('letters not permitted');
		}
    }
    private function validateStrLength(string &$number):void{
        if(strlen($number) > 11 || strlen($number) < 10){
			throw new InvalidArgumentException();
		}else if(strlen($number) === 11){
            if(!str_starts_with($number, '1')){
				throw new InvalidArgumentException('11 digits must start with 1');
			}
            $number = substr($number,1);
		}
    }
    private function validateAreaCode(string $number):void{
        if($number[0] < 2){
			throw new InvalidArgumentException('area code cannot start with '.self::NUMBERSTRING[$number[0]]);
		}
    }
    private function validateExchangeCode(string $number):void{
        if($number[3] < 2){
			throw new InvalidArgumentException('exchange code cannot start with '.self::NUMBERSTRING[$number[3]]);
		}
    }
}
