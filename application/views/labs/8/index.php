<h3>
    Экзамен. Вариант 2
</h3>
<p> Data: </p>
<br>
<h4>Модуль 1:</h4>
<form datatype="post">
	<?php
	new dataTableWidget($params);
	?>
    <button type="submit" class="btn-primary">Get Result</button>
</form>
<?php
new arrayTableWidget([$polinom], ['0'], ['Точка', 'Результат']);
echo $polinomString;
?>
<h4>Модуль 2:</h4>
2) Прямоугольников(средние, левые, правые)
<br>Разбиение интеграла на равные части и вычисление площади прямоугольника входящие в этот интервал, из-за малой точности эти методы используют редко.
<br><br>
Парабол,
<br>Замена интегральной функции на каждом из интервалов на параболу, принимающия в каждых трех последовательных узлах значение совпадающие с значением подинтегральной функции. Метод является точным для полиномов до 3-ей степени так как 4-я равна нулю при большом количестве N разбиений.
<br><br>
Трапеций
<br>подинтегральную функцию заменяют на кусочно-ломаную функцию, точки излома которой совпадают с узлами квадратурной формулы. Дает точный результат для любой линейной функции.
<br><br>
Ньютона-Катеса
<br>подинтегральная функция заменяется на соответствующий ей интерполяционный многочлен Лагранджа, где коэфиценты вычисляются заранее
<br><br>
<br>Все перечисленные методы имеют поястоянный интервал h, а следовательно имеют проблемы с точностью при одинаковом и фиксированном числе N. Кроме того на границах функция может обладать особенностью, что делает невозможным применение алгоритмов типа трапеций или парабол.
<br><br>3)
Wolfram: -0.212998
<?php
new arrayTableWidget([
	$fRes
], [
	'Результат'
], [
	'', 'Цетральных прямоугольников', 'Парабол'
]);
new arrayTableWidget([
	$fInfelicity
], [
	'Погрешность'
], [
	'', 'Цетральных прямоугольников', 'Парабол'
]);
?>
<script type="text/javascript">
	$(document).ready(function() {
		$('.cell').editable({
			success: onCellValueChanged
		});
		function removeAction() {
			if(!$(this).hasClass('glyphicon-pushpin')) $(this).parent().remove();
		}
		function hoverOnTdAction() {
			if(!$(this).hasClass('glyphicon-pushpin')) $(this).addClass('glyphicon-remove');
		}
		function hoverOutTdAction() {
			$(this).removeClass('glyphicon-remove');
		}
		function onCellValueChanged(response, newValue) {
			$(this).parent().children('input').attr('value', newValue);
		}
		$('table#data .glyphicon').hover(hoverOnTdAction,hoverOutTdAction).click(function () {
			if($(this).hasClass('glyphicon-pushpin')) $(this).parent().prev().after('<tr><td><label class="cell editable editable-click">1</label><input type="text" name="x[]" class="inactive" value="1"/></td>' +
				'<td><label class="cell editable editable-click">1</label><input type="text" name="y[]" class="inactive" value="1"/></td><td class="glyphicon"></td></tr>');
			if(!$(this).hasClass('glyphicon-pushpin')) $(this).parent().remove();
			$('table .glyphicon:nth-last-of-type(1)').hover(hoverOnTdAction,hoverOutTdAction).click(removeAction);
			$('tr:nth-last-of-type(2) .cell').editable({
				success: onCellValueChanged
			});
		});
	});
</script>

