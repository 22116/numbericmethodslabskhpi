<?php

class modelHalfDiv extends modelThirdLab
{
	public function __construct(float $a, float $b, float $e, callable $func, callable $func2, callable $func3)
	{
		parent::__construct($a, $b, $e, $func, $func2, $func3);
		$this->result = $this->makeJb($a, $b, $e);
	}

	public function makeJb($a, $b, $e)
	{
		$counter = 0;
		while (abs($b - $a) > $e)
		{
			$c = ($a + $b) / 2;

			if (call_user_func($this->f, $b) * call_user_func($this->f, $c) < 0)
				$a = $c;
			else
				$b = $c;

			$counter++;
		}
		return [$counter, ($a + $b) / 2];
	}
}