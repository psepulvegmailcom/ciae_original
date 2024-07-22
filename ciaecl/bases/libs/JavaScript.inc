<?php
class JavaScript extends HtmlElement {

	var $className = "JavaScript";
	var $js        = ""; 

	function JavaScript($js) {
		$this->js  = $js;
	}

	function toHtml() 
	{
		return("<script>".$this->js."</script>");
	}
}
?>
