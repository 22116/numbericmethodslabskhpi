<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Data example</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        $data = [
			[ 18.1,29.2 ],
			[ 15.1,36.0 ],
			[ 15.5,33.3 ],
			[ 17.9,16.6 ],
			[ 29.3,35.1 ],
			[ 38.4,44.2 ],
			[ 16.8, 9.4 ],
			[ 34.1,35.7 ],
			[ 10.0,24.2 ],
			[ 23.6,24.8 ]
		];
        </pre>
	</div>
</div>
<div class="panel panel-default">
	<div class="panel-heading">
		<h3 class="panel-title">Logic</h3>
	</div>
	<div class="panel-body">
        <pre class="brush: php;">
        class modelAproximal
		{
			private $data;

			public function __construct(array $data)
			{
				$this->data = $data;
			}

			public function Calculate() : array
			{
				$inData = $this->data;
				$data2 = [ 0,0,0,0,0,0,0 ];
				for ($i = 0; $i < 10; $i++)
				{
					$data2[0] += ($inData[$i][0] * $inData[$i][0])*$inData[$i][1];
					$data2[1] += $inData[$i][0] * $inData[$i][1];
					$data2[2] += $inData[$i][1];
					$data2[3] += $inData[$i][0];
					$data2[4] += $inData[$i][0] * $inData[$i][0];
					$data2[5] += $inData[$i][0] * $inData[$i][0] * $inData[$i][0];
					$data2[6] += $inData[$i][0] * $inData[$i][0] * $inData[$i][0] * $inData[$i][0];
				}
				$masd = $masa = $masb = $masc = array();

				for ($i = 0;$i < 3;$i++)
				{
					$masd[0][$i] = $data2[6 - $i];
					$masb[0][$i] = $data2[6 - $i];
					$masc[0][$i] = $data2[6 - $i];
					$masa[0][$i] = $data2[6 - $i];

					$masd[1][$i] = $data2[5 - $i];
					$masa[1][$i] = $data2[5 - $i];
					$masc[1][$i] = $data2[5 - $i];
					$masb[1][$i] = $data2[5 - $i];

					$masd[2][$i] = $data2[4 - $i];
					$masb[2][$i] = $data2[4 - $i];
					$masc[2][$i] = $data2[4 - $i];
					$masa[2][$i] = $data2[4 - $i];
					if (0 == $i)
					{
						$masa[0][0] = $data2[0];
						$masa[1][0] = $data2[1];
						$masa[2][0] = $data2[2];
					}
					if (1 == $i)
					{
						$masb[0][1] = $data2[0];
						$masb[1][1] = $data2[1];
						$masb[2][1] = $data2[2];
					}
					if (2 == $i)
					{
						$masc[0][2] = $data2[0];
						$masc[1][2] = $data2[1];
						$masc[2][2] = $data2[2];
					}
				}
				$masd[2][2] = 10;
				$masa[2][2] = 10;
				$masb[2][2] = 10;
				$maskoef = [ 0,0,0 ];
				$maskoef[0] = $this->det($masa,3) / $this->det($masd,3);
				$maskoef[1] = $this->det($masb,3) / $this->det($masd,3);
				$maskoef[2] = $this->det($masc,3) / $this->det($masd,3);

				$outData = array();
				for ($i = 0;$i < 150;$i++)
				{
					$outData[$i][0] = 0 + $i * 0.3;
					$outData[$i][1] = $maskoef[0] * $outData[$i][0] * $outData[$i][0] +
						$maskoef[1] * $outData[$i][0] + $maskoef[2];
				}
				return $outData;
			}

			private function det(array $a, int $N) : float
			{
				$determ = 0;
				if ($N == 2)
				{
					$determ = $a[0][0] * $a[1][1] - $a[0][1] * $a[1][0];
				}
				else
				{
					$matr1 = array();
					for ($i = 0; $i < $N; $i++)
					{
						for ($j = 0; $j < $N - 1; $j++)
						{
							$matr1[$j] = $j < $i ? $a[$j] : $a[$j + 1];
						}
						$determ += pow(-1, ($i + $j)) * $this->det($matr1, $N - 1) * $a[$i][$N - 1];
					}
				}
				return $determ;
			}
		}
        </pre>
	</div>
</div>