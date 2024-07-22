<?php
class TextArea extends FormControl {

	var $className = "TextArea";
	var $name      = "";
	var $value     = "";
	var $col       = 20;
	var $row       = 4;
	var $tip       = "";

	function TextArea($name, $value, $col=20,$row=4,$tip="") {
		$this->name  = $name;
		$this->value = $value;
		$this->col   = $col;
		$this->row   = $row;
		$this->tip   = $tip;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
	
		if ($this->tip!="") {
			$this->addHtml("<textarea name='$this->name' cols=$this->col rows=$this->row title='$this->tip'>$this->value</textarea>\n");
		} else {
			$this->addHtml("<textarea name='$this->name' cols=$this->col rows=$this->row>$this->value</textarea>\n");
		}
		return($this->toString());

	}
}
?>
