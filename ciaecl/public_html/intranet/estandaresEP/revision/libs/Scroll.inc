<?
class Scroll extends HtmlElement {

	var $className = "Scroll";
	var $value     = "";

	function Scroll($value) {		
		$this->value = $value;		
	}

	function toHtml() {
		global $HTTP_POST_VARS;
					
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return("<div style='position:relative; width:100%; height:100%;overflow:scroll'>$this->value</div>");
	}
}
?>
