<h3>
    МЕТОДЫ ИНТЕРПОЛИРОВАНИЯ ФУНКЦИИ. Вариант 16
</h3>
<p> Data: </p>
<p> b = 10.4</p>
<form datatype="post">
	<?php
	new dataTableWidget($params);
	?>
    <button type="submit" class="btn-primary">Get Result</button>
</form>
<br>
<?php
new arrayTableWidget([$lagrange, $newton], ['Langrange', 'Newton']);
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
