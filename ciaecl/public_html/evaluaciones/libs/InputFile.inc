<?
class InputFile extends FormControl {

	var $className = "InputFile";
	var $size      = 20;
	var $tip       = "";

	function InputFile($name, $value, $tip='', $size=20) {
		$this->name  = $name;
		$this->value = $value;
		$this->size  = $size;
		$this->tip   = $tip;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");

		if ($this->tip!="") {
			$this->addHtml("<input type=file name='$this->name' value='$this->value' size=$this->size title='$this->tip'>\n");
		} else {
			$this->addHtml("<input type=file name='$this->name' value='$this->value' size=$this->size>\n");
		}

		if ($this->validText!="") {
			$this->addHtml("<font color=red>$this->validText</font>");
		}
		return($this->toString());
	}
}
?>
