<?php
class InputText extends FormControl {

	var $className = "InputText";
	var $size      = 20;
	var $tip       = "";
	var $readonly  = "";
	var $class     = "inputtext";

	function InputText($name, $value, $tip='', $size=20,$ro=false, $js="") {
		
		$this->name  = $name;
		$this->value = $value;
		$this->size  = $size;
		$this->tip   = $tip;
		$this->js    = $js;
		if ($ro) {
			$this->readonly = "READONLY";
		}
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		if ($this->tip!="") {
			$this->addHtml("<input class='$this->class' type=text name='$this->name' value='$this->value' size=$this->size title='$this->tip' $this->readonly $this->js >\n");
		} else {
			$this->addHtml("<input class='$this->class' type=text name='$this->name' value='$this->value' size=$this->size $this->readonly $this->js >\n");
		}


		if ($this->validText!="") {
			$this->addHtml("<font color=red>$this->validText</font>");
		}
		return($this->toString());
	}
}
?>
