<?php

class modelFifthLab
{
	protected $result;
	protected $myFunction;
	protected $ARes;

	public function __construct(callable $func, float $alf = 3.71375)
	{
		$this->ARes = $alf;
		$this->myFunction = $func;
	}

	public function setARes(float $alf)
	{
		$this->ARes = $alf;
	}

	public function getResult()
	{
		return $this->result;
	}
}