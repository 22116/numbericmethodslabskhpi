<?php

class sideBarWidget
{
	private $links;
	private $titles;
	private $activeTab;
	public function __construct(array $links, array $titles, $activeTab = 0)
	{
		$this->links = $links;
		$this->titles = $titles;
		$this->activeTab = $activeTab;
		if(count($links) != count($titles)) throw new Exception("links_count != titles_count");
		echo $this->constructHeader().
			$this->constructTabs().
			$this->constructFooter();
	}
	private function constructHeader() : string
	{
		return "<div class=\"side_bar\">
        <div class=\"list-group\">";
	}
	private function constructTabs() : string
	{
		$html = "";
		for($i = 0; $i < count($this->links); $i++)
		{
			$html .= "<a href=\"/labs/".$this->links[$i]."/\" class=\"list-group-item ".
				($this->activeTab == $i ? "active" : "") .
			"\">".$this->titles[$i]."</a>";
		}
		return $html;
	}
	private function constructFooter() : string
	{
		return "</div></div>";
	}
}