<?php

class modelNewton extends modelFirstlab
{
	function __construct($data)
	{
		for($z = 0; $z < count($data['p']); $z++)
		{
			$h = ($data['x'][count($data['x']) - 1] - $data['x'][0]) / (count($data['x']) - 1);
			for ($i = 0; $i < count($data['x']); $i++) $del[$i][0] = $data['y'][$i];
			for ($i = 1; $i < count($data['x']); $i++)
				for ($j = 1; $j < count($data['x']) - $i + 1; $j++)
					$del[$j - 1][$i] = $del[$j][$i - 1] - $del[$j - 1][$i - 1];

			$res = $data['y'][0];
			for ($i = 1; $i < count($data['x']); $i++)
			{
				$tmp = $del[0][$i] / $this->factorial($i) / pow($h, $i);
				for ($j = 0; $j < $i; $j++) $tmp *= $data['p'][$z] - $data['x'][$j];
				$res += $tmp;
			}
			$this->result[] = $res;
		}
	}
	private function factorial($n)
	{
		return $n == 0 ? 1 : $n * $this->factorial($n - 1);
	}
}