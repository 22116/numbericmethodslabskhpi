<?php

class modelKombinational extends modelThirdLab
{
	public function __construct($a, $b, $e, callable $func, callable $func2, callable $func3)
	{
		parent::__construct($a, $b, $e, $func, $func2, $func3);
		$this->result = $this->komb($a, $b, $e);
	}

	public function komb(float $a, float $b, float $e)
	{
		$niter = 0;
		$a0 = $a;
		$b0 = $b;
		while (abs($b - $a) > $e)
		{
			if (call_user_func($this->f1, $a)*call_user_func($this->f2, $a) > 0)
			{
				$a = $a0 - call_user_func($this->f, $a0) * ($b0 - $a0) / (call_user_func($this->f, $b0) - call_user_func($this->f, $a0));
				$b = $b0 - call_user_func($this->f, $b0) / call_user_func($this->f1, $b0);
			}
			else
			{
				$a = $a0 - call_user_func($this->f, $a0) / call_user_func($this->f1, $a0);
				$b = $b0 - call_user_func($this->f, $b0) * ($b0 - $a0) / (call_user_func($this->f, $b0) - call_user_func($this->f, $a0));
			}
			$a0 = $a;
			$b0 = $b;
			$niter++;
		}
		return [$niter, ($a + $b) / 2.0];
	}
}