<?php
class Link extends HtmlElement {

	var $className = "Link";
	var $text      = "";
	var $action    = "";
	var $level     = 0;
	var $cAction   = ""; 

	function Link($text,$action,$level = 0,$cAction = '') {
		$this->text  = $text;
		$this->action= $action;
		$this->level = $level;
		$this->cAction= $cAction;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		if($this->cAction=="")
			return("<center><a href=\"javascript:process('$this->action','$this->level')\">$this->text</a></center>\n");
		else {
			if ($this->action!="") {		
				return("<center><a href=\"javascript:$this->cAction;process('$this->action','$this->level')\">$this->text</a></center>\n");
			} else {
				return("<center><a href=\"javascript:".$this->cAction."\">$this->text</a></center>\n");
			}
		}
	}
}
?>
