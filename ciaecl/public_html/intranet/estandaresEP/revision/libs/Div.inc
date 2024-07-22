<?
class Div extends Frame {

	var $className = "Div";
	var $tip       = "";
	var $class     = "div";

	function Div($name,$c,$r) {
		$this->name = $name;
		parent::Frame($c,$r);
	}

	function toHtml() {
		$this->cleanHtml();
		$this->addHtml("<div class='$this->class' id='$this->name' style='$this->style'>\n");
		parent::toHtml();
		$this->addHtml("</div>\n");
		return($this->toString());
	}
}
?>
