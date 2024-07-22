<?php
class PasswordText extends FormControl {

	var $className = "PasswordText";
	var $size      = 20;
	var $tip       = "";
	var $class     = "inputtext";

	function PasswordText($name, $value, $tip='', $size=20,$js="") {
		$this->name  = $name;
		$this->value = $value;
		$this->size  = $size;
		$this->tip   = $tip;
		$this->js    = $js;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		if ($this->tip!="") {
			$this->addHtml("<input class='$this->class' type=password name='$this->name' value='$this->value' size=$this->size title='$this->tip' $this->js >\n");
		} else {
			$this->addHtml("<input class='$this->class' type=password name='$this->name' value='$this->value' size=$this->size $this->js >\n");
		}

		if ($this->validText!="") {
			$this->addHtml("<font color=red>$this->validText</font>");
		}
		return($this->toString());
	}
}
?>
