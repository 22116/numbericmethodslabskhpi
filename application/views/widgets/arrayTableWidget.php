<?php

class arrayTableWidget
{
	private $data;
	private $titles;
	private $headers;
	function __construct(array $data, array $titles, array $headers = [])
	{
		$this->headers = $headers;
		$this->data = $data;
		$this->titles = $titles;
		for($i = 0; $i < count($titles); $i++)
		{
			array_unshift($this->data[$i], $titles[$i]);
		}
		$this->construct();
	}
	private function construct()
	{
		echo "<table id=\"data\" class=\"table\">";
		echo "<tr class='alert - success'>";
		foreach ($this->headers as $header)
		{
			echo "<th class=\"cell\"><label >{$header}</label></th>";
		}
		echo "</tr>";
		foreach ($this->data as $item)
		{
			echo "<tr>";
			echo "<th class=\"cell btn-success\"><label >{$item[0]}</label></th>";
			for($i = 1; $i < count($item); $i++)
			{
				if(!is_array($item[$i])) echo "<td><label class=\"cell\">$item[$i]</label></td>";
				else echo "<td><label class=\"cell\">".print_r($item[$i], true)."</label></td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}
}
