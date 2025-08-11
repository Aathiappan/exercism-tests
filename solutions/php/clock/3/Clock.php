<?php
declare(strict_types=1);
class Clock{
	private DateTimeImmutable  $time;
	public function __construct(int $hours, int $minutes = 0){
		$this->time = (new DateTimeImmutable())->setTime($hours, $minutes)->setDate(0,0,0);
	}
	public function __toString(): string
	{
		return $this->time->format('H:i');
	}
	public function add(int $minutes): self
	{
		$this->time = $this->time->modify("{$minutes} minutes")->setDate(0,0,0);
		return $this;
	}
	public function sub(int $minutes): self
	{
		$this->time = $this->time->modify("-{$minutes} minutes")->setDate(0,0,0);
		return $this;
	}
}