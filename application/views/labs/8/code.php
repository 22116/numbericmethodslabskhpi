<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Module 1 data set</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $N = 1000;
		$a = -2;
		$b = -0.5;
		$function1 = create_function('$x', 'return (1-pow($x,2))*pow((1+pow($x,2)),-1);');
		$analitics = [ -0.212998 ];
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'fRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[1]
			],
			'fInfelicity' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1, $analitics[0]))->getResult()[2],
				2 => (new modelParabol($a, $b, $N, $function1, $analitics[0]))->getResult()[2]
			],
		]);
        </pre>
    </div>
</div>