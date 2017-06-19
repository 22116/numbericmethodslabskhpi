<?php

class modelKasatel extends modelThirdLab
{
	public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
	{
		parent::__construct($a, $b, $e, $func, $func2, $func3);
		$this->result = $this->kas($a, $b, $e);
	}

	public function kas(float $a, float $b, float $e)
	{
		$c = (call_user_func($this->f, $a) * call_user_func($this->f2, $a) > 0) ? $a : $b;
		$counter = 0;
		$d = $c - call_user_func($this->f, $c) / call_user_func($this->f1, $c);
		while (abs($d - $c) > $e)
		{
			$c = $d;
			$d = $c - call_user_func($this->f, $c) / call_user_func($this->f1, $c);
			$counter++;
		}

		return [$counter, $d];
	}
}