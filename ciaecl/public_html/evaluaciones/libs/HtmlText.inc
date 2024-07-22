<?
class HtmlText extends HtmlElement {

	var $className = "HtmlText";
	var $text      = ""; 

	function HtmlText($text) {
		$this->text  = $text;
	}

	function toHtml() 
	{
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		return($this->text);
	}
}
?>
