<?
class TextEditor extends TextArea {

	var $className = "TextEditor";
	var $name      = "";
	var $value     = "";
	var $col       = 20;
	var $row       = 4;
	var $tip       = "";

	function TextEditor($name, $value, $col=20,$row=4,$tip="") {
		$this->name  = $name;
		$this->value = $value;
		$this->col   = $col;
		$this->row   = $row;
		$this->tip   = $tip;
	}

	function toHtml() {
		global $HTTP_POST_VARS;
		extract($HTTP_POST_VARS,EXTR_PREFIX_SAME, "wddx");
		$this->addHtml("<script src='www/libjs/whizzywig.js' type='text/javascript'></script>\n");

		if ($this->style!="") {
			$style="style='".$this->style."'";
		}

		if ($this->tip!="") {
			$this->addHtml("<textarea id='$this->name' name='$this->name' cols=$this->col rows=$this->row title='$this->tip' $style>$this->value</textarea>\n");
		} else {
			$this->addHtml("<textarea id='$this->name' name='$this->name' cols=$this->col rows=$this->row $style>$this->value</textarea>\n");
		}
 		$this->addHtml("<script type='text/javascript'>buttonPath = 'images/buttons/';imageBrowse = 'whizzypic.php'; ;  makeWhizzyWig('$this->name','all')</script>");

		return($this->toString());

	}
}
?>
