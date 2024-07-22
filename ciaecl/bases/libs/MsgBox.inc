<?php
class MsgBox extends HtmlElement {

	var $sourceFile       = "";
	var $htmlElement      = array();
	var $css              = "";
	var $lastAction       = "";
	var $className        = "MsgBox";
	var $text             = "";

	function MsgBox($msg) {
 		$this->text    = $msg;
	}

	function toHtml() {
		return("<script>alert('".$this->text."');</script>");
	}
}
?>
