<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Data example</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $b = 10.4;
        $data = [
            'x' => [ 0, $b / 4, $b / 2, 0.75 * $b, $b ],
			'y' => [ 10.7, -13.7, -5.5, -1.8, 9.5 ],
			'p' => [ $b / 8, $b / 4 + $b / 8, $b / 2 + $b / 8, 0.75 * $b + $b / 8, $b + $b / 8 ]
		];
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Lagrange</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
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
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Newton</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        private function factorial($n)
        {
            return $n == 0 ? 1 : $n * $this->factorial($n - 1);
        }
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
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Code Gauss</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $this->result = [];
        </pre>
	</div>
</div>
</p>