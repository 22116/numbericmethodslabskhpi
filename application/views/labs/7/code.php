<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Data example</h3>
    </div>
    <div class="panel-body">
        <pre class="brush: php;">
        $N = 10000;
		$a = 1;
		$b = 5;
		$function1 = $this->createIdzFunc(0.3);
		$function2 = $this->createIdzFunc(1.2);
		$this->view->generate(self::$pageNum.'/index', [
			'tabNumber' => self::$pageNum,
			'fRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function1))->getResult()[1],
				1 => (new modelTrapeciya($a, $b, $N, $function1))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function1))->getResult()[1]
			],
			'sRes' => [
				0 => (new modelCentralRectangle($a, $b, $N, $function2))->getResult()[1],
				1 => (new modelTrapeciya($a, $b, $N, $function2))->getResult()[1],
				2 => (new modelParabol($a, $b, $N, $function2))->getResult()[1]
			]
		]);

        function createIdzFunc(float $alf) : callable
        {
            return create_function('$x', "return (log(1 - (2 * {$alf} * cos(\$x)) + pow({$alf}, 2)));");
        }
        </pre>
    </div>
</div>