<?php

class modelLagrange extends modelFirstlab
{
	function __construct($data)
	{
		for($i = 0; $i < count($data['p']); $i++)
		{
			$result = 0;
			for($j = 0; $j < count($data['y']); $j++)
			{
				$temp = 1;
				for($k = 0; $k < count($data['x']); $k++)
				{
					if($j != $k) $temp *= ($data['p'][$i] - $data['x'][$k]) / ($data['x'][$j] - $data['x'][$k]);
				}
				$result += $data['y'][$j] * $temp;
			}
			$this->result[] = $result;
		}
	}
	static public function getStringPolinom($data)
	{
		$res = '';

		$result = 0;
		for($j = 0; $j < count($data['y']); $j++)
		{
			$temp = 1;
			$tmp = '';
			for($k = 0; $k < count($data['x']); $k++)
			{
				if($j != $k) {
					$temp *= (1 - $data['x'][$k]) / ($data['x'][$j] - $data['x'][$k]);
					$tmp .= '(x-('.$data['x'][$k].'))/('.$data['x'][$j].'-('.$data['x'][$k].'))';
				}
			}
			$result += $data['y'][$j] * $temp;
			$res .= $data['y'][$j].'*('.$tmp.') '.($j==count($data['y'])-1 ? '': '+').' <br>';
		}
		return $res;
	}
}