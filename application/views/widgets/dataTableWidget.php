<?php

class dataTableWidget
{
	private $data;
	function __construct($data)
	{
		$this->data = $data;
		$this->constructXYFromData();
		$this->constructPointsFromData();
	}
	private function constructXYFromData()
	{
		echo "<table id=\"data\" class=\"table\">
			<tr class=\"alert-success\">
				<th>X</th>
				<th>Y</th>
				<th>Actions</th>
			</tr>";
		for($i=0;$i<count($this->data['x']);$i++)
			echo "<tr>
				<td><label class=\"cell editable editable-click\">{$this->data['x'][$i]}</label><input type=\"text\" name=\"x[]\" class=\"inactive\" value=\"{$this->data['x'][$i]}\"/></td>
				<td><label class=\"cell editable editable-click\">{$this->data['y'][$i]}</label><input type=\"text\" name=\"y[]\" class=\"inactive\" value=\"{$this->data['y'][$i]}\"/></td>
				<td class=\"glyphicon\"></td>
			</tr>";
		echo "<tr>
				<td class=\"glyphicon glyphicon-pushpin\" colspan=\"3\"></td>
			</tr>
		</table>
		";
	}
	private function constructPointsFromData()
	{
		echo "<table id=\"points\" class=\"table\"><tr>
            <td class=\"alert-success\">Point:</td>";

		for($i=0;$i<count($this->data['p']);$i++)
			echo "<td><label class=\"cell editable editable-click\">{$this->data['p'][$i]}</label><input type=\"text\" name=\"p[]\" class=\"inactive\" value=\"{$this->data['p'][$i]}\"/></td>";

		echo "</tr></table>";
	}
}
